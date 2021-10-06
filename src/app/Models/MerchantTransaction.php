<?php

namespace App\Models;

use App\Filters\MerchantTransaction\MerchantTransactionFilters;
use App\Traits\MerchantTransactionable;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class MerchantTransaction extends Model
{
    use MorphOneTransaction, MerchantTransactionable;

    const STATUS_PROCESSING = 'PROCESSING';
    const STATUS_COMPLETE = 'COMPLETE';
    const STATUS_VERIFIED = 'VERIFIED';

    protected $connection = 'dpaisa';

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new MerchantTransactionFilters($request))->add($filters)->filter($builder);
    }

}
