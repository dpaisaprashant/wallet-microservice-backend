<?php

namespace App\Models;

use App\Filters\FiltersAbstract;
use App\Filters\PreTransactionFilters\PreTransactionFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PreTransaction extends Model
{
    protected $connection = 'dpaisa';
    protected $guarded = [];
    protected $table = 'pre_transactions';



    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new PreTransactionFilters($request))->add($filters)->filter($builder);
    }

    public function UserToBFIFundTransfer(){
        return $this->hasMany(UserToBfiFundTransfer::class,'from_pre_transaction_id','pre_transaction_id');
    }

}
