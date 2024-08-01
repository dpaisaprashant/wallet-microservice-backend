<?php

namespace App\Wallet\AakashSMS;

use GuzzleHttp\Client;


abstract class AakashGuzzleWrapper
{

    public $config = [];

    public $client;

    public $url;

    public function __construct()
    {
        $this->config = $this->defaultConfig();
        $this->loadClient();
        $this->url = config('aakash-sms.base_url') . config('aakash-sms.url');
    }

    protected function loadClient()
    {
        $this->client = new Client();
    }

    public function defaultConfig()
    {
        return ["auth_token" => config("aakash-sms.auth_token")];
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
//                'User-Agent' => 'sajiloPay/1.0',
                'Accept' => '*/*',
                "Content-Type" => "application/x-www-form-urlencoded",
            ],
            'body' => $this->serializeConfig($this->config),
        ];
        $response = $this->client->post($this->url,  $requestConfig);
        return $response->getBody()->getContents();
    }
}
