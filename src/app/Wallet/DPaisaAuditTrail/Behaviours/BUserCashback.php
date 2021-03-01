<?php


namespace App\Wallet\DPaisaAuditTrail\Behaviours;


use App\Wallet\Commission\Models\Commission;

class BUserCashback
{
    public function getUserCashback(Commission $commission)
    {
        if ($commission['module'] == 'cashback') {
            return $commission->cashbackAmount();
        }
        return 0;
    }
}
