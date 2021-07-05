<?php


namespace App\Wallet\TransactionClearance\Clearance\Resolver;


use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\Strategy\PaypointClearanceStrategy;

class ClearanceTransactionTypeResolver
{
    private $transactionType;

    public function __construct($transactionType)
    {
        $this->transactionType = $transactionType;
    }

    public function resolve()
    {
        switch ($this->transactionType) {
            case UserTransaction::class:
                return new PaypointClearanceStrategy();



        }
    }


}
