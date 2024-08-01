<?php

namespace App\Wallet\WalletAPI\Microservice;

use App\Wallet\WalletAPI\BackendWalletAPIMicroservice;
use App\Wallet\WalletAPI\MicroserviceJSONAbstract;
use Illuminate\Http\Request;

class CoreMicroservice
{
    public function dispatchKhaltiRepost(Request $request)
    {
        $username = 'BackendProduction';
        $password = 'Pr0ducT10n8@ck3nd';
        $basicAuth = base64_encode($username . ':' . $password);

        $microservice = new MicroserviceJSONAbstract();
        $microservice->setBaseUrl(config('microservices.CORE'))
            ->setUrl('/api/khaltidlr-manual')
            ->addParam('reference', $request->reference)
            ->addParam('amount', $request->amount)
            ->addParam('status', $request->status)
            ->addParam('detail', optional($request->detail) ?? null)
            ->addParam('response_id', optional($request->response_id) ?? null)
            ->addHeader('App-Authorizer', '647061697361')
            ->addHeader('Authorization', 'Basic ' . $basicAuth);

        $response = $microservice->makeRequest();
        return $response;
    }
}
