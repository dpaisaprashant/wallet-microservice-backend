<?php

namespace App\Wallet\SparrowSMS;

use GuzzleHttp\Client;


abstract class SparrowGuzzleWrapper
{

    public $config = [];

    public $client;

    public $url;

    public function __construct()
    {
        $this->config = $this->defaultConfig();
        $this->loadClient();
        $this->url = config('sparrow-sms.base_url') . config('sparrow-sms.url');
    }

    protected function loadClient()
    {
        $this->client = new Client();
    }

    public function defaultConfig()
    {
        return ["token" => config("sparrow-sms.token"), "from" => config("sparrow-sms.from")];
    }

    public function serializeConfig($data)
    {
        return http_build_query(array_merge($this->config, $data), '', '&');
    }

    public function addConfig($param1, $param2)
    {
        $this->config = array_merge($this->config, $param1, $param2);
        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function makeRequest()
    {
        $requestConfig = [
            'headers' => [
                'User-Agent' => 'dPaisa/1.0',
                'Accept' => '*/*',
                "Content-Type" => "application/x-www-form-urlencoded",
            ],
            'body' => $this->serializeConfig($this->config),
        ];
        $response = $this->client->post($this->url,  $requestConfig);
        return $response->getBody()->getContents();
    }
}
