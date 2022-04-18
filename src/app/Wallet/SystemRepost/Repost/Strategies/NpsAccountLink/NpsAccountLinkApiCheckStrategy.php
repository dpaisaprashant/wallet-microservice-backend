<?php

namespace App\Wallet\SystemRepost\Repost\Strategies\NpsAccountLink;

use App\Wallet\SystemRepost\Repost\Contracts\CheckByApiContract;
use Illuminate\Support\Facades\Log;

class NpsAccountLinkApiCheckStrategy implements CheckByApiContract
{

    public function checkMicroserviceApiStatus()
    {
        Log::info("5. check api of npa load");

        // TODO: Implement checkMicroserviceApiStatus() method.
    }
}
