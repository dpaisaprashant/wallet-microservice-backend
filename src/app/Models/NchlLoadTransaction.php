<?php

namespace App\Models;

use App\Filters\NchlLoadTransaction\NchlLoadTransactionFilters;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneCommission;
use App\Traits\MorphOneDispute;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NchlLoadTransaction extends Model
{

    use BelongsToUser, BelongsToUseThroughMicroservice, MorphOneTransaction, MorphOneCommission, MorphOneDispute;

    protected $connection = 'nchl';

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new NchlLoadTransactionFilters($request))->add($filters)->filter($builder);
    }

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }
}
