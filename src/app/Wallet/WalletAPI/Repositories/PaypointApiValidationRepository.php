<?php

namespace App\Wallet\WalletAPI\Repositories;

use App\Models\DisputedApiTransaction;
use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\WalletAPI\Microservice\PaypointMicroservice;
use Illuminate\Http\Request;
use App\Wallet\Paypoint\Repository\PayPointRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PaypointApiValidationRepository
{
    protected $from;
    protected $to;

    public function getDisputedTransactions(Request $request, PayPointRepository $repository)
    {
        $amount_mismatches[] = null;
        $wallet_success_mismatches = array();
        $paypoint_success_mismatches[] = null;
        $wallet_status_mismatches = array();
        $wallet_status_mismatches_api = array();

        if (!empty($_GET['from'])) {
            $from_convert = strtotime($_GET['from']);
            $this->from = date('Y-m-d', $from_convert);
            $convertedFrom = date('Y-m-d\TH:i:s', $from_convert);

        }
        if (!empty($_GET['to'])) {
            $to_convert = strtotime($_GET['to']);
            $this->to = date('Y-m-d', $to_convert);
            $convertedTo = date('Y-m-d\TH:i:s', $to_convert);
        }
        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $transactions = $repository->latestTransactionsUnpaginated()->whereBetween('created_at', [$this->from, $this->to])->get();

        } else {
            $transactions = $repository->latestTransactionsUnpaginated()->whereBetween('created_at', [Carbon::now()->subDays(7)->format('Y-m-d'), Carbon::now()->format('Y-m-d')])->get();
        }

        $paypointAPIs = array();
        $paypointMicroservice = new PaypointMicroservice();
        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $paypointAPI = $paypointMicroservice->getPaypointAPIByDate($request, $convertedFrom, $convertedTo);

        } else {
            $paypointAPI = $paypointMicroservice->getPaypointAPIByDate($request, Carbon::now()->subDays(7)->format('Y-m-d\TH:i:s'), Carbon::now()->format('Y-m-d\TH:i:s'));
        }

        $paypointAPIs=$paypointAPI['ResultMessage']['Transaction'];
//dd($transactions);
        foreach ($transactions as $transaction) {
            foreach ($paypointAPI['ResultMessage']['Transaction'] as $paypointAPITransaction) {
                if ($paypointAPITransaction['RefStan'] == $transaction->refStan) {

                    if ((optional($transaction->userTransaction)->amount * 100) != ($paypointAPITransaction['Amount'] ?? null)) {
                        $amount_mismatches[] = $transaction;
                    }

                    if ($transaction->code == 000 && ($paypointAPITransaction['Status'] ?? 4) != 1) {
                        $wallet_success_mismatches[] = $transaction;
                    }

                    if ($transaction->code != 000 && ($paypointAPITransaction['Status'] ?? 4) == 1) {
                        $paypoint_success_mismatches[] = $transaction;
                    }
                    if ($transaction->code == 000 && ($paypointAPITransaction['Status'] ?? 4) != 1 || $transaction->code != 000 && ($paypointAPITransaction['ResultMessage']['Transaction']['Status'] ?? 'no data') == 000) {
                        $wallet_status_mismatches[] = $transaction;
                        $wallet_status_mismatches_api[] = $paypointAPITransaction;
                    }
                }
            }
        }

        $totalTransactionCount = count($transactions);
        $totalTransactionCountAPI = count($paypointAPI['ResultMessage']['Transaction']);
        $totalAmount = 0;
        foreach ($transactions as $transaction) {
            if (isset($transaction->userTransaction->amount)) {
                $totalAmount += $transaction->userTransaction->amount;
            }
        }

        $totalAmountAPI = 0;
        foreach ($paypointAPI['ResultMessage']['Transaction'] as $paypointAPI) {
            if (isset($paypointAPI['Amount'])) {
                $totalAmountAPI += $paypointAPI['Amount'];
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
            'wallet_status_mismatches' => $wallet_status_mismatches,
            'wallet_status_mismatches_api' => $wallet_status_mismatches_api
        ];

        return $disputedTransactions;
    }
}
