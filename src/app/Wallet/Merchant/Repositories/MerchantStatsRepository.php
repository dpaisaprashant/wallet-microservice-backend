<?php


namespace App\Wallet\Merchant\Repositories;


use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantKYC;
use App\Models\MerchantTransaction;
use App\Models\UserKYC;
use Illuminate\Http\Request;
use App\Models\User;

class MerchantStatsRepository
{
    public function validKYCMerchantCount()
    {

        //merchant with accepted kyc
        return User::with('merchant','kyc')->whereHas('merchant')->whereHas('kyc',function($query){
            $query->where('accept',1);
        })->count();

    }

    public function invalidKYCMerchantCount()
    {
        return 0;
        //merchant with invalid kyc or not filled kyc
        return Merchant::count() - $this->validKYCMerchantCount();
    }

    public function successfulMerchantTransactionCount()
    {
        return 0;
        return MerchantTransaction::where('status', MerchantTransaction::STATUS_COMPLETE)->count();
    }

    public function successfulMerchantTransactionSum()
    {
        return 0;
        return MerchantTransaction::where('status', MerchantTransaction::STATUS_COMPLETE)->sum('amount') / 100;
    }
}
