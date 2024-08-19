<?php

namespace App\Models;

use App\Filters\FiltersAbstract;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneCommission;
use App\Traits\MorphOneDispute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Filters\UserTransaction\UserTransactionFilters;

class NepalQrTransaction extends Model
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
        return $this->morphOne(TransactionEvent::class, 'transactionable', 'transaction_type', 'transaction_id');
    }

    public function clearanceTransactions()
    {
        return $this->morphOne(ClearanceTransaction::class, 'clearanceable', 'transaction_type', 'transaction_id');
    }

    public function checkTransaction()
    {
        return $this->hasOne(UserCheckPayment::class, "refStan", "refStan");
    }

    public function executeTransaction()
    {
        return $this->hasMany(UserExecutePayment::class, "refStan_request", "refStan");
    }

    public function excelTransaction()
    {
        return $this->hasOne(PaypointToDpaisaClearanceTransaction::class, 'refStan', 'refStan');
    }

    public function getFailedUserTransactions()
    {
        $successfulTransactionId = $this->pluck('refStan')->all();
        return UserCheckPayment::with('user', 'userExecutePayment')->whereNotIn('refStan', $successfulTransactionId); //50
    }

    public function getCompleteUserTransactions()
    {
        $successfulTransactionId = $this->pluck('refStan')->all();
        return UserCheckPayment::with('user', 'userExecutePayment')->whereIn('refStan', $successfulTransactionId); //50
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

