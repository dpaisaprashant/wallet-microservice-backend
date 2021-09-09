<?php

namespace App\Wallet\WalletAPI\Repositories;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\WalletAPI\Microservice\PaypointMicroservice;
use Illuminate\Http\Request;
use App\Wallet\Paypoint\Repository\PayPointRepository;
use Carbon\Carbon;

class PaypointApiValidationRepository
{
    protected $from;
    protected $to;

    public function getDisputedTransactions(Request $request, PayPointRepository $repository)
    {


        $amount_mismatches[] = null;
        $wallet_success_mismatches = array();
        $paypoint_success_mismatches[] = null;
        $wallet_status_mismatches=array();
        $wallet_status_mismatches_api=array();

        if (!empty($_GET['from'])) {
            $from_convert = strtotime($_GET['from']);
            $this->from = date('Y-m-d', $from_convert);
            $convertedFrom =date('Y-m-d\TH:i:s', $from_convert);

        }
        if (!empty($_GET['to'])) {
            $to_convert = strtotime($_GET['to']);
            $this->to = date('Y-m-d', $to_convert);
            $convertedTo=date('Y-m-d\TH:i:s', $from_convert);
        }
        if (!empty($_GET['from']) && !empty($_GET['to'])) {
            $transactions = $repository->latestTransactionsUnpaginated()->whereBetween('created_at', [$this->from, $this->to])->get();

        } else {
            $transactions = $repository->latestTransactionsUnpaginated()->whereBetween('created_at', [Carbon::now()->subDays(7)->format('Y-m-d'), Carbon::now()->format('Y-m-d')])->get();
        }

        $paypointAPIs = array();
        $paypointMicroservice = new PaypointMicroservice();

        foreach ($transactions as $transaction) {

            if (!empty($_GET['from']) && !empty($_GET['to'])) {
                $paypointAPI = $paypointMicroservice->getPaypointAPIByDate($request, $convertedFrom, $convertedTo);

            } else {
                $paypointAPI = $paypointMicroservice->getPaypointAPIByDate($request, Carbon::now()->subDays(7)->format('Y-m-d\TH:i:s'), Carbon::now()->format('Y-m-d\TH:i:s'));
            }

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
            if($transaction->code == 000 && ($paypointAPI['@attributes']['Result'] ?? 'no data') != 000 || $transaction->code != 000 && ($paypointAPI['@attributes']['Result'] ?? 'no data') == 000){
                $wallet_status_mismatches[]=$transaction;
                $wallet_status_mismatches_api[]=$paypointAPI;
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
            'wallet_status_mismatches' => $wallet_status_mismatches,
            'wallet_status_mismatches_api' => $wallet_status_mismatches_api
        ];
        return $disputedTransactions;
    }
}
