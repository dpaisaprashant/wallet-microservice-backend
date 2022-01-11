<?php

namespace App\Models;

use App\Filters\NicAsia\NICAsiaCyberSourceLoadTransactionFilters;
use App\Filters\PaymentNepalLoadTransaction\PaymentNepalLoadTransactionFilters;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PaymentNepalLoadTransaction extends Model
{

    use BelongsToUser, MorphOneTransaction, BelongsToUseThroughMicroservice;

    protected $connection = 'paymentnepal';

    protected $table = "payment_nepal_transaction";

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new PaymentNepalLoadTransactionFilters($request))->add($filters)->filter($builder);
    }
}
