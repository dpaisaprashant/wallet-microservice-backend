<?php

namespace App\Wallet\WalletAPI\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use Illuminate\Http\Request;

class PaypointMicroservice
{
    public function getPaypointAPI(Request $request, $id)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("PAYPOINT")
            ->setDescription("PAYPOINT Transaction")
            ->setVendor("PAYPOINT")
            ->setMicroservice("PAYPOINT")
            ->setUrl("/transaction/get")
            ->setRefStan($id);
        $response = $microservice->processRequest();
        $paypointAPI = json_decode($response, true);
        return $paypointAPI;
    }

    public function getPaypointAPIByDate(Request $request, $dateFrom,$dateTo)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("PAYPOINT")
            ->setDescription("PAYPOINT Transaction by Date")
            ->setVendor("PAYPOINT")
            ->setMicroservice("PAYPOINT")
            ->setUrl("/transaction/get")
            ->setStartDate($dateFrom)
            ->setEndDate($dateTo);
        $response = $microservice->processRequest();
        $paypointAPI = json_decode($response, true);

        return $paypointAPI;
    }

}
