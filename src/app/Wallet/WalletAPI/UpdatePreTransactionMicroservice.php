<?php


namespace App\Wallet\Microservice;



use App\Models\Microservice\PreTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdatePreTransactionMicroservice extends MicroserviceJSONAbstract
{
    private $serviceType;
    private $vendor;
    private $microservice;
    private $preTransactionId;
    private $jsonResponse;
    private $requestParam = [];

    /**
     * @param mixed $serviceType
     * @return UpdatePreTransactionMicroservice
     */
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;
        return $this;
    }

    /**
     * @param array $requestParam
     * @return UpdatePreTransactionMicroservice
     */
    public function setRequestParam(array $requestParam)
    {
        $this->requestParam = $requestParam;
        return $this;
    }

    /**
     * @param mixed $vendor
     * @return UpdatePreTransactionMicroservice
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
        return $this;
    }

    /**
     * @param mixed $microservice
     * @return UpdatePreTransactionMicroservice
     */
    public function setMicroservice($microservice)
    {
        $this->microservice = $microservice;
        return $this;
    }


    public function preRequest()
    {
        $this->addParam('vendor', $this->vendor)
            ->addParam('service_type', $this->serviceType ?? "")
            ->addParam('microservice_type', $this->microservice)
            ->addParam('request_param', $this->requestParam);

        $this->setBaseUrl(config('microservices.' . $this->microservice));
    }

    public function postRequest()
    {
        $responseTransaction = json_decode($this->jsonResponse, true);
        if (isset($responseTransaction['transaction']) && isset($responseTransaction['transaction']['pre_transaction_status'])) {
            $responseStatus = $responseTransaction['transaction']['pre_transaction_status'] ?? false;
            $status = $responseStatus ? "SUCCESS" : "FAILED";
            $this->preTransactionId = $responseTransaction['transaction']['pre_transaction_id'] ?? null;
        }

        $data = [
            'status' => $status ?? "FAILED",
            'json_response' => ($this->jsonResponse) ?? []
        ];

        if ($this->preTransactionId) PreTransaction::where('pre_transaction_id', $this->preTransactionId)->update($data);
    }

    public function processRequest()
    {
        DB::beginTransaction();

        /*if (auth()->check()) {
            $bounceCheck = PreTransaction::whereUserId(auth()->user()->id)->latest()->lockForUpdate()->first();
            if (!empty($bounceCheck) && $bounceCheck->created_at->diffInSeconds() < 6) {
                Log::info("Subsequent Request with diff - " .  $bounceCheck->created_at->diffInSeconds() . " id:" .$this->preTransactionId);
                throw new \Exception("Subsequent Request");
            }
        }*/

            $bounceCheck = PreTransaction::latest()->lockForUpdate()->first();
            if (!empty($bounceCheck) && $bounceCheck->created_at->diffInSeconds() < 6) {
                Log::info("Subsequent Request with diff - " .  $bounceCheck->created_at->diffInSeconds() . " id:" .$this->preTransactionId);
                throw new \Exception("Subsequent Request");
            }


        $this->preRequest();
        $response =  $this->jsonResponse = $this->makeRequest();
        $this->postRequest();

        DB::commit();
        return $response;
    }


}
