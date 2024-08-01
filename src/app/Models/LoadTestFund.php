<?php

namespace App\Models;

use App\Filters\LoadTestFund\LoadTestFundFilters;
use App\Models\Microservice\PreTransaction;
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
    protected $fillable = [];

    protected $appends = ['amount', 'bonus_amount'];

    public function getAmountAttribute()
    {
        $amount = $this->getOriginal('after_amount') - $this->getOriginal('before_amount');
        return $amount / 100;
    }

    public function getBonusAmountAttribute()
    {
        $amount = $this->getOriginal('after_bonus_balance') - $this->getOriginal('before_bonus_balance');
        return $amount / 100;
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new LoadTestFundFilters($request))->add($filters)->filter($builder);
    }

    public function transactionEvent(){
        return $this->hasOne(TransactionEvent::class,'pre_transaction_id','pre_transaction_id');
    }

    public function preTransaction(){
        return $this->BelongsTo(PreTransaction::class,'self_pre_transaction_id','pre_transaction_id');
    }

}
