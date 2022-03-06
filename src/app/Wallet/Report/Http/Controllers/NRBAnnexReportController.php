<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use App\Wallet\Report\Repositories\NrbAnnexAgentMerchantPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbAnnexAgentPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbAnnexCustomerPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbAnnexMerchantPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbAnnexPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbEachAgentReportRepository;
use App\Wallet\Report\Repositories\StatementSettlementBankRepository;
use App\Wallet\WalletAPI\Microservice\WalletClearanceMicroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NRBAnnexReportController extends Controller
{
    use CollectionPaginate;

    public function agentReport(Request $request)
    {
        //10.1.5 agent report
        if ($request->all() != NULL) {
            $amountRange = json_decode($request->amount_range);
            $fromAmount = $request->fromAmount;
            $toAmount = $request->toAmount;
            $request->merge(['fromAmount' => $fromAmount, 'toAmount' => $toAmount]);
        }

        $repository = new NrbAnnexPaymentReportRepository($request);

        $nrbAnnexAgentPayments = [
            'Bill Payment' => [
                'number' => $repository->getBillPaymentCount(),
                'value' => ($repository->getBillPaymentValue()) ?? 0
            ],

            'Transfer (A/c to A/c)' => [
                'number' => $repository->getTransferCount(),
                'value' => ($repository->getTransferValue()) ?? 0,
            ],

            'Cash In (wallet load)' => [
                'number' => $repository->getCashInCount(),
                'value' => ($repository->getCashInValue()) ?? 0
            ],

            'Offer/Cashback/Coupon' => [
                'number' => $repository->getOfferNumber(),
                'value' => ($repository->getOfferValue()) ?? 0
            ],

            'Fees and Charges' => [
                'number' => $repository->getFeesChargesNumber(),
                'value' => ($repository->getFeesChargesValue()) ?? 0
            ],

            'Cash Out' => [
                'number' => $repository->getCashOutNumber(),
                'value' => ($repository->getCashOutValue()) ?? 0,
            ],

            'QR Payment' => [
                'number' => $repository->getQRPaymentCount(),
                'value' => $repository->getQRPaymentValue() ?? 0,
            ],

            'Service Refund' => [
                'number' => $repository->getServiceRefundCount(),
                'value' => $repository->getServiceRefundValue() ?? 0,
            ],

            'Government Payments' => [
                'number' => $repository->getGovernmentPaymentCount(),
                'value' => $repository->getGovernmentPaymentValue() ?? 0,
            ],

            'Others' => [
                'number' => 0,
                'value' => 0,
            ]
        ];

        return view('WalletReport::nrbAnnex.transaction-report-agent')->with(compact('nrbAnnexAgentPayments'));
    }

    public function customerReport(Request $request)
    {
        //10.1.5 initiated customer report
        if ($request->all() != NULL) {
            $amountRange = json_decode($request->amount_range);
            $fromAmount = $request->fromAmount;
            $toAmount = $request->toAmount;
            $request->merge(['fromAmount' => $fromAmount, 'toAmount' => $toAmount]);
        }

        $repository = new NrbAnnexCustomerPaymentReportRepository($request);

        $nrbAnnexCustomerPayments = [
            'Bill Payment' => [
                'number' => $repository->getBillPaymentCount(),
                'value' => ($repository->getBillPaymentValue()) ?? 0
            ],

            'Transfer (A/c to A/c)' => [
                'number' => $repository->getTransferCount(),
                'value' => ($repository->getTransferValue()) ?? 0,
            ],

            'Cash In (wallet load)' => [
                'number' => $repository->getCashInCount(),
                'value' => ($repository->getCashInValue()) ?? 0
            ],

            'Offer/Cashback/Coupon' => [
                'number' => $repository->getOfferNumber(),
                'value' => ($repository->getOfferValue()) ?? 0
            ],

            'Fees and Charges' => [
                'number' => $repository->getFeesChargesNumber(),
                'value' => ($repository->getFeesChargesValue()) ?? 0
            ],

            'Cash Out' => [
                'number' => $repository->getCashOutNumber(),
                'value' => ($repository->getCashOutValue()) ?? 0,
            ],

            'QR Payment' => [
                'number' => $repository->getQRPaymentCount(),
                'value' => $repository->getQRPaymentValue() ?? 0,
            ],

            'Service Refund' => [
                'number' => $repository->getServiceRefundCount(),
                'value' => $repository->getServiceRefundValue() ?? 0,
            ],

            'Government Payments' => [
                'number' => $repository->getGovernmentPaymentCount(),
                'value' => $repository->getGovernmentPaymentValue() ?? 0,
            ],

            'Others' => [
                'number' => 0,
                'value' => 0,
            ]
        ];

        return view('WalletReport::nrbAnnex.transaction-report-customer')->with(compact('nrbAnnexCustomerPayments'));
    }

//    public function customerReportDetails(Request $request)
//    {
//        if ($request->all() != NULL) {
//            $amountRange = json_decode($request->amount_range);
//            $fromAmount = $amountRange->fromAmount;
//            $toAmount = $amountRange->toAmount;
//            $request->merge(['fromAmount' => $fromAmount, 'toAmount' => $toAmount]);
//        }
//
//        $repository = new NrbAnnexCustomerPaymentReportRepository($request);
//
//        $nrbAnnexCustomerPayments = [
//            'Range of Transactions' => [
//                'number' => $repository->getBillPaymentCount(),
//                'value' => ($repository->getBillPaymentValue()) ?? 0
//            ],
//
//            'Form of Transaction' => [
//                'number' => $repository->getTransferCount(),
//                'value' => ($repository->getTransferValue()) ?? 0,
//            ],
//
//            'Cash In (wallet load)' => [
//                'number' => $repository->getCashInCount(),
//                'value' => ($repository->getCashInValue()) ?? 0
//            ],
//
//            'Offer/Cashback/Coupon' => [
//                'number' => $repository->getOfferNumber(),
//                'value' => ($repository->getOfferValue()) ?? 0
//            ],
//
//            'Fees and Charges' => [
//                'number' => $repository->getFeesChargesNumber(),
//                'value' => ($repository->getFeesChargesValue()) ?? 0
//            ],
//
//            'Cash Out' => [
//                'number' => $repository->getCashOutNumber(),
//                'value' => ($repository->getCashOutValue()) ?? 0,
//            ],
//
//            'QR Payment' => [
//                'number' => $repository->getQRPaymentCount(),
//                'value' => $repository->getQRPaymentValue() ?? 0,
//            ],
//
//            'Service Refund' => [
//                'number' => $repository->getServiceRefundCount(),
//                'value' => $repository->getServiceRefundValue() ?? 0,
//            ],
//
//            'Others' => [
//                'number' => 0,
//                'value' => 0,
//            ]
//        ];
//
//        return view('WalletReport::nrbAnnex.transaction-report-customer')->with(compact('nrbAnnexCustomerPayments'));
//    }


    public function merchantReport(Request $request)
    {
        //NRB Annex 10.1.6 Report

//        if ($request->all() != NULL) {
//            $amountRange = json_decode($request->amount_range);
//            $fromAmount = $amountRange->fromAmount;
//            $toAmount = $amountRange->toAmount;
//            $request->merge(['fromAmount' => $fromAmount, 'toAmount' => $toAmount]);
//        }

//        if($request->all() == null){
//            return view('WalletReport::nrbAnnex.transaction-report-merchant');
//        }

        $repository = new NrbAnnexMerchantPaymentReportRepository($request);

        $nrbAnnexMerchantPayments = [
            'Merchant Payment' => [
                'successful' => $repository->getSuccessfulMerchantPaymentCount(),
                'failed' => ($repository->getFailedMerchantPaymentCount())
            ],

            'Transfer to wallet (P2P)' => [
                'successful' => $repository->getSuccessfulLoadFundsCount(),
                'failed' => ($repository->getFailedLoadFundsCount())
            ],

            'Transfer to bank A/C (P2P)' => [
                'successful' => $repository->getSuccessfulBankTransferCount(),
                'failed' => ($repository->getFailedBankTransferCount())
            ],

            'Government payment (P2G)' => [
                'successful' => $repository->getSuccessfulNchlAggregatedCount(),
                'failed' => ($repository->getFailedNchlAggregatedCount())
            ],

            'Topup' => [
                'successful' => $repository->getSuccessfulTopUpCount(),
                'failed' => ($repository->getFailedTopUpCount())
            ],

            'Cash in' => [
                'successful' => $repository->getSuccessfulCashInCount(),
                'failed' => ($repository->getFailedCashInCount())
            ],

            'Cash out' => [
                'successful' => $repository->getSuccessfulCashOutCount(),
                'failed' => ($repository->getFailedCashOutCount())
            ],

        ];

        return view('WalletReport::nrbAnnex.transaction-report-merchant')->with(compact('nrbAnnexMerchantPayments'));
    }

    public function agentMerchantReport(Request $request)
    {
//        if ($request->all() != NULL) {
//            $amountRange = json_decode($request->amount_range);
//            $fromAmount = $amountRange->fromAmount;
//            $toAmount = $amountRange->toAmount;
//            $request->merge(['fromAmount' => $fromAmount, 'toAmount' => $toAmount]);
//        }

//        if($request->all() == null){
//            return view('WalletReport::nrbAnnex.transaction-report-merchant');
//        }

        $repository = new NrbAnnexAgentMerchantPaymentReportRepository($request);

        $nrbAnnexMerchantPayments = [
            'Merchant Payment' => [
                'successful' => $repository->getSuccessfulMerchantPaymentCount(),
                'failed' => ($repository->getFailedMerchantPaymentCount())
            ],

            'Transfer to wallet (P2P)' => [
                'successful' => $repository->getSuccessfulLoadFundsCount(),
                'failed' => ($repository->getFailedLoadFundsCount())
            ],

            'Transfer to bank A/C (P2P)' => [
                'successful' => $repository->getSuccessfulBankTransferCount(),
                'failed' => ($repository->getFailedBankTransferCount())
            ],

            'Government payment (P2G)' => [
                'successful' => $repository->getSuccessfulNchlAggregatedCount(),
                'failed' => ($repository->getFailedNchlAggregatedCount())
            ],

            'Topup' => [
                'successful' => $repository->getSuccessfulTopUpCount(),
                'failed' => ($repository->getFailedTopUpCount())
            ],

            'Cash in' => [
                'successful' => $repository->getSuccessfulCashInCount(),
                'failed' => ($repository->getFailedCashInCount())
            ],

            'Cash out' => [
                'successful' => $repository->getSuccessfulCashOutCount(),
                'failed' => ($repository->getFailedCashOutCount())
            ],

        ];

        return view('WalletReport::nrbAnnex.transaction-report-agent-merchant')->with(compact('nrbAnnexMerchantPayments'));
    }

    public function statementSettlementBank(Request $request)
    {
        if ($request->all() == null) {
            return view('WalletReport::nrbAnnex.statement-settlement-bank');
        }
        $repository = new StatementSettlementBankRepository($request);

        $check = $repository->checkForReport();

        if ($check == null) {
            $walletClearance = new WalletClearanceMicroService();
            $walletClearanceResponse['message'] = '';

            if (isset(request()->from)) {
                $walletClearanceResponse = $walletClearance->dispatchStatementSettlementJobs(request(), request()->from);
            }

            $statementSettlementBanks = 'The report is being generated. Please check in at another time. Current Status: Starting Report Generation ....';

            return view('WalletReport::nrbAnnex.statement-settlement-bank', compact('statementSettlementBanks'));
        }
        if ($check) {
            if ($check->status == "PROCESSING") {
                $statementSettlementBanks = 'The report is being generated. Please check in at another time. Current Status: Processing Report Generation ....';
                return view('WalletReport::nrbAnnex.statement-settlement-bank', compact('statementSettlementBanks'));
            }
        }

        $statementSettlementBanks = [
            'NPAY' => [
                'debit' => 0,
                'credit' => ($repository->getCreditByTitle($check->id, "NPAY")) ?? 0
            ],

            'NPS' => [
                'debit' => 0,
                'credit' => ($repository->getCreditByTitle($check->id, "NPS")) ?? 0
            ],

            'NCHL LOAD' => [
                'debit' => 0,
                'credit' => ($repository->getCreditByTitle($check->id, "NCHL_LOAD")) ?? 0
            ],

            'NCHL Aggregated' => [
                'debit' => $repository->getCreditByTitle($check->id, "NCHL_AGG"),
                'credit' => 0
            ],

            'CyberSource' => [
                'debit' => 0,
                'credit' => ($repository->getCreditByTitle($check->id, "NCHL_CYBERSOURCE")) ?? 0
            ],

            'PayPoint Advance' => [
                'debit' => $repository->getCreditByTitle($check->id, "PP_ADVANCE"),
                'credit' => 0
            ],
        ];

        return view('WalletReport::nrbAnnex.statement-settlement-bank')->with(compact('statementSettlementBanks'));
    }

    public function agentPaymentReport(Request $request)
    {
        if ($request->all() == null) {
            return view('WalletReport::nrbAnnex.agent-payment-report');
        }

        $repository = new NrbAnnexAgentPaymentReportRepository($request);

        $check = $repository->checkForReport();

        if ($check == null) {
            $walletClearance = new WalletClearanceMicroService();

            $walletClearanceResponse = $walletClearance->dispatchAgentPaymentJobs(request());
            $agentPaymentReports = 'The report is being generated. Please check in at another time. Current Status: Starting Report Generation ....';

            return view('WalletReport::nrbAnnex.agent-payment-report', compact('agentPaymentReports'));
        }
        if ($check) {
            if ($check->status == "PROCESSING") {
                $agentPaymentReports = 'The report is being generated. Please check in at another time. Current Status: Processing Report Generation ....';
                return view('WalletReport::nrbAnnex.agent-payment-report', compact('agentPaymentReports'));
            }
        }

        $fromDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from)));
        $toDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to)));
        $walletClearanceResponses = DB::connection('clearance')->table('agent_reports')->where('from_date', $fromDate)->where('to_date', $toDate)->get();
        $agentPaymentReports = [];
        foreach ($walletClearanceResponses as $response) {
            $agentPaymentReports[] = [
                'agent_name' => $response->agent_name,
                'agent_code' => $response->agent_code,
                'sub_agents' => $response->sub_agents,
                'balance' => $response->balance,
                'bill_payments' => $response->bill_payments,
                'p2p' => $response->p2p,
                'cash_in' => $response->cash_in,
                'others' => 0,
                'total' => $response->total,
            ];
        }

        return view('WalletReport::nrbAnnex.agent-payment-report')->with(compact('agentPaymentReports'));
    }

    public function eachAgentReport(Request $request)
    {
        if ($request->all() == null) {
            return view('WalletReport::nrbAnnex.each-agent-report');
        }

        $repository = new NrbEachAgentReportRepository($request);

        $check = $repository->checkForReport();

        if ($check == null) {
            $walletClearance = new WalletClearanceMicroService();

            $walletClearanceResponse = $walletClearance->dispatchNrbAgentReportJobs(request());
            $nrbAgentReports = 'The report is being generated. Please check in at another time. Current Status: Starting Report Generation ....';

            return view('WalletReport::nrbAnnex.each-agent-report', compact('nrbAgentReports'));
        }
        if ($check) {
            if ($check->status == "PROCESSING") {
                $nrbAgentReports = 'The report is being generated. Please check in at another time. Current Status: Processing Report Generation ....';
                return view('WalletReport::nrbAnnex.each-agent-report', compact('nrbAgentReports'));
            }
        }

        $fromDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->from_date)));
        $toDate = date('Y-m-d', strtotime(str_replace(',', ' ', $request->to_date)));
        $walletClearanceResponses = DB::connection('clearance')->table('nrb_agent_reports')->where('from_date', $fromDate)->where('to_date', $toDate)->get();
        $nrbAgentReports = [];
        foreach ($walletClearanceResponses as $response) {
            $nrbAgentReports[] = [
                'agent_name' => $response->name,
                'agent_code' => $response->reference_code,
                'user_id' => $response->user_id,
                'totalTopUpCount' => $response->totalTopUpCount,
                'totalTopUpAmount' => ($response->totalTopUpAmount)/100,
                'totalTransferToWalletCount' => $response->totalTransferToWalletCount,
                'totalTransferToWalletAmount' => ($response->totalTransferToWalletAmount)/100,
                'totalTransferToBankCount' => $response->totalTransferToBankCount,
                'totalTransferToBankAmount' => ($response->totalTransferToBankAmount)/100,
                'totalCashInCount' => $response->totalCashInCount,
                'totalCashInAmount' =>( $response->totalCashInAmount)/100,
                'totalCashOutCount' => $response->totalCashOutCount,
                'totalCashOutAmount' => ($response->totalCashOutAmount)/100,
                'totalMerchantPaymentCount' => $response->totalMerchantPaymentCount,
                'totalMerchantPaymentAmount' => ($response->totalMerchantPaymentAmount)/100,
            ];
        }

        return view('WalletReport::nrbAnnex.each-agent-report', compact('nrbAgentReports'));
    }
}
