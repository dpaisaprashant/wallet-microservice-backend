<?php


namespace App\Wallet\Microservice\Services;


use App\Http\Requests\MobileRechargeRequest;
use App\Wallet\Microservice\PreTransactionMicroservice;
use App\Wallet\Microservice\RequestInfoMicroservice;
use Illuminate\Http\Request;

class NTCTopUpService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function retailerTopUp()
    {
        $microservice = new RequestInfoMicroservice($this->request);
        $microservice->setServiceType("NTC_RETAILER_TOPUP")
            ->setDescription("NTC Retailer Top Up")
            ->setVendor("NTC")
            ->setMicroservice("NTC")
            ->setBaseUrl(config('microservices.' . 'NTC'))
            ->setUrl("/api/microservice/ntc/retailer-top-up")
            //->setTransactionType("debit")
            //->setAmount($this->request->amount)
            ->setRequestParam([
                //"number" => $this->request->number,
                "amount" => $this->request->amount,
                //"phone_type" => $this->request->phone_type ?? 3,
            ]);

        return $microservice->processRequest();
    }

    public function customerTopUp()
    {
        $microservice = new PreTransactionMicroservice($this->request);
        $microservice->setServiceType("NTC_TOPUP")
            ->setDescription("NTC Top Up")
            ->setVendor("NTC")
            ->setMicroservice("NTC")
            ->setBaseUrl(config('microservices.' . 'NTC'))
            ->setUrl("/ntc/customer-top-up")
            ->setTransactionType("debit")
            ->setAmount($this->request->amount)
            ->setRequestParam([
                "mobile_no" => $this->request->mobile_no,
                "amount" => $this->request->amount,
                "service_code" => $this->request->service_code?? 5,
            ]);

        return $microservice->processRequest();
    }


    public function checkRetailerBalance()
    {
        $microservice = new RequestInfoMicroservice($this->request);
        $microservice->setServiceType("NTC_RETAILER_CHECK")
            ->setDescription("NTC Retailer Check")
            ->setVendor("NTC")
            ->setMicroservice("NTC")
            ->setBaseUrl(config('microservices.' . 'NTC'))
            ->setUrl("/api/microservice/ntc/check-retailer-balance")
            ->setHttpMethod('GET')
            //->setTransactionType("debit")
            //->setAmount($this->request->amount)
            ->setRequestParam([
                //"number" => $this->request->number,
                "amount" => $this->request->amount,
                //"phone_type" => $this->request->phone_type ?? 3,
            ]);

        return $microservice->processRequest();
    }


    public function checkRetailer()
    {
        $microservice = new RequestInfoMicroservice($this->request);
        $microservice->setServiceType("NTC_RETAILER_CHECK")
            ->setDescription("NTC Retailer Check")
            ->setVendor("NTC")
            ->setMicroservice("NTC")
            ->setBaseUrl(config('microservices.' . 'NTC'))
            ->setUrl("/api/microservice/ntc/check-retailer")
            ->setHttpMethod('GET')
            //->setTransactionType("debit")
            //->setAmount($this->request->amount)
            ->setRequestParam([
                //"number" => $this->request->number,
                "amount" => $this->request->amount,
                //"phone_type" => $this->request->phone_type ?? 3,
            ]);

        return $microservice->processRequest();
    }
}
