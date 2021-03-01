<?php


namespace App\Wallet\DisputeHandler\Behaviors;


use App\Models\Dispute;
use App\Models\DisputeHandler;
use App\Wallet\DisputeHandler\Interfaces\IDisputeHandler;

class BDoNothingHandler implements IDisputeHandler
{

    private $disputeId;

    private $vendorType;

    private $handler = 'DO_NOTHING';

    private $source;

    private $description;

    private $clearanceId;

    private $repostedStatus = 'ERROR';

    /**
     * @param mixed $disputeId
     * @return $this
     */
    public function setDisputeId($disputeId)
    {
        $this->disputeId = $disputeId;
        return $this;
    }

    /**
     * @param mixed $vendorType
     * @return $this
     */
    public function setVendorType($vendorType)
    {
        $this->vendorType = $vendorType;
        return $this;
    }

    /**
     * @param string $handler
     * @return $this
     */
    public function setHandler(string $handler)
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * @param mixed $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param mixed $description
     * @return BDoNothingHandler
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param mixed $clearanceId
     * @return BDoNothingHandler
     */
    public function setClearanceId($clearanceId)
    {
        $this->clearanceId = $clearanceId;
        return $this;
    }

    public function handlerStrategy()
    {
        // create a row in dispute handler
        $disputeHandler = [
            'admin_id' => auth()->user()->id,
            'dispute_id' => $this->disputeId,
            'handler' => $this->handler,
            'reposted_status' => $this->repostedStatus,
        ];
        DisputeHandler::create($disputeHandler);

        $status = Dispute::USER_DISPUTE_STATUS_CLEARED;


        //update dispute
        $dispute = Dispute::with('disputeable')->find($this->disputeId);
        $dispute->source =  $this->source;
        $dispute->handler = $this->handler;
        $dispute->user_dispute_status = $status;
        $dispute->reposted_status = 'COMPLETED';
        $dispute->reposted_amount = $dispute->disputeable->amount * 100;
        $dispute->description = $this->description;
        $dispute->save();


        return $dispute;
    }




}
