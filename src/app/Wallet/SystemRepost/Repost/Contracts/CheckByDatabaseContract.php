<?php

namespace App\Wallet\SystemRepost\Repost\Contracts;

use App\Models\Microservice\PreTransaction;

interface CheckByDatabaseContract
{
    /**
     * validate from microservice table
     * @return array  [
     *          "before_transaction_status" => "failed" / null,
     *          "error_description" => "reason for error",
     *          "status" => "ERROR" / "PROCESSING"
     *       ]
     */
    public function checkMicroserviceDatabaseStatus(PreTransaction $preTransaction); // for failed
}
