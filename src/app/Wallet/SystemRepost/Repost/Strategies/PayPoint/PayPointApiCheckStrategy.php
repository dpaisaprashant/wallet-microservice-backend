<?php

namespace App\Wallet\SystemRepost\Repost\Strategies\PayPoint;

use App\Wallet\SystemRepost\Repost\Contracts\CheckByApiContract;
use Illuminate\Support\Facades\Log;

class PayPointApiCheckStrategy implements CheckByApiContract
{

    public function checkMicroserviceApiStatus()
    {
        Log::info("5. check api of PayPoint");

        // TODO: Implement checkMicroserviceApiStatus() method.
    }
}
