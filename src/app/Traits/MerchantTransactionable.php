<?php
namespace App\Traits;

use App\Models\MerchantTransactionEvent;

trait MerchantTransactionable{

   /**
     * Get the post's image.
     */
    public function merchantTransactions()
    {
        return $this->morphOne(MerchantTransactionEvent::class, 'transactionable', 'transaction_type', 'transaction_id');
    }
}
