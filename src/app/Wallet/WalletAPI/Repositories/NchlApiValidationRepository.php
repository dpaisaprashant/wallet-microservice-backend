<?php

namespace App\Wallet\WalletAPI\Repositories;

use App\Events\CreditTransactionCompleteEvent;
use App\Http\Requests\NCHL\NchlProcessLoadRequest;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Wallet\Architecture\Builders\WalletTransactionTypeValidationBuilder;
use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\WalletAPI\PreTransactionMicroservice;
use App\Wallet\Microservice\Response\CreditResponse;
use Illuminate\Http\Request;
use App\Wallet\NCHL\Repository\NchlBankTransferRepository;
use Carbon\Carbon;

class NchlApiValidationRepository
{
    public function getNchlAPI(Request $request, $id)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("NCHL_LOAD")
            ->setDescription("Nchl process load transaction")
            ->setVendor("NCHL_LOAD")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl/report/by-id")
            ->setRequestParam(['batch_id' => $id]);
        $response = $microservice->processRequest();
        $nchlAPI = json_decode($response, true);
        return $nchlAPI;
    }

    public function getDisputedTransactions(Request $request, NchlBankTransferRepository $repository)
    {
//        $disputedTransactions = array();
        $debit_mismatches = array();
        $debit_mismatch_api[] = null;
        $credit_mismatches[] = null;
        $credit_mismatches_api[] = null;
        $amount_mismatches[] = null;
        $amount_mismatches_api[] = null;
        $wallet_status_mismatches = array();
        $wallet_status_mismatches_api[] = null;
        $nchl_status_mismatches[] = null;
        $nchl_status_mismatches_api[] = null;

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
        $nchlAPIs = array();

        foreach ($transactions as $transaction) {
            $id = $transaction->transaction_id;
            $nchlAPI = $this->getNchlAPI($request, $id);
            $nchlAPIs[] = $nchlAPI;

            if ((optional($transaction)->debit_status) != ($nchlAPI['debitStatus'] ?? null)) {
                $debit_mismatches[] = $transaction;
                $debit_mismatch_api[] = $nchlAPI;
            }

            if ((optional($transaction)->credit_status) != ($nchlAPI['cipsTransactionDetailList']['0']['creditStatus'] ?? null)) {
                $credit_mismatches[] = $transaction;
                $credit_mismatches_api[] = $nchlAPI;
            }

            if ((optional($transaction)->amount) != ($nchlAPI['cipsTransactionDetailList']['0']['amount'] ?? null)) {
                $amount_mismatches[] = $transaction;
                $amount_mismatches_api[] = $nchlAPI;
            }

            if (($this->walletStatus($transaction)) == 'success' && ($this->compareStatus($nchlAPI)) == 'failed') {
                $wallet_status_mismatches[] = $transaction;
                $wallet_status_mismatches_api[] = $nchlAPI;
            }

            if (($this->walletStatus($transaction)) == 'failed' && ($this->compareStatus($nchlAPI)) == 'success') {
                $nchl_status_mismatches[] = $transaction;
                $nchl_status_mismatches_api[] = $nchlAPI;
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

        $disputedTransactions = ['wallet_status_mismatches' => $wallet_status_mismatches,
            'wallet_status_mismatch_api' => $wallet_status_mismatches_api,
            'nchl_status_mismatches' => $nchl_status_mismatches,
            'nchl_status_mismatches_api' => $nchl_status_mismatches_api,
            'debit_mismatches' => $debit_mismatches,
            'debit_mismatches_api' => $debit_mismatch_api,
            'credit_mismatches' => $credit_mismatches,
            'credit_mismatches_api' => $credit_mismatches_api,
            'amount_mismatches' => $amount_mismatches,
            'amount_mismatches_api' => $amount_mismatches_api,
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
