<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\NtcRetailerToCustomerTransaction;
use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

class NicAsiaCybersourceClearanceStrategy extends AbstractClearanceCompareStrategy
{
    const TRANSACTION_TYPE = NICAsiaCyberSourceLoadTransaction::class;

    public function clearanceInfo()
    {
        return "Use reference_number as linked_id";
    }

    public function transactionName()
    {
        return "Nicasia Cybersource Load Transaction";
    }

    public function walletTransactionsWithLinkedId()
    {
        return TransactionEvent::whereTransactionType(self::TRANSACTION_TYPE)
            ->with('transactionable')
            ->wherehas("preTransaction", function ($query) {
                return $query->filter(request());
            })
            ->get()
            ->transform(function ($value) {
                $value->linked_id = $value->transactionable->reference_number;
                return $value;
            });
    }
}
