<?php

namespace App\Wallet\Commission\Models;

use App\Filters\Commission\CommissionFilters;
use App\Models\TransactionEvent;
use App\Traits\MerchantTransactionable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Commission extends Model
{
    use MerchantTransactionable;

    protected $table = 'commissions';
    protected $connection = 'dpaisa';

    const MODULE_CASHBACK = 'cashback';
    const MODULE_COMMISSION = 'commission';

    const SERVICE_TYPE_CASHBACK = 'CASHBACK';
    const SERVICE_TYPE_COMMISSION = 'COMMISSION';

    public function getBeforeAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function getAfterAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new CommissionFilters($request))->add($filters)->filter($builder);
    }

    public function commissionable()
    {
        return $this->morphTo('commissionable', 'commissionable_type', 'commissionable_id');
    }

    public function transactions()
    {
        return $this->morphOne(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }

    public function commissionAmount()
    {
        if ($this->module == self::MODULE_COMMISSION) {
            return round($this->before_amount - $this->after_amount, 3) ?? 0;
        }
        return 0;
    }

    public function cashbackAmount()
    {
        if ($this->module == self::MODULE_CASHBACK) {
            return round($this->after_amount - $this->before_amount, 3) ?? 0;
        }
        return 0;
    }


}
