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
        $wallet_success_mismatches = array();
        $paypoint_success_mismatches[] = null;

        if (!empty($_GET['from'])) {
            $from_convert = strtotime($_GET['from']);
            $from = date('Y-m-d', $from_convert);
        }
        if (!empty($_GET['to'])) {
            $to_convert = strtotime($_GET['to']);
            $to = date('Y-m-d', $to_convert);
        }

        $transactions = $repository->latestTransactionsUnpaginated()->whereBetween('created_at', [Carbon::now()->subMonths(6)->format('Y-m-d'), Carbon::now()->format('Y-m-d')])->get();
        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $transactions = $repository->latestTransactionsUnpaginated()->whereBetween('created_at', [$from, $to])->get();
        }

        $paypointAPIs = array();
        $paypointMicroservice = new PaypointMicroservice();

        foreach ($transactions as $transaction) {
            $id = $transaction->refStan;
            $paypointAPI = $paypointMicroservice->getPaypointAPI($request, $id);
            $paypointAPIs[] = $paypointAPI;
            if ((optional($transaction->userTransaction)->amount*100) != ($paypointAPI['ResultMessage']['Transaction']['Amount'] ?? null)) {
                $amount_mismatches[] = $transaction;
            }

            if ($transaction->code == 000 && ($paypointAPI['@attributes']['Result'] ?? 'no data') != 000) {
                $wallet_success_mismatches[] = $transaction;
            }

            if ($transaction->code != 000 && ($paypointAPI['@attributes']['Result'] ?? 'no data') == 000) {
                $paypoint_success_mismatches[] = $transaction;
            }

        }
        $totalTransactionCount = count($transactions);
        $totalTransactionCountAPI = count($paypointAPIs);
        $totalAmount = 0;
        foreach ($transactions as $transaction) {
            if (isset($transaction->userTransaction->amount)) {
                $totalAmount += $transaction->userTransaction->amount;
            }
        }
        $totalAmountAPI = 0;
        foreach ($paypointAPIs as $paypointAPI) {
            if (isset($paypointAPI['ResultMessage']['Transaction']['Amount'])) {
                $totalAmountAPI += $paypointAPI['ResultMessage']['Transaction']['Amount'];
            }
        }

        $disputedTransactions = ['wallet_success_mismatches' => $wallet_success_mismatches,
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
}
