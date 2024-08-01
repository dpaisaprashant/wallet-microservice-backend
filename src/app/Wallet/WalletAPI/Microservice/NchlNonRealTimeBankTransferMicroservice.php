<?php

namespace App\Wallet\WalletAPI\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;


class NchlNonRealTimeBankTransferMicroservice
{
    public function getBankList($request)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setMicroservice("NCHL")
            ->setUrl('/non-real-time-nchl-bank-list');
        $response = $microservice->processRequest();
        $bankListApi = json_decode($response, true);
        return $bankListApi;
    }

    public function getBranchList($id, $request)
    {

        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setMicroservice("NCHL")
            ->setUrl('/nchl-branch-list/' . $id);

        $response = $microservice->processRequest();
        $branchListApi = json_decode($response, true);
        return $branchListApi;
    }

    public function processPayment($bankId, $bankName, $branchId, $branchName, $amount, $accountNumber, $accountName, $request)
    {

        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setMicroservice("NCHL")
            ->setUrl('/nchl/non-real-time/process-bank-transfer')
            ->addParam('bank_id', $bankId)
            ->addParam('bank_name', $bankName)
            ->addParam('branch_id',$branchId)
            ->addParam('branch_name',$branchName)
            ->addParam('amount',$amount)
            ->addParam('account_number',$accountNumber)
            ->addParam('account_name',$accountName);

        $response = $microservice->processRequest();
        $processBankTransfer = json_decode($response,true);
        return $processBankTransfer;
    }

    public function getTransactionResponse($id,$request){
        \Log::info('Transaction Response Status');
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setMicroservice('NCHL')
            ->setUrl('/nchl/nonrealtimereport/by-ids')
            ->addParam('batch_id',$id);
        $response = $microservice->processRequest();
        $statusResponse = json_decode($response,true);
        return $statusResponse;
    }

}
