<?php

namespace App\Wallet\WalletAPI\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use Illuminate\Http\Request;

class NchlAggregatedMicroservice
{
    public function getNchlAggregatedAPI(Request $request, $id)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("NCHL_AGGREGATED_PAYMENT")
            ->setDescription("Nchl Aggregated Payment")
            ->setVendor("NCHL Aggregated Payment")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl/report/by-id")
            ->setRequestParam(['batch_id' => $id]);

        $response = $microservice->processRequest();
        $nchlAggregatedAPI = json_decode($response, true);
        return $nchlAggregatedAPI;
    }

    public function getNchlAggregatedAPIByDate(Request $request, $dateFrom, $dateTo)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("NCHL_AGGREGATED_PAYMENT")
            ->setDescription("Nchl Aggregated Payment")
            ->setVendor("NCHL Aggregated Payment")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl/report/by-date")
            ->setRequestParam(['txnDateFrom' => $dateFrom,
                                'txnDateTo' => $dateTo]);
        $response = $microservice->processRequest();
        $nchlAggregatedAPI = json_decode($response, true);
        return $nchlAggregatedAPI;
    }

}
