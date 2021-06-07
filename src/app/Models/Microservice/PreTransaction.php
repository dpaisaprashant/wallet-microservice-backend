<?php

namespace App\Models\Microservice;

use App\Filters\PreTransaction\PreTransactionFilters;
use App\Models\KhaltiUserTransaction;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\UserCheckPayment;
use App\Models\UserExecutePayment;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class PreTransaction extends Model
{
    use BelongsToUser;

    protected $connection = 'dpaisa';
    protected $guarded = [];

    CONST MICROSERVICE_PAYPOINT = 'PAYPOINT';
    CONST MICROSERVICE_NCHL = 'NCHL';

    /**
     * @param $amount
     * @return float|int
     */
    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    protected $casts = [
        "amount" => "number"
    ];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new PreTransactionFilters($request))->add($filters)->filter($builder);
    }

    public function userLoadTransaction()
    {
        return $this->hasOne(UserLoadTransaction::class, 'pre_transaction_id', 'pre_transaction_id');
    }

    public function userCheckPayment()
    {
        return $this->hasOne(UserCheckPayment::class, 'pre_transaction_id', 'pre_transaction_id');
    }

    public function userExecutePayment()
    {
        return $this->hasOne(UserExecutePayment::class, 'pre_transaction_id', 'pre_transaction_id');
    }

    public function userTransaction()
    {
        return $this->hasOne(UserTransaction::class, 'pre_transaction_id', 'pre_transaction_id');
    }

    public function khaltiUserTransaction()
    {
        return $this->hasOne(KhaltiUserTransaction::class, 'reference_no', 'pre_transaction_id');
    }

    public function nchlBankTransfer()
    {
        return $this->hasOne(NchlBankTransfer::class, 'pre_transaction_id', 'pre_transaction_id');
    }

    public function nchlLoadTransaction()
    {
        return $this->hasOne(NchlLoadTransaction::class, 'pre_transaction_id', 'pre_transaction_id');
    }

    public function transactionEvent()
    {
        return $this->hasOne(TransactionEvent::class, 'pre_transaction_id', 'pre_transaction_id');
    }
}
