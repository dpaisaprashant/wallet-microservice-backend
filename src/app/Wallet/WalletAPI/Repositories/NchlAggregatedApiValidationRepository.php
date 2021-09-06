<?php

namespace App\Wallet\WalletAPI\Repositories;

use App\Traits\CollectionPaginate;
use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\WalletAPI\Microservice\NchlAggregatedMicroservice;
use Illuminate\Http\Request;
use App\Wallet\NCHL\Repository\NchlAggregatedPaymentRepository;
use Carbon\Carbon;

class NchlAggregatedApiValidationRepository
{
    use CollectionPaginate;

    public function getDisputedTransactions(Request $request, NchlAggregatedPaymentRepository $repository)
    {
        $debit_mismatches = array();
        $credit_mismatches[] = null;
        $amount_mismatches[] = null;
        $wallet_success_mismatches = array();
        $nchl_success_mismatches[] = null;

        if (!empty($_GET['from'])) {
            $from_convert = strtotime($_GET['from']);
            $from = date('Y-m-d', $from_convert);
        }
        if (!empty($_GET['to'])) {
            $to_convert = strtotime($_GET['to']);
            $to = date('Y-m-d', $to_convert);
        }

        $transactions = $repository->paginatedTransactions()->whereBetween('created_at', [Carbon::now()->subMonths(12)->format('Y-m-d'), Carbon::now()->format('Y-m-d')]);
        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $transactions = $repository->latestTransactionsUnpaginated()->whereBetween('created_at', [$from, $to])->get();
        }
        $nchlAPIs = array();
        $nchlMicroservice = new NchlAggregatedMicroservice();
//dd($transactions);
        foreach ($transactions as $transaction) {
            $id = $transaction->transaction_id;
            $nchlAPI = $nchlMicroservice->getNchlAggregatedAPI($request, $id);
            $nchlAPIs[] = $nchlAPI;

            if ((optional($transaction)->debit_status) != ($nchlAPI['debitStatus'] ?? null)) {
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

        $totalTransactionCount = count($transactions);
        $totalTransactionCountAPI = count($nchlAPIs);
        $totalAmount = $transactions->sum('amount');
        $totalAmountAPI = 0;
        foreach ($nchlAPIs as $nchlAPI) {
            if (isset($nchlAPI['batchAmount'])) {
                $totalAmountAPI += $nchlAPI['batchAmount'];
            }
        }

//        $data = $this->paginate($nchl_status_mismatches);
$transactions= $transactions->paginate(15);
        $disputedTransactions = ['wallet_status_mismatches' => $wallet_success_mismatches,
            'nchl_status_mismatches' => $nchl_success_mismatches,
            'debit_mismatches' => $debit_mismatches,
            'credit_mismatches' => $credit_mismatches,
            'amount_mismatches' => $amount_mismatches,
            'nchlAPIs' => $nchlAPIs,
            'transactions' => $transactions,
            'totalTransactionCount' => $totalTransactionCount,
            'totalTransactionCountAPI' => $totalTransactionCountAPI,
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
            optional(($nchlAPI['debit_status']) == '000')) {
            $nchlStatus = 'success';
        } elseif ($nchlAPI['debitStatus'] == 'ENTR' || $nchlAPI['cipsTransactionDetailList']['0']['creditStatus'] == 'ENTR') {
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
