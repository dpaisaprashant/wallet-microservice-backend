<?php

namespace App\Models;

use App\Filters\FundRequest\FundRequestFilters;
use App\Traits\MorphOneCommission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class FundRequest extends Model
{
    use MorphOneCommission;


    protected $table = "fund_requests";
    protected $connection = 'dpaisa';

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }


    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new FundRequestFilters($request))->add($filters)->filter($builder);
    }

    public function transactions()
    {
        return $this->morphMany(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class,'from_user','id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class,'to_user','id');
    }

    public function requestStatus()
    {
        return 'successful';
    }

    public function responseStatus()
    {
        $status = 'unknown';
        if ($this->response === 0 && $this->status == 1) {
            $status = 'Rejected';
        } elseif($this->response === 0 && $this->transaction_status === 0){
            $status = 'Pending';
        } elseif ($this->response == 1 && $this->request == 1) {
            $status = 'Accepted';
        }
        return $status;
    }

}
