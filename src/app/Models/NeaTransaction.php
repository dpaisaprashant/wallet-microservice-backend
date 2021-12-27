<?php

namespace App\Models;

use App\Filters\FiltersAbstract;
use App\Filters\Khalti\KhaltiFilters;
use App\Filters\NEASettlement\NEASettlementFilters;
use App\Models\Microservice\PreTransaction;
use App\Traits\BelongsToPreTransaction;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneCommission;
use App\Traits\MorphOneDispute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NeaTransaction extends Model
{
    use BelongsToUseThroughMicroservice, BelongsToUser, MorphOneCommission, MorphOneDispute;

//    protected $connection = 'nea';
    protected $table = 'nea_transaction';

    protected $casts = [
        "amount" => "number"
    ];

    /**
     * @param $amount
     * @return float|int
     */

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new NEASettlementFilters($request))->add($filters)->filter($builder);
    }
    public function getAmountAttribute($amount)
    {
        return ($amount / 100);
    }

    public function transactions()
    {
        return $this->morphOne(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }

    public function preTransaction()
    {
        return $this->belongsTo(PreTransaction::class, 'reference_no','pre_transaction_id');
    }

}
