<?php

namespace App\Models;

use App\Filters\UserTransaction\UserTransactionFilters;
use App\Traits\BelongsToPreTransaction;
use App\Traits\BelongsToRequestInfo;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneDispute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UserCheckPayment extends Model
{
    use BelongsToUseThroughMicroservice, BelongsToUser, MorphOneDispute;

    protected $connection = 'paypoint';

    protected $fillable = [
        'transaction_id', //id we set to track
        'refStan', //transaction_id used in response
        'bill_number',//key used in response
        'response' //response from the paypoint server
    ];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new UserTransactionFilters($request))->add($filters)->filter($builder);
    }


    public function userExecutePayment()
    {
        return $this->hasMany(UserExecutePayment::class, 'refStan_request', 'refStan');
    }

    public function userTransaction()
    {
        return $this->belongsTo(UserTransaction::class, 'refStan', 'refStan');
    }

    public function getStatus()
    {
        $status = 'not available';
        if ($this->userExecutePayment()->count() != 0) {
            foreach ($this->userExecutePayment as $execute) {
                if ($execute->code == 000) {
                    $status = 'complete';
                } else {
                    $status = 'failed';
                }
            }
        } else {
            $status = 'failed';
        }

        return $status;
    }

}
