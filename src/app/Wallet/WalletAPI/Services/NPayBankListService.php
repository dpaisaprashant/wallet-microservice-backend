<?php


namespace App\Wallet\Microservice\Services;

use App\Wallet\Microservice\RequestInfoMicroservice;
use Illuminate\Http\Request;

class NPayBankListService
{
    protected $request;
    protected $microservice;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->microservice = new RequestInfoMicroservice($request);
        $this->microservice->setHttpMethod('GET')
            ->setMicroservice('NPAY');
    }

    public function getBankList()
    {
        $this->microservice->setUrl("/list")
            ->setDescription('Get npay bank list');

        return $this->microservice->processRequest();
    }
}
