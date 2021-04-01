<?php

namespace App\Models;

use App\Filters\MerchantTransactionEvent\MerchantTransactionEventFilters;
use App\Traits\BelongsToMerchant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class MerchantTransactionEvent extends Model
{
    use BelongsToMerchant;

    protected $connection = 'dpaisa';

    protected $guarded = [];
    //protected $with = ['current_balance'];
    /**
     * @param $amount
     * @return float|int
     */
    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    /**
     * @param $balance
     * @return float|int
     */
    public function getBalanceAttribute($balance)
    {
        return ($balance/100);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new MerchantTransactionEventFilters($request))->add($filters)->filter($builder);
    }

    public function transactionable()
    {
        return $this->morphTo('transactionable', 'transaction_type', 'transaction_id');
    }
}
