<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Models\NtcRetailerToCustomerTransaction;
use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

class NtcPaymentClearanceStrategy extends AbstractClearanceCompareStrategy
{
    const TRANSACTION_TYPE = NtcRetailerToCustomerTransaction::class;

    public function transactionName()
    {
        return "Ntc Payment";
    }

    public function walletTransactionsWithLinkedId()
    {
        return TransactionEvent::whereTransactionType(self::TRANSACTION_TYPE)
            ->with('transactionable')
            ->filter(request())
            ->get()
            ->transform(function ($value) {
                $value->linked_id = $value->transactionable->ext_transaction_id;
                return $value;
            });
    }
}
