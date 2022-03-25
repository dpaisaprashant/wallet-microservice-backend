<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use App\Wallet\Report\Repositories\ActiveInactiveUserReportRepository;
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

    //10.1.5 agent report
    public function agentReport(Request $request)
    {
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

        if ($request->has('forExcel')) {
            return $nrbAnnexAgentPayments;
        }

        return view('WalletReport::nrbAnnex.transaction-report-agent')->with(compact('nrbAnnexAgentPayments'));
    }

    //10.1.5 initiated customer report
    public function customerReport(Request $request)
    {
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

        if ($request->has('forExcel')) {
            return $nrbAnnexCustomerPayments;
        }

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

    //10.1.6 report
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
                'successful' => $repository->getSuccessfulPaypointCount(),
                'failed' => ($repository->getFailedPaypointCount())
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

        if ($request->has('forExcel')) {
            return $nrbAnnexMerchantPayments;
        }

        return view('WalletReport::nrbAnnex.transaction-report-merchant')->with(compact('nrbAnnexMerchantPayments'));
    }

    //10.1.6 for agents only
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

    //Statement Settlement Bank Report
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

            'Bank Transfer' => [
                'debit' => $repository->getCreditByTitle($check->id, "BANK_TRANSFER"),
                'credit' => 0
            ]
        ];

        if ($request->has('forExcel')) {
            return $statementSettlementBanks;
        }

        return view('WalletReport::nrbAnnex.statement-settlement-bank')->with(compact('statementSettlementBanks'));
    }

    public function statementSettlementBankReportGenerated(Request $request)
    {
        $generatedReports = DB::connection('clearance')->table('statement_settlement_banks')->where('status', 'COMPLETED')->get();

        return view('WalletReport::nrbAnnex.statement-settlement-bank-generated', compact('generatedReports'));
    }

    public function statementSettlementBankReportDelete($id)
    {
        DB::connection('clearance')->table('statement_settlement_banks')->where('id', $id)->delete();
        return redirect()->back();
    }

    //10.1.11 Report
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

        if ($request->has('forExcel')) {
            return $agentPaymentReports;
        }
        return view('WalletReport::nrbAnnex.agent-payment-report')->with(compact('agentPaymentReports'));
    }

    public function agentPaymentReportGenerated(Request $request)
    {
        $generatedReports = DB::connection('clearance')->table('agent_reports')->where('status', 'COMPLETED')->groupBy(['from_date', 'to_date'])->get();

        return view('WalletReport::nrbAnnex.agent-payment-report-generated', compact('generatedReports'));
    }

    public function agentPaymentReportDelete($fromDate, $toDate)
    {
        DB::connection('clearance')->table('agent_reports')->where('from_date', $fromDate)->where('to_date', $toDate)->delete();
        return redirect()->back();
    }

    //22 part four agents report
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
                'totalTopUpCount' => $response->totalTopUpCount ?? 0,
                'totalTopUpAmount' => ($response->totalTopUpAmount) / 100 ?? 0,
                'totalTransferToWalletCount' => $response->totalTransferToWalletCount ?? 0,
                'totalTransferToWalletAmount' => ($response->totalTransferToWalletAmount) / 100 ?? 0,
                'totalTransferToBankCount' => $response->totalTransferToBankCount ?? 0,
                'totalTransferToBankAmount' => ($response->totalTransferToBankAmount) / 100 ?? 0,
                'totalCashInCount' => $response->totalCashInCount ?? 0,
                'totalCashInAmount' => ($response->totalCashInAmount) / 100 ?? 0,
                'totalCashOutCount' => $response->totalCashOutCount ?? 0,
                'totalCashOutAmount' => ($response->totalCashOutAmount) / 100 ?? 0,
                'totalMerchantPaymentCount' => $response->totalMerchantPaymentCount ?? 0,
                'totalMerchantPaymentAmount' => ($response->totalMerchantPaymentAmount) / 100 ?? 0,
                'totalGovernmentPaymentCount' => ($response->totalGovernmentPaymentAmount) ?? 0,
                'totalGovernmentPaymentAmount' => ($response->totalGovernmentPaymentAmount) / 100 ?? 0,
            ];
        }

        if ($request->has('forExcel')) {
            return $nrbAgentReports;
        }

        return view('WalletReport::nrbAnnex.each-agent-report', compact('nrbAgentReports'));
    }

    public function eachAgentReportGenerated(Request $request)
    {
        $generatedReports = DB::connection('clearance')->table('nrb_agent_report_statuses')->where('status', 'COMPLETED')->get();

        return view('WalletReport::nrbAnnex.each-agent-report-generated', compact('generatedReports'));
    }

    public function eachAgentReportDelete($id)
    {
        $report = DB::connection('clearance')->table('nrb_agent_report_statuses')->where('id', $id)->first();

        DB::connection('clearance')->table('nrb_agent_reports')->where('from_date', $report->from_date)->where('to_date', $report->to_date)->delete();
        DB::connection('clearance')->table('nrb_agent_report_statuses')->where('id', $id)->delete();
        return redirect()->back();
    }
}
