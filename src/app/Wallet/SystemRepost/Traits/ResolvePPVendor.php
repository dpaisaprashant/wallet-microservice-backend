<?php


namespace App\Wallet\SystemRepost\Traits;

use App\Models\Merchant\Merchant;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

trait ResolvePPVendor
{
    public function resolveVendor($companyCode, $serviceCode, $serviceType = "")
    {

        try {
            $configuration = config('paypoint_validation.' . $companyCode);
            if ($configuration == null) {
                return "NOT_RESOLVED";
            }

            if ($companyCode == '596' && $serviceCode == '0') {
                if (!empty($serviceType)) {
                    $serviceType = strtoupper($serviceType);
                    return "SUBISU_{$serviceType}";
                }
            }

            $services = $configuration['services'];
            if (!Arr::exists($services, $serviceCode)) {
                //return "NOT_RESOLVED";
                return $configuration['vendor_name'];
            }
            $rules = $services[$serviceCode];
            return $rules['short_code'];
        } catch (\Exception $e) {
            Log::error($e);
            if ($companyCode == '720') {
                return "NEPAL-WATER";
            }
            return "NOT_RESOLVED";

        }

    }
}
