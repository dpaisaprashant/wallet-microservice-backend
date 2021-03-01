<?php


namespace App\Wallet\AuditTrail\Behaviors;


use App\Models\UserCheckPayment;
use App\Wallet\AuditTrail\Interfaces\IAuditTrail;

class BPayPoint implements IAuditTrail
{
    private $request;

    /**
     * @param mixed $request
     * @return BPayPoint
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }
    public function createTrial($user)
    {
        return  UserCheckPayment::with('userExecutePayment', 'userTransaction', 'user')->where('user_id', $user->id)->latest()->paginate(10,['*'], 'paypoint-audit');
    }
}
