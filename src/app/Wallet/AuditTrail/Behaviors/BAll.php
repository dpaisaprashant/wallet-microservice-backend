<?php


namespace App\Wallet\AuditTrail\Behaviors;


use App\Models\FundRequest;
use App\Models\Microservice\PreTransaction;
use App\Models\Microservice\RequestInfo;
use App\Models\UsedUserReferral;
use App\Models\User;
use App\Models\UserCheckPayment;
use App\Models\UserLoadTransaction;
use App\Models\UserToUserFundTransfer;
use App\Models\UserTransaction;
use App\Wallet\AuditTrail\Interfaces\IAuditTrail;
use App\Wallet\Commission\Models\Commission;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BAll implements IAuditTrail
{

    private $request;

    /**
     * @param mixed $request
     * @return BAll
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function createTrial($user)
    {
        $preTransactions = $user->preTransactions()->whereUserId($user->id)->filter($this->request)->get();
        $requestInfo = $user->requestInfos()->whereUserId($user->id)->filter($this->request)->get();

        //$userLoadTransactions = $user->userLoadTransactions()->whereUserId($user->id)->filter($this->request)->get();
        $userLoginHistories = $user->userLoginHistories()->whereUserId($user->id)->filter($this->request)->get();
        //$userTransactions = $user->userCheckPayment()->whereUserId($user->id)->filter($this->request)->get();
        $fromFundTransfers = $user->fromFundTransfers()->whereFromUser($user->id)->filter($this->request)->get();
        $receiveFundTransfers = $user->receiveFundTransfers()->whereToUser($user->id)->filter($this->request)->get();
        $fromFundRequest = $user->fromFundRequests()->whereFromUser($user->id)->filter($this->request)->get();
        $receiveFundRequest = $user->receiveFundRequests()->whereToUser($user->id)->filter($this->request)->get();

        //$nchlBankTransfer = $user->nchlBankTransfers()->whereUserId($user->id)->filter($this->request)->get();
        //$nchlLoadTransaction = $user->nchlLoadTransactions()->whereUserId($user->id)->filter($this->request)->get();
        //$merchantTransaction = $user->merchantTransactions()->get();
        //$nicAsiaCyberSourceTransactions = $user->nicAsiaCyberSourceTransactions()->whereUserId($user->id)->filter($this->request)->get();


        //$merchantTransaction = $user->merchantTransactions()->get();

        $cashBack = $user->userCashBack()->filter($this->request)->get();
        $commission = $user->userCommission()->filter($this->request)->get();
        $kycFilled = $user->kyc()->whereUserId($user->id)->filter($this->request)->get();
        $kycAcceptReject =[];
        if (count($kycFilled)) {
            $kycAcceptReject = $user->userAcceptRejectKyc()->filter($this->request)->get() ;
        }
        $activities = $user->activities()->filter($this->request)->get();
        $loadTestFunds = $user->loadTestFunds()->filter($this->request)->get();

        $referralFrom = $user->referralFrom()->whereReferredFrom($user->id)->get();
        $referralTo = $user->referralTo()->whereReferredTo($user->id)->get();

        $referralBonus = $user->userReferralBonusTransactions()->whereUserId($user->id)/*->filter($this->request)*/->get();

        //from Fund Request and receiveFundRequest

        $preTransactions->transform(function ($value){
            $value['created_at'] = $value['updated_at'];
            return $value;
        });

        $requestInfo->transform(function ($value){
            $value['created_at'] = $value['updated_at'];
            return $value;
        });

        $fromFundRequest->transform(function ($value){
            $value['created_at'] = $value['updated_at'];
            return $value;
        });

        $receiveFundRequest->transform(function ($value){
            $value['created_at'] = $value['updated_at'];
            return $value;
        });

       /* $userLoadTransactions->transform(function ($value){
            $value['created_at'] = $value['updated_at'];
            return $value;
        });*/

        //add 1sec to cashback
        $cashBack->transform(function ($value) {
            $newDate = Carbon::parse($value['created_at'])->addSeconds(1);
            $value['created_at'] = $newDate;
            return $value;
        });

        $commission->transform(function ($value) {
            $newDate = Carbon::parse($value['created_at'])->addSeconds(1);
            $value['created_at'] = $newDate;
            return $value;
        });

        $referralBonus->transform(function ($value) {
            $newDate = Carbon::parse($value['created_at'])->addSeconds(2);
            $value['created_at'] = $newDate;
            return $value;
        });

        $referralFrom->transform(function ($value) {
            $newDate = Carbon::parse($value['created_at'])->addSeconds(2);
            $value['created_at'] = $newDate;
            return $value;
        });

        $referralTo->transform(function ($value) {
            $newDate = Carbon::parse($value['created_at'])->addSeconds(2);
            $value['created_at'] = $newDate;
            return $value;
        });

        $collection = ($userLoginHistories)
            //->concat($userTransactions)
            ->concat($fromFundTransfers)
            ->concat($receiveFundTransfers)
            ->concat($fromFundRequest)
            ->concat($receiveFundRequest)
            //->concat($nchlBankTransfer)
            //->concat($nchlLoadTransaction)
            //->concat($nchlAggregatedPayments)
            ->concat($cashBack)
            ->concat($commission)
            ->concat($kycFilled)
            ->concat($kycAcceptReject)
            ->concat($activities)
            ->concat($loadTestFunds)
            ->concat($referralFrom)
            ->concat($referralTo)
            ->concat($preTransactions)
            ->concat($requestInfo)
            ->concat($referralBonus);
            //->concat($merchantTransaction);

        $balance = 0;
        $bonusBalance = 0;

        foreach ($collection->sortBy('created_at') as $event) {
            if ($event instanceof UserCheckPayment) { //paypoint
                $balance = $event->userTransaction->transactions->balance ?? $balance;
                $bonusBalance = $event->userTransaction->transactions->bonus_balance ?? $bonusBalance;
                $event['current_balance'] = $balance;
                $event['current_bonus_balance'] = $bonusBalance;

            } elseif ($event instanceof UserToUserFundTransfer) {
                $balance = $event->transactions()->where('user_id', $user->id)->first()->balance ?? $balance;
                $bonusBalance = $event->transactions()->where('user_id', $user->id)->first()->bonus_balance ?? $bonusBalance;
                $event['current_balance'] = $balance;
                $event['current_bonus_balance'] = $bonusBalance;

            }
            elseif ($event instanceof FundRequest) {
                $balance = $event->transactions()->where('user_id', $user->id)->first()->balance ?? $balance;
                $bonusBalance = $event->transactions()->where('user_id', $user->id)->first()->bonus_balance ?? $bonusBalance;
                $event['current_balance'] = $balance;
                $event['current_bonus_balance'] = $bonusBalance;
            }
            elseif ($event instanceof UsedUserReferral) {
                $balance = $event->transactions()->where('user_id', $user->id)->first()->balance ?? $balance;
                $bonusBalance = $event->transactions()->where('user_id', $user->id)->first()->bonus_balance ?? $bonusBalance;
                $event['current_balance'] = $balance;
                $event['current_bonus_balance'] = $bonusBalance;
            }
            elseif ($event instanceof PreTransaction) {
                $balance = $event->transactionEvent()->first()->balance ?? $balance;
                $bonusBalance = $event->transactionEvent()->first()->bonus_balance ?? $bonusBalance;
                $event['current_balance'] = $balance;
                $event['current_bonus_balance'] = $bonusBalance;
                //dd($event);
            }
            elseif ($event instanceof RequestInfo) {
                $event['current_balance'] = $balance;
                $event['current_bonus_balance'] = $bonusBalance;
                //dd($event);
            }
            else
            {
                $balance = $event->transactions->balance ?? $balance;
                $bonusBalance = $event->transactions->bonus_balance ?? $bonusBalance;
                $event['current_balance'] = $balance;
                $event['current_bonus_balance'] = $bonusBalance;
            }
        }

        $collection =  $collection->sortByDesc('created_at');

        return $collection;
    }
}
