<?php

namespace App\Wallet\SystemRepost\Repost\Resolver;

use App\Models\KhaltiUserTransaction;
use App\Models\Microservice\PreTransaction;
use App\Models\NPSAccountLinkLoad;
use App\Models\NpsLoadTransaction;
use App\Models\User;
use App\Models\UserTransaction;
use App\Wallet\SystemRepost\Repost\PerformSystemRepost;
use App\Wallet\SystemRepost\Repost\Strategies\Khalti\KhaltiSystemRepostStrategy;
use App\Wallet\SystemRepost\Repost\Strategies\NpsAccountLink\NpsAccountLinkApiCheckStrategy;
use App\Wallet\SystemRepost\Repost\Strategies\NpsAccountLink\NpsAccountLinkDBCheckStrategy;
use App\Wallet\SystemRepost\Repost\Strategies\NpsAccountLink\NpsAccountLinkSystemRepostStrategy;

use App\Wallet\SystemRepost\Repost\Strategies\PayPoint\PayPointApiCheckStrategy;
use App\Wallet\SystemRepost\Repost\Strategies\PayPoint\PayPointDBCheckStrategy;
use App\Wallet\SystemRepost\Repost\Strategies\PayPoint\PayPointSystemRepostStrategy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BackendSystemRepostResolver
{
    private PreTransaction $preTransaction;
    private string $transactionType;
    public function __construct(PreTransaction $preTransaction,string $transactionType)
    {
        $this->preTransaction = $preTransaction;
        $this->transactionType = $transactionType;
    }

    public function resolve(){
        switch ($this->transactionType){
            case NPSAccountLinkLoad::class:

                Log::info("2. Resolve for nps account link load");
                return new PerformSystemRepost(
                    new NpsAccountLinkDBCheckStrategy($this->preTransaction),
                    new NpsAccountLinkApiCheckStrategy(),
                    new NpsAccountLinkSystemRepostStrategy(),
                    $this->preTransaction,
                );
            case KhaltiUserTransaction::class:

                Log::info("2. Resolve for khalti");
                $strategy =  new KhaltiSystemRepostStrategy();

                return new PerformSystemRepost(
                    $strategy,
                    $strategy,
                    $strategy,
                    $this->preTransaction,
                );
            case UserTransaction::class:
                Log::info("3. Resolve for PAYPOINT");

                return new PerformSystemRepost(
                    new PayPointDBCheckStrategy($this->preTransaction),
                    new PayPointApiCheckStrategy(),
                    new PayPointSystemRepostStrategy(),
                    $this->preTransaction,
                );
        }
    }
}
