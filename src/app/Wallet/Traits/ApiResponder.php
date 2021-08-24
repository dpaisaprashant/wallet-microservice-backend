<?php

namespace App\Wallet\Traits;

use App\Wallet\Helpers\ErrorGenerator;
use Illuminate\Http\JsonResponse;

trait ApiResponder
{
    private function successResonse($data, $code = 200)
    {
        return response()->json($data, $code);
    }

    private function errorResponse($data, $code = 400)
    {
        return response()->json($data, $code);
    }

    private function errorGenerator(array $array, $code = 400)
    {
        $vendor = $array[0];
        $key = $array[1];
        $defaultValue = count($array) > 2 ? $array[2] : "";
        //dd(response()->json(ErrorGenerator::generate($vendor, $key, $defaultValue)));
        return response()->json(ErrorGenerator::generate($vendor, $key, $defaultValue), $code);
    }
}
