<?php


namespace App\Wallet\Microservice\Response;


use App\Events\CreditTransactionCompleteEvent;
use App\Models\Microservice\PreTransaction;
use App\Models\User;
use App\Wallet\Architecture\Transactions\CreditTransactionResponse;
use App\Wallet\Microservice\Exceptions\MicroserviceTransactionNotFoundException;

trait CreditResponse
{
    public function handleCreditResponse($request, $response, $walletTransactionType = null, User $involvedUser = null)
    {
        $handler = new CreditTransactionResponse($request, $response, $walletTransactionType);
        return $handler->handleResponse();
    }
}
