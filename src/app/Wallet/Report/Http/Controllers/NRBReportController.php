<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use App\Traits\CollectionPaginate;
use App\Wallet\Report\Repositories\AbstractReportRepository;
use App\Wallet\Report\Repositories\ActiveInactiveCustomerReportRepository;
use App\Wallet\Report\Repositories\AgentReportRepository;
use App\Wallet\Report\Repositories\NonBankPaymentReportRepository;
use Illuminate\Http\Request;

class NRBReportController extends Controller
{
    use CollectionPaginate;

    public function activeInactiveCustomerReport(Request $request)
    {
        $activityReports = [];
        if(!empty($_GET)) {
            $repository = new ActiveInactiveCustomerReportRepository($request);
            $activityReports = [
                'Active Customer Wallet' => [
                    'Male' => [
                        'Number' => $repository->activeMaleUserCount(),
                        'Value' =>'Rs.' . $repository->activeMaleUserBalance()
                    ],

                   /* 'Female' => [
                        'Number' => $repository->activeFemaleUserCount(),
                        'Value' => 'Rs.' . $repository->activeFemaleUserBalance()
                    ],

                    'Other' => [
                        'Number' => $repository->activeOtherUserCount(),
                        'Value' => 'Rs.' . $repository->activeOtherUserBalance()
                    ],

                    'Unknown' => [
                        'Number' => $repository->activeUnknownUserCount(),
                        'Value' => 'Rs.' . $repository->activeUnknownUserBalance()
                    ],

                    'Grand Total' => [
                        'Number' => $repository->activeTotalUserCount(),
                        'Value' => 'Rs.' . $repository->activeTotalUserBalance()
                    ],*/
                ],

               /* 'Inactive Customer Wallet' => [
                    'Inactive (6-12 months)' => [
                        'Number' => $repository->inactiveFor6To12MonthsUserCount(),
                        'Value' => 'Rs.' . $repository->inactiveFor6To12MonthsUserBalance()
                    ],

                    'Inactive (> 12 months)' => [
                        'Number' => $repository->inactiveForMoreThan12MonthsUserCount(),
                        'Value' => 'Rs.' . $repository->inactiveForMoreThan12MonthsUserBalance()
                    ],

                    'Grand Total' => [
                        'Number' => $repository->inactiveTotalUserCount(),
                        'Value' => 'Rs.' . $repository->inactiveTotalUserBalance()
                    ]
                ]*/
            ];
        }

        return view('WalletReport::nrb.activeInactiveUserReport')->with(compact('activityReports'));
    }

    public function agentReport(Request $request)
    {

        $agents = Agent::with('user')
            ->where('status', Agent::STATUS_ACCEPTED)
            /*->filter($request)*/
            ->latest()
            ->get()
            ->transform(function ($value, $key) use ($request) {

                $repository = new AgentReportRepository($request, $value);
                $value->totalSubAgent = $repository->totalSubAgent();
                $value->previousReportingBalance = 'Rs.' . $repository->previousReportingBalance();
                $value->currentReportingBalance = 'Rs.'. $value->user->wallet->balance;
                $value->billPayment = 'Rs.' . $repository->totalBillPayment() / 100;
                $value->p2pTransfer = 'Rs.' . $repository->totalP2PTransfer() / 100;
                $value->cashIn = 'Rs.' . $repository->totalCashIn() / 100;
                $value->others = 'Rs.' . $repository->otherPayment() / 100;
                $value->total = 'Rs.' . $repository->totalPayment() / 100;
                return $value;
            });

        $agents = $this->collectionPaginate(200, $agents, $request);
        return view('WalletReport::nrb.agentReport')->with(compact('agents'));

    }

    public function nonBankPaymentReport(Request $request){
        $repository = new NonBankPaymentReportRepository($request);

        $nonBankPayments = [
            'Bill Payment' => [
                'number' => $repository->getBillPaymentNumber(),
                'value' => ($repository->getBillPaymentValue())/100
            ],

            'Transfer (A/c to A/c)' => [
                'number' => $repository->getTransferNumber(),
                'value' => ($repository->getTransferValue())/100,
            ],

            'Cash In (wallet load)' => [
                'number' => $repository->getCashInNumber(),
                'value' => ($repository->getCashInValue())/100
            ],

            'Offer/Cashback/Coupon' => [
                'number' => $repository->getOfferNumber(),
                'value' => ($repository->getOfferValue())/100
            ],

            'Commission/Fees and Charges' => [
                'number' => $repository->getFeesChargesNumber(),
                'value' => ($repository->getFeesChargesValue())/100
            ],

            'Cash Out (Bank withdrawal)' => [
                'number' => $repository->getCashOutNumber(),
                'value' => ($repository->getCashOutValue())/100,
            ]
        ];
        return view('WalletReport::nrb.nonBankPaymentReport',compact('nonBankPayments'));
    }
}
