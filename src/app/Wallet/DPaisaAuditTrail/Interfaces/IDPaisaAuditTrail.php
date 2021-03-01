<?php


namespace App\Wallet\DPaisaAuditTrail\Interfaces;


use App\Wallet\Commission\Models\Commission;

interface IDPaisaAuditTrail
{
    public function getUserCommission(Commission $commission);

    public function getUserCashback(Commission $commission);

    public function createTrail();

}
