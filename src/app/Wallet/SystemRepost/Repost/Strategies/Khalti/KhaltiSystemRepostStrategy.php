<?php

namespace App\Wallet\SystemRepost\Repost\Strategies\Khalti;

use App\Models\Microservice\PreTransaction;
use App\Wallet\SystemRepost\Repost\Contracts\CheckByApiContract;
use App\Wallet\SystemRepost\Repost\Contracts\CheckByDatabaseContract;
use App\Wallet\SystemRepost\Repost\Contracts\SystemRepostContract;
use Illuminate\Support\Facades\Log;

class KhaltiSystemRepostStrategy implements CheckByDatabaseContract, CheckByApiContract, SystemRepostContract
{

    public function checkMicroserviceApiStatus(PreTransaction $preTransaction)
    {
        Log::info("5. check api of khalti");

        // TODO: Implement checkMicroserviceApiStatus() method.
    }

    public function checkMicroserviceDatabaseStatus($preTransaction)
    {
        Log::info("4. check db of khalti");

        // TODO: Implement checkMicroserviceDatabaseStatus() method.
    }

    public function performRepost($preTransaction)
    {
        Log::info("6. perform repost of khalti");

        // TODO: Implement performRepost() method.
    }
}
