<?php


namespace App\Wallet\Microservice\Exceptions;


use App\Wallet\Traits\ApiResponder;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Throwable;

class MicroserviceClientException extends Exception
{
    use ApiResponder;

    protected $message;
    protected $response;
    protected $responseCode;
    protected $transaction;

    public function __construct($transaction, $message, $response, $responseCode = 400)
    {
        $this->transaction = $transaction;
        $this->message = $message;
        $this->response = $response;
        $this->responseCode = $responseCode;
    }

    public function report()
    {

    }

    public function render()
    {
        $error = is_array($this->response) ? $this->response : json_decode($this->response, true);

        if (is_array($error)) {
            if (!array_key_exists("message", $error)) {
                $modifiedError["message"] = $this->message;
                $modifiedError["errors"] = $error;
                $error = $modifiedError;
            }
        } else {
            $error["message"] = $this->message;
        }

        if ($this->transaction && $this->transaction->status != "FAILED") $this->transaction->update([
            "status" => "FAILED",
            "json_response" => json_encode($error)
        ]);

        if (isset($error['transaction'])) {
            unset($error['transaction']);
        }

        if (isset($error['error'])) {
            if (isset($error['error']['transaction'])) {
                unset($error['error']['transaction']);
            }
        }

        if (! isset($error['message'])) {
            $error["message"] = "Transaction could not be completed";
        }

        if (empty($error['message']) || $error['message'] == "") {
            $error["message"] = "Transaction could not be completed";
        }

        return $this->errorResponse($error, $this->responseCode);
    }
}
