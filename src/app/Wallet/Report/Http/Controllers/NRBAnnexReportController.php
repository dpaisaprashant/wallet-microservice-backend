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
use App\Wallet\Report\Repositories\AgentReportRepository;
use App\Wallet\Report\Repositories\NonBankPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbAnnexCustomerPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbAnnexMerchantPaymentReportRepository;
use App\Wallet\Report\Repositories\NrbAnnexPaymentReportRepository;
use App\Wallet\Report\Repositories\StatementSettlementBankRepository;
use App\Wallet\WalletAPI\Microservice\WalletClearanceMicroService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NRBAnnexReportController extends Controller
{
    use CollectionPaginate;

    public function agentReport(Request $request)
    {
        if ($request->all() != NULL) {
            $amountRange = json_decode($request->amount_range);
            $fromAmount = $amountRange->fromAmount;
            $toAmount = $amountRange->toAmount;
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

            'Others' => [
                'number' => 0,
                'value' => 0,
            ]
        ];

        return view('WalletReport::nrbAnnex.transaction-report-agent')->with(compact('nrbAnnexAgentPayments'));
    }

    public function customerReport(Request $request)
    {
        if ($request->all() != NULL) {
            $amountRange = json_decode($request->amount_range);
            $fromAmount = $amountRange->fromAmount;
            $toAmount = $amountRange->toAmount;
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

            'Others' => [
                'number' => 0,
                'value' => 0,
            ]
        ];

        return view('WalletReport::nrbAnnex.transaction-report-customer')->with(compact('nrbAnnexCustomerPayments'));
    }

    public function customerReportDetails(Request $request)
    {
        if ($request->all() != NULL) {
            $amountRange = json_decode($request->amount_range);
            $fromAmount = $amountRange->fromAmount;
            $toAmount = $amountRange->toAmount;
            $request->merge(['fromAmount' => $fromAmount, 'toAmount' => $toAmount]);
        }

        $repository = new NrbAnnexCustomerPaymentReportRepository($request);

        $nrbAnnexCustomerPayments = [
            'Range of Transactions' => [
                'number' => $repository->getBillPaymentCount(),
                'value' => ($repository->getBillPaymentValue()) ?? 0
            ],

            'Form of Transaction' => [
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

            'Others' => [
                'number' => 0,
                'value' => 0,
            ]
        ];

        return view('WalletReport::nrbAnnex.transaction-report-customer')->with(compact('nrbAnnexCustomerPayments'));
    }


    public function merchantReport(Request $request)
    {
//        if ($request->all() != NULL) {
//            $amountRange = json_decode($request->amount_range);
//            $fromAmount = $amountRange->fromAmount;
//            $toAmount = $amountRange->toAmount;
//            $request->merge(['fromAmount' => $fromAmount, 'toAmount' => $toAmount]);
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
                'successful' => $repository->getSuccessfulAgentReceivedFundsCount(),
                'failed' => ($repository->getFailedAgentReceivedFundsCount())
            ],

            'Cash out' => [
                'successful' => $repository->getSuccessfulAgentTransferFundsCount(),
                'failed' => ($repository->getFailedAgentTransferFundsCount())
            ],

        ];

        return view('WalletReport::nrbAnnex.transaction-report-merchant')->with(compact('nrbAnnexMerchantPayments'));
    }

    public function statementSettlementBank(Request $request)
    {
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
}
