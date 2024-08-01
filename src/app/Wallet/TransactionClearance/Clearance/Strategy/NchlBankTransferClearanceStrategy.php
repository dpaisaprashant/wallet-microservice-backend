<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Models\NchlBankTransfer;
use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

class NchlBankTransferClearanceStrategy extends AbstractClearanceCompareStrategy
{
    const TRANSACTION_TYPE = NchlBankTransfer::class;

    public function clearanceInfo()
    {
        return "Use transaction_id/batch_id as linked_id";
    }

    public function transactionName()
    {
        return "NCHL Bank Transfer";
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
