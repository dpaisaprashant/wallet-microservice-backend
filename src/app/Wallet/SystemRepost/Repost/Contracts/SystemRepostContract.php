<?php

namespace App\Wallet\SystemRepost\Repost\Contracts;

use App\Models\Microservice\PreTransaction;

interface SystemRepostContract
{
    public function performRepost(PreTransaction $preTransaction);
}
