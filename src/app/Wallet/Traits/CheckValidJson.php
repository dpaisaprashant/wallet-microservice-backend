<?php


namespace App\Wallet\Traits;


trait CheckValidJson
{
    public function isValidJson($json)
    {
        try {
            if (is_string($json)) {
                json_decode($json, true);
            } else {
                return false;
            }

            if (json_last_error() != JSON_ERROR_NONE) {
                // There was an error
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }


        return true;
    }
}
