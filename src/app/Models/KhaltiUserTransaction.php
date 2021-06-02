<?php

namespace App\Models;

use App\Traits\BelongsToUser;
use App\Traits\BelongsToUseThroughMicroservice;
use App\Traits\MorphOneCommission;
use App\Traits\MorphOneDispute;
use Illuminate\Database\Eloquent\Model;

class KhaltiUserTransaction extends Model
{
    use BelongsToUseThroughMicroservice, BelongsToUser, MorphOneCommission, MorphOneDispute;

    protected $connection = 'khalti';
    protected $table = 'khalti_api_table';

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

    public function transactions()
    {
        return $this->morphOne(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }
}
