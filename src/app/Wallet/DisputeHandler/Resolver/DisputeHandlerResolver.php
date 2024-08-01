<?php


namespace App\Wallet\DisputeHandler\Resolver;


use App\Models\Dispute;
use App\Wallet\DisputeHandler\Behaviors\BAutomaticHandler;
use App\Wallet\DisputeHandler\Behaviors\BDeductionHandler;
use App\Wallet\DisputeHandler\Behaviors\BDoNothingHandler;
use App\Wallet\DisputeHandler\Behaviors\BReimburseHandler;

class DisputeHandlerResolver
{
    private $handler;

    public function __construct($handler)
    {
        $this->handler = $handler;
    }

    public function resolve()
    {

        switch ($this->handler) {
            case Dispute::HANDLER_MANUAL_REIMBURSE:
                return new BReimburseHandler();
                break;

            case Dispute::HANDLER_MANUAL_DEDUCTION:
                return new BDeductionHandler();
                break;

            case Dispute::HANDLER_AUTOMATIC:
                return new BAutomaticHandler();
                break;

            default:
                return new BDoNothingHandler();
        }

    }
}
