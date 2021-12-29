<?php


namespace App\Wallet\TransactionClearance\Clearance\Strategy;


use App\Models\KhaltiUserTransaction;
use App\Models\TransactionEvent;
use App\Models\UserTransaction;
use App\Wallet\TransactionClearance\Clearance\contracts\CompareTransactionForClearance;

class KhaltiPaymentClearanceStrategy extends AbstractClearanceCompareStrategy
{
    const TRANSACTION_TYPE = KhaltiUserTransaction::class;

    public function clearanceInfo()
    {
        return "Use reference no as linked_id";
    }

    public function transactionName()
    {
        return "Khalti Payments";
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
                $value->linked_id = $value->transactionable->reference_no;
                return $value;
            });
    }
}
