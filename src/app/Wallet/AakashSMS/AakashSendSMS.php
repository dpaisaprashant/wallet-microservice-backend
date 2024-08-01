<?php

namespace App\Wallet\AakashSMS;

use App\Wallet\AakashSMS\AakashGuzzleWrapper;
use App\Wallet\Helpers\ErrorGenerator;
use App\Wallet\AakashSMS\Models\AakashSMS;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;

class AakashSendSMS extends AakashGuzzleWrapper
{

    protected function addRecord($to, $message)
    {
        AakashSMS::create([
            'mobile_no' => $to,
            'description' => $message
        ]);
    }

    public function send($to, $message)
    {
        try {
            $this->addConfig(["to" => $to], ["text" => $message]);
            $this->addRecord($to,$message);
            $response = $this->makeRequest();
            Log::info("Aakash SMS response", [$response]);
            return $response;
        } catch (ConnectException $e) {
            Log::info("Error while sending the sms: ConnectException ");
            Log::debug($e->getMessage());
            return response()->json(ErrorGenerator::generate("app.sparrow", "server-response"));
        } catch (\Exception $e) {
            Log::info("Unknown exception while sending sms");
            Log::debug($e->getMessage());
            return response()->json(ErrorGenerator::generate("app.sparrow", "server-client-exception"));
        }
    }
}
