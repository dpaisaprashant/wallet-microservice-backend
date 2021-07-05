<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Models\NpsLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

class NpsLoadClearanceStrategy extends AbstractClearanceCompareStrategy
{
    const TRANSACTION_TYPE = NpsLoadTransaction::class;

    public function transactionName()
    {
        return "Nps Load";
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
