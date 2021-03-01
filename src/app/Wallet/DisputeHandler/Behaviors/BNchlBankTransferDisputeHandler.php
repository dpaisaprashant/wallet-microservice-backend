<?php


namespace App\Wallet\DisputeHandler\Behaviors;


use App\Wallet\DisputeHandler\Resolver\DisputeHandlerResolver;
use App\Wallet\DisputeHandler\Traits\SingleDisputeHandlerAttributes;

class BNchlBankTransferDisputeHandler
{
    use SingleDisputeHandlerAttributes;

    public function __construct()
    {
        $this->vendorType = 'nchlBankTransfer';
    }

    public function selectDisputeHandler()
    {
        $handle = (new DisputeHandlerResolver($this->handler))->resolve();

        $handle->setDisputeId($this->disputeId)
            ->setVendorType($this->vendorType)
            ->setSource($this->source)
            ->setHandler($this->handler)
            ->setDescription($this->description);

        return $handle->handlerStrategy();
    }

}
