<?php

namespace App\Models;

use App\Filters\NchlBankTransfer\NchlBankTransferFilters;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneCommission;
use App\Traits\MorphOneDispute;
use App\Traits\MorphOneTransaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class NchlBankTransfer extends Model
{

    use BelongsToUser, BelongsToUseThroughMicroservice, MorphOneTransaction, MorphOneCommission, MorphOneDispute;


    protected $connection = 'nchl';

    protected $appends = ['commission_amount', 'bank'];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new NchlBankTransferFilters($request))->add($filters)->filter($builder);
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

    public function getBankAttribute()
    {
        $vendor = explode('_', $this->vendor);
        if (count($vendor) > 1) {
            return $vendor[1];
        }
        return $this->vendor;
    }

    public function successfulBankTransfer()
    {
        if (($this->credit_status == '000' || $this->credit_status == '999') &&
            ($this->debit_status == '000' || $this->debit_status = '999')) {
            return true;
        }
        return false;
    }
}
