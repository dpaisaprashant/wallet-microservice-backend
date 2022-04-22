<?php

namespace App\Wallet\MiracleInfoSMS;

use App\Wallet\Helpers\ErrorGenerator;
use App\Wallet\MiracleInfoSMS\Models\MiracleInfoSms;
use App\Wallet\SparrowSMS\Models\Sparrow;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Support\Facades\Log;

class MiracleInfoSendSMS extends MiracleInfoGuzzleWrapper
{

    protected function addRecord($to, $message)
    {
        MiracleInfoSms::create([
            'mobile_no' => $to,
            'description' => $message
        ]);
    }

    public function send($to, $message)
    {
        try {
            $this->addConfig(["mob" => "977".$to], ["msg" => $message]);
            $this->addRecord($to,$message);
            $response = $this->makeRequest();
            if ($response == 1) {
                return $response;
            }
            return response()->json(ErrorGenerator::generate("app.sparrow", "server-response"));
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
