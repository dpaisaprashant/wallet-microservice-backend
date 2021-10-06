<?php


namespace App\Wallet\Microservice\Exceptions;


use App\Wallet\Traits\ApiResponder;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class MicroserviceTransactionNotFoundException extends Exception
{
    use ApiResponder;

    protected $message;
    protected $responseCode;
    protected $response;

    public function __construct($response, $message = "Transaction not found in  microservice response" , $responseCode = 400)
    {
        $this->response = $response;
        $this->message = $message;
        $this->responseCode = $responseCode;
    }

    public function report()
    {
        Log::info($this->message);
        Log::info("Microservice Response", [$this->response]);
    }
    public function render()
    {
        return $this->errorResponse(["message" => $this->message, "response" => $this->response]);
    }
}
