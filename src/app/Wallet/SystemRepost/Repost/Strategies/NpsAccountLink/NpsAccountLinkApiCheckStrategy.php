<?php

namespace App\Wallet\SystemRepost\Repost\Strategies\NpsAccountLink;

use App\Models\Microservice\PreTransaction;
use App\Wallet\SystemRepost\Repost\Contracts\CheckByApiContract;
use App\Wallet\WalletAPI\MicroserviceJSONAbstract;
use Illuminate\Support\Facades\Log;

class NpsAccountLinkApiCheckStrategy implements CheckByApiContract
{

    public function checkMicroserviceApiStatus(PreTransaction $preTransaction)
    {
        Log::info("5. check api of npa load");

        try {
            $microservice = new MicroserviceJSONAbstract();
            $microservice->setBaseUrl(config('microservices.NPS_ACCOUNT_LINK'))
                ->setUrl('/api/account-link/CheckLoadWalletTxStatus')
                ->addParam('reference', $preTransaction->pre_transaction_id);

            $response = $microservice->makeRequest();
            Log::info("5.1. nps check api response", [$response]);
            return true;
        } catch (\Exception $e) {
            Log::error("5. check api for nps load fail");
            Log::error($e);
            return false;
        }
    }
}
