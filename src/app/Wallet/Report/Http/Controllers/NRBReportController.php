<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use App\Traits\CollectionPaginate;
use App\Wallet\Report\Repositories\AbstractReportRepository;
use App\Wallet\Report\Repositories\ActiveInactiveCustomerReportRepository;
use App\Wallet\Report\Repositories\ActiveInactiveTransactionRepository;
use App\Wallet\Report\Repositories\AgentReportRepository;
use App\Wallet\Report\Repositories\NonBankPaymentReportRepository;
use Illuminate\Http\Request;

class NRBReportController extends Controller
{
    use CollectionPaginate;

    public function activeCustomerReport(Request $request)
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

                    'Female' => [
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
                    ],
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

        return view('WalletReport::nrb.activeUserReport')->with(compact('activityReports'));
    }

    public function inactiveCustomerReport(Request $request)
    {
        $activityReports = [];
        if(!empty($_GET)) {
            $repository = new ActiveInactiveCustomerReportRepository($request);
            $activityReports = [
                 'Inactive Customer Wallet' => [
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
                 ]
            ];
        }

        return view('WalletReport::nrb.inactiveUserReport')->with(compact('activityReports'));
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
            ],

            'Bank Transfer' => [
                'number' => $repository->getBankTransferNumber(),
                'value' => $repository->getBankTransferValue() / 100,
            ],

            'TopUp' => [
                'number' => $repository->getTopUpNumber(),
                'value' => $repository->getTopUpValue() / 100,
            ],

            'Government Payments' => [
                'number' => $repository->getGovernmentPaymentNumber(),
                'value' => $repository->getGovernmentPaymentValue() / 100,
            ]
        ];
        return view('WalletReport::nrb.nonBankPaymentReport',compact('nonBankPayments'));
    }

    public function nonBankPaymentCountReport(Request $request){
        $repository = new NonBankPaymentReportRepository($request);

        $nonBankPayments = [
//merchant transaction table count
            'Merchant Payment' => [
                'Successful Count' => $repository->checkCountMerchantTransactions()['successfulCountMerchantTransactions'],
                'Failed Count' => $repository->checkCountMerchantTransactions()['failedCountMerchantTransactions']
            ],
//user to user fund
            'Transfer to Wallet (P2P)' => [
                'Successful Count' => $repository->checkCountUserToUserFundTransfer()['successfulCountUserToUserFundTransfer'],
                'Failed Count' => $repository->checkCountUserToUserFundTransfer()['failedCountUserToUserFundTransfer'],
            ],

            'Transfer to Bank A/C (P2P)' => [
                'Successful Count' => $repository->checkCountNchlBankTransfer()['successfulNchlBankTransferCount'],
                'Failed Count' => $repository->checkCountNchlBankTransfer()['failedNchlBankTransferCount'],
            ],

            'Government Payment (P2G)' => [
                'Successful Count' => $repository->checkCountNchlAggregated()['successfulNchlAggregatedCount'],
                'Failed Count' => $repository->checkCountNchlAggregated()['failedNchlAggregatedCount'],
            ],

            'Topup' => [
                'Successful Count' => $repository->checkCountKhaltiPayment()['successfulKhaltiPaymentCount'],
                'Failed Count' => $repository->checkCountKhaltiPayment()['failedKhaltiPaymentCount'],
            ],

            'Cash In' => [
                'Successful Count' => $repository->checkCountCashIn()['successfulCashInCount'],
                'Failed Count' => $repository->checkCountCashIn()['failedCashInCount'],
            ],

            'Cash Out' => [
                'Successful Count' => $repository->checkCountCashOut()['successfulCashOutCount'],
                'Failed Count' => $repository->checkCountCashOut()['failedCashOutCount'],
            ],
        ];
        return view('WalletReport::nrb.nonBankPaymentCountReport',compact('nonBankPayments'));
    }

    public function activeInactiveTransaction(Request $request)
    {
        $reports = [];
        if (!empty($_GET)) {
            $repository = new ActiveInactiveTransactionRepository($request);
            $reports = [
                "Male" => [
                    "count" => $repository->getUserCount("m"),
                    "transaction_count" => $repository->getUserTransactionCount("m"),
                    "transaction_value" => $repository->getUserTransactionValue("m") / 100
                ],

                "Female" => [
                    "count" => $repository->getUserCount("f"),
                    "transaction_count" => $repository->getUserTransactionCount("f"),
                    "transaction_value" => $repository->getUserTransactionValue("f") / 100
                ],

                "Others" => [
                    "count" => $repository->getUserCount("o"),
                    "transaction_count" => $repository->getUserTransactionCount("o"),
                    "transaction_value" => $repository->getUserTransactionValue("o") / 100
                ],
            ];
        }
        return view('WalletReport::nrb.activeInactiveTransactionReport')->with(compact('reports'));

    }
}
