<?php

namespace App\Models;

use App\Filters\FiltersAbstract;
use App\Traits\BelongsToPreTransaction;
use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneCommission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Filters\NPS;

class NpsLoadTransaction extends Model
{
    use BelongsToPreTransaction,MorphOneCommission,BelongsToUseThroughMicroservice,BelongsToUser;
    CONST STATUS_COMPLETED = 'COMPLETED';
    CONST STATUS_VALIDATED = 'VALIDATED';
    CONST STATUS_PENDING = 'PENDING';
    CONST STATUS_FAILED = 'FAILED';

    protected $guarded = [];

    protected $connection = 'nps';

    protected $table = 'nps_load_transactions';

    protected $casts = [
        "amount" => "integer"
    ];

    protected $appends = [
        "model",
        "type",
        "pre_transaction_status",
        "vendor"
    ];

    public function getAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function getTypeAttribute()
    {
        return "credit";
    }

    public function getModelAttribute()
    {
        return NpsLoadTransaction::class;
    }

    public function getVendorAttribute()
    {
        return $this->payment_mode;
    }

    public function getPreTransactionStatusAttribute()
    {
        if ($this->status == self::STATUS_COMPLETED){
            return true;
        }
        return false;
    }


    public function response()
    {
        return $this->hasOne(NpsTransactionResponse::class, "load_id");
    }

    /**
     * Check Gateway Ref No
     *
     * @param string $value
     * @return object
     */
    public function checkGatewayRef($value)
    {
        return $this->where('gateway_ref_no', $value)->lockForUpdate()->first();
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new NPS\NpsFilters($request))->add($filters)->filter($builder);
    }

    public function transactions()
    {
        return $this->morphOne(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }


    /**
     * Check If the transsaction id exists
     *
     * @param string $value
     * @return object
     */
    public function checkTransactionId($value)
    {
        return $this->where('transaction_id', $value)->lockForUpdate()->first();
    }
}
