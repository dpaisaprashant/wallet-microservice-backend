<?php

namespace App;

use App\Filters\FiltersAbstract;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneCommission;
use App\Traits\MorphOneDispute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Filters\UserTransaction\UserTransactionFilters;

use Illuminate\Database\Eloquent\Model;

class NPIBillerTransaction extends Model
{
    use BelongsToUseThroughMicroservice, BelongsToUser, MorphOneCommission, MorphOneDispute;

    //protected $table = 'user_transactions';
    protected $connection = 'dpaisa';
    /**
     * @param $amount
     * @return float|int
     */
    public function getAmountAttribute($amount)
    {
        return ($amount / 100);
    }

    protected $casts = [
        "amount" => "number"
    ];

    public function transactions()
    {   
        return $this->morphMany(TransactionEvent::class, 'transaction_id');
    }


    public function getCommission()
    {
        return $this->commission ? $this->commission->commissionAmount() : 0;
    }

    public function getCashback()
    {
        return $this->commission ? $this->commission->cashbackAmount() : 0;
    }

    public function getTransactionFee()
    {
        if ($this->checkTransaction->transaction_fee_type == 'FLAT') {
            return round($this->checkTransaction->transaction_fee_amount / 100, 3);
        } elseif ($this->checkTransaction->transaction_fee_type == 'PERCENTAGE') {
            return round(($this->checkTransaction->transaction_fee_amount / 100) * $this->amount, 3);
        }
        return 0;
    }

    public function getTotalCommission($transactions)
    {
        $totalCommission = 0;
        foreach ($transactions as $transaction) {
            $totalCommission += $transaction->getCommission();
        }
        return round($totalCommission, 3);
    }

    public function getTotalCashback($transactions)
    {
        $totalCommission = 0;
        foreach ($transactions as $transaction) {
            $totalCommission += $transaction->getCashback();
        }
        return round($totalCommission, 3);
    }

    public function getTotalTransactionFee($transactions)
    {
        $totalCommission = 0;
        foreach ($transactions as $transaction) {
            $totalCommission += $transaction->getTransactionFee();
        }
        return round($totalCommission, 3);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        (new UserTransactionFilters($request))->add($filters)->filter($builder);
    }
}
