<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Microservice\PreTransaction;
use App\Filters\NPSAccountLinkLoad\NPSAccountLinkLoadFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Traits\BelongsToUser;

class NPSAccountLinkLoad extends Model
{
    use BelongsToUser;

    protected $connection = 'nps-accountlink';
    protected $table = "load_wallet";

    const LOAD_STATUS_SUCCESS = "Transaction Success";
    const LOAD_STATUS_ERROR = "Error";

    // protected $casts = [
    //     "amount" => "integer",
    //     "load_time_stamp" => "datetime"
    // ];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new NPSAccountLinkLoadFilters($request))->add($filters)->filter($builder);
    }

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function preTransaction(){
        return $this->belongsTo(PreTransaction::class,'reference_id','pre_transaction_id');
    }

    public function transactions()
    {
        return $this->morphOne(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }


}
