<?php

namespace App\Models;

use App\Filters\Transaction\TransactionFilters;
use App\Models\Clearance;
use App\Models\User;
use App\Traits\BelongsToUser;
use App\Traits\MorphOneCommission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Microservice\PreTransaction;

class TransactionEvent extends Model
{
    use BelongsToUser, MorphOneCommission;
    protected $table = 'transaction_events';
    protected $connection = 'dpaisa';
    protected $guarded = [];
    //protected $with = ['current_balance'];

    protected $appends = ["fee", "cashback_amount"];


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

    /**
     * @param $balance
     * @return float|int
     */
    public function getBonusBalanceAttribute($balance)
    {
        return ($balance/100);
    }

    public function getCashbackAmountAttribute(){

        return optional($this->commission)->transactions->amount ?? 0;
    }


    public function getFeeAttribute()
    {
        switch ($this->transaction_type) {
            case NchlLoadTransaction::class:
                if ($this->amount <= 500) {
                    return 2;
                }elseif ($this->amount >= 501 && $this->amount <= 50000) {
                    return 5;
                }elseif ($this->amount >= 50001) {
                    return 10;
                }
            case NpsLoadTransaction::class:
                if ($this->amount >= 10 && $this->amount <= 1000) {
                    return (0.5 / 100) * $this->amount;
                }elseif ($this->amount >= 1001) {
                    return 7;
                }
            case UserLoadTransaction::class:
                if ($this->vendor == "SCT") {
                    if ($this->amount >= 1 && $this->amount <= 5000) {
                        return 5;
                    } elseif ($this->amount >= 5001 && $this->amount <= 15000) {
                        return 10;
                    }elseif ($this->amount >= 15001) {
                        return 25;
                    }
                }

                if ($this->amount >= 1 && $this->amount <= 1000 ) {
                    return (0.5/100) * $this->amount;
                } elseif ($this->amount >= 1001 && $this->amount <= 15000) {
                    return 6;
                } elseif ($this->amount >= 15001) {
                    return 7;
                }
            case NchlBankTransfer::class:
            case NchlAggregatedPayment::class:
                if ($this->amount <= 500) {
                    return 2;
                }elseif ($this->amount >= 501 && $this->amount <= 5000) {
                    return 5;
                }elseif ($this->amount >= 5001 && $this->amount <= 50000) {
                    return 10;
                } elseif ($this->amount >= 50001 ) {
                    return 15;
                }
            default:
                return 0;
        }
    }

   /* public function getCurrentBalanceAttribute(){
        return $this->attributes['balance'] / 100;
    }*/

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new TransactionFilters($request))->add($filters)->filter($builder);
    }

    public function transactionable()
    {
        return $this->morphTo('transactionable', 'transaction_type', 'transaction_id');
    }

    public function clearances()
    {
        return $this->belongsToMany(Clearance::class, 'clearance_transaction_event', 'transaction_event_id')->withTimestamps();
    }

    public function totalTransactionAmountByUser($id){
        $totalAmount = $this->where('user_id', $id)->sum("amount");
        $user = User::find($id);
        if($user){
            $user->totalAmount = $totalAmount;
        }
        return $user;
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function selectedMonthTransactions($year, $month, $transactionType)
    {
        return $this->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->whereTransactionType($transactionType)
            ->with('transactionable')
            ->get();
    }

    public function refundTransaction()
    {
        return $this->hasOne(LoadTestFund::class, 'pre_transaction_id', 'pre_transaction_id');
    }

    public function preTransaction(){
        return $this->hasMany(PreTransaction::class,"pre_transaction_id",'pre_transaction_id');
    }

    public function preTransactionMicroservice(){
        return $this->belongsTo(PreTransaction::class,'pre_transaction_id','pre_transaction_id');
    }

}
