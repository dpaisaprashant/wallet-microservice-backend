<?php


namespace App\Wallet\Microservice;


use App\Logging\MongoErrorLoggerHandler;
use App\Models\Microservice\PreTransaction;
use App\Models\User;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\Traits\CheckValidJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PreTransactionMicroservice extends MicroserviceJSONAbstract
{
    use CheckValidJson;

    private $preTransactionId;
    private $userId;
    private $amount;
    private $description;
    private $vendor;
    private $serviceType;
    private $microservice;
    private $special1;
    private $special2;
    private $special3;
    private $special4;
    private $status;
    private $transactionType;
    private $jsonRequest = [];
    private $jsonResponse;
    private $requestParam = [];

    public function __construct(Request $request)
    {
        $this->setUserId($request->user()->id ?? "")
            ->setAmount($request->amount)
            ->setServiceType($request->service_type)
            ->setDescription($request->description)
            ->setVendor($request->vendor)
            ->setMicroservice($request->microservice_type)
            ->setUrl($request->url)
            ->setTransactionType($request->transaction_type)
            ->setSpecial1($request->special1)
            ->setSpecial2($request->special2)
            ->setSpecial3($request->special3)
            ->setSpecial4($request->special4)
            ->setJsonRequest($request->all())
            ->setRequestParam($request->request_param ?? []);
        //$this->preTransactionId = TransactionIdGenerator::generate(19);
        $this->preTransactionId = resolve(MongoErrorLoggerHandler::class)->getLogRequestId();
    }

    public function setPreTransactionId($preTransactionId)
    {
        $this->preTransactionId = $preTransactionId;
        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
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

    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
        return $this;
    }

    public function setJsonRequest(array $jsonRequest): PreTransactionMicroservice
    {
        $this->jsonRequest = $jsonRequest;
        return $this;
    }

    public function setJsonResponse(array $jsonResponse): PreTransactionMicroservice
    {
        $this->jsonResponse = $jsonResponse;
        return $this;
    }

    public function setRequestParam(array $requestParam): PreTransactionMicroservice
    {
        $this->requestParam = $requestParam;
        return $this;
    }

    private function currentUser()
    {
        $user = User::whereId($this->userId)->first();
        $user->load(['wallet', 'kyc', 'referral']);
        return $user;
    }

    private function preRequest()
    {
        $this->addParam('reference', $this->preTransactionId)
            ->addParam('pre_transaction_id', $this->preTransactionId)
            ->addParam('amount', $this->amount)
            ->addParam('description', $this->description)
            ->addParam('vendor', $this->vendor)
            ->addParam('service_type', $this->serviceType ?? "")
            ->addParam('microservice_type', $this->microservice)
            ->addParam('transaction_type', $this->transactionType)
            ->addParam('status', $this->status = 'STARTED')
            ->addParam('special1', $this->special1)
            ->addParam('special2', $this->special2)
            ->addParam('special3', $this->special3)
            ->addParam('special4', $this->special4)
            ->addParam('request_param', $this->requestParam);

        //if (auth()->check()) $this->addParam('user', json_encode(new UserInfoResource($this->currentUser())));

        $this->setBaseUrl(config('microservices.' . $this->microservice));
        $user = $this->currentUser();


        $requestInfo = $this->apiParams;
        $requestInfo['request_param'] = json_encode($requestInfo['request_param']);
        $data = array_merge($requestInfo, [
            'user_id' => auth()->user()->id ?? $user->id,
            'amount' => $this->amount,
            'url' => $this->url,
            'json_request' => json_encode($this->jsonRequest),

            //'json_response' => json_encode([])
        ]);

        $balances = [
            'before_balance' => $user->wallet->balance,
            'after_balance' => $user->wallet->balance,
            'before_bonus_balance' => $user->wallet->bonus_balance,
            'after_bonus_balance' => $user->wallet->bonus_balance,
        ];

        if ($this->transactionType = "debit") {
            $balances = [
                'before_balance' => $user->wallet->before_balance,
                'after_balance' => $user->wallet->balance,
                'before_bonus_balance' => $user->wallet->before_bonus_balance,
                'after_bonus_balance' => $user->wallet->bonus_balance,
            ];
        }

        $data = array_merge($data, $balances);

        unset($data["user"], $data['reference']);
        $this->preTransaction = PreTransaction::create($data);

        //deduct balance

    }

    private function postRequest()
    {
        $status = "FAILED";
        $dataToSaveOnFail = null;
        $responseTransaction = json_decode($this->jsonResponse, true);
        if (isset($responseTransaction['transaction']) && isset($responseTransaction['transaction']['pre_transaction_status'])) {

            Log::info("Inside Transaction");

            $responseStatus = $responseTransaction['transaction']['pre_transaction_status'] ?? false;

            if ($responseStatus === "false" || $responseStatus === false) {
                $status = "FAILED";
            }
            if ($responseStatus === "true" || $responseStatus === true) {
                $status = "SUCCESS";
            }

            Log::info("Response Status: " . $responseStatus);
            Log::info("Status: " . $status);


            /*if ($status == "FAILED") {
                $dataToSaveOnFail = [
                    "status" => $status,
                    "json_response" => array_merge($responseTransaction , ["transaction" => $responseTransaction['transaction']])

                ];
            }*/
        }

        $data = [

            'status' => $status,
            'json_response' => $this->isValidJson($this->jsonResponse) ? $this->jsonResponse : json_encode($this->jsonResponse),
            'special1' => isset($responseTransaction['transaction']['special1']) ?? $this->special1,
            'special2' => isset($responseTransaction['transaction']['special2']) ?? $this->special2,
            'special3' => isset($responseTransaction['transaction']['special3']) ?? $this->special3,
            'special4' => isset($responseTransaction['transaction']['special4']) ?? $this->special4,
        ];

       /* if ($dataToSaveOnFail) {
            Log::info("data to save on fail", $dataToSaveOnFail);
            $this->preTransaction->update($dataToSaveOnFail);
        }else {*/
            $this->preTransaction->update($data);

        //}
    }

    public function processRequest($endpoint = "")
    {
        DB::beginTransaction();

        // Resource Sharing through shared lock
        //$bounceCheck = PreTransaction::whereUserId(auth()->user()->id)->latest()->lockForUpdate()->first();
        $bounceCheck = PreTransaction::whereUserId(auth()->user()->id)->where('service_type', '!=', 'NPS_ACCOUNT_LINK_LOAD')->latest()->lockForUpdate()->first();

        if (!empty($bounceCheck) && $bounceCheck->created_at->diffInSeconds() < 6) {
            Log::info("Subsequent Request with diff - " .  $bounceCheck->created_at->diffInSeconds() . " id:" .$this->preTransactionId);
            throw new \Exception("Subsequent Request");
        }
        // Resource Sharing through shared lock

        $this->preRequest();
        $response = $this->jsonResponse = $this->makeRequest();
        $this->postRequest();
        DB::commit();


        Log::info("Response Json", [$response]);
        return $response;
    }





}
