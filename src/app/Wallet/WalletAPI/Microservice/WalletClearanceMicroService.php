<?php

namespace App\Wallet\WalletAPI\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use Illuminate\Http\Request;

class WalletClearanceMicroService
{
    public function dispatchStatementSettlementJobs(Request $request, $date)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("WALLET_CLEARANCE")
            ->setDescription("WALLET CLEARANCE")
            ->setVendor("WALLET_CLEARANCE")
            ->setMicroservice("WALLET_CLEARANCE")
            ->setUrl("dispatch_statement_sb")
            ->setRequestParam(['date' => $date]);

        $response = $microservice->processRequest();
        $statementSettlement = json_decode($response, true);
        return $statementSettlement;
    }

    public function dispatchActiveInactiveUserJobs(Request $request, $date)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("WALLET_CLEARANCE")
            ->setDescription("WALLET CLEARANCE")
            ->setVendor("WALLET_CLEARANCE")
            ->setMicroservice("WALLET_CLEARANCE")
            ->setUrl("dispatch_active_inactive")
            ->setRequestParam(['as_of_date' => $date]);

        $response = $microservice->processRequest();

        $activeInactive = json_decode($response, true);
        return $activeInactive;
    }
    public function dispatchActiveInactiveUserSlabJobs(Request $request)
    {
        $date=$request->from;
        $slab_from=$request->fromAmount;
        $slab_to=$request->toAmount;

        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("WALLET_CLEARANCE")
            ->setDescription("WALLET CLEARANCE")
            ->setVendor("WALLET_CLEARANCE")
            ->setMicroservice("WALLET_CLEARANCE")
            ->setUrl("dispatch_active_inactive_slab")
            ->setRequestParam(['as_of_date' => $date,
                'slab_from'=> $slab_from,
                'slab_to'=>$slab_to]);

        $response = $microservice->processRequest();

        $activeInactive = json_decode($response, true);
        return $activeInactive;
    }

}
