<?php


namespace App\Wallet\Merchant\Repositories;


use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantKYC;
use App\Models\MerchantTransaction;
use Illuminate\Http\Request;

class MerchantStatsRepository
{
    public function validKYCMerchantCount()
    {
        return MerchantKYC::where('accept', 1)->count();
    }

    public function invalidKYCMerchantCount()
    {
        return Merchant::count() - $this->validKYCMerchantCount();
    }

    public function successfulMerchantTransactionCount()
    {
        return MerchantTransaction::where('status', MerchantTransaction::STATUS_COMPLETE)->count();
    }

    public function successfulMerchantTransactionSum()
    {
        return MerchantTransaction::where('status', MerchantTransaction::STATUS_COMPLETE)->sum('amount') / 100;
    }
}
