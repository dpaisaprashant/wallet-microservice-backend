<?php

namespace App\Models;

use App\Filters\FailedUserTransaction\FailedUserTransactionFilters;
use App\Filters\Transaction\TransactionFilters;
use App\Traits\BelongsToPreTransaction;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\UserTransaction;
use App\Models\UserCheckPayment;

class UserExecutePayment extends Model
{
    use BelongsToUseThroughMicroservice, BelongsToUser, BelongsToPreTransaction;
    protected $connection = 'paypoint';

    protected $fillable = [
        'response',
        'refStan_request',
        'bill_number',
        'transaction_id',
    ];


    public function getTimeElapsedAttribute($time)
    {
        $time = (float) $time;
        return round($time, 3);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new FailedUserTransactionFilters($request))->add($filters)->filter($builder);
    }

    public function userCheckPayment()
    {
        return $this->belongsTo(UserCheckPayment::class, 'refStan_request', 'refStan');
    }

    public function userTransaction()
    {
        return $this->belongsTo(UserTransaction::class, 'refStan_request', 'refStan');
    }
}
