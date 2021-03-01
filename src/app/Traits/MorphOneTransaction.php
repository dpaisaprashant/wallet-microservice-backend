<?php


namespace App\Traits;


use App\Models\TransactionEvent;

trait MorphOneTransaction
{
    public function transactions()
    {
        return $this->morphOne(TransactionEvent::class, 'transactionable','transaction_type', 'transaction_id');
    }
}
