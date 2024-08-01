<?php

namespace App\Models;

use App\Filters\UsedUserReferral\UsedUserReferralFilters;
use App\Filters\User\UserFilters;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UsedUserReferral extends Model
{
    protected $connection = 'dpaisa';

    CONST STATUS_PROCESSING = 'PROCESSING';
    CONST STATUS_INVALID = 'INVALID';
    CONST STATUS_COMPLETE = 'COMPLETE';

    public function getReferredFromAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function getReferredToAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new UsedUserReferralFilters($request))->add($filters)->filter($builder);
    }

    public function transactions()
    {
        return $this->morphMany(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }

    public function referredTo()
    {
        return $this->belongsTo(User::class, 'referred_to');
    }

    public function referredFrom()
    {
        return $this->belongsTo(User::class, 'referred_from');
    }
}
