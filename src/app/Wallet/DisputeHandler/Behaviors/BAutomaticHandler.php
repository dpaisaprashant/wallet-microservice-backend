<?php


namespace App\Wallet\DisputeHandler\Behaviors;


use App\Events\UserWalletPaymentEvent;
use App\Events\UserWalletUpdateEvent;
use App\Models\Dispute;
use App\Models\DisputeHandler;
use App\Models\UserLoadTransaction;
use App\Wallet\DisputeHandler\Interfaces\IDisputeHandler;

class BAutomaticHandler implements IDisputeHandler
{

    private $disputeId;

    private $vendorType;

    private $handler = 'AUTOMATIC';

    private $source;

    private $description;

    private $clearanceId;

    private $repostedStatus;




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
     * @return BAutomaticHandler
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param mixed $clearanceId
     * @return BAutomaticHandler
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
        ];
        DisputeHandler::create($disputeHandler);

        $status = Dispute::USER_DISPUTE_STATUS_PROCESSING;

        //update dispute
        $dispute = Dispute::with('disputeable')->find($this->disputeId);
        $dispute->source =  $this->source;
        $dispute->handler = $this->handler;
        $dispute->user_dispute_status = $status;
        $dispute->description = $this->description;
        $dispute->save();

        // decrease the wallet amount

        return $dispute;
    }

    public function acceptHandleStrategy()
    {
        $dispute = Dispute::with('disputeable', 'disputeHandler')->where('id', $this->disputeId)->first();

        $userId = $dispute->disputeable->user_id;
        $amount = $dispute->disputeHandler->reposted_amount ?? 0;

        //dd($dispute->disputeHandler->reposted_status, $dispute->disputeable['status']);

        if ($dispute->disputeable instanceof UserLoadTransaction) {
            if ($dispute->disputeHandler->reposted_status == 'SUCCESS' && $dispute->disputeable['status'] != 'COMPLETED') {
                event(new UserWalletUpdateEvent($userId, $amount));
            } elseif ($dispute->disputeHandler->reposted_status == 'ERROR' && $dispute->disputeable['status'] == 'COMPLETED') {
                event(new UserWalletPaymentEvent($userId, $amount));
            }
        } else {

            if ($dispute->disputeHandler->reposted_status == 'ERROR') {
                event(new UserWalletPaymentEvent($userId, $amount));
            }
        }



        $dispute->user_dispute_status = Dispute::USER_DISPUTE_STATUS_CLEARED;
        $dispute->save();

        return true;
    }

    public function rejectHandleStrategy()
    {
        $dispute = Dispute::with('disputeable', 'disputeHandler')->where('id', $this->disputeId)->first();
        $dispute->user_dispute_status = Dispute::USER_DISPUTE_STATUS_REJECTED;
        $dispute->save();

        return true;

    }




}
