<?php


namespace App\Wallet\DisputeHandler\Behaviors;


use App\Models\Dispute;
use App\Models\DisputeHandler;
use App\Wallet\DisputeHandler\Interfaces\IDisputeHandler;

class BClearanceHandler implements IDisputeHandler
{

    private $disputeId;

    private $clearanceId;

    private $source;

    private $handler = 'CLEARANCE';

    private $vendorType;

    private $description;

    /**
     * @param mixed $disputeId
     * @return BClearanceHandler
     */
    public function setDisputeId($disputeId)
    {
        $this->disputeId = $disputeId;
        return $this;
    }

    /**
     * @param mixed $clearanceId
     * @return BClearanceHandler
     */
    public function setClearanceId($clearanceId)
    {
        $this->clearanceId = $clearanceId;
        return $this;
    }

    /**
     * @param mixed $source
     * @return BClearanceHandler
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param string $handler
     * @return BClearanceHandler
     */
    public function setHandler(string $handler): BClearanceHandler
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * @param mixed $vendorType
     * @return BClearanceHandler
     */
    public function setVendorType($vendorType)
    {
        $this->vendorType = $vendorType;
        return $this;
    }

    /**
     * @param mixed $description
     * @return BClearanceHandler
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }


    public function handlerStrategy()
    {
        $dispute = Dispute::with('disputeable', 'clearance')->find($this->disputeId);
        dd($dispute->clearance->clearanceTransactions());

        // create a row in dispute handler
        // increase the wallet amount
    }

    public function acceptHandleStrategy()
    {
        $dispute = Dispute::with('disputeable', 'disputeHandler')->where('id', $this->disputeId)->first();
        $dispute->clearance_dispute_status = Dispute::CLEARANCE_DISPUTE_STATUS_CLEARED;
        $dispute->save();

        $handler = $dispute->disputeHandlers()->whereHandler(DisputeHandler::HANDLER_CLEARANCE)->first();
        $handler->cleared_clearance_id = $this->clearanceId;
        $handler->save();

        return true;
    }


}
