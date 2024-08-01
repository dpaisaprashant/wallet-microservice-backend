<?php

namespace App\Http\Controllers\API;

use App\Events\CreditTransactionCompleteEvent;
use App\Events\DebitTransactionCompleteEvent;
use App\Wallet\Microservice\PreTransactionMicroservice;
use App\Wallet\Microservice\RequestInfoMicroservice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BackendMicroserviceController extends Controller
{
    public function requestInfo(Request $request)
    {
        $microservice = new RequestInfoMicroservice($request);

        $response = $microservice->processRequest();
        if ($response instanceof JsonResponse) {
            return $response;
        }
        return json_decode($response, true);
        //1. get request
        //2. Generate request info row in table [response_id, user_id, microservice_type...]
        //3. Save request to request_infos table
        //4. Based on microservice type send api request to the specific microservice
        //5. Get response from microservice
        //6. save microservice response to database
        //7. return the response from microservice to the user
    }

    public function preTransaction(Request $request)
    {
        $microservice = new PreTransactionMicroservice($request);

        $response = $microservice->processRequest();
        $response =  json_decode($response, true);
        $transaction = $response['transaction'] ?? null;

        if (empty($transaction)) return $response;

        if ($transaction['type'] = 'debit') {
            event(new DebitTransactionCompleteEvent($request->user(), $transaction));
        } elseif ($transaction['type'] = 'credit'){
            event(new CreditTransactionCompleteEvent());
        } else {
            dd("cannot find transaction event");
        }

        unset($response['transaction']);
        return $response;
        //0.1 check user balance
        //1. get request
        //2. Generate pre_transaction [transaction_id, user_id, microservice_type...]
        //3. Save request to pre_transactions table
        //4. Based on microservice type send api request to the specific microservice
        //5. Get response from microservice
        //6. save microservice response to database
        //7. Transaction is successful
        //8. based on transaction_type [debit, credit] call DebitTransactionCompleteEvent or CreditTransactionCompleteEvent
        //9. return response to user


        //7a1. Transaction is unsuccessful
        //7a2. Return error response to user
    }
}
