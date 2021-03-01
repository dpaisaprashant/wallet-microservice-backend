<?php

namespace App\Wallet\SparrowSMS;

use App\Wallet\Helpers\ErrorGenerator;
use App\Wallet\SparrowSMS\Models\Sparrow;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;

class SendSMS extends SparrowGuzzleWrapper
{

    protected function addRecord($to, $message)
    {
        Sparrow::create([
            'mobile_no' => $to,
            'description' => $message
        ]);
    }

    public function send($to, $message)
    {
        try {
            $this->addConfig(["to" => $to], ["text" => $message]);
            $this->addRecord($to,$message);
            return $this->makeRequest();
        } catch (ConnectException $e) {
            Log::info("Error while sending the sms: ConnectException ");
            Log::debug($e->getMessage());
            return;
            //return response()->json(ErrorGenerator::generate("app.sparrow", "server-response"));
        } catch (\Exception $e) {
            Log::info("Unknown exception while sending sms");
            Log::debug($e->getMessage());
            return;
            //return response()->json(ErrorGenerator::generate("app.sparrow", "server-client-exception"));
        }
    }
}
