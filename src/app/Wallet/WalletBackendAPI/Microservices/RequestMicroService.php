<?php


namespace App\Wallet\WalletBackendAPI\Microservice;


use App\Logging\MongoErrorLoggerHandler;
use App\Models\Microservice\RequestInfo;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\Traits\CheckValidJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestMicroService
{

    private $requestParam = [];

    public function __construct(Request $request){
        $this->setRequestParam($request->request_param);
    }

    public function setRequestParam($requestParam){
        $this->requestParam = $requestParam;
        return $this;
    }

}
