<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Models\NPSAccountLinkLoad;
use App\Models\TransactionEvent;
use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

class NPSAccountLinkLoadClearanceStrategy extends AbstractClearanceCompareStrategy
{
    const TRANSACTION_TYPE = NPSAccountLinkLoad::class;

    public function clearanceInfo()
    {
        return "Use reference_id/pre_transaction_id as linked_id";
    }

    public function transactionName()
    {
        return "NPS account link load";
    }

    public function walletTransactionsWithLinkedId()
    {
        return TransactionEvent::whereTransactionType(self::TRANSACTION_TYPE)
            ->with('transactionable')
            ->filter(request())
            ->get()
            ->transform(function ($value) {
                $value->linked_id = $value->transactionable->reference_id;
                return $value;
            });
    }
}
