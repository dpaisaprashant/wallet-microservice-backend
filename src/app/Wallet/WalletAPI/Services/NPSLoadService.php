<?php


namespace App\Wallet\Microservice\Services;

use App\Wallet\Microservice\PreTransactionMicroservice;
use App\Wallet\Microservice\RequestInfoMicroservice;
use App\Wallet\Microservice\UpdatePreTransactionMicroservice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NPSLoadService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;

    }

    public function getBankList()
    {
        $microservice = new RequestInfoMicroservice($this->request);
        $microservice->setHttpMethod('GET')
            ->setMicroservice('NPS')
            ->setUrl("/list")
            ->setDescription('Get nps bank list');

        return $microservice->processRequest();
    }

    public function processTransaction()
    {
        Log::info("Nps Process in core");
        $microservice = new PreTransactionMicroservice($this->request);
        $microservice->setServiceType('NPS_LOAD')
            ->setDescription('NPS process load transaction')
            ->setVendor('NPS')
            ->setMicroservice('NPS')
            ->setBaseUrl(config('microservices.' . 'NPS'))
            ->setTransactionType('credit')
            ->setAmount($this->request->amount * 100)
            ->setUrl('/process')
            //->setHttpMethod('GET')
            ->setRequestParam([
                'amount' => $this->request->amount,
                'bankCode' => $this->request->bankCode,
                'description' => $this->request->description
            ]);

        return $microservice->processRequest();
    }

    public function deliveryTransaction()
    {
        $microservice = new UpdatePreTransactionMicroservice();
        $microservice->setServiceType('NPS_LOAD')
            ->setVendor('NPS')
            ->setMicroservice('NPS')
            ->setBaseUrl(config('microservice.' . 'NPS'))
            ->setUrl('/delivery-url')
            ->setRequestParam(array_merge($this->request->all(), [
                'transaction_id' => $this->request->MERCHANTTXNID,
                'gateway_ref_no' => $this->request->GTWREFNO ?? $this->request->ampGTWREFNO ?? null
            ]));

        return $microservice->processRequest();
    }
}
