<?php


namespace App\Wallet\WalletBackendAPI\Microservices;


use App\Logging\MongoErrorLoggerHandler;
use App\Models\Microservice\RequestInfo;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\Traits\CheckValidJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestMicroService extends MicroserviceJSONAbstractClass
{

    private $requestParam = [];
    private $jsonRequest = [];
    private $jsonResponse = [];

    public function __construct(Request $request){
        $this->setRequestParam($request->request_param);
        $this->setJsonRequest($request->all());

    }

    public function setRequestParam($requestParam){
        $this->requestParam = $requestParam;
        return $this;
    }

    public function setJsonRequest($jsonRequest){
        $this->jsonRequest = $jsonRequest;
        return $this;
    }

    public function preRequest(){
        $this->addApiParam('request_param',$this->requestParam);

        $requestInfo = $this->apiParam;
        $requestInfo['request_param'] = json_encode($requestInfo['request_param']);
        $data = array_merge($requestInfo,[
            'url' => $this->url,
            'jsonRequest' => $this->jsonRequest
        ]);

    }

    public function postRequest(){
        $data = [
            'status' => 'COMPLETED',
            'json_response' => $this->jsonResponse,
        ];
    }

    public function processRequest(){
        $this->preRequest();
        $response = $this->jsonResponse = $this->makeRequest();
        $this->postRequest();
        return $response;


    }

}
