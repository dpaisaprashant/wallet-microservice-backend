<?php

namespace App\Wallet\SystemRepost\Repost\Contracts;

use App\Models\Microservice\PreTransaction;

interface CheckByDatabaseContract
{
    /**
     * validate from microservice table
     * @return mixed
     */
    public function checkMicroserviceDatabaseStatus(PreTransaction $preTransaction); // for failed
}
