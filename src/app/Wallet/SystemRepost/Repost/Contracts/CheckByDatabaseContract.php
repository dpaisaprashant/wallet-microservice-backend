<?php

namespace App\Wallet\SystemRepost\Repost\Contracts;

interface CheckByDatabaseContract
{
    /**
     * validate from microservice table
     * @return mixed
     */
    public function checkMicroserviceDatabaseStatus($preTransaction); // for failed
}
