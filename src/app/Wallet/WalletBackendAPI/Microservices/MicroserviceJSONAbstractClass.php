<?php


namespace App\Wallet\WalletBackendAPI\Microservices;


use App\Wallet\Architecture\Exceptions\AddBalanceToUserException;
use App\Wallet\Microservice\Exceptions\MicroserviceClientException;
use App\Wallet\Microservice\Exceptions\MicroserviceException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MicroserviceJSONAbstract
{
    protected $httpMethod = "POST";

    protected $url;

    public function setHttpMethod($httpMethod){
        $this->httpMethod = $httpMethod;
    }

    public function setUrl($url){
        $this->url = $url;
    }

}
