<?php

namespace App\Wallet\SystemRepost\Repost\Contracts;

use App\Models\Microservice\PreTransaction;

interface CheckByApiContract
{
    public function checkMicroserviceApiStatus(PreTransaction $preTransaction);
}
