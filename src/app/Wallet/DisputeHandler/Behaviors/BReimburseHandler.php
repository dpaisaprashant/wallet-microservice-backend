<?php


namespace App\Wallet\DisputeHandler\Behaviors;


use App\Events\UserWalletUpdateEvent;
use App\Models\Dispute;
use App\Models\DisputeHandler;
use App\Wallet\DisputeHandler\Interfaces\IDisputeHandler;

class BReimburseHandler implements IDisputeHandler
{

    private $disputeId;

    private $vendorType;

    private $handler = 'REIMBURSE';

    private $source;

    private $description;

    private $clearanceId;

    private $repostedStatus = 'COMPLETED';

    /**
     * @param mixed $disputeId
     * @return BReimburseHandler
     */
    public function setDisputeId($disputeId)
    {
        $this->disputeId = $disputeId;
        return $this;
    }

    /**
     * @param mixed $vendorType
     * @return BReimburseHandler
     */
    public function setVendorType($vendorType)
    {
        $this->vendorType = $vendorType;
        return $this;
    }

    /**
     * @param string $handler
     * @return BReimburseHandler
     */
    public function setHandler(string $handler): BReimburseHandler
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * @param mixed $source
     * @return BReimburseHandler
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param mixed $description
     * @return BReimburseHandler
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param mixed $clearanceId
     * @return BReimburseHandler
     */
    public function setClearanceId($clearanceId)
    {
        $this->clearanceId = $clearanceId;
        return $this;
    }



    public function handlerStrategy()
    {
        $dispute = Dispute::with('disputeable')->find($this->disputeId);

        $userId = $dispute->disputeable->user_id;
        $amount = $dispute->disputeable->amount * 100;


        // create a row in dispute handler
        $disputeHandler = [
            'admin_id' => auth()->user()->id,
            'dispute_id' => $this->disputeId,
            'handler' => $this->handler,
            'reposted_status' => $this->repostedStatus,
            'reposted_amount' => $amount
        ];
        DisputeHandler::create($disputeHandler);

        $status = Dispute::USER_DISPUTE_STATUS_CLEARED;

        //update dispute
        $dispute->source =  $this->source;
        $dispute->handler = $this->handler;
        $dispute->user_dispute_status = $status;
        $dispute->reposted_status = 'COMPLETED';
        $dispute->reposted_amount = $dispute->disputeable->amount * 100;
        $dispute->description = $this->description;
        $dispute->save();

        // increase the wallet amount


        event(new UserWalletUpdateEvent($userId, $amount));

        return $dispute;

    }




}
