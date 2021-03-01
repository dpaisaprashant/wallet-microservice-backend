<?php


namespace App\Wallet\AuditTrail\Behaviors;


use App\Models\UserLoadTransaction;
use App\Wallet\AuditTrail\Interfaces\IAuditTrail;

class BNpay implements IAuditTrail
{

    private $request;

    /**
     * @param mixed $request
     * @return BNpay
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function createTrial($user)
    {
       return UserLoadTransaction::with('loadTransactionResponse')->where('user_id', $user->id)->latest()->paginate(10,['*'], 'npay-audit');
    }
}
