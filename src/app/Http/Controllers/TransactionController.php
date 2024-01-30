<?php

namespace App\Http\Controllers;

use App\Models\KhaltiUserTransaction;
use App\Models\LoadTestFund;
use App\Models\TicketSale;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Wallet\FundRequest\Repository\FundRequestRepository;
use App\Wallet\FundTransfer\Repository\FundTransferRepository;
use App\Wallet\Khalti\Repository\KhaltiRepository;
use App\Wallet\NCHL\Repository\NchlAggregatedPaymentRepository;
use App\Wallet\NCHL\Repository\NchlBankTransferRepository;
use App\Wallet\NCHL\Repository\NchlLoadTransactionRepository;
use App\Wallet\NicAsia\Repository\NicAsiaCyberSourceRepository;
use App\Wallet\NPay\Repository\NPayRepository;
use App\Wallet\NPS\Repository\NPSRepository;
use App\Wallet\PayPoint\Repository\PayPointRepository;
use App\Wallet\TransactionEvent\Repository\TransactionEventRepository;
use App\Wallet\User\Repositories\UserRepository;
use App\Wallet\User\Repositories\UserTotalTransactionRepository;
use App\Wallet\NepalQR\Repository\NepalQRRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    //SUCCESSFUL
    public function complete(Request $request, TransactionEventRepository $repository)
    {
        if (!empty($_GET)) {
            $transactions = $repository->paginatedTransactions();
            $totalTransactionCount = $repository->transactionsCount();
            $totalTransactionAmountSum = $repository->transactionAmountSum();
            $totalTransactionFeeSum = $repository->transactionFeeSum();
$totalTransactionCommissionSum = $repository->transactionCommissionSum();
            $getAllUniqueVendors = $repository->getUniqueVendors();

//             $totalTransactionCashbackSum = $repository->transactionCashbackSum();
//             return view('admin.transaction.complete')->with(compact('transactions', 'getAllUniqueVendors', 'totalTransactionAmountSum', 'totalTransactionCount', 'totalTransactionFeeSum',
// 'totalTransactionCashbackSum','totalTransactionCommissionSum'));

            return view('admin.transaction.complete')->with(compact('transactions', 'getAllUniqueVendors', 'totalTransactionAmountSum', 'totalTransactionCount', 'totalTransactionFeeSum'));

        }
        $getAllUniqueVendors = $repository->getUniqueVendors();
        return view('admin.transaction.complete')->with(compact('getAllUniqueVendors'));

    }

    //USER TO USER FUND TRANSFER
    public function userToUserFundTransfer(FundTransferRepository $repository)
    {
        $fundTransfers = $repository->paginatedTransactions();
        return view('admin.transaction.userToUserFundTransfer')->with(compact('fundTransfers'));
    }

    public function userToUserFundTransferDetail($id, FundTransferRepository $repository)
    {
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.userToUserFundTransferDetail')->with(compact('transaction'));
    }

    //FUND REQUEST
    public function fundRequest(FundRequestRepository $repository)
    {
        $fundRequests = $repository->paginatedTransactions();
        return view('admin.transaction.fundRequest')->with(compact('fundRequests'));
    }

    public function fundRequestDetail($id, FundRequestRepository $repository)
    {
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.fundRequestDetail')->with(compact('transaction'));
    }

    //NPAY
    public function eBanking(Request $request, NPayRepository $repository)
    {
        if (!empty($_GET)) {
            $totalCountEbanking = $repository->getTotalCountEbanking();
            $totalSumEbanking = $repository->getTotalSumEbanking();
            $userLoadTransactions = $repository->paginatedTransactions();
            return view('admin.transaction.eBanking')->with(compact('userLoadTransactions', 'totalCountEbanking', 'totalSumEbanking'));
        }
        return view('admin.transaction.eBanking');

    }

    public function eBankingDetail($id, NPayRepository $repository)
    {
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.eBankingDetail')->with(compact('transaction'));
    }

    //NPS
    public function nps(Request $request, NPSRepository $repository)
    {
        if (!empty($_GET)) {
            $npsTotalTransactionCount = $repository->getNpsTotalTransactionCount();
            $npsTotalTransactionSum = $repository->getNpsTotalTransactionSum();
            $npsLoadTransactions = $repository->paginatedTransactions();
            return view('admin.transaction.nps', compact('npsLoadTransactions', 'npsTotalTransactionCount', 'npsTotalTransactionSum'));
        }
        return view('admin.transaction.nps');
    }

    public function npsDetail($id, NPSRepository $repository)
    {
        $transaction = $repository->detail($id);

        return view('admin.transaction.detail.npsDetail')->with(compact('transaction'));
    }


    //PAYPOINT
    public function paypoint(PayPointRepository $repository, Request $request)
    {
        if (!empty($_GET)) {
            $totalPayPointTransactionCount = $repository->getPayPointTransactionCount();
            $totalPayPointTransactionSum = $repository->getPayPointTransactionSum();
            $transactions = $repository->paginatedTransactions();
            dd($transactions);
            return view('admin.transaction.paypoint')->with(compact('transactions', 'totalPayPointTransactionCount', 'totalPayPointTransactionSum'));
        }
        return view('admin.transaction.paypoint');
    }

    public function paypointDetail($id, PayPointRepository $repository)
    {
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.paypointDetail')->with(compact('transaction'));
    }

    //NCHL LOAD TRANSACTION
    public function nchlLoadTransaction(NchlLoadTransactionRepository $repository, Request $request)
    {
        if (!empty($_GET)) {
            $totalNchlLoadTransactionCount = $repository->getTotalNchlLoadTransactionCount();
            $totalNchlLoadTransactionSum = $repository->getTotalNchlLoadTransactionSum();
            $transactions = $repository->paginatedTransactions();
            dd($transactions);
            return view('admin.transaction.nchlLoadTransaction')->with(compact('transactions', 'totalNchlLoadTransactionCount', 'totalNchlLoadTransactionSum'));
        }
        return view('admin.transaction.nchlLoadTransaction');
    }

    public function nchlLoadTransactionDetail($id, NchlLoadTransactionRepository $repository)
    {
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.nchlLoadTransactionDetail')->with(compact('transaction'));
    }

    //NCHL BANK TRANSFER
    public function nchlBankTransfer(NchlBankTransferRepository $repository, Request $request)
    {
        if (!empty($_GET)) {
            $totalNchlLoadBankTransferTransactionCount = $repository->getNchlLoadBankTransferTransactionCount();
            $totalNchlLoadBankTransferTransactionSum = $repository->getNchlLoadBankTransferTransactionSum();
            $transactions = $repository->paginatedTransactions();
            return view('admin.transaction.nchlBankTransfer')->with(compact('transactions', 'totalNchlLoadBankTransferTransactionCount', 'totalNchlLoadBankTransferTransactionSum'));
        }
        return view('admin.transaction.nchlBankTransfer');
    }

    public function nchlBankTransferDetail($id, NchlBankTransferRepository $repository)
    {
        Log::info('detail',[$id]);
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.nchlBankTransferDetail')->with(compact('transaction'));
    }

    //NCHL AGGREGATED PAYMENT
    public function nchlAggregatedPayment(NchlAggregatedPaymentRepository $repository)
    {
        $nchlAggregatedPayments = $repository->paginatedTransactions();
        $nchlAggregatedTotalCount = $repository->nchlAggregatePaymentTotalCount();
        $nchlAggregatedTotalAmount = $repository->nchlAggregatePaymentTotalAmount();
        $nchlAggregatedTotalFee = $repository->nchlAggregatePaymentTotalFee();
        return view('admin.transaction.nchlAggregatedTransaction', compact('nchlAggregatedPayments', 'nchlAggregatedTotalCount', 'nchlAggregatedTotalAmount', 'nchlAggregatedTotalFee'));
    }

    public function nchlAggregatedPaymentDetail($id, NchlAggregatedPaymentRepository $repository)
    {
        Log::info('repor', $repository);
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.nchlAggregatedPaymentDetail')->with(compact('transaction'));
    }


    //KHALTI
    public function khaltiPaymentDetail($id, KhaltiRepository $repository)
    {
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.khaltiDetail')->with(compact('transaction'));
    }

    //REIMBURSE TRANSACTION
    public function reimburseTransaction()
    {
        return view('admin.transaction.reimburse');
    }

    public function reimburseTransactionDetail()
    {
        return view('admin.transaction.detail.reimburseDetail');
    }


    public function transactionDetail()
    {
        return view('admin.transaction.transactionDetail');
    }

    //FAILED USER TRANSACTION
    public function failedUserTransaction(PayPointRepository $repository)
    {
        $failedTransactions = $repository->paginatedFailedTransaction();
        return view('admin.transaction.failedTransaction.paypoint')->with(compact('failedTransactions'));
    }

    //FAILED USER LOAD TRANSACTION
    public function failedUserLoadTransaction(NPayRepository $repository)
    {
        $failedTransactions = $repository->paginatedFailedTransaction();
        return view('admin.transaction.failedTransaction.npay')->with(compact('failedTransactions'));
    }

    //KHALTI TRANSACTION
    public function khaltiTransaction(KhaltiRepository $repository, Request $request)
    {

        if (!empty($_GET)) {
            $khaltiTotalTransactionCount = $repository->getKhaltiTotalTransactionCount();
            $khaltiTotalTransactionSum = $repository->getKhaltiTotalTransactionSum();
            $khaltiTransactions = $repository->paginatedTransactions();
            $vendorNames = $repository->getVendorName();
            return view('admin.transaction.khalti')->with(compact('khaltiTransactions', 'vendorNames', 'khaltiTotalTransactionCount', 'khaltiTotalTransactionSum'));
        }
        $vendorNames = $repository->getVendorName();
        return view('admin.transaction.khalti')->with(compact('vendorNames'));
    }

    public function khaltiSpecificDetail($id)
    {
        $khaltiTransaction = KhaltiUserTransaction::with('preTransaction')->find($id);
        return view('admin.transaction.khalti.details', compact('khaltiTransaction'));
    }

    public function completeUserList(Request $request, UserTotalTransactionRepository $user)
    {
        $users = $user->totalUserTransactions();

        return view('admin.transaction.userTransactionList')
            ->with(compact('users'));

    }

    public function ticketSalesReport(Request $request){
    
      $request->merge(['transaction_type'=>TicketSale::class]);
      $ticket_sales_reports = TransactionEvent::with('user')
          ->whereNull('refund_id')
          ->filter($request)
          ->get();
      return view('admin.transaction.ticketSalesReport.ticketSalesReport')->with(compact('ticket_sales_reports'));
    }

    public function loadTestFundReport(Request $request){

        $request->merge(['transaction_type'=>LoadTestFund::class,'service'=>'LUCKY WINNER']);
        $load_test_fund_reports = TransactionEvent::with('user')
            ->filter($request)
            ->get();

        return view('admin.transaction.loadTestFundReport.loadTestFundReport')->with(compact('load_test_fund_reports'));
    }

    //nepalqr payment transaction.
    public function nepalqrPayment(NepalQRRepository $repository, Request $request) {
        if (!empty($_GET)) {
            $totalTransactionCount = $repository->getNepalQrTransactionCount();
            $totalTransactionSum = $repository->getNepalQrTransactionSum();
            $transactions = $repository->paginatedTransactions();
            return view('admin.transaction.nepalqr')->with(compact('transactions', 'totalTransactionCount', 'totalTransactionSum'));
        }
        return view('admin.transaction.nepalqr');
    }

}
