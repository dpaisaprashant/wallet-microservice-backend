<?php

namespace App\Listeners;

use App\Events\UserBonusWalletPaymentEvent;
use App\Events\UserBonusWalletUpdateEvent;
use App\Events\UserWalletPaymentEvent;
use App\Events\UserWalletUpdateEvent;
use App\Models\CashbackPull;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\Wallet;
use App\Wallet\Helpers\TransactionIdGenerator;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoadTestFundListener
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $preTransactionId = $event->transaction->pre_transaction_id ?? null;

        $vendor = $event->vendor
            ?: ($preTransactionId ? "REFUND" : "TEST FUND");

        $serviceType = $event->serviceType
            ?: ($preTransactionId ? "REFUND" : "LOAD_TEST_FUND");

        $uid  = $event->serviceType
            ?: ($preTransactionId ? "REFUND" : "LOAD-TEST-FUND");

        $currentBalance = Wallet::whereUserId($event->transaction->user_id)->first()->balance * 100;
        $currentBonusBalance = Wallet::whereUserId($event->transaction->user_id)->first()->bonus_balance * 100;
        $amount = $event->transaction->amount * 100;
        $bonusAmount = $event->transaction->bonus_amount * 100;
        $loadTransactionEvent = $event->transaction->transactions()->create([
            "account" => $event->transaction->user->mobile_no,
            "amount" => $amount + $bonusAmount,
            "vendor" => $vendor,
            "user_id" => $event->transaction->user_id,
            "description" => $event->transaction->description,
            "service_type" => $serviceType,
            "balance" => $currentBalance + $amount ,
            "bonus_balance" => $currentBonusBalance + $bonusAmount,
            "uid" => $event->transaction->pre_transaction_id
                ? $uid . "-" . TransactionIdGenerator::generateAlphaNumeric(7)
                : $uid . '-' . TransactionIdGenerator::generateAlphaNumeric(7),
            "account_type" => "credit",
            "refund_pre_transaction_id" => $preTransactionId
        ]);

        if ($preTransactionId) {
            DB::connection("dpaisa")->table("transaction_events")
                ->where("pre_transaction_id", $preTransactionId)
                ->whereNotNull("pre_transaction_id")
                ->where("service_type", "!=", "REFUND")
                ->update(["refund_id" => $event->transaction->id]);

            DB::connection("dpaisa")->table("pre_transactions")
                ->where('pre_transaction_id', $preTransactionId)
                ->update(["refund_id" =>  $event->transaction->id]);

           /* TransactionEvent::where("pre_transaction_id", $preTransactionId)
                ->whereNotNull("pre_transaction_id")
                ->where("service_type", "!=", "REFUND")
                ->update(["refund_id" => $event->transaction->id]);*/

            /*PreTransaction::where('pre_transaction_id', $preTransactionId)
                ->update(["refund_id" =>  $event->transaction->id]);*/
        }


        Log::info("=============================REFUND======================================");
        Log::info("user id: " . $event->transaction->user_id);
        Log::info("main balance refund: " . $amount);
        Log::info("bonus balance refund: " . $bonusAmount);
        Log::info("=========================================================================");


        if ($amount > 0) {
            event(new UserWalletUpdateEvent($event->transaction->user_id, $amount));
        }

        if ($bonusAmount) {
            event(new UserBonusWalletUpdateEvent($event->transaction->user_id, $bonusAmount));
        }


        //pull cashback
        if ($preTransactionId && $serviceType == "REFUND") {
            if (isset(request()->pull_cashback) && request()->pull_cashback == "on") {
                //PULL CASHBACK
                $refundedTransaction = TransactionEvent::where('pre_transaction_id', $preTransactionId)
                    ->with('commission', 'commission.transactions')
                    ->first();

                Log::info("Refunded Transaction", [$refundedTransaction]);
                if ($commissionTransaction = optional($refundedTransaction->commission)->transactions) {
                    if ($commissionTransaction->service_type = "CASHBACK") {

                        $amountInPaisa = $commissionTransaction->amount * 100;
                        $user = User::with('wallet')
                            ->where('id', $event->transaction->user_id)
                            ->first();


                        $userBonusBalance = $user->wallet->bonus_balance * 100;
                        $userMainBalance = $user->wallet->balance * 100;

                        if ($userBonusBalance >= $amountInPaisa) {
                            $amountToDeductFromBonusBalance = $amountInPaisa;
                            $amountToDeductFromMainBalance = 0;
                        } else {
                            $amountToDeductFromBonusBalance = $userBonusBalance;
                            $amountToDeductFromMainBalance = $amountInPaisa - $userBonusBalance;
                        }

                        if ($amountToDeductFromMainBalance > $userMainBalance) {
                            Log::error("Error while pulling cashback from user main balance");
                            Log::info("amountToDeductFromMainBalance: " . $amountToDeductFromMainBalance);
                            Log::info("userMainBalance: " . $userMainBalance);
                            return;
                        }

                        if ($amountToDeductFromBonusBalance > $userBonusBalance) {
                            Log::error("Error while pulling cashback from user main bonus balance");
                            Log::info("amountToDeductFromBonusBalance: " . $amountToDeductFromBonusBalance);
                            Log::info("userBonusBalance: " . $userBonusBalance);
                            return;
                        }

                        $cashbackPullPreTransaction = PreTransaction::create([
                            'pre_transaction_id' => TransactionIdGenerator::generate(),
                            'amount' => $amountInPaisa,
                            'description' => "Cashback pull for transaction: {$preTransactionId}, cashback transaction id: {$commissionTransaction->id}",
                            'vendor' => 'WALLET',
                            'service_type' => 'CASHBACK_PULL',
                            'microservice_type' => 'WALLET',
                            'transaction_type' => 'debit',
                            'url' => '/cashback-pull',
                            "user_id" => $user->id,
                            "before_balance" => $userMainBalance,
                            "after_balance" => $userMainBalance - $amountToDeductFromMainBalance,
                            "before_bonus_balance" => $userBonusBalance,
                            "after_bonus_balance" => $userBonusBalance - $amountToDeductFromBonusBalance,
                            'json_response' => json_encode(request()->all()),
                            'status' => PreTransaction::STATUS_SUCCESS,
                            'created_at' => Carbon::now()->addSecond()->format("Y-m-d H:i:s.u"),
                            'updated_at' => Carbon::now()->addSecond()->format("Y-m-d H:i:s.u")
                        ]);

                        $cashbackPull = CashbackPull::create([
                            "user_id" => $user->id,
                            "admin_id" => optional(auth()->user())->id,
                            "pre_transaction_id" => $cashbackPullPreTransaction->pre_transaction_id,
                            "refunded_pre_transaction_id" => $preTransactionId,
                            "refunded_transaction_event_id" => $refundedTransaction->id,
                            "pulled_cashback_transaction_event_id" => $commissionTransaction->id,
                            "pulled_cashback_commission_id" => $refundedTransaction->commission->id,
                            "amount" => $amountInPaisa,
                            "before_balance" => $cashbackPullPreTransaction['before_balance'],
                            "after_balance" => $cashbackPullPreTransaction['after_balance'],
                            "before_bonus_balance" => $cashbackPullPreTransaction['before_bonus_balance'],
                            "after_bonus_balance" => $cashbackPullPreTransaction['after_bonus_balance'],
                            "description" => "Cashback pull for transaction: {$preTransactionId}",
                            'created_at' => Carbon::now()->addSecond()->format("Y-m-d H:i:s.u"),
                            'updated_at' => Carbon::now()->addSecond()->format("yY-m-d H:i:s.u")
                        ]);

                        $cashbackPull->transactions()->create([
                            "account" => $event->transaction->user->mobile_no,
                            "amount" => $amountInPaisa,
                            "vendor" => "CASHBACK_PULL",
                            "user_id" => $user->id,
                            "description" => "Cashback pull for transaction: {$preTransactionId}",
                            "service_type" => "CASHBACK_PULL",
                            "balance" => $cashbackPull['after_balance'] ,
                            "bonus_balance" => $cashbackPull['after_bonus_balance'],
                            "uid" =>  'CASHBACK_PULL-' . TransactionIdGenerator::generateAlphaNumeric(7),
                            "account_type" => "debit",
                            "refund_pre_transaction_id" => $cashbackPullPreTransaction->pre_transaction_id,
                            "pre_transaction_id" => $cashbackPullPreTransaction->pre_transaction_id,
                            'created_at' => Carbon::now()->addSecond()->format("Y-m-d H:i:s.u"),
                            'updated_at' => Carbon::now()->addSecond()->format("Y-m-d H:i:s.u")
                        ]);

                        $user->load('wallet');
                        Log::info("Wallet info before cashback pull main balance", ["main_balance" => $user->wallet->balance]);
                        Log::info("Wallet info before cashback pull bonus balance", ["bonus_balance" => $user->wallet->balance]);
                        Log::info("==========================================================================");
                        Log::info("amountToDeductFromMainBalance: " . $amountToDeductFromMainBalance);
                        Log::info("amountToDeductFromBonusBalance: " . $amountToDeductFromBonusBalance);


                        if ($amountToDeductFromBonusBalance > 0) {
                            //DB::commit();
                            event(new UserBonusWalletPaymentEvent($event->transaction->user_id, $amountToDeductFromBonusBalance));
                        }

                        if ($amountToDeductFromMainBalance > 0) {
                            //DB::commit();
                            event(new UserWalletPaymentEvent($event->transaction->user_id, $amountToDeductFromMainBalance));
                        }

                    }
                }
            }
        }
    }
}
