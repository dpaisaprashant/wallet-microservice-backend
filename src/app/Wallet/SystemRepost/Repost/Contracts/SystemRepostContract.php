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
     * 4. Create transaction_event for that transaction (take out of this class in future)
     * 5. Update balance of user if update_balance is set to 1 (take out of this class in future)
     *
     * @param PreTransaction $preTransaction
     * @return TransactionEvent
     */
    public function performRepost(PreTransaction $preTransaction);
}
