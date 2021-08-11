<?php


namespace App\Wallet\Microservice\Services;

use App\Wallet\Microservice\RequestInfoMicroservice;
use Illuminate\Http\Request;

class PaypointBranchService
{
    protected $request;
    protected $microservice;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->microservice = new RequestInfoMicroservice($request);
        $this->microservice->setHttpMethod('GET')
            ->setMicroservice('PAYPOINT');
    }

    public function khanepaniBranchesRequest()
    {
        $this->microservice->setUrl("/khanepani-water-branches")
            ->setDescription('Get paypoint khanepani water branches');

        return $this->microservice->processRequest();
    }

    public function neaBranchesRequest()
    {
        $this->microservice->setUrl("/nea-branches")
            ->setDescription('Get paypoint nea branches');

        return $this->microservice->processRequest();
    }

    public function nepalWaterBranchesRequest()
    {
        $this->microservice->setUrl("/nepal-water-branches")
            ->setDescription('Get paypoint nepal water branches');

        return $this->microservice->processRequest();
    }
}
