<?php

namespace App\Wallet\MiracleInfoSMS;

use GuzzleHttp\Client;


abstract class MiracleInfoGuzzleWrapper
{

    public $config = [];

    public $client;

    public $url;

    public function __construct()
    {
        $this->config = $this->defaultConfig();
        $this->loadClient();
        $this->url = config('miracle-info-sms.base_url') . config('miracle-info-sms.url');
    }

    protected function loadClient()
    {
        $this->client = new Client();
    }

    public function defaultConfig()
    {
        return [
            "tag" => config("miracle-info-sms.tag"),
            "ac" => config("miracle-info-sms.ac"),
            "dt" => config("miracle-info-sms.dt"),
            "u" => config("miracle-info-sms.u"),
            "p" => config("miracle-info-sms.p"),
            "s" => config("miracle-info-sms.s"),
            "c" => config("miracle-info-sms.c"),
        ];
    }

    public function serializeConfig($data)
    {
        return array_merge($this->config, $data);
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
            'query' => $this->serializeConfig($this->config),
        ];
        $response = $this->client->get($this->url,  $requestConfig);
        return $response->getBody()->getContents();
    }
}
