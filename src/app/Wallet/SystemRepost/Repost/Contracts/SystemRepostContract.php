<?php

namespace App\Wallet\SystemRepost\Repost\Contracts;

use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;

interface SystemRepostContract
{
    /**
     * 1. Get record of transaction from respective microservice table using preTransaction
     * 2. Update the status in respective microservice table
     * 3. Update the status in preTransaction microservice
     * 4. Create transaction_event for that transaction
     * 5. return transaction event
     *
     * @param PreTransaction $preTransaction
     * @return TransactionEvent
     */
    public function performRepost(PreTransaction $preTransaction) : TransactionEvent;
}
