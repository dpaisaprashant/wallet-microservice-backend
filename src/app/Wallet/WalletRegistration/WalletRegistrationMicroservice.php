<?php


namespace App\Wallet\WalletRegistration;


//use App\Logging\MongoErrorLoggerHandler;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\Traits\CheckValidJson;
use App\Wallet\WalletAPI\BackendWalletAPIJSONAbstract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WalletRegistrationMicroservice extends BackendWalletAPIJSONAbstract
{

    use CheckValidJson;

    private $requestId;
    private $userId;
    private $name;
    private $email;
    private $password;
    private $mobile_no;

    public function __construct(Request $request)
    {
        $this->setUserId($request->user()->id ?? "")
            ->setName($request->name)
            ->setEmail($request->email)
            ->setPassword($request->password)
            ->setMobileNumber($request->mobile_no)
            ->setUrl($request->url);
//        $this->requestId = TransactionIdGenerator::generate(19);
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

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setMobileNumber($mobile_no)
    {
        $this->mobile_no = $mobile_no;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    private function preRequest()
    {
        $this->addParam('reference', $this->requestId)
            ->addParam('request_id', $this->requestId)
            ->addParam('name', $this->name ?? "")
            ->addParam('email', $this->email ?? "")
            ->addParam('password', $this->password ?? "")
            ->addParam('mobile_no', $this->mobile_no)
            ->addParam('user_id', $this->userId ?? "");

        $this->setBaseUrl(config('microservices.' . $this->microservice));
        $requestInfo = $this->apiParams;
        Log::info('Request info include the following data');
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
