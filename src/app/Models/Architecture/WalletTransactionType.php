<?php

namespace App\Models\Architecture;

use App\Filters\WalletTransactionType\WalletTransactionTypeFilters;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\Activitylog\Traits\LogsActivity;

class WalletTransactionType extends Model
{
    CONST LIMIT_TYPE_LOAD = 'LOAD';
    CONST LIMIT_TYPE_BANK_TRANSFER = 'BANK_TRANSFER';

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

    public function getCachedWalletVendors()
    {
        //retrieves from cache, if not in cache adds the query to cache
        return Cache::remember('walletVendors', 86400, function () {
            return  $this->groupBy('vendor')->pluck('vendor')->toArray();
        });
    }

    public function getCachedWalletServiceTypes()
    {
        return Cache::remember('walletServiceTypes', 86400, function () {
            return $this->groupBy('service_type')->pluck('service_type')->toArray();
        });
    }

    public function resolveWalletTransactionType($vendor, $transactionCategory = null, $serviceType = null, $service = null)
    {
        return $this->where('vendor', $vendor)
            ->where('transaction_category', $transactionCategory)
            ->where('service_type', $serviceType)
            ->where('service', $service)
            ->first();
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = []){
        return (new WalletTransactionTypeFilters($request))->add($filters)->filter($builder);
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

    public function walletTransactionTypeMerchantRevenue(){
        return $this->hasMany(WalletTransactionTypeMerchantRevenue::class);
    }

    public function getLoadTransactionModels()
    {
        return $this->where("limit_type", self::LIMIT_TYPE_LOAD)
            ->groupBy("transaction_type")
            ->pluck("transaction_type")
            ->toArray();
    }

    public function getBankTransferTransactionModels()
    {
        return $this->where("limit_type", self::LIMIT_TYPE_BANK_TRANSFER)
            ->groupBy("transaction_type")
            ->pluck("transaction_type")
            ->toArray();
    }

}
