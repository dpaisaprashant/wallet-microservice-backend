<?php


namespace App\Wallet\DPaisaAuditTrail;


use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\UserCheckPayment;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Wallet\Commission\Models\Commission;
use App\Wallet\DPaisaAuditTrail\Interfaces\IDPaisaAuditTrail;

class AllAuditTrail implements IDPaisaAuditTrail
{

    public function getUserCommission(Commission $commission)
    {
        // TODO: Implement getUserCommission() method.
    }

    public function getUserCashback(Commission $commission)
    {
        // TODO: Implement getUserCashback() method.
    }

    public function createTrail()
    {
        $paypointTransactions = (new PPAuditTrail())->createTrail();
        $npayTransactions = (new NPayAuditTrail())->createTrail();
        $nchlBankTransfer = (new NchlBankTransferAuditTrail())->createTrail();
        $nchlLoadTransaction = (new NchlLoadTransactionAuditTrail())->createTrail();
        $balance = 0;

        $transactions = $paypointTransactions
            ->concat($npayTransactions)
            ->concat($nchlBankTransfer)
            ->concat($nchlLoadTransaction);

        $transactions = $transactions->sortBy('created_at');

        foreach ($transactions as $key => $value) {
            if ($value instanceof UserCheckPayment)
            {
                if (!empty($value->userTransaction))
                {
                    $balance = $balance - $value['debit'] + $value['credit'];
                }
                $value['balance'] = $balance;

            } elseif ($value instanceof UserLoadTransaction)
            {
                if ($value->status == 'COMPLETED') {
                    $balance = round($balance + $value['credit'] - $value['debit'], 3);
                }
                $value['balance'] = $balance;

            } elseif ($value instanceof NchlBankTransfer) {
                if ($value->successfulBankTransfer()) {
                    $balance = round($balance + $value['credit'] - $value['debit'], 3);
                }
                $value['balance'] = $balance;

            } elseif ($value instanceof NchlLoadTransaction) {
                if ($value->status == 'SUCCESS') {
                    $balance = round($balance + $value['credit'] - $value['debit'], 3);
                }
                $value['balance'] = $balance;
            }
        }
        return $transactions->sortByDesc('created_at');
    }
}
