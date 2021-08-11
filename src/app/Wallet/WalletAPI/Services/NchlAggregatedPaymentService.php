<?php


namespace App\Wallet\Microservice\Services;


use App\Wallet\Microservice\PreTransactionMicroservice;
use App\Wallet\Microservice\RequestInfoMicroservice;
use Illuminate\Http\Request;

class NchlAggregatedPaymentService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function serviceListRequest($id)
    {
        $microservice = new RequestInfoMicroservice($this->request);

        $microservice->setServiceType("NCHL_AGGREGATED_PAYMENT")
            ->setDescription("Get aggregated service list")
            ->setVendor("NCHL AGGREGATED PAYMENT")
            ->setMicroservice("NCHL")
            ->setUrl("/aggregated-service-list/" . $id)
            ->setRequestParam(array_merge($this->request->all(), []));

        return $microservice->processRequest();
    }

    public function ourServiceListRequest($id)
    {
        $microservice = new RequestInfoMicroservice($this->request);

        $microservice->setServiceType("NCHL_AGGREGATED_PAYMENT")
            ->setDescription("Get custom aggregated service list")
            ->setVendor("NCHL AGGREGATED PAYMENT")
            ->setMicroservice("NCHL")
            ->setUrl("/our-aggregated-service-list/" . $id)
            ->setRequestParam(array_merge($this->request->all(), []));

        return $microservice->processRequest();
    }

    public function servicePaymentRequest()
    {
        $microservice = new PreTransactionMicroservice($this->request);
        $microservice->setDescription("One step NCHL aggregated payment")
            ->setAmount($this->request->amount)
            ->setVendor("NCHL")
            ->setMicroservice("NCHL")
            ->setTransactionType("debit")
            ->setUrl("/nchl/aggregated-service-payment")
            ->setRequestParam(array_merge($this->request->all(), []));

        return $microservice->processRequest();
    }

    public function serviceCheckPaymentRequest()
    {
        $microservice = new RequestInfoMicroservice($this->request);
        $microservice->setDescription("Two step NCHL aggregated check payment")
            ->setVendor("NCHL")
            ->setMicroservice("NCHL")
            ->setUrl("/nchl/aggregated-service-check")
            ->setRequestParam(array_merge($this->request->all(), []));

        return $microservice->processRequest();
    }

    public function serviceExecutePaymentRequest()
    {
        $microservice = new PreTransactionMicroservice($this->request);
        $microservice->setDescription("Two step NCHL aggregated execute payment")
            ->setAmount($this->request->amount)
            ->setVendor("NCHL")
            ->setMicroservice("NCHL")
            ->setTransactionType("debit")
            ->setUrl("/nchl/aggregated-service-execute")
            ->setRequestParam(array_merge($this->request->all(), []));

        return $microservice->processRequest();
    }
}
