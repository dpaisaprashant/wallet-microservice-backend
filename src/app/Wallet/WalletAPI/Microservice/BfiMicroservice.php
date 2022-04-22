<?php

namespace App\Wallet\WalletAPI\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\WalletAPI\MicroserviceJSONAbstract;
use Illuminate\Http\Request;

class BfiMicroservice
{
    public function dispatchBfiRepost(Request $request)
    {
        $username = config('bfi-users.'.$request->bfi_user.'username');
        $password = config('bfi-users.'.$request->bfi_user.'password');
        $basicAuth = base64_encode($username.':'.$password);

        $microservice = new MicroserviceJSONAbstract();
        $microservice->setBaseUrl(config('microservices.BFI'))
            ->setUrl('/api/bfi/repost-execute-payment')
            ->addParam('process_id', $request->process_id)
            ->addHeader('Authorization', 'Basic ' . $basicAuth);

        $response = $microservice->makeRequest();

        return $response;
    }
}
