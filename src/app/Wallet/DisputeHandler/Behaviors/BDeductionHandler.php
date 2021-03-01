<?php


namespace App\Wallet\DisputeHandler\Behaviors;


use App\Events\UserWalletPaymentEvent;
use App\Models\Dispute;
use App\Models\DisputeHandler;
use App\Wallet\DisputeHandler\Interfaces\IDisputeHandler;

class BDeductionHandler implements IDisputeHandler
{

    private $disputeId;

    private $vendorType;

    private $handler = 'DEDUCTION';

    private $source;

    private $description;

    private $clearanceId;

    private $repostedStatus = 'ERROR';

    /**
     * @param mixed $disputeId
     * @return BDeductionHandler
     */
    public function setDisputeId($disputeId)
    {
        $this->disputeId = $disputeId;
        return $this;
    }

    /**
     * @param mixed $vendorType
     * @return BDeductionHandler
     */
    public function setVendorType($vendorType)
    {
        $this->vendorType = $vendorType;
        return $this;
    }

    /**
     * @param string $handler
     * @return BDeductionHandler
     */
    public function setHandler(string $handler): BDeductionHandler
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * @param mixed $source
     * @return BDeductionHandler
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param mixed $description
     * @return BDeductionHandler
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param mixed $clearanceId
     * @return BDeductionHandler
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
        $dispute->reposted_status = 'ERROR';
        $dispute->reposted_amount = $dispute->disputeable->amount * 100;
        $dispute->description = $this->description;
        $dispute->save();

        // decrease the wallet amount

        event(new UserWalletPaymentEvent($userId, $amount));


        return $dispute;
    }




}
