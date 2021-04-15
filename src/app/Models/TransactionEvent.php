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

class TransactionEvent extends Model
{
    use BelongsToUser, MorphOneCommission;

    protected $table = 'transaction_events';
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

    /**
     * @param $balance
     * @return float|int
     */
    public function getBonusBalanceAttribute($balance)
    {
        return ($balance/100);
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

    public function selectedMonthTransactions($year, $month, $transactionType)
    {
        return $this->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->whereTransactionType($transactionType)
            ->with('transactionable')
            ->get();
    }

}
