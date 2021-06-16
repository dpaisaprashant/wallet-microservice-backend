<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NpsLoadTransaction extends Model
{
    CONST STATUS_COMPLETED = 'COMPLETED';
    CONST STATUS_VALIDATED = 'VALIDATED';

    protected $guarded = [];

    protected $connection = 'nps';

    protected $casts = [
        "amount" => "integer"
    ];

    protected $appends = [
        "model",
        "type",
        "pre_transaction_status",
        "vendor"
    ];

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
