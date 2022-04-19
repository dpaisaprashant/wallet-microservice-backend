<?php


namespace App\Wallet\SystemRepost\Traits;

use App\Models\Merchant\Merchant;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

trait ResolvePPTransactionEventsServiceTypeVendor
{
    public function resolveVendorServiceType($payPointUserTransaction)
    {
        if (!empty($payPointUserTransaction)) {
            Log::info("User Transaction", [$payPointUserTransaction]);
            $transactionVendor = $payPointUserTransaction->vendor;
            $serviceType = 'PAYMENT';
            $vendor = $transactionVendor;
            if ($transactionVendor == "NEPAL_WATER") {
                $transactionVendor = "NEPAL-WATER";
            }

            if ($transactionVendor == "KHANEPANI_WATER") {
                $transactionVendor = "KHANEPANI-WATER";
            }

            Log::info("Microservice Transaction Vendor");
            $explodeVendor = explode("_", $transactionVendor);
            if (count($explodeVendor) > 1) {
                $vendor = $explodeVendor[0];
                $serviceType = $explodeVendor[1];
            }

            Log::info("Microservice Vendor: " . $vendor);
            Log::info("Microservice Service Type: " . $serviceType);

          return ['vendor'=>$vendor,'serviceType'=>$serviceType];
        }

    }
}
