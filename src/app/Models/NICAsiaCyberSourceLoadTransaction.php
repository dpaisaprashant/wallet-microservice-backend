<?php

namespace App\Models;

use App\Filters\NicAsia\NICAsiaCyberSourceLoadTransactionFilters;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Microservice\PreTransaction;

class NICAsiaCyberSourceLoadTransaction extends Model
{

    use BelongsToUser, MorphOneTransaction, BelongsToUseThroughMicroservice;

    protected $connection = 'nicasia';
    protected $guarded = [];
    protected $table = "nicasia_cybersource_load_transactions";

    CONST STATUS_STARTED = 'STARTED';
    CONST STATUS_PROCESSING = 'PROCESSING';
    CONST STATUS_SUCCESS = 'SUCCESS';
    CONST STATUS_ERROR = 'ERROR';


    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new NICAsiaCyberSourceLoadTransactionFilters($request))->add($filters)->filter($builder);
    }

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function preTransaction(){
        return $this->belongsTo(PreTransaction::class,'pre_transaction_id','pre_transaction_id');
    }
}
