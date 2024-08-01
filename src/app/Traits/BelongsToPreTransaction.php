<?php


namespace App\Traits;


use App\Models\Microservice\PreTransaction;

trait BelongsToPreTransaction
{
    public function preTransaction()
    {
        return $this->belongsTo(PreTransaction::class, 'pre_transaction_id', 'pre_transaction_id');
    }
}
