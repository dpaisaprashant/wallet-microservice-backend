<?php


namespace App\Wallet\DPaisaAuditTrail;


use App\Models\NchlBankTransfer;
use App\Models\UserCheckPayment;
use App\Wallet\Commission\Models\Commission;
use App\Wallet\DPaisaAuditTrail\Behaviours\BUserCashback;
use App\Wallet\DPaisaAuditTrail\Behaviours\BUserCommission;
use App\Wallet\DPaisaAuditTrail\Interfaces\IDPaisaAuditTrail;

class NchlBankTransferAuditTrail implements IDPaisaAuditTrail
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

    private function getCredit($userCommission )
    {
        return round($userCommission, 3);
    }

    public function createTrail()
    {
        $transactions = NchlBankTransfer::with('user', 'commission')->get();
        $balance = 0;

        foreach ($transactions as $key => $value) {

            $commission = $value['commission'];

            $value['user_commission'] = $commission ? $value->commission_amount : 0;
            $value['user_cashback'] = $commission ? $this->getUserCashback($commission) : 0;
            //$value['vendor_commission'] = $this->getVendorCommission($value);

            $value['credit'] = $this->getDebit($value->amount, $value['user_cashback']);
            $value['debit'] = $this->getCredit($value['user_commission']);

            if ($value->successfulBankTransfer()) {
                $balance = round($balance + $value['credit'] - $value['debit'], 3);
            }
            $value['balance'] = $balance;
        }
        return $transactions->sortByDesc('balance')->sortByDesc('created_at');
    }
}
