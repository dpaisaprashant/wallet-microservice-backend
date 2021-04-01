<?php


namespace App\Wallet\Referral\Repositories;


use Illuminate\Http\Request;

abstract class AbstractReferralRepository
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
