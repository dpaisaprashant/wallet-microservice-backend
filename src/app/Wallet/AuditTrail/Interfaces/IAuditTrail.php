<?php


namespace App\Wallet\AuditTrail\Interfaces;


use App\Models\User;

interface IAuditTrail
{
    public function createTrial($user);
}
