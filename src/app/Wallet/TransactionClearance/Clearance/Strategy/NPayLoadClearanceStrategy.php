<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Models\TransactionEvent;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

class NPayLoadClearanceStrategy extends AbstractClearanceCompareStrategy
{
    const TRANSACTION_TYPE = UserLoadTransaction::class;

    public function clearanceInfo()
    {
        return "Use gateway_ref_no as linked_id";
    }

    public function transactionName()
    {
        return "NPay Load";
    }

    public function walletTransactionsWithLinkedId()
    {
        return TransactionEvent::whereTransactionType(self::TRANSACTION_TYPE)
            ->with('transactionable')
            ->filter(request())
            ->get()
            ->transform(function ($value) {
                $value->linked_id = $value->transactionable->gateway_ref_no;
                return $value;
            });
    }
}
