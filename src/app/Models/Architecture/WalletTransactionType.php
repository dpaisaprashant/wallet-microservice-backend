<?php

namespace App\Models\Architecture;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class WalletTransactionType extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Wallet Transaction Type';

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

    public function walletTransactionTypeCommissions()
    {
        return $this->hasMany(WalletTransactionTypeCommission::class);
    }

    public function singleUserCashbacks()
    {
        return $this->hasMany(SingleUserCashback::class);
    }

    public function singleUserCommissions()
    {
        return $this->hasMany(SingleUserCommission::class);
    }

    public function walletServices()
    {
        return $this->hasMany(WalletService::class);
    }

    public function walletTransactionBonus(){
        return $this->hasMany(WalletTransactionBonus::class);
    }
}
