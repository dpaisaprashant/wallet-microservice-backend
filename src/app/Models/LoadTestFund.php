<?php

namespace App\Models;

use App\Filters\LoadTestFund\LoadTestFundFilters;
use App\Traits\BelongsToUser;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;

class LoadTestFund extends Model
{
    use BelongsToUser, MorphOneTransaction, LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Load Test Fund (Refund)';

    protected $connection = 'dpaisa';
    protected $guarded = [];

    protected $appends = ['amount', 'bonus_amount'];

    public function getAmountAttribute()
    {
        $amount = $this->getOriginal('after_amount') - $this->getOriginal('before_amount');
        return $amount / 100;
    }

    public function getBonusAmountAttribute()
    {
        $amount = $this->getOriginal('after_bonus_amount') - $this->getOriginal('before_bonus_amount');
        return $amount / 100;
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new LoadTestFundFilters($request))->add($filters)->filter($builder);
    }
}
