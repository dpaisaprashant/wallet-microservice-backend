<?php


namespace App\Wallet\AuditTrail\Behaviors;


use App\Models\Merchant\Merchant;
use App\Models\User;
use App\Wallet\AuditTrail\Interfaces\IAuditTrail;
use App\Wallet\AuditTrail\Interfaces\IAuditTrailMerchant;
use Carbon\Carbon;

class BMerchant implements IAuditTrail
{
    private $request;

    /**
     * @param mixed $request
     * @return BMerchant
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
    public function createTrial($merchant)
    {
        $merchantLoginAttempts = $merchant->loginAttempts()->get();
        $kycFilled = $merchant->kyc()->whereMerchantId($merchant->id)->get();
        $kycAcceptReject =[];
        if (count($kycFilled)) {
            $kycAcceptReject = $merchant->merchantAcceptRejectKyc()->get() ;
        }
        $nchlLoadTransaction = $merchant->nchlLoadTransactions()->get();
        $nchlBankTransfer = $merchant->nchlBankTransfers()->get();
        $merchantTransaction = $merchant->merchantTransaction()->get();

        $commission = $merchant->merchantCommission()->filter($this->request)->get();

        $commission->transform(function ($value) {
            $newDate = Carbon::parse($value['created_at'])->addSeconds(1);
            $value['created_at'] = $newDate;
            return $value;
        });

        $collection = $nchlLoadTransaction
            ->concat($nchlBankTransfer)
            ->concat($merchantTransaction)
            ->concat($merchantLoginAttempts)
            ->concat($kycFilled)
            ->concat($kycAcceptReject)
            ->concat($commission);

        $balance = 0;
        foreach ($collection->sortBy('created_at') as $event) {

                $balance = $event->merchantTransactions->balance ?? $balance;
                $event['current_balance'] = $balance;
        }

        $collection =  $collection->sortByDesc('created_at');

        return $collection;
    }
}
