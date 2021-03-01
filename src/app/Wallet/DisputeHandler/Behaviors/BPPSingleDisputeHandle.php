<?php


namespace App\Wallet\DisputeHandler\Behaviors;


use App\Models\Dispute;
use App\Wallet\DisputeHandler\Interfaces\IHandleDispute;
use App\Wallet\DisputeHandler\Resolver\DisputeHandlerResolver;
use App\Wallet\DisputeHandler\Traits\SingleDisputeHandlerAttributes;

class BPPSingleDisputeHandle implements IHandleDispute
{
    use SingleDisputeHandlerAttributes;

    public function __construct()
    {
        $this->vendorType = 'payPoint';
    }

    public function selectDisputeHandler()
    {
        $handle = (new DisputeHandlerResolver($this->handler))->resolve();

        $handle->setDisputeId($this->disputeId)
            ->setVendorType($this->vendorType)
            ->setSource($this->source)
            ->setDescription($this->description)
            ->setHandler($this->handler);

        return $handle->handlerStrategy();
    }

    public function acceptDisputeHandler()
    {
        $handle = new BAutomaticHandler();
        $handle->setDisputeId($this->disputeId);
        return $handle->acceptHandleStrategy();
    }

    public function rejectDisputeHandler()
    {
        $handler = new BAutomaticHandler();
        $handler->setDisputeId($this->disputeId);
        return $handler->rejectHandleStrategy();
    }
}
