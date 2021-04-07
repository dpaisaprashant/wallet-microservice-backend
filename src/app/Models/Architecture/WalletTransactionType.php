<?php

namespace App\Models\Architecture;

use Illuminate\Database\Eloquent\Model;

class WalletTransactionType extends Model
{
    protected $connection = 'dpaisa';
    protected $guarded = [];

    public function walletTransactionTypeable()
    {
        return $this->morphTo();
    }


    public function getTransactionModels()
    {
        return [
            'App\\Models\\FundRequest',
            'App\\Models\\UserToUserFundTransfer',
            'App\\Models\\LoadTestFund',
            'App\\Models\\MerchantTransaction',
            'App\\Models\\NchlAggregatedPayment',
            'App\\Models\\NchlBankTransfer',
            'App\\Models\\NchlLoadTransaction',
            'App\\Models\\UsedUserReferral',
            'App\\Models\\UserLoadTransaction',
            'App\\Models\\NICAsiaCyberSourceLoadTransaction',
            'App\\Models\\UserMerchantEventTicketPayment',
            'App\\Models\\UserTransaction',
            'App\\Wallet\\Commission\\Models\\Commission'
        ];
    }

    public function resolveWalletTransactionType($vendor, $transactionCategory = null, $serviceType = null, $service = null)
    {
        return $this->where('vendor', $vendor)
            ->where('transaction_category', $transactionCategory)
            ->where('service_type', $serviceType)
            ->where('service', $service)
            ->first();
    }

    public function walletTransactionTypeCashbacks()
    {
        return $this->hasMany(WalletTransactionTypeCashback::class);
    }
}
