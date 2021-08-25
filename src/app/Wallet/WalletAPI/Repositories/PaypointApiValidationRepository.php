<?php

namespace App\Wallet\WalletAPI\Repositories;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\WalletAPI\Microservice\PaypointMicroservice;
use Illuminate\Http\Request;
use App\Wallet\Paypoint\Repository\PayPointRepository;
use Carbon\Carbon;

class PaypointApiValidationRepository
{
    public function getDisputedTransactions(Request $request, PayPointRepository $repository)
    {
        $amount_mismatches[] = null;
        $wallet_status_mismatches = array();
        $paypoint_success_mismatches[] = null;

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
            $transactions = $repository->paginatedTransactions()->whereBetween('created_at', [$from, $to]);
        }

        $paypointAPIs = array();
        $paypointMicroservice = new PaypointMicroservice();

        foreach ($transactions as $transaction) {
            $id = $transaction->transaction_id;
            $paypointAPI = $paypointMicroservice->getPaypointAPI($request, $id);
            $paypointAPIs[] = $paypointAPI;

            if ((optional($transaction)->amount) != ($paypointAPI['ResultMessage']['Amount'] ?? null)) {
                $amount_mismatches[] = $transaction;
            }

            if ($transaction->code == 000 && ($paypointAPI['@attributes']['Result'] ?? null) != 000) {
                $wallet_success_mismatches[] = $transaction;
            }

            if ($transaction->code != 000 && $paypointAPI['@attributes']['Result'] == 000) {
                $api_success_mismatches[] = $transaction;
            }

        }
        $totalTransactionCount = count($transactions);
        $totalTransactionCountAPI = count($paypointAPIs);
        $totalAmount = $transactions->sum('amount');
        $totalAmountAPI = 0;
        foreach ($paypointAPIs as $paypointAPI) {
            if (isset($paypointAPI['ResultMessage']['Amount'])) {
                $totalAmountAPI += $paypointAPI['ResultMessage']['Amount'];
            }
        }

//        $data = $this->paginate($nchl_status_mismatches);

        $disputedTransactions = ['wallet_success_mismatches' => $wallet_status_mismatches,
            'paypoint_success_mismatches' => $paypoint_success_mismatches,
            'amount_mismatches' => $amount_mismatches,
            'paypointAPIs' => $paypointAPIs,
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
