<?php


namespace App\Wallet\Microservice\Response;


use App\Events\DebitTransactionCompleteEvent;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Wallet\Architecture\Transactions\AbstractHandleTransactionResponse;
use App\Wallet\Architecture\Transactions\DebitTransactionResponse;
use App\Wallet\Microservice\Exceptions\MicroserviceTransactionNotFoundException;
use Illuminate\Support\Facades\DB;

trait DebitResponse
{
    public function handleDebitResponse($request, $response, $walletTransactionType = null, User $involvedUser = null)
    {
        $handler = new DebitTransactionResponse($request, $response, $walletTransactionType);
        return $handler->handleResponse();
    }

    public function handleDebitRequest($preTransaction, $walletTransactionType)
    {

    }
}
