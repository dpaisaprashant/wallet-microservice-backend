<?php


namespace App\Wallet\Microservice\Exceptions;


use App\Wallet\Traits\ApiResponder;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Throwable;

class MicroserviceException extends Exception
{
    use ApiResponder;

    protected $message;
    protected $response;
    protected $responseCode;

    public function __construct($message, $response = [], $responseCode = 400)
    {
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
            if (! array_key_exists("message", $error)) {
                $modifiedError["message"] = $this->message;
                $modifiedError["errors"] = $error ;
                $error = $modifiedError;
            }
        }else {
            $error["message"] = $this->message;
        }

        return $this->errorResponse($error, $this->responseCode);
    }
}
