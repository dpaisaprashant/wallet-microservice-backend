<?php

namespace App\Models;

use App\Filters\CellPayUserTransactions\CellPayUserTransactionFilters;
use App\Filters\FiltersAbstract;
use App\Filters\Khalti\KhaltiFilters;
use App\Models\Microservice\PreTransaction;
use App\Traits\BelongsToPreTransaction;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneCommission;
use App\Traits\MorphOneDispute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CellPayUserTransaction extends Model
{
    use BelongsToUseThroughMicroservice, BelongsToUser, MorphOneCommission, MorphOneDispute;

    protected $connection = 'cellpay';
    protected $guarded = [];
    protected $table = 'cell_pay_execute_payments';

    /**
     * @param $amount
     * @return float|int
     */
    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    protected $casts = [
        "amount" => "number"
    ];

    public function transactions()
    {
        return $this->morphOne(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }

    public function preTransaction()
    {
        return $this->belongsTo(PreTransaction::class, 'pre_transaction_id', 'reference_no');
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new CellPayUserTransactionFilters($request))->add($filters)->filter($builder);
    }




}
