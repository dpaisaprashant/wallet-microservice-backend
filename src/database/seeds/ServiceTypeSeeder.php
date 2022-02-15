<?php

use App\Models\Microservice\PreTransaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add cashback for agent types that do not exist
        $preTransactions = PreTransaction::where('microservice_type', 'NTC')->orderBy('created_at', 'DESC')->get();

        foreach ($preTransactions as $preTransaction) {
            $jsonRequest = json_decode($preTransaction->json_request, true);

            if ($jsonRequest['service_code'] !== null && $preTransaction->service_type == null) {
                if ($jsonRequest['service_code'] === 1) {
                    $preTransaction->update(["service_type" => 'NTC_PSTN']);
                } elseif ($jsonRequest['service_code'] === 2) {
                    $preTransaction->update(["service_type" => 'NTC_ADSLU']);
                } elseif ($jsonRequest['service_code'] === 3) {
                    $preTransaction->update(["service_type" => 'NTC_ADSLV']);
                } elseif ($jsonRequest['service_code'] === 4) {
                    $preTransaction->update(["service_type" => 'NTC_SIP']);
                } elseif ($jsonRequest['service_code'] === 5) {
                    $preTransaction->update(["service_type" => 'NTC_RECHARGE']);
                } elseif ($jsonRequest['service_code'] === 6) {
                    $preTransaction->update(["service_type" => 'NTC_PREPAID']);
                } elseif ($jsonRequest['service_code'] === 7) {
                    $preTransaction->update(["service_type" => 'NTC_POSTPAID']);
                } elseif ($jsonRequest['service_code'] === 8) {
                    $preTransaction->update(["service_type" => 'NTC_NTFTTH']);
                } elseif ($jsonRequest['service_code'] === 9) {
                    $preTransaction->update(["service_type" => 'NTC_NTWIMAX']);
                }
            }
        }
    }
}
