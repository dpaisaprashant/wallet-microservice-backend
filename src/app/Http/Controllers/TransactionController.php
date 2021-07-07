<?php

namespace App\Http\Controllers;

use App\Models\KhaltiUserTransaction;
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
use Carbon\Carbon;
use Illuminate\Http\Request;


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
            $getAllUniqueVendors = $repository->getUniqueVendors();
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

    //PAYPOINT
    public function paypoint(PayPointRepository $repository, Request $request)
    {
        if (!empty($_GET)) {
            $totalPayPointTransactionCount = $repository->getPayPointTransactionCount();
            $totalPayPointTransactionSum = $repository->getPayPointTransactionSum();
            $transactions = $repository->paginatedTransactions();
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
        if(!empty($_GET)) {
            $totalNchlLoadTransactionCount = $repository->getTotalNchlLoadTransactionCount();
            $totalNchlLoadTransactionSum = $repository->getTotalNchlLoadTransactionSum();
            $transactions = $repository->paginatedTransactions();
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
        if(!empty($_GET)) {
            $totalNchlLoadBankTransferTransactionCount = $repository->getNchlLoadBankTransferTransactionCount();
            $totalNchlLoadBankTransferTransactionSum = $repository->getNchlLoadBankTransferTransactionSum();
            $transactions = $repository->paginatedTransactions();
            return view('admin.transaction.nchlBankTransfer')->with(compact('transactions', 'totalNchlLoadBankTransferTransactionCount', 'totalNchlLoadBankTransferTransactionSum'));
        }
        return view('admin.transaction.nchlBankTransfer');
    }

    public function nchlBankTransferDetail($id, NchlBankTransferRepository $repository)
    {
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.nchlBankTransferDetail')->with(compact('transaction'));
    }

    //NCHL AGGREGATED PAYMENT
    public function nchlAggregatedPaymentDetail($id, NchlAggregatedPaymentRepository $repository)
    {
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.nchlAggregatedPaymentDetail')->with(compact('transaction'));
    }

    //NIC ASIA CYBERSOURCE LOAD TRANSACTION
    public function nicAsiaCyberSourceLoadDetail($id, NicAsiaCyberSourceRepository $repository)
    {
        $transaction = $repository->detail($id);
        return view('admin.transaction.detail.nicAsiaCyberSourceLoadDetail')->with(compact('transaction'));
    }

    public function nicAsiaCyberSourceLoad(NicAsiaCyberSourceRepository $repository, Request $request)
    {
        if(!empty($_GET)) {
            $totalNicAisaTransactionCount = $repository->getTotalNicAisaTransactionCount();
            $totalNicAisaTransactionSum = $repository->getTotalNicAisaTransactionSum();
            $transactions = $repository->paginatedTransactions();
            return view('admin.transaction.nicAsiaCyberSourceLoad', compact('transactions', 'totalNicAisaTransactionCount', 'totalNicAisaTransactionSum'));
        }
        return view('admin.transaction.nicAsiaCyberSourceLoad');
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
}
