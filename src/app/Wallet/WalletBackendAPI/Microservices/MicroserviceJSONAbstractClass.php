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

class MicroserviceJSONAbstractClass
{
    protected $httpMethod = "POST";

    protected $url;

    protected $apiParam = [];

    protected $baseUrl;

    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setBaseUrl($baseUrl){
        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function addApiParam($key, $value)
    {
        $this->apiParam[$key] = $value;
        return $this;
    }

    public function makeRequest($endpoint="")
    {

        try {
            $requestJson = array_merge(request()->all(), $this->apiParam);
            $client = new Client();
            $response = $client->request($this->httpMethod,$this->baseUrl.$this->url, [
                'json' => $requestJson
            ]);


            return $response->getBody()->getContents();

        } catch (ClientException $e) {

            Log::info('Client Exception');
            Log::info($e);

            DB::commit();
        } catch (\Exception $e) {

            Log::info('Unknown Exception');
            Log::info($e);

            DB::commit();
        }catch(ConnectException $e){

            Log::info('Connection Exception');
            Log::info($e);
        }
    }

}
