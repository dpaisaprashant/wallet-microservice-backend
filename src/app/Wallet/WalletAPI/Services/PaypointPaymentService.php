<?php


namespace App\Wallet\WalletAPI\Services;


use App\Wallet\Microservice\PreTransactionMicroservice;
use App\Wallet\Microservice\RequestInfoMicroservice;
use Illuminate\Http\Request;

class PaypointPaymentService
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function oneStepRequest()
    {
        $microservice = new PreTransactionMicroservice($this->request);
        $microservice->setDescription("One step paypoint transaction")
            ->setVendor('PAYPOINT')
            ->setMicroservice('PAYPOINT')
            ->setTransactionType("debit")
            ->setUrl("/pp_one_step")
            ->setAmount( $this->request->amount)
            ->setRequestParam([
                "company_code" => $this->request->company_code,
                "service_code" => $this->request->service_code,
                "account" => $this->request->account,
                "amount" => $this->request->amount,
                "special1" => $this->request->special1,
                "special2" => $this->request->special2
            ]);

        return $microservice->processRequest();
    }

    public function twoStepCheckRequest()
    {
        $microservice = new RequestInfoMicroservice($this->request);
        $microservice->setDescription("Two step paypoint check payment")
            ->setVendor('PAYPOINT')
            ->setMicroservice('PAYPOINT')
            ->setUrl("/pp_two_step_check")
            ->setRequestParam($this->request->all());
           /* ->setRequestParam([
                "company_code" => $this->request->company_code,
                "service_code" => $this->request->service_code,
                "account" => $this->request->account,
            ]);*/

        return $microservice->processRequest();
    }

    public function twoStepExecuteRequest()
    {
        $microservice = new PreTransactionMicroservice($this->request);
        $microservice->setDescription("Two step paypoint execute transaction")
            ->setVendor('PAYPOINT')
            ->setMicroservice('PAYPOINT')
            ->setTransactionType("debit")
            ->setUrl("/pp_two_step_execute")
            ->setAmount($this->request->amount)
            ->setRequestParam([
                "company_code" => $this->request->company_code,
                "service_code" => $this->request->service_code,
                "account" => $this->request->account,
                "amount" => $this->request->amount,
                'refStan' => $this->request->refStan,
                'billNumber'=> $this->request->billNumber,
                'package_id' => $this->request->package_id,
                "special1" => $this->request->special1 ?? null,
                "special2" => $this->request->special2 ?? null
            ]);

        return $microservice->processRequest();
    }
}
