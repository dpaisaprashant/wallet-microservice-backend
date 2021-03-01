<?php


namespace App\Wallet\DisputeHandler\Behaviors;

use App\Models\Clearance;
use App\Models\ClearanceTransaction;
use App\Models\Dispute;
use App\Models\DisputeHandler;
use App\Models\PaypointToDpaisaTransaction;
use App\Wallet\DisputeHandler\Interfaces\IHandleDispute;
use Illuminate\Support\Facades\Log;

class BPPClearanceDisputeHandle implements IHandleDispute
{

    private $disputeId;

    private $handler; //reimburse, deduction, clearance

    private $vendorType;

    private $source;

    private $description;

    private $clearanceId;

    private $clearedClearanceId;

    /**
     * @param mixed $disputeId
     * @return BPPClearanceDisputeHandle
     */
    public function setDisputeId($disputeId)
    {
        $this->disputeId = $disputeId;
        return $this;
    }

    /**
     * @param mixed $handler
     * @return BPPClearanceDisputeHandle
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * @param mixed $vendorType
     * @return BPPClearanceDisputeHandle
     */
    public function setVendorType($vendorType)
    {
        $this->vendorType = $vendorType;
        return $this;
    }

    /**
     * @param mixed $source
     * @return BPPClearanceDisputeHandle
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @param mixed $description
     * @return BPPClearanceDisputeHandle
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @param mixed $clearanceId
     * @return BPPClearanceDisputeHandle
     */
    public function setClearanceId($clearanceId)
    {
        $this->clearanceId = $clearanceId;
        return $this;
    }

    /**
     * @param mixed $clearedClearanceId
     * @return BPPClearanceDisputeHandle
     */
    public function setClearedClearanceId($clearedClearanceId)
    {
        $this->clearedClearanceId = $clearedClearanceId;
        return $this;
    }

    public function selectDisputeHandler()
    {
        if ($this->handler == \App\Models\Dispute::HANDLER_MANUAL_REIMBURSE)
        {
            $handle = new BReimburseHandler();

        } elseif ($this->handler == \App\Models\Dispute::HANDLER_MANUAL_DEDUCTION)
        {
            $handle = new BDeductionHandler();

        } elseif ($this->handler == \App\Models\Dispute::HANDLER_AUTOMATIC)
        {
            $handle = new BAutomaticHandler();

        }  else
        {
            $handle = new BDoNothingHandler();
        }

        $handle->setDisputeId($this->disputeId)
            ->setVendorType($this->vendorType)
            ->setSource($this->source)
            ->setHandler($this->handler)
            ->setClearanceId($this->clearedClearanceId);

        $strategy =  $handle->handlerStrategy();
        //$this->updateClearanceStatus($this->disputeId);
        return $strategy;
    }

    public function updateClearanceStatus($disputeId)
    {
        $dispute = Dispute::where('id', $disputeId)->first();

        $transactionType = 'App\Models\UserTransaction';

        ClearanceTransaction::where('transaction_id', $dispute->transaction_id)
            ->where('transaction_type', $transactionType)
            ->update(['dispute_status' => null]);

        if (ClearanceTransaction::where('clearance_id', $dispute->clearance_id)->where('dispute_status', 1)->count() === 0) {
            Clearance::where('id', $dispute->clearance_id)->update(['clearance_status' => 0] , ['dispute_status' => null]);
        }
    }

    public function createDisputeHandler()
    {
        $clearanceDisputes = Dispute::with('disputeable')->where('clearance_id', $this->clearanceId)->get();
        $disputes = [];

        foreach ($clearanceDisputes as $key => $value) {
            Log::info("Clearance Id: ". $this->clearanceId);
            $excelTransaction = PaypointToDpaisaTransaction::where('clearance_id', $this->clearanceId)
                ->where('refStan', $value->disputeable->refStan)
                ->first();

            if (empty($excelTransaction)) return false;
            Log::info($excelTransaction);




            array_push($disputes, [
                'admin_id' =>  auth()->user()->id,
                'dispute_id' => $value->id,
                'handler' => Dispute::HANDLER_CLEARANCE,
                'reposted_clearance_status' => $excelTransaction['status'],
                'reposted_clearance_amount' => (double) str_replace(',','',$excelTransaction['amount']),
                'reposted_clearance_ref_no' => $excelTransaction['refStan']
            ]);

        }

        $handlers = DisputeHandler::insert($disputes);
        Dispute::with('disputeable')->where('clearance_id', $this->clearanceId)
            ->update(['clearance_dispute_status' => Dispute::CLEARANCE_DISPUTE_STATUS_PROCESSING]);

        if ($handlers) {
            return true;
        }
        return false;
    }

    public function acceptDisputeHandler()
    {
        $handle = new BClearanceHandler();
        $handle->setDisputeId($this->disputeId)->setClearanceId($this->clearanceId);

        if ($handle->acceptHandleStrategy()) {
            $this->updateClearanceStatus($this->disputeId);
            return true;
        }
        return false;
    }




}
