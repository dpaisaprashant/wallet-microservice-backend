<?php

namespace App\Wallet\WalletRegistration\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use Illuminate\Http\Request;

class MerchantRegistrationMicroservice
{
    public function getMerchantRegistration(Request $request, $id)
    {
        $microservice = new BackendWalletAPIMicroservice($request);
        dd($microservice);
        $microservice->setName($request->mobile_no)
            ->setEmail($request->mobile_no)
            ->setPassword($request->mobile_no)
            ->setMobileNumber($request->mobile_no)
            ->setUrl("/nchl/report/by-id");

        $response = $microservice->processRequest();
        $nchlAggregatedAPI = json_decode($response, true);
        return $nchlAggregatedAPI;
    }

}
