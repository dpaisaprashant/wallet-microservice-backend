<?php


namespace App\Wallet\DPaisaAuditTrail;


use App\Models\UserCheckPayment;
use App\Wallet\Commission\Models\Commission;
use App\Wallet\DPaisaAuditTrail\Behaviours\BUserCashback;
use App\Wallet\DPaisaAuditTrail\Behaviours\BUserCommission;
use App\Wallet\DPaisaAuditTrail\Interfaces\IDPaisaAuditTrail;

class PPAuditTrail implements IDPaisaAuditTrail
{

    public function getUserCommission(Commission $commission)
    {
        return (new BUserCommission())->getUserCommission($commission);
    }

    public function getUserCashback(Commission $commission)
    {
        return (new BUserCashback())->getUserCashback($commission);
    }

    private function getVendorCommission($transaction)
    {
        return $transaction->userTransaction->getTransactionFee();
    }

    private function getDebit($amount , $vendorCommission, $userCashback)
    {
        return round($amount + $vendorCommission + $userCashback, 3);
    }

    private function getCredit($userCommission)
    {
        return round($userCommission, 3);
    }

    public function createTrail()
    {
        $transactions = UserCheckPayment::with('userExecutePayment', 'userTransaction', 'user')->get();

        $balance = 0;

        foreach ($transactions as $key => $value) {

            if (!empty($value->userTransaction))
            {
                $commission = $value->userTransaction->commission;

                $value['user_commission'] = $commission ? $this->getUserCommission($commission) : 0;
                $value['user_cashback'] = $commission ? $this->getUserCashback($commission) : 0;
                $value['vendor_commission'] =  $this->getVendorCommission($value);

                $value['debit'] = $this->getDebit($value->userTransaction->amount,  $value['vendor_commission'], $value['user_cashback']);
                $value['credit'] = $this->getCredit($value['user_commission']);

                $balance = $balance + $value['credit'] - $value['debit'];
                $value['balance'] = round($balance, 3);

            } else {
                $value['balance'] = $balance;
            }
        }
        return $transactions->sortByDesc('balance')->sortByDesc('created_at');
    }
}
