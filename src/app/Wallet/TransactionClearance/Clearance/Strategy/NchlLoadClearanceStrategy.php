<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Models\NchlLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

class NchlLoadClearanceStrategy extends AbstractClearanceCompareStrategy
{
    const TRANSACTION_TYPE = NchlLoadTransaction::class;

    public function clearanceInfo()
    {
        return "Use app_transaction_id as linked_id";
    }

    public function transactionName()
    {
        return "ConnectIPS Load";
    }

    public function walletTransactionsWithLinkedId()
    {
        return TransactionEvent::whereTransactionType(self::TRANSACTION_TYPE)
            ->with('transactionable')
            ->filter(request())
            ->get()
            ->transform(function ($value) {
                $value->linked_id = $value->transactionable->transaction_id;
                return $value;
            });
    }
}
