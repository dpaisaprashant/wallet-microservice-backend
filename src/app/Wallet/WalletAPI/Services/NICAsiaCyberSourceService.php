<?php


namespace App\Wallet\Microservice\Services;


use App\Wallet\Microservice\MicroserviceJSONAbstract;
use App\Wallet\Microservice\PreTransactionMicroservice;
use Illuminate\Http\Request;

class NICAsiaCyberSourceService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function processLoadTransaction()
    {
        $user = $this->request->user();
        $name = explode(" ", $user->name);

        $microservice = new PreTransactionMicroservice($this->request);
        $microservice->setServiceType("NIC_ASIA_LOAD")
            ->setDescription("NIC Asia load transaction with CyberSource")
            ->setVendor("NIC_ASIA_LOAD")
            ->setMicroservice("NIC_ASIA")
            ->setBaseUrl(config('microservices.' . 'NIC_ASIA'))
            ->setUrl("/nicasia/process-load-transaction")
            ->setTransactionType("credit")
            ->setRequestParam([
                "first_name" => $name[0],
                "last_name" => $name[1] ?? "N/A",
                "email" => $user->email,
                "mobile_no" => $user->mobile_no,
                "amount" => $this->request->amount,
                "currency" => $this->request->currency ?? "NPR",
            ]);

        return $microservice->processRequest();
    }

    public function loginRedirect()
    {
        $microservice = new MicroserviceJSONAbstract();
        $microservice->setBaseUrl(config('microservices.' . 'NIC_ASIA'))
            ->setUrl("/nicasia/pay-with-cybersource/{$this->request->transaction_id}/{$this->request->reference_number}")
            ->setHttpMethod('GET');

        return $transaction = $microservice->makeRequest();
    }

    public function success()
    {
        $microservice = new MicroserviceJSONAbstract();
        $microservice->setBaseUrl(config('microservices.' . 'NIC_ASIA'))
            ->setUrl("/nicasia-success")
            ->addParam('request_param',
                $this->request->all()
            );

        return $microservice->makeRequest();
    }
}
