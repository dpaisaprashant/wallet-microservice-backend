<?php


namespace App\Wallet\WalletAPI\Exceptions;


use App\Wallet\Traits\ApiResponder;
use Illuminate\Support\Facades\Log;

class ArchitectureValidationException extends \Exception
{
    use ApiResponder;

    protected $customMessage = [];
    protected $request;
    protected $responseCode;

    public function __construct($customMessage = [], $request = [], $responseCode = 400)
    {
        $this->customMessage = $customMessage;
        $this->request = $request;
        $this->responseCode = $responseCode;
    }

    public function report()
    {
        Log::info("================== Wallet Transaction Type Validation ================");
        Log::info("Message: ", [$this->customMessage]);
        Log::info("Request: ", [$this->request]);
        Log::info("Error Message: ", [$this->getMessage()]);
        Log::info("File: " . $this->getFile());
        Log::info("Line: " . $this->getLine());
    }
    public function render()
    {
        Log::info("custom message", [$this->customMessage]);
        return $this->errorResponse($this->customMessage, $this->responseCode);
    }
}
