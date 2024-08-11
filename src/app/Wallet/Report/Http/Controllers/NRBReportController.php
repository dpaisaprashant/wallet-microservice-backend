<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\User;
use App\Traits\CollectionPaginate;
use App\Wallet\Report\Repositories\AbstractReportRepository;
use App\Wallet\Report\Repositories\ActiveInactiveCustomerReportRepository;
use App\Wallet\Report\Repositories\ActiveInactiveTransactionRepository;
use App\Wallet\Report\Repositories\ActiveInactiveUserReportRepository;
use App\Wallet\Report\Repositories\ActiveInactiveUserSlabReportRepository;
use App\Wallet\Report\Repositories\AgentReportRepository;
use App\Wallet\Report\Repositories\NonBankPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbReconciliationReportRepository;
use App\Wallet\WalletAPI\Microservice\WalletClearanceMicroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NRBReportController extends Controller
{
    use CollectionPaginate;

    public function activeInactiveUserReport(Request $request)
    {
        if ($request->all() == null) {
            return view('WalletReport::nrb.active-inactive-user-report');
        }

        $repository = new ActiveInactiveUserReportRepository($request);

        $check = $repository->checkForReport();

        if ($check == null) {
            $walletClearance = new WalletClearanceMicroService();
            $walletClearanceResponse = $walletClearance->dispatchActiveInactiveUserJobs(request(), request()->from);

            $activeInactiveUserReports = 'Report is being generated. Please be patient and check in at another time. Current Status: Started Report Generation ....';
            return view('WalletReport::nrb.active-inactive-user-report', compact('activeInactiveUserReports'));

        }
        if ($check) {
            if ($check->status == "PROCESSING") {
                $activeInactiveUserReports = 'Report is being generated. Please be patient and reload the page at another time. Current Status: Processing Report ....';

                return view('WalletReport::nrb.active-inactive-user-report', compact('activeInactiveUserReports'));
            }
        }

        $walletClearance = new WalletClearanceMicroService();
        $walletClearanceResponse = $walletClearance->dispatchActiveInactiveUserJobs(request(), request()->from);

        $totalUsers = $walletClearanceResponse['active']['total_number'] + $walletClearanceResponse['inactive']['total_number'];


        $totalBalance = round(($walletClearanceResponse['active']['total_amount'] / 100 + $walletClearanceResponse['inactive']['total_amount'] / 100) , 2);
        $openingBalance = $walletClearanceResponse['wallet_balance'][0]['sum'];
        $shouldBeZero = $totalBalance - $openingBalance;

        $activeInactiveUserReports = [
            'Active Customer Wallet' => [
                'Male' => [
                    'Number' => $walletClearanceResponse['active']['male_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['male_amount'] / 100, 2)
                ],

                'Female' => [
                    'Number' => $walletClearanceResponse['active']['female_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['female_amount'] / 100, 2)
                ],

                'Other' => [
                    'Number' => $walletClearanceResponse['active']['others_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['others_amount'] / 100, 2)
                ],

                'Grand Total' => [
                    'Number' => $walletClearanceResponse['active']['total_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['total_amount'] / 100, 2)
                ]
            ],
            'Inactive Customer Wallet' => [
                'Inactive  (6-12 months)' => [
                    'Number' => $walletClearanceResponse['inactive']['six_month_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_month_amount'] / 100, 2)
                ],

                'Inactive (> 12 months)' => [
                    'Number' => $walletClearanceResponse['inactive']['tweleve_month_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['tweleve_month_amount'] / 100, 2)
                ],

                'Grand Total' => [
                    'Number' => $walletClearanceResponse['inactive']['total_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['total_amount'] / 100, 2)
                ]
            ],

        ];

        return view('WalletReport::nrb.active-inactive-user-report')->with(compact('activeInactiveUserReports', 'totalUsers', 'totalBalance', 'openingBalance', 'shouldBeZero'));
    }

    public function activeInactiveUserReportNew(Request $request)
    {
        if ($request->all() == null) {
            return view('WalletReport::nrb.active-inactive-user-report-new');
        }
       
        $repository = new ActiveInactiveUserReportRepository($request);
        

        $check = $repository->checkForNewReport();
        if ($check == null) {
            $walletClearance = new WalletClearanceMicroService();
            $walletClearanceResponse = $walletClearance->dispatchActiveInactiveUserNewJobs(request(), request()->from);
            
            $activeInactiveUserReports = 'Report is being generated. Please be patient and check in at another time. Current Status: Started Report Generation ....';
            return view('WalletReport::nrb.active-inactive-user-report-new', compact('activeInactiveUserReports'));
        }

        if ($check) {
            if ($check->status == "PROCESSING") {
                $activeInactiveUserReports = 'Report is being generated. Please be patient and reload the page at another time. Current Status: Processing Report ....';
                return view('WalletReport::nrb.active-inactive-user-report-new', compact('activeInactiveUserReports'));
            }
        }

        $walletClearanceResponse = $repository->dispatchWalletClearance();
        dd($walletClearanceResponse);

        $activeInactiveUserReports = $walletClearanceResponse['activeInactiveUserReports'];
        $totalUsers = $walletClearanceResponse['totalUsers'];
        $totalBalance = $walletClearanceResponse['totalBalance'];
        $shouldBeZero = $walletClearanceResponse['shouldBeZero'];
        $openingBalance = $walletClearanceResponse['openingBalance'];

        return view('WalletReport::nrb.active-inactive-user-report-new')->with(compact('activeInactiveUserReports', 'totalUsers', 'totalBalance', 'openingBalance', 'shouldBeZero'));
    }

    public function activeInactiveUserReportGenerated(Request $request)
    {
        $generatedReports = DB::connection('clearance')->table('nrb_active_inactive')->where('status', 'COMPLETED')->get();

        return view('WalletReport::nrb.active-inactive-user-report-generated', compact('generatedReports'));
    }

    public function activeInactiveUserReportDelete($id)
    {
        DB::connection('clearance')->table('nrb_active_inactive')->where('id',$id)->delete();
        return redirect()->back();
    }

    public function activeInactiveUserNewReportGenerated(Request $request)
    {
        $generatedReports = DB::connection('clearance')->table('nrb_active_inactive_new')->where('status', 'COMPLETED')->get();

        return view('WalletReport::nrb.active-inactive-user-report-generated-new', compact('generatedReports'));
    }

    public function activeInactiveUserNewReportDelete($id)
    {
        DB::connection('clearance')->table('nrb_active_inactive_new')->where('id',$id)->delete();
        return redirect()->back();
    }

    public function activeInactiveUserSlabReport(Request $request)
    {

        if ($request->all() == null) {
            return view('WalletReport::nrb.active-inactive-user-slab-report');
        }

        if ($request->all() != NULL) {
            $amountRange = json_decode($request->amount_range);
//            $fromAmount = $amountRange->fromAmount;
            $fromAmount = $request->from_amount;
            if($fromAmount==0){
                $fromAmount=-1000000;
            }
//            $toAmount = $amountRange->toAmount;
            $toAmount = $request->to_amount;
            $request->merge(['fromAmount' => $fromAmount, 'toAmount' => $toAmount]);
        }

        $repository = new ActiveInactiveUserSlabReportRepository($request);

        $check = $repository->checkForReport();

        if ($check == null) {
            $walletClearance = new WalletClearanceMicroService();

            $walletClearanceResponse = $walletClearance->dispatchActiveInactiveUserSlabJobs(request());

            $activeInactiveUserReports = 'Report is being generated. Please be patient and check in at another time. Current Status: Starting Report Generation ....';


            return view('WalletReport::nrb.active-inactive-user-slab-report', compact('activeInactiveUserReports'));
        }
        if ($check) {
            if ($check->status == "PROCESSING") {
                $activeInactiveUserReports = 'Report is being generated. Please be patient and check in at another time. Current Status: Processing Report ....';
                return view('WalletReport::nrb.active-inactive-user-slab-report', compact('activeInactiveUserReports'));
            }
        }

        $walletClearance = new WalletClearanceMicroService();
        $walletClearanceResponse = $walletClearance->dispatchActiveInactiveUserSlabJobs(request());

        $activeInactiveUserReports = [
            'Active Customer Wallet' => [
                'Male' => [
                    'Count' => $walletClearanceResponse['active']['male_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['male_amount'] / 100, 2)
                ],

                'Female' => [
                    'Count' => $walletClearanceResponse['active']['female_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['female_amount'] / 100, 2)
                ],

                'Other' => [
                    'Count' => $walletClearanceResponse['active']['others_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['active']['others_amount'] / 100, 2)
                ],

                'Grand Total' => [
                    'Number' => $walletClearanceResponse['active']['male_number']+$walletClearanceResponse['active']['female_number']+$walletClearanceResponse['active']['others_number'],
                    'Total Balance' => 'Rs. '. ($walletClearanceResponse['active']['male_amount']/100 + $walletClearanceResponse['active']['female_amount']/100+$walletClearanceResponse['active']['others_amount']/100)
                ]
            ],

            'Inactive Customer Wallets (upto 6 Months)' => [
                'Male' => [
                    'Count' => $walletClearanceResponse['inactive']['upto_six_months_male_number'],
//                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_months_male_amount'] / 100, 2)
                ],
                'Female' => [
                    'Count' => $walletClearanceResponse['inactive']['upto_six_months_female_number'],
//                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_months_female_amount'] / 100, 2)
                ],
                'Others' => [
                    'Count' => $walletClearanceResponse['inactive']['upto_six_months_other_number'],
//                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_months_other_amount'] / 100, 2)
                ],

                'Grand Total' => [
                    'Total Count' => $walletClearanceResponse['inactive']['upto_six_months_male_number']+$walletClearanceResponse['inactive']['upto_six_months_female_number']+$walletClearanceResponse['inactive']['upto_six_months_other_number'],
//                    'Total Balance' => 'Rs. '. ($walletClearanceResponse['inactive']['upto_six_months_male_amount']/100+$walletClearanceResponse['inactive']['upto_six_months_female_amount']/100+$walletClearanceResponse['inactive']['upto_six_months_other_amount']/100)
                ]
                ],

            'Inactive Customer Wallets (6-12 Months)' => [

                'Male' => [
                    'Count' => $walletClearanceResponse['inactive']['six_months_male_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_months_male_amount'] / 100, 2)
                ],
                'Female' => [
                    'Count' => $walletClearanceResponse['inactive']['six_months_female_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_months_female_amount'] / 100, 2)
                ],
                'Others' => [
                    'Count' => $walletClearanceResponse['inactive']['six_months_other_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['six_months_other_amount'] / 100, 2)
                ],

                'Grand Total' => [
                    'Total Count' => $walletClearanceResponse['inactive']['six_months_male_number']+$walletClearanceResponse['inactive']['six_months_female_number']+$walletClearanceResponse['inactive']['six_months_other_number'],
                    'Total Balance' => 'Rs. '. ($walletClearanceResponse['inactive']['six_months_male_amount']/100+$walletClearanceResponse['inactive']['six_months_female_amount']/100+$walletClearanceResponse['inactive']['six_months_other_amount']/100)
                ]
                ],

            'Inactive Customer Wallets (> 12 Months)' => [

                'Male' => [
                    'Count' => $walletClearanceResponse['inactive']['twelve_months_male_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['twelve_months_male_amount'] / 100, 2)
                ],

                'Female' => [
                    'Count' => $walletClearanceResponse['inactive']['twelve_months_female_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['twelve_months_female_amount'] / 100, 2)
                ],

                'Others' => [
                    'Count' => $walletClearanceResponse['inactive']['twelve_months_other_number'],
                    'Total Balance' => 'Rs. ' . round($walletClearanceResponse['inactive']['twelve_months_other_amount'] / 100, 2)
                ],

                'Grand Total' => [
                    'Total Count' => $walletClearanceResponse['inactive']['twelve_months_male_number']+$walletClearanceResponse['inactive']['twelve_months_female_number']+$walletClearanceResponse['inactive']['twelve_months_other_number'],
                    'Total Balance' => 'Rs. '. ($walletClearanceResponse['inactive']['twelve_months_male_amount']/100+$walletClearanceResponse['inactive']['twelve_months_female_amount']/100+$walletClearanceResponse['inactive']['twelve_months_other_amount']/100)
                ]
            ]
        ];

        return view('WalletReport::nrb.active-inactive-user-slab-report')->with(compact('activeInactiveUserReports'));
    }

    public function activeInactiveUserSlabReportGenerated(Request $request)
    {
        $generatedReports = DB::connection('clearance')->table('active_inactive_slab')->where('status', 'COMPLETED')->get();

        return view('WalletReport::nrb.active-inactive-user-slab-report-generated', compact('generatedReports'));
    }

    public function activeInactiveUserSlabReportDelete($id)
    {
        DB::connection('clearance')->table('active_inactive_slab')->where('id',$id)->delete();
        return redirect()->back();
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
                $value->currentReportingBalance = 'Rs.' . ($value->user->wallet->balance + $value->user->wallet->bonus_balance);
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

    public function nonBankPaymentReport(Request $request)
    {
        $repository = new NonBankPaymentReportRepository($request);

        $nonBankPayments = [
            'Bill Payment' => [
                'number' => $repository->getBillPaymentNumber(),
                'value' => ($repository->getBillPaymentValue()) / 100
            ],

            'Transfer (A/c to A/c)' => [
                'number' => $repository->getTransferNumber(),
                'value' => ($repository->getTransferValue()) / 100,
            ],

            'Cash In (wallet load)' => [
                'number' => $repository->getCashInNumber(),
                'value' => ($repository->getCashInValue()) / 100
            ],

            'Offer/Cashback/Coupon' => [
                'number' => $repository->getOfferNumber(),
                'value' => ($repository->getOfferValue()) / 100
            ],

            'Commission/Fees and Charges' => [
                'number' => $repository->getFeesChargesNumber(),
                'value' => ($repository->getFeesChargesValue()) / 100
            ],

            'Cash Out (Bank withdrawal)' => [
                'number' => $repository->getCashOutNumber(),
                'value' => ($repository->getCashOutValue()) / 100,
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
        return view('WalletReport::nrb.nonBankPaymentReport', compact('nonBankPayments'));
    }

    public function nonBankPaymentCountReport(Request $request)
    {
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
        return view('WalletReport::nrb.nonBankPaymentCountReport', compact('nonBankPayments'));
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

    public function reconciliationReport(Request $request)
    {
//        if ($request->all() != NULL) {
//            $amountRange = json_decode($request->amount_range);
//            $npsAmount = $amountRange->fromAmount;
//            $npsAmount = $amountRange->fromAmount;
//            $toAmount = $amountRange->toAmount;
//            $request->merge(['fromAmount' => $fromAmount, 'toAmount' => $toAmount]);
//        }

        $repository = new nrbReconciliationReportRepository($request);

        $check = $repository->checkForReport();

        if ($check == null) {
            $walletClearance = new WalletClearanceMicroService();

            if (!empty($_GET)) {
                $walletClearanceResponse = $walletClearance->dispatchReconciliationJobs(request());
            }

            $nrbReconciliationReport = 'The report is being generated. Please check in at another time. Current Status: Starting Report Generation ....';
//            $nrbReconciliationReport = $walletClearanceResponse['message'];

            return view('WalletReport::nrbAnnex.nrb-recon-report', compact('nrbReconciliationReport'));
        }
        if ($check) {
            if ($check->status == "PROCESSING") {
                $nrbReconciliationReport = 'The report is being generated. Please check in at another time. Current Status: Processing Report Generation ....';
                return view('WalletReport::nrbAnnex.nrb-recon-report', compact('nrbReconciliationReport'));
            }
        }

        $walletClearance = new WalletClearanceMicroService();
        $walletClearanceResponse = $walletClearance->dispatchReconciliationJobs(request());

        $nrbReconciliationReport = [
            'NRB Reconciliation Report' => [
                'E-Money Balance as per Wallet (1) :' => round($walletClearanceResponse['recon_data']['opening_balance'] / 100, 2),

                'Add (2) :' => [
                    'Debited in Wallet but not Debited in Settlement Bank' => [
                        'Paypoint' => round($walletClearanceResponse['generated_sums_title'][1]['amount'] / 100, 2),
                        'Wallet User Commission' => round($walletClearanceResponse['generated_sums_title'][2]['amount'] / 100, 2)],
                    'Credited in Settlement Bank but not Credited in Wallet' => [
                        'Success in NCHL not in Wallet' => $request->nchlAmount,
                        'Success in NPS not in Wallet' => $request->npsAmount,
                    ],
                ],
                'Less (6) :' => [
                    'Credited in Wallet but not Credited in Settlement Bank' => [
                        'NPAY' => round($walletClearanceResponse['generated_sums_title'][3]['amount'] / 100, 2),
                        'CARD' => round($walletClearanceResponse['generated_sums_title'][4]['amount'] / 100, 2),
                        'NPS Load Commission to Dpaisa' => round($walletClearanceResponse['generated_sums_title'][5]['amount'] / 100, 2),
                        'NCHL Load Commission to Dpaisa' => round($walletClearanceResponse['generated_sums_title'][6]['amount'] / 100, 2),
                        'Wallet User Cashback, Lucky Winner and Referral' => round($walletClearanceResponse['generated_sums_title'][8]['amount'] / 100, 2)],
                    'Debited in Settlement Bank but not Debited in Wallet' => [
                        'NCHL Bank Transfer' => round($walletClearanceResponse['generated_sums_title'][7]['amount'] / 100, 2),
                        'NCHL Agg Commission to Dpaisa' => round($walletClearanceResponse['generated_sums_title'][9]['amount'] / 100, 2),
                        'NPS FT Commission to Dpaisa' => 0,
                        'Paypoint Advance' => round($walletClearanceResponse['generated_sums_title'][10]['amount'] / 100, 2),
                    ],
                ],

                'Balance (1+2-6)' => round($walletClearanceResponse['recon_data']['opening_balance'] / 100 + $walletClearanceResponse['recon_data']['add'] / 100 - $walletClearanceResponse['recon_data']['less'] / 100, 2),
                'Balance as per Settlement Bank (Statement)' => round($walletClearanceResponse['recon_data']['balance_per_statement'], 2),
                'Difference (10-11)' => round($walletClearanceResponse['recon_data']['opening_balance'] / 100 + $walletClearanceResponse['recon_data']['add'] / 100 - $walletClearanceResponse['recon_data']['less'] / 100 - $walletClearanceResponse['recon_data']['balance_per_statement'], 2),

            ],


        ];

        return view('WalletReport::nrbAnnex.nrb-recon-report')->with(compact('nrbReconciliationReport'));
    }
}
