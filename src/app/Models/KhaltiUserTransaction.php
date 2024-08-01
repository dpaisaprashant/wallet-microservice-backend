<?php

namespace App\Models;

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

class KhaltiUserTransaction extends Model
{
    use BelongsToUseThroughMicroservice, BelongsToUser, MorphOneCommission, MorphOneDispute;

    protected $connection = 'dpaisa';
    protected $table = 'khalti_user_transactions';

    /**
     * @param $amount
     * @return float|int
     */
    public function getAmountAttribute($amount)
    {
        if(is_numeric($amount)){
            return ($amount);
        }else{
            $newAmount = substr($amount,1);
            return $newAmount;
        }

    }

    protected $casts = [
        "amount" => "number"
    ];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new KhaltiFilters($request))->add($filters)->filter($builder);
    }

    public function transactions()
    {
        return $this->morphOne(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }

    public function preTransaction()
    {
        return $this->belongsTo(PreTransaction::class, 'reference_no','pre_transaction_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

}
