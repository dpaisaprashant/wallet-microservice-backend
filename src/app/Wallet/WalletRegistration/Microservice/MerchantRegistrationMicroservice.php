<?php


namespace App\Wallet\WalletRegistration\Microservice;


use App\Wallet\WalletAPI\BackendWalletAPIJSONAbstract;
use Illuminate\Http\Request;

class MerchantRegistrationMicroservice extends BackendWalletAPIJSONAbstract
{
    private $name;
    private $email;
    private $password;
    private $mobile_no;
    private $backendUser;


    public function __construct(Request $request)
    {
        $this->setBackendUser($request->user()->id ?? "")
            ->setName($request->name)
            ->setEmail($request->email)
            ->setPassword($request->password)
            ->setMobileNo($request->mobile_no);
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function setMobileNo($mobile_no)
    {
        $this->mobile_no = $mobile_no;
        return $this;
    }

    public function setBackendUser($backendUser)
    {
        $this->backendUser = $backendUser;
        return $this;
    }

    public function processRequest()
    {
        return $this->addParam('name',$this->name)
            ->addParam('email',$this->email)
            ->addParam('password',$this->password)
            ->addParam('mobile_no',$this->mobile_no)
            ->setBaseUrl(config('wallet-registration.base_url'))
            ->setUrl(config('wallet-registration.merchant_registration'))
            ->addParam('fcm_token','12345');
    }

    public function createMerchant()
    {
        $this->processRequest();
        $response = $this->makeRequest();
        return $response;
    }
}
