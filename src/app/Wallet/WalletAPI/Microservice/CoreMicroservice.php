<?php

namespace App\Wallet\WalletAPI\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\WalletAPI\MicroserviceJSONAbstract;
use Illuminate\Http\Request;

class CoreMicroservice
{
    public function dispatchKhaltiRepost(Request $request)
    {

        $microservice = new MicroserviceJSONAbstract();
        $microservice->setBaseUrl(config('microservices.CORE'))
            ->setUrl('/khaltidlr-manual')
            ->addParam('reference', $request->reference)
            ->addParam('amount', $request->amount)
            ->addParam('status', $request->status)
            ->addParam('detail', optional($request->detail) ?? null)
            ->addParam('response_id', optional($request->response_id) ?? null);

        $response = $microservice->makeRequest();
        return $response;
    }
}
