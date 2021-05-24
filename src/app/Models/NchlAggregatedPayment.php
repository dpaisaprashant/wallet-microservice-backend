<?php

namespace App\Models;

use App\Filters\NchlAggregatedPayment\NchlAggregatedPaymentFilters;
use App\Traits\BelongsToUser;
use App\Traits\MorphOneCommission;
use App\Traits\MorphOneDispute;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NchlAggregatedPayment extends Model
{
    use BelongsToUser, MorphOneTransaction, MorphOneCommission, MorphOneDispute;

    protected $connection = 'nchl';
    protected $appends = ['commission_amount'];
    protected $guarded = [];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new NchlAggregatedPaymentFilters($request))->add($filters)->filter($builder);
    }

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function getCommissionAmountAttribute()
    {
        if (!empty($this->commission)) {
            $commission = ($this->commission->getOriginal('before_amount') - $this->commission->getOriginal('after_amount')) / 100;
            return round($commission, 8);
        }
        return 0;
    }

    public function successfulPayment()
    {
        if (($this->credit_status == '000' || $this->credit_status == '999') &&
            ($this->debit_status == '000')) {
            return true;
        }
        return false;
    }

    public function pendingPayment()
    {
        if ($this->debit_status == 'ENTR' || $this->credit_status == 'ENTR') {
            return true;
        }
        return false;
    }

    public function getCommissionAmount()
    {
        return 0;
    }
}
