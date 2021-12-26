<?php


namespace App\Wallet\WalletAPI;


//use App\Logging\MongoErrorLoggerHandler;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\Traits\CheckValidJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BackendWalletAPIMicroservice extends BackendWalletAPIJSONAbstract
{

    use CheckValidJson;

    private $requestId;
    private $userId;
    private $description;
    private $vendor;
    private $serviceType;
    private $microservice;
    private $special1;
    private $special2;
    private $special3;
    private $special4;
    private $status;
    private $amount;
    private $accountNumber;
    private $accountName;
    private $jsonRequest = [];
    private $jsonResponse = [];
    private $requestParam = [];

    public function __construct(Request $request)
    {
        $this->setUserId($request->user()->id ?? "")
            ->setServiceType($request->service_type)
            ->setDescription($request->description)
            ->setVendor($request->vendor)
            ->setMicroservice($request->microservice_type)
            ->setUrl($request->url)
            ->setSpecial1($request->special1)
            ->setSpecial2($request->special2)
            ->setSpecial3($request->special3)
            ->setSpecial4($request->special4)
            ->setJsonRequest($request->all());
//            ->setRequestParam($requestParamArr['cipsBatchDetail']['batchId']);
        $this->requestId = TransactionIdGenerator::generate(19);
    }
    public function setBankId($bankId){

    }

    public function getRequestId()
    {
        return $this->requestId;
    }

    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;

    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }

    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    public function setMicroservice($microservice)
    {
        $this->microservice = $microservice;
        return $this;
    }

    public function setSpecial1($special1)
    {
        $this->special1 = $special1;
        return $this;
    }

    public function setSpecial2($special2)
    {
        $this->special2 = $special2;
        return $this;
    }

    public function setSpecial3($special3)
    {
        $this->special3 = $special3;
        return $this;
    }

    public function setSpecial4($special4)
    {
        $this->special4 = $special4;
        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setJsonRequest($jsonRequest)
    {
        $this->jsonRequest = $jsonRequest;
        return $this;
    }

    public function setJsonResponse($jsonResponse)
    {
        $this->jsonResponse = $jsonResponse;
        return $this;
    }

    public function setRequestParam($requestParam)
    {
        $this->requestParam = $requestParam;
        return $this;
    }

    public function setRefStan($refStan)
    {
        $this->refStan = $refStan;
        return $this;
    }

    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    private function preRequest()
    {
        $this->addParam('reference', $this->requestId)
            ->addParam('request_id', $this->requestId)
            ->addParam('description', $this->description ?? "")
            ->addParam('vendor', $this->vendor ?? "")
            ->addParam('service_type', $this->serviceType ?? "")
            ->addParam('microservice_type', $this->microservice)
            ->addParam('status', $this->status)
            ->addParam('special1', $this->special1)
            ->addParam('special2', $this->special2)
            ->addParam('special3', $this->special3)
            ->addParam('special4', $this->special4)
            ->addParam('user_id', $this->userId ?? "")
            ->addParam('request_param', $this->requestParam)
            ->addParam('refStan', $this->refStan ?? -1)
            ->addParam('startDate', $this->startDate ?? "")
            ->addParam('endDate', $this->endDate ?? "");

        $this->setBaseUrl(config('microservices.' . $this->microservice));
        $requestInfo = $this->apiParams;
        Log::info('Request info include the following data');
        if(isset($requestInfo['bank_id'])){
            $requestInfo['request_param'] = [
                'bank_id' => $requestInfo['bank_id'],
                'bank_name' => $requestInfo['bank_name'],
                'branch_id' => $requestInfo['branch_id'],
                'branch_name' => $requestInfo['branch_name'],
                'amount' => $requestInfo['amount'],
                'account_number' => $requestInfo['account_number'],
                'account_name' => $requestInfo['account_name'],
            ];
        }
        Log::info($requestInfo);
        $requestInfo['request_param'] = json_encode($requestInfo['request_param']);
        $data = array_merge($requestInfo, [
//            'user_id' => auth()->user()->id,
            'url' => $this->url,
            'json_request' => json_encode($this->jsonRequest),
        ]);
       /* dd($requestInfo);*/
        unset($data['reference'], $data['linked_ref_id']);
        return $data;
    }

    public function processRequest($endpoint = "")
    {
        $this->preRequest();
        $response = $this->jsonResponse = $this->makeRequest();
        Log::info("Response Json", [$response]);
        return $response;
    }

}
