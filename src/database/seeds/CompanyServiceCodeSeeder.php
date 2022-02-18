<?php


use App\Models\Microservice\PreTransaction;
use Illuminate\Database\Seeder;

class CompanyServiceCodeSeeder extends Seeder
{
    public function run()
    {
        $preTransactions = PreTransaction::where('vendor', 'PAYPOINT')->orderBy('created_at', 'DESC')->get();

        foreach ($preTransactions as $preTransaction) {
            $jsonRequest = json_decode($preTransaction->json_request, true);

            if ($jsonRequest['company_code'] !== null) {
                $preTransaction->update(["company_code" => $jsonRequest['company_code']]);
            }

            if ($jsonRequest['service_code'] !== null) {
                if($jsonRequest['service_code'] === 0){
                    $preTransaction->update(["service_code" => 0]);
            }
            $preTransaction->update(["service_code" => $jsonRequest['service_code']]);
        }
    }
}
}
