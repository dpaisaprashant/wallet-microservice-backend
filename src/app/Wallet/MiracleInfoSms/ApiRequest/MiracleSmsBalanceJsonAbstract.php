<?php


namespace App\Wallet\MiracleInfoSms\ApiRequest;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

abstract class MiracleSmsBalanceJsonAbstract
{
    protected $apiParams = [];
    protected $baseUrl;
    protected $url;
    protected $httpMethod = 'GET';

    public function addParam($key, $value)
    {
        $this->apiParams[$key]  = $value;
        return $this;
    }

    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }



    public function makeRequest($endpoint = "")
    {
        try {
            $requestJson = $this->apiParams;
            Log::info("Request Json", $requestJson);
            $client = new Client();
            $response = $client->request($this->httpMethod, $this->baseUrl . $this->url, [
                'query' => $requestJson
            ]);
            return $response->getBody()->getContents();
        }
        catch (ClientException $e) {
            Log::info("Client Exception");
            Log::info($e);
            return "errorClient";
        }
        catch (RequestException $e) {
            Log::info("Request Exception");
            Log::info($e);
            return "errorRequest";
        } catch (ConnectException $e) {
            Log::info($e);
            return "errorConnectException";
        } catch (\Exception $e) {
            Log::info("Unknown Exception");
            Log::info($e);
            return "Other Error";
        }
    }
}
