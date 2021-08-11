<?php


namespace App\Wallet\Microservice\Services;


use App\Wallet\Microservice\MicroserviceJSONAbstract;
use App\Wallet\Microservice\PreTransactionMicroservice;
use App\Wallet\Microservice\RequestInfoMicroservice;
use App\Wallet\Microservice\UpdatePreTransactionMicroservice;
use Illuminate\Http\Request;

class NPayLoadService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function processTransaction()
    {
        $microservice = new PreTransactionMicroservice($this->request);
        $microservice->setServiceType('NPAY_LOAD')
            ->setDescription('Npay process load transaction')
            ->setVendor('NPAY')
            ->setMicroservice('NPAY')
            ->setBaseUrl(config('microservices.' . 'NPAY'))
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
        $microservice->setServiceType('NPAY_LOAD')
            ->setVendor('NPAY')
            ->setMicroservice('NPAY')
            ->setBaseUrl(config('microservice.' . 'NPAY'))
            ->setUrl('/delivery-url')
            ->setRequestParam(array_merge($this->request->all(), [
                'transaction_id' => $this->request->MERCHANTTXNID,
                'gateway_ref_no' => $this->request->GTWREFNO ?? $this->request->ampGTWREFNO ?? null
            ]));

        return $microservice->processRequest();
    }
}
