<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

class PaypointClearanceStrategy extends AbstractClearanceCompareStrategy
{
    const TRANSACTION_TYPE = UserTransaction::class;

    public function clearanceInfo()
    {
        return "Use refStan as linked_id";
    }

    public function transactionName()
    {
        return "paypoint";
    }

    public function walletTransactionsWithLinkedId()
    {
        return TransactionEvent::whereTransactionType(self::TRANSACTION_TYPE)
            ->with('transactionable')
            ->filter(request())
            ->get()
            ->transform(function ($value) {
                $value->linked_id = $value->transactionable->refStan;
                return $value;
            });
    }
}
