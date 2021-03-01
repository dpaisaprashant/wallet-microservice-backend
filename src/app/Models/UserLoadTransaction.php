<?php

namespace App\Models;

use App\Filters\EBanking\EBankingFilters;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneCommission;
use App\Traits\MorphOneDispute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserLoadTransaction extends Model
{

    use BelongsToUser, MorphOneDispute, MorphOneCommission, BelongsToUseThroughMicroservice;

    protected $table = "user_load_transactions";
    protected $connection = 'npay';

    const STATUS_COMPLETED = 'COMPLETED';

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function getTransactionFeeAttribute($transactionFee)
    {
        return ($transactionFee/100);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new EBankingFilters($request))->add($filters)->filter($builder);
    }

    public function clearanceTransactions()
    {
        return $this->morphOne(ClearanceTransaction::class, 'clearanceable', 'transaction_type', 'transaction_id');
    }

    public function transactions()
    {
        return $this->morphOne(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }

    public function loadTransactionResponse()
    {
        return $this->hasOne(LoadTransactionResponse::class, 'load_id', 'id');
    }

    public function getFailedUserLoadTransaction()
    {
        return $this->with('user', 'loadTransactionResponse')->where('status', '!=', 'COMPLETED');
    }

    public function getCommission()
    {
        return $this->commission ? $this->commission->getCommission() : 0;
    }

    public function getCashback()
    {
        return $this->commission ? $this->commission->getCashback() : 0;
    }

    public function getTransactionFee()
    {
        return $this->transaction_fee ?? 0;
    }

    public function getTotalCommission($transactions)
    {
        $totalCommission = 0;
        foreach ($transactions as $transaction) {
            $totalCommission += $transaction->getCommission();
        }
        return $totalCommission;
    }

    public function getTotalCashback($transactions)
    {
        $totalCommission = 0;
        foreach ($transactions as $transaction) {
            $totalCommission += $transaction->getCashback();
        }
        return $totalCommission;
    }

    public function getTotalTransactionFee($transactions)
    {
        $totalCommission = 0;
        foreach ($transactions as $transaction) {
            $totalCommission += $transaction->getTransactionFee();
        }
        return $totalCommission;
    }
}
