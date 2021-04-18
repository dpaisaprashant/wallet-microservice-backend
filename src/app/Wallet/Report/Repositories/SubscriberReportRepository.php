<?php


namespace App\Wallet\Report\Repositories;


use App\Models\User;
use App\Models\UserKYC;
use App\Models\Wallet;
use Illuminate\Http\Request;

class SubscriberReportRepository extends AbstractReportRepository
{
    protected $from;
    protected $to;


    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->from = $request->from;
        $this->to = $request->to;
    }

    //verified kyc
    public function totalKYCSubscriber()
    {
        return User::whereHas('kyc', function ($query) {
            $query->where('accept', UserKyc::ACCEPT_ACCEPTED);
        })->filter($this->request)->count();
    }

    public function totalKycPendingSubscriber()
    {
        return User::whereHas('kyc', function ($query) {
            $query->where('accept', UserKyc::ACCEPT_UNVERIFIED);
        })->filter($this->request)->count();
    }

    public function totalNonKycSubscriber()
    {
        return User::doesnthave('kyc')->filter($this->request)->count();
    }

    public function totalSubscriberMainBalance()
    {
        return Wallet::whereHas('user', function ($query) {
            return $query->filter($this->request);
        })->sum('balance') / 100;
    }

    public function totalSubscriberBonusBalance()
    {
        return Wallet::whereHas('user', function ($query) {
                return $query->filter($this->request);
            })->sum('bonus_balance') / 100;
    }

    public function totalSubscriberBonusPoint()
    {
        return 0;
    }
}
