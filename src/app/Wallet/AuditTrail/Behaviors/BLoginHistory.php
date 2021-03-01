<?php


namespace App\Wallet\AuditTrail\Behaviors;


use App\Models\UserLoginHistory;
use App\Wallet\AuditTrail\AuditTrial;
use App\Wallet\AuditTrail\Interfaces\IAuditTrail;

class BLoginHistory implements IAuditTrail
{

    public $request;

    /**
     * @param mixed $request
     * @return BLoginHistory
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function createTrial($user)
    {
        return UserLoginHistory::with('user')->where('user_id', $user->id)->latest()->paginate(10, ['*'], 'user-login-history-audit');
    }
}
