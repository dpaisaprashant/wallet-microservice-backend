<?php

namespace App\Models\Microservice;

use App\Filters\RequestInfo\RequestInfoFilters;
use App\Models\UserCheckPayment;
use App\Models\UserExecutePayment;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RequestInfo extends Model
{
    use BelongsToUser;

    protected $connection = 'dpaisa';
    protected $guarded = [];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new RequestInfoFilters($request))->add($filters)->filter($builder);
    }

    public function userLoadTransactions()
    {
        return $this->hasOne(UserLoadTransaction::class, 'request_id', 'request_id');
    }

    public function userCheckPayment()
    {
        return $this->hasOne(UserCheckPayment::class, 'request_id', 'request_id');
    }

    public function userExecutePayment()
    {
        return $this->hasOne(UserExecutePayment::class, 'request_id', 'request_id');
    }

    public function userTransactions()
    {
        return $this->hasOne(UserTransaction::class, 'request_id', 'request_id');
    }
}
