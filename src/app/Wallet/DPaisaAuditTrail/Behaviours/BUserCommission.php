<?php


namespace App\Wallet\DPaisaAuditTrail\Behaviours;


use App\Wallet\Commission\Models\Commission;

class BUserCommission
{
    public function getUserCommission(Commission $commission)
    {
        if ($commission['module'] == 'commission') {
            return $commission->commissionAmount();
        }
        return 0;
    }
}
