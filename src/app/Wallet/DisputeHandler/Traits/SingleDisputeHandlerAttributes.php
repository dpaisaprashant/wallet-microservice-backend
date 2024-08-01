<?php


namespace App\Wallet\DisputeHandler\Traits;

trait SingleDisputeHandlerAttributes
{
    private $disputeId;

    private $vendorType;

    private $handler; //reimburse, deduction, clearance

    private $source;

    private $description;


    /**
     * @param $disputeId
     * @return $this
     */
    public function setDisputeId($disputeId)
    {
        $this->disputeId = $disputeId;
        return $this;
    }

    /**
     * @param string $vendorType
     */
    public function setVendorType(string $vendorType)
    {
        $this->vendorType = $vendorType;
        return $this;
    }

    /**
     * @param $handler
     * @return $this
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}
