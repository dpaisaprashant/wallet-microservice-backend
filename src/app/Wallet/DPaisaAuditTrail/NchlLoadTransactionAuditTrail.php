<?php


namespace App\Wallet\DPaisaAuditTrail;


use App\Models\NchlLoadTransaction;
use App\Models\UserLoadTransaction;
use App\Wallet\Commission\Models\Commission;
use App\Wallet\DPaisaAuditTrail\Behaviours\BUserCashback;
use App\Wallet\DPaisaAuditTrail\Behaviours\BUserCommission;
use App\Wallet\DPaisaAuditTrail\Interfaces\IDPaisaAuditTrail;

class NchlLoadTransactionAuditTrail implements IDPaisaAuditTrail
{

    public function getUserCommission(Commission $commission)
    {
        return (new BUserCommission())->getUserCommission($commission);
    }

    public function getUserCashback(Commission $commission)
    {
        return (new BUserCashback())->getUserCashback($commission);
    }

    private function getDebit($vendorCommission, $userCashback)
    {
        return round($vendorCommission + $userCashback, 3);
    }

    private function getCredit($amount, $userCommission )
    {
        return round($amount + $userCommission, 3);
    }

    public function createTrail()
    {
        $transactions =  NchlLoadTransaction::with( 'commission')->get();
        $balance = 0;

        foreach ($transactions as $key => $value)
        {
            $commission = $value['commission'];

            $value['user_commission'] = $commission ? $this->getUserCommission($commission) : 0;
            $value['user_cashback'] = $commission ? $this->getUserCashback($commission) : 0;
            //$value['vendor_commission'] = $this->getVendorCommission($value);

            $value['credit'] = $this->getCredit($value->amount, $value['user_commission']);
            $value['debit'] = $this->getDebit($value['vendor_commission'], $value['user_cashback']);

            if ($value->status == 'SUCCESS') {
                $balance = round($balance + $value['credit'] - $value['debit'], 3);
            }
            $value['balance'] = $balance;
        }
        return $transactions->sortByDesc('balance')->sortByDesc('created_at');
    }
}
