<?php

namespace App\Models;

use App\Filters\FundTransfer\FundTransferFilters;
use App\Traits\MorphOneCommission;
use App\Wallet\Commission\Models\Commission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserToUserFundTransfer extends Model
{

    use MorphOneCommission;

    protected $table = "user_to_user_fund_transfers";
    protected $connection = 'dpaisa';

    /**
     * @param $amount
     * @return float|int
     */
    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }


    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new FundTransferFilters($request))->add($filters)->filter($builder);
    }


    public function transactions()
    {
        return $this->morphMany(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }



    public function fromUser()
    {
        return $this->belongsTo(User::class,'from_user','id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class,'to_user','id');
    }

    public function getFundTransfers()
    {
        return $this->with('fromUser', 'toUser', 'transactions');
    }
}
