<?php

namespace App\Wallet\WalletAPI\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use Illuminate\Http\Request;

class NchlMicroservice
{
    public function getNchlAPI(Request $request, $id)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("NCHL_BANK_TRANSFER")
            ->setDescription("Nchl Bank Transfer")
            ->setVendor("NCHL BANK TRANSFER")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl/report/by-id")
            ->setRequestParam(['batch_id' => $id]);
        $response = $microservice->processRequest();
        $nchlAPI = json_decode($response, true);
        return $nchlAPI;
    }

    public function getNchlAPIByDate(Request $request, $dateFrom, $dateTo)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        $microservice->setServiceType("NCHL_BANK_TRANSFER")
            ->setDescription("Nchl Bank Transfer")
            ->setVendor("NCHL Bank Transfer")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl/report/by-date")
            ->setRequestParam(['txnDateFrom' => $dateFrom,
                'txnDateTo' => $dateTo]);
        $response = $microservice->processRequest();
        $nchlAPI = json_decode($response, true);
        return $nchlAPI;
    }

}
