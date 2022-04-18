<?php

namespace App\Wallet\SystemRepost\Repost\Contracts;

interface SystemRepostContract
{
    public function performRepost(
        $preTransaction,
        $systemRepost,
        $dbCheckResponse
    );
}
