<?php

namespace App\Wallet\WalletAPI\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use Illuminate\Http\Request;

class NchlAggregatedMicroservice
{
    public function getNchlAggregatedAPI(Request $request, $id)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("NCHL_AGGREGATED_TRANSFER")
            ->setDescription("Nchl Aggregated Transfer")
            ->setVendor("NCHL Aggregated TRANSFER")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl/report/by-id")
            ->setRequestParam(['batch_id' => $id]);
        $response = $microservice->processRequest();
        $nchlAPI = json_decode($response, true);
        return $nchlAPI;
    }

}
