<?php

namespace App\Wallet\WalletAPI\Repositories;

use App\Traits\CollectionPaginate;
use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\WalletAPI\Microservice\NchlMicroservice;
use Illuminate\Http\Request;
use App\Wallet\NCHL\Repository\NchlBankTransferRepository;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NchlApiValidationRepository
{
    use CollectionPaginate;

    protected $from;
    protected $to;

    public function getDisputedTransactions(Request $request, NchlBankTransferRepository $repository)
    {
        $debit_mismatches = array();
        $credit_mismatches[] = null;
        $amount_mismatches[] = null;
        $wallet_success_mismatches = array();
        $nchl_success_mismatches[] = null;

        if (!empty($_GET['from'])) {
            $from_convert = strtotime($_GET['from']);
            $this->from = date('Y-m-d', $from_convert);
        }
        if (!empty($_GET['to'])) {
            $to_convert = strtotime($_GET['to']);
            $this->to = date('Y-m-d', $to_convert);
        }

        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $transactions = $repository->latestTransactionsUnpaginated()->whereBetween('created_at', [$this->from, $this->to])->get();
        }else {
            $transactions = $repository->latestTransactionsUnpaginated()->whereBetween('created_at', [Carbon::now()->subMonths(6)->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);

        }
        $nchlAPIs = array();
        $nchlMicroservice = new NchlMicroservice();
        $nchlAPIs = $nchlMicroservice->getNchlAPIByDate($request,$this->from,$this->to);
        $comparedNchlAPIs = array();
        foreach ($transactions as $transaction) {
            foreach($nchlAPIs as $nchlAPI){
                if($nchlAPI['cipsBatchDetail']['batchId'] == $transaction->transaction_id){
                    $comparedNchlAPIs[]=$nchlAPI;

                    if ((optional($transaction)->debit_status) != ($nchlAPI['cipsBatchDetail']['debitStatus'] ?? null)) {
                        $debit_mismatches[] = $transaction;
//                $debit_mismatch_api[] = $nchlAPI;
                    }

                    if ((optional($transaction)->credit_status) != ($nchlAPI['cipsTransactionDetailList']['0']['creditStatus'] ?? null)) {
                        $credit_mismatches[] = $transaction;
                    }

                    if ((optional($transaction)->amount) != ($nchlAPI['cipsTransactionDetailList']['0']['amount'] ?? null)) {
                        $amount_mismatches[] = $transaction;
                    }

                    if (($this->walletStatus($transaction)) == 'success' && ($this->compareStatus($nchlAPI)) == 'failed') {

                        $wallet_success_mismatches[] = $transaction;
                    }

                    if (($this->walletStatus($transaction)) == 'failed' && ($this->compareStatus($nchlAPI)) == 'success') {
                        $nchl_success_mismatches[] = $transaction;
                    }
                }
            }
        }
        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $totalTransactionCount = count($transactions);
        }else{
            $totalTransactionCount = count($transactions->get());
        }
        $totalAmount = $transactions->sum('amount');
        $totalAmountAPI = 0;
        foreach ($comparedNchlAPIs as $nchlAPI) {
            if (isset($nchlAPI['cipsBatchDetail']['batchAmount'])) {
                $totalAmountAPI += $nchlAPI['cipsBatchDetail']['batchAmount'];
            }
        }

        $disputedTransactions = ['wallet_success_mismatches' => $wallet_success_mismatches,
            'nchl_success_mismatches' => $nchl_success_mismatches,
            'debit_mismatches' => $debit_mismatches,
            'credit_mismatches' => $credit_mismatches,
            'amount_mismatches' => $amount_mismatches,
            'comparedNchlAPIs' => $comparedNchlAPIs,
            'transactions' => $transactions,
            'totalTransactionCount' => $totalTransactionCount,
            'totalAmount' => $totalAmount,
            'totalAmountAPI' => $totalAmountAPI,
        ];
        return $disputedTransactions;
    }

    public function compareStatus($nchlAPI)
    {
        if (empty($nchlAPI)) {
            return "failed";
        }

        if ($nchlAPI['cipsTransactionDetailList']['0']['creditStatus'] == '000' || optional($nchlAPI['cipsTransactionDetailList']['0']['creditStatus']) == '999' || optional($nchlAPI['cipsTransactionDetailList']['0']['creditStatus']) == 'DEFER' &&
            optional(($nchlAPI['cipsBatchDetail']['debit_status']) == '000')) {
            $nchlStatus = 'success';
        } elseif ($nchlAPI['cipsBatchDetail']['debitStatus'] == 'ENTR' || $nchlAPI['cipsTransactionDetailList']['0']['creditStatus'] == 'ENTR') {
            $nchlStatus = 'success';
        } else {
            $nchlStatus = 'failed';
        }
        return $nchlStatus;
    }

    public function walletStatus($transaction)
    {
        if (empty($transaction)) {
            return "failed";
        }

        if (($transaction->credit_status == '000' || $transaction->credit_status == '999' || $transaction->credit_status == 'DEFER') &&
            ($transaction->debit_status == '000')) {
            $walletStatus = 'success';
        } elseif ($transaction->debit_status == 'ENTR' || $transaction->credit_status == 'ENTR') {
            $walletStatus = 'success';
        } else {
            $walletStatus = 'failed';
        }
        return $walletStatus;
    }
}
