<?php


namespace App\Wallet\MiracleInfoSMS\ApiRequest;


use Illuminate\Support\Facades\Log;

class MiracleSmsBalance extends MiracleSmsBalanceAbstract
{
    private $tag;
    private $ac;
    private $dt;
    private $msg;
    private $u;
    private $p;
    private $s;
    private $c;

    public function __construct(){
        $this->setTag()
            ->setAc()
            ->setDt()
            ->setMsg()
            ->setU()
            ->setP()
            ->setS()
            ->setC();
    }

    public function setTag(){
        $this->tag = config('MiracleInfo-sms.'."tag");
        return $this;
    }

    public function setAc(){
        $this->ac = config('MiracleInfo-sms.'."ac");
        return $this;
    }

    public function setDt(){
        $this->dt = config('MiracleInfo-sms.'."dt");
        return $this;
    }

    public function setMsg(){
        $this->msg = config('MiracleInfo-sms.'."msg");
        return $this;
    }

    public function setU(){
        $this->u = config('MiracleInfo-sms.'."from");
        return $this;
    }

    public function setP(){
        $this->p = config('MiracleInfo-sms.'."token");
        return $this;
    }

    public function setS(){
        $this->s = config('MiracleInfo-sms.'."s");
        return $this;
    }

    public function setC(){
        $this->c = config('MiracleInfo-sms.'."c");
        return $this;
    }

    public function preRequest()
    {
        $this->addParam('tag',$this->tag)
            ->addParam('ac',$this->ac)
            ->addParam('dt',$this->dt)
            ->addParam('msg',$this->msg)
            ->addParam('u',$this->u)
            ->addParam('p',$this->p)
            ->addParam('s',$this->s)
            ->addParam('c',$this->c);
        $this->setBaseUrl(config('MiracleInfo-sms.'."base_url"));
        $this->setUrl(config('MiracleInfo-sms.'."url"));
    }

    public function processRequest()
    {
        $this->preRequest();
        $response = $this->makeRequest();
        Log::info("Response Json", [$response]);
        return $response;
    }

}
