<?php


namespace App\Wallet\WalletAPI;


use App\Wallet\WalletAPI\Exceptions\MicroserviceClientException;
use App\Wallet\Microservice\Exceptions\MicroserviceException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Psr7;

abstract class BackendWalletAPIJSONAbstract
{
    protected $apiParams = [];

    protected $baseUrl;

    protected $url;

    protected $httpMethod = 'POST';

    protected $preTransaction;

    public function setApiParams(array $apiParams)
    {
        $this->apiParams = $apiParams;
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

    public function setHttpMethod(string $httpMethod)
    {
        $this->httpMethod = $httpMethod;
        return $this;
    }

    public function addParam($key, $value)
    {
        $this->apiParams[$key]  = $value;
        return $this;
    }


    public function makeRequest($endpoint = "")
    {
        try {
            $requestJson = (array_merge(request()->all(), $this->apiParams));
            Log::info("Request Json", $requestJson);
            $client = new Client();
            $response = $client->request($this->httpMethod, $this->baseUrl . $this->url, [
                'json' => $requestJson
            ]);
            return $response->getBody()->getContents();
        }catch (ClientException $e) {
            Log::info("Client Exception");
            Log::info($e);

            DB::commit();
            throw new MicroserviceClientException(
                $this->preTransaction,
                $e->getResponse()->getReasonPhrase(),
                $e->getResponse()->getBody()->getContents(),
                $e->getCode()
            );

        } catch (RequestException $e) {
            Log::info("Request Exception");
            if ($this->preTransaction) $this->preTransaction->update([
                "status" => "FAILED",
                "json_response" => json_encode($e->getMessage())
            ]);
            DB::commit();
            Log::info($e);
            throw new \Exception($e->getMessage());

        } catch (ConnectException $e) {
            //TODO: Notify Developers
            if ($this->preTransaction) $this->preTransaction->update([
                "status" => "FAILED",
                "json_response" => json_encode($e->getMessage())
            ]);
            DB::commit();
            Log::info($e);

            $preTransactionId = $this->apiParams['pre_transaction_id'] ?? null;
//            throw new AddBalanceToUserException($e->getMessage(), $preTransactionId);

        } catch (\Exception $e) {
            Log::info("Unknown Exception");
            if ($this->preTransaction) $this->preTransaction->update([
                "status" => "FAILED",
                "json_response" => json_encode($e->getMessage())
            ]);
            Log::info($e);
            DB::commit();
            throw new \Exception($e->getMessage());
        }
    }

    public function uploadImage()
    {
        try {
            $requestJson = ($this->apiParams);
            Log::info("Request Json", $requestJson);
            $client = new Client();
            $response = $client->request($this->httpMethod, $this->baseUrl . $this->url,[
               "headers" => [
                   'App-Authorizer'=>'647061697361',
               ],
                'multipart' => [
                    [
                        'name' => "image",
                        'contents' => $requestJson['image']
                    ],
                    [
                        'name' => "disk",
                        "contents" => $requestJson['disk'],
                    ],
                ]
            ]);
            return $response->getBody()->getContents();
        }catch (ClientException $e) {
            Log::info("Client Exception");
            Log::info($e);

//            throw new MicroserviceClientException(
//                $this->preTransaction,
//                $e->getResponse()->getReasonPhrase(),
//                $e->getResponse()->getBody()->getContents(),
//                $e->getCode()
//            );
            throw new \Exception($e->getMessage());

        } catch (RequestException $e) {
            Log::info("Request Exception");
            Log::info($e);
            throw new \Exception($e->getMessage());

        } catch (ConnectException $e) {
            //TODO: Notify Developers
            Log::info($e);
            dd("connection exception");
//            throw new AddBalanceToUserException($e->getMessage(), $preTransactionId);

        } catch (\Exception $e) {
            Log::info("Unknown Exception");
            Log::info($e);
            throw new \Exception($e->getMessage());
        }
    }
}
