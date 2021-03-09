<?php


namespace App\Wallet\Report\Traits;

use App\Wallet\Report\Repositories\AbstractReportRepository;

trait SubscriberReportGenerator
{

    public function generateReport(AbstractReportRepository $repository)
    {
        return  [
            'KYC Subscriber' => $repository->totalKYCSubscriber(),
            'KYC Pending Subscriber' => $repository->totalKycPendingSubscriber(),
            'Non-KYC Subscriber' => $repository->totalNonKycSubscriber(),

            'Subscriber Main Balance' => 'Rs.'.$repository->totalSubscriberMainBalance(),
            'Subscriber Bonus Balance' => 'Rs.'.$repository->totalSubscriberBonusBalance(),
            'Subscriber Bonus Point' => $repository->totalSubscriberBonusPoint()
        ];
    }
}
