<?php

namespace App\Wallet\WalletAPI\Http\Controllers;

use App\Events\CreditTransactionCompleteEvent;
use App\Http\Requests\NCHL\NchlProcessLoadRequest;
use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Wallet\Architecture\Builders\WalletTransactionTypeValidationBuilder;
use App\Wallet\Limits\Traits\CheckLimit;
use App\Wallet\WalletAPI\BackendWalletAPIJSONAbstract;
use App\Wallet\WalletAPI\PreTransactionMicroservice;
use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\Microservice\Response\CreditResponse;
use App\Wallet\Traits\ApiResponder;
use App\Wallet\WalletAPI\Repositories\NchlApiValidationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Wallet\NCHL\Repository\NchlBankTransferRepository;
use Carbon\Carbon;


class NCHLController extends Controller
{

//    public function getNchlAPI(Request $request,$id){
//        $microservice = new BackendWalletAPIMicroservice($request);
//        $microservice->setServiceType("NCHL_LOAD")
//            ->setDescription("Nchl process load transaction")
//            ->setVendor("NCHL_LOAD")
//            ->setMicroservice("NCHL")
//            ->setUrl("/nchl/report/by-id")
//            ->setRequestParam(['batch_id' => $id]);
//        $response = $microservice->processRequest();
//        $nchlAPI = json_decode($response, true);
//
//        return $nchlAPI;
//    }

    public function byId(Request $request, $id)
    {
        $repository = new NchlApiValidationRepository();
        $nchlAPI= $repository->getNchlAPI($request,$id);

        return view('WalletAPI::viewWalletAPI', compact('nchlAPI'));
    }

//    public function compareTransactions(Request $request, NchlBankTransferRepository $repository)
//    {
//        $repository = new NchlApiValidationRepository();
//        $disputedTransactions = $repository->getDisputedTransactions();
//
////        $debit_mismatches[] = null;
////        $debit_mismatch_api[] = null;
////        $credit_mismatches[] = null;
////        $credit_mismatches_api[] = null;
////        $amount_mismatches[] = null;
////        $amount_mismatches_api[] = null;
////        $wallet_status_mismatches[] = null;
////        $wallet_status_mismatches_api[] = null;
////        $nchl_status_mismatches[] = null;
////        $nchl_status_mismatches_api[] = null;
////
////        $from_convert=strtotime($_GET['from']);
////        $from = date('Y-m-d', $from_convert);
////
////        $to_convert=strtotime($_GET['to']);
////        $to = date('Y-m-d', $to_convert);
//
////        $transactions = $repo
/// sitory->paginatedTransactions()->whereBetween('created_at', [$from, $to]);
////        $nchlAPIs = array();
////        foreach ($transactions as $transaction) {
////            $id = $transaction->transaction_id;
////            $nchlAPI= $this->getNchlAPI($request,$id);
////            $nchlAPIs[] = $nchlAPI;
////
////            if ((optional($transaction)->debit_status) != ($nchlAPI['debitStatus'] ?? null)) {
////                $debit_mismatches[] = $transaction;
////                $debit_mismatch_api[] = $nchlAPI;
////            }
////
////            if ((optional($transaction)->credit_status) != ($nchlAPI['cipsTransactionDetailList']['0']['creditStatus'] ?? null)) {
////                $credit_mismatches[] = $transaction;
////                $credit_mismatches_api[] = $nchlAPI;
////            }
////
////            if ((optional($transaction)->amount) != ($nchlAPI['cipsTransactionDetailList']['0']['amount'] ?? null)) {
////                $amount_mismatches[] = $transaction;
////                $amount_mismatches_api[] = $nchlAPI;
////            }
////
////            if (($this->walletStatus($transaction)) =='success' && ($this->compareStatus($nchlAPI)) == 'failed') {
////                $wallet_status_mismatches[] = $transaction;
////                $wallet_status_mismatches_api[] = $nchlAPI;
////            }
////
////            if (($this->walletStatus($transaction)) =='failed' && ($this->compareStatus($nchlAPI)) == 'success') {
////                $nchl_status_mismatches[] = $transaction;
////                $nchl_status_mismatches_api[] = $nchlAPI;
////            }
////
////        }
//
//        return view('WalletAPI::viewWalletAPICompare', compact('nchlAPIs',
//                                                                  'debit_mismatches',
//                                                                            'debit_mismatch_api',
//                                                                            'credit_mismatches',
//                                                                            'credit_mismatches_api',
//                                                                            'amount_mismatches',
//                                                                            'amount_mismatches_api',
//                                                                            'wallet_status_mismatches',
//                                                                            'wallet_status_mismatches_api',
//                                                                            'nchl_status_mismatches',
//                                                                            'nchl_status_mismatches_api',
//                                                                            'transactions',
//                                                                            ));
//
//    }

    public function compareTransactions(Request $request, NchlBankTransferRepository $repo)
    {
        $repository = new NchlApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions($request,$repo);

        return view('WalletAPI::viewWalletAPICompare', compact('disputedTransactions'));

    }

//    public function compareStatus($nchlAPI)
//    {
//
//        if (empty($nchlAPI)) {
//            return "failed";
//        }
//
//        if ($nchlAPI['cipsTransactionDetailList']['0']['creditStatus']  == '000' || optional($nchlAPI['cipsTransactionDetailList']['0']['creditStatus']) == '999' || optional($nchlAPI['cipsTransactionDetailList']['0']['creditStatus']) == 'DEFER' &&
//            optional(($nchlAPI['debit_status']) == '000')) {
//            $nchlStatus='success';
//        }
//
//        elseif ($nchlAPI['debitStatus'] == 'ENTR' || $nchlAPI['cipsTransactionDetailList']['0']['creditStatus'] == 'ENTR') {
//            $nchlStatus='success';
//        }
//
//        else{
//            $nchlStatus='failed';
//        }
//
//        return $nchlStatus;
//    }
//
//    public function walletStatus($transaction)
//    {
//        if (empty($transaction)) {
//            return "failed";
//        }
//
//        if (($transaction->credit_status == '000' || $transaction->credit_status == '999' || $transaction->credit_status == 'DEFER') &&
//            ($transaction->debit_status == '000')) {
//            $walletStatus='success';
//        }
//
//        elseif ($transaction->debit_status == 'ENTR' || $transaction->credit_status == 'ENTR') {
//            $walletStatus='success';
//        }
//        else{
//            $walletStatus='failed';
//        }
//        return $walletStatus;
//
//    }
}
