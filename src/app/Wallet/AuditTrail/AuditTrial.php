<?php


namespace App\Wallet\AuditTrail;


use App\Wallet\AuditTrail\Behaviors\BAll;
use App\Wallet\AuditTrail\Interfaces\IAuditTrail;

class AuditTrial
{
    public $IAuditTrialBehaviour;

    public $request;

    /**
     * @param mixed $request
     * @return AuditTrial
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function __construct(IAuditTrail $IAuditTrialBehaviour)
    {
        $this->IAuditTrialBehaviour = $IAuditTrialBehaviour;
    }

    public function createTrial($user) {

        return $this->IAuditTrialBehaviour->setRequest($this->request)->createTrial($user);
    }


}
