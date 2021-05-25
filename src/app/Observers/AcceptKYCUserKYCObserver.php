<?php

namespace App\Observers;

use App\Events\UserBonusWalletUpdateEvent;
use App\Events\UserWalletUpdateEvent;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserKYC;
use App\Models\UserReferralBonusTransaction;
use App\Notifications\ReferralAcceptedBonusNotification;
use App\Notifications\ReferralUsedBonusNotification;
use App\Wallet\Helpers\TransactionIdGenerator;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AcceptKYCUserKYCObserver
{
    /**
     * Handle the UserKYC "updated" event.
     *
     * @param UserKYC $kyc
     * @return void
     */
    public function updated(UserKYC $kyc)
    {
        DB::commit();
        try {
            $referralService = Setting::where('option', 'referral_service_enable')->first()->value ?? 0;

            $generalNewKycAccept = Setting::where('option', 'referral_new_user_amount_on_kyc_accept')->first()->value ?? 0;
            $generalOldKycAccept = Setting::where('option', 'referral_old_user_amount_on_kyc_accept')->first()->value ?? 0;
            if ($referralService == 0 ) {
                return;
            }

            DB::beginTransaction();
            if ($kyc->accept == 1) {
                $userOldBonus = UserReferralBonusTransaction::where('user_id', $kyc->user_id)
                    ->where('referred_from', '!=', null)
                    ->where('type', UserReferralBonusTransaction::TYPE_KYC_VERIFIED)
                    ->count();

                Log::info("KYC ACCEPT BONUS: " . $userOldBonus);

                if ($userOldBonus == 0) {
                    $user = User::where('id', $kyc->user_id)->first();
                    $referredByUser = $user->referredByUser();

                    if (empty($referredByUser)) return;

                    if ($referredByUser && $user) {
                        $registrationDate = Carbon::parse($user->created_at);
                        $phoneVerifiedDate = Carbon::parse($user->phone_verified_at);

                        $differenceInSec = $registrationDate->diffInSeconds($phoneVerifiedDate);

                        if ($differenceInSec > 10 * 60) {
                            return;
                        }
                    }

                    $kycAcceptedAmount = optional($referredByUser->userReferralBonus)->code_user_kyc_accept_value  === null
                        ? $generalNewKycAccept
                        : optional($referredByUser->userReferralBonus)->code_user_kyc_accept_value ?? 0;

                    if (! empty($kycAcceptedAmount) && $kycAcceptedAmount != 0) {
                        Log::info("kycAcceptedAmount: " . $kycAcceptedAmount);
                        $transaction = UserReferralBonusTransaction::create([
                            'user_id' => $user->id,
                            'referred_from' => $user->referredByUserId(),
                            'referred_to' => null,
                            'type' => UserReferralBonusTransaction::TYPE_KYC_VERIFIED,
                            'amount' => $kycAcceptedAmount,
                            'description' => 'KYC verified transaction bonus'
                        ]);

                        $transaction->transactions()->create([
                            'amount' => $kycAcceptedAmount,
                            'account' => $user->mobile_no,
                            'description' => $transaction->description,
                            'vendor' => 'REFERRAL',
                            'service_type' => /*$transaction->type*/ 'REFERRAL',
                            'uid' => 'REFERRAL-' . TransactionIdGenerator::generateAlphaNumeric(),
                            'balance' => $user->wallet->getOriginal('balance') + $kycAcceptedAmount,
                            'bonus_balance' => $user->wallet->getOriginal('bonus_balance') + $kycAcceptedAmount,
                            'user_id' => $user->id,
                        ]);

                        event(new UserBonusWalletUpdateEvent($user->id, $kycAcceptedAmount));

                        try {
                            if ($user->mobile_no != 9819210396) {
                                $user->notify(new ReferralUsedBonusNotification($user, $referredByUser, UserReferralBonusTransaction::TYPE_KYC_VERIFIED, $kycAcceptedAmount));
                            }
                        }catch (\Exception $e) {
                            Log::info($e);
                            Log::info("Could not send notification to user");
                        }

                    }


                    if ($referredByUser) {

                        $referredByKycAcceptAmount = optional($referredByUser->userReferralBonus)->code_owner_kyc_accept_value === null
                            ? $generalOldKycAccept
                            : optional($referredByUser->userReferralBonus)->code_owner_kyc_accept_value ?? 0;

                        if (!empty($referredByKycAcceptAmount) || $referredByKycAcceptAmount != 0) {
                            $transaction = UserReferralBonusTransaction::create([
                                'user_id' => $referredByUser->id,
                                'referred_from' => null,
                                'referred_to' => $user->id,
                                'type' => UserReferralBonusTransaction::TYPE_KYC_VERIFIED,
                                'amount' => $referredByKycAcceptAmount,
                                'description' => 'Referred to KYC verified transaction bonus'
                            ]);

                            $transaction->transactions()->create([
                                'amount' => $referredByKycAcceptAmount,
                                'account' => $referredByUser->mobile_no,
                                'description' => $transaction->description,
                                'vendor' => 'REFERRAL',
                                'service_type' => /*$transaction->type*/ 'REFERRAL',
                                'uid' => 'REFERRAL-' . TransactionIdGenerator::generateAlphaNumeric(),
                                'balance' => $referredByUser->wallet->getOriginal('balance'),
                                'bonus_balance' => $referredByUser->wallet->getOriginal('bonus_balance') + $referredByKycAcceptAmount,
                                'user_id' => $referredByUser->id,

                            ]);

                            event(new UserBonusWalletUpdateEvent($referredByUser->id, $referredByKycAcceptAmount));

                            try {
                                if ($referredByUser->mobile_no != 9819210396) {
                                    $referredByUser->notify(new ReferralAcceptedBonusNotification($user, $referredByUser, UserReferralBonusTransaction::TYPE_KYC_VERIFIED, $referredByKycAcceptAmount));
                                }
                            }catch (\Exception $e) {
                                Log::info($e);
                                Log::info("Could not send notification to referred by user");
                            }
                        }
                    }
                }
            }

        } catch (\Exception $e) {
            Log::info($e);
            Log::error("Error while providing referral bonus on kyc verify");
            DB::rollBack();
        }
    }
}
