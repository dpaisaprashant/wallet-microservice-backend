<?php


namespace App\Wallet\DisputeHandler;


use App\Models\ClearanceTransaction;
use App\Models\DisputeHandler;
use App\Wallet\DisputeHandler\Behaviors\BNPayClearanceDisputeHandle;
use App\Wallet\DisputeHandler\Behaviors\BNpaySingleDisputeHandle;
use App\Wallet\DisputeHandler\Behaviors\BPPClearanceDisputeHandle;
use App\Wallet\DisputeHandler\Behaviors\BPPSingleDisputeHandle;
use App\Wallet\DisputeHandler\Resolver\TransactionTypeHandleDisputeResolver;
use Illuminate\Support\Facades\Log;
use App\Models\Dispute as DisputeModel;

class Dispute
{

    private $transactionID = [];

    private $transactionType;

    private $disputeId = null;

    private $disputeType; //single , clearance

    private $vendorType; //paypoint, npay

    private $vendorStatus;

    private $vendorAmount;

    private $clearanceId = null;

    private $userAmount = null;

    private $userStatus = null;

    private $source = null;

    private $handler = null;

    private $userDisputeStatus = 'STARTED';

    private $clearanceDisputeStatus = 'STARTED';

    private $repostedAmount = null;

    private $repostedStatus = null;

    private $repostedHandler = null;

    private $description = null;


    /**
     * @param array $transactionID
     * @return $this
     */
    public function setTransactionID(array $transactionID)
    {
        $this->transactionID = $transactionID;
        return $this;

    }


    /**
     * @param $transactionType
     * @return $this
     */
    public function setTransactionType($transactionType)
    {
        $this->transactionType = $transactionType;
        return $this;
    }


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
     * @param $disputeType
     * @return $this
     */
    public function setDisputeType($disputeType)
    {
        $this->disputeType = $disputeType;
        return $this;
    }


    /**
     * @param $vendorType
     * @return $this
     */
    public function setVendorType($vendorType)
    {
        $this->vendorType = $vendorType;
        return $this;
    }


    /**
     * @param $vendorStatus
     * @return $this
     */
    public function setVendorStatus($vendorStatus)
    {
        $this->vendorStatus = $vendorStatus;
        return $this;
    }


    /**
     * @param $vendorAmount
     * @return $this
     */
    public function setVendorAmount($vendorAmount)
    {
        $this->vendorAmount = $vendorAmount;
        return $this;
    }


    /**
     * @param $clearanceId
     * @return $this
     */
    public function setClearanceId($clearanceId)
    {
        $this->clearanceId = $clearanceId;
        return $this;
    }


    /**
     * @param $userAmount
     * @return $this
     */
    public function setUserAmount($userAmount)
    {
        $this->userAmount = $userAmount;
        return $this;
    }

    /**
     * @param $userStatus
     * @return $this
     */
    public function setUserStatus($userStatus)
    {
        $this->userStatus = $userStatus;
        return $this;
    }


    /**
     * @param $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;
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
     * @param string $userDisputeStatus
     * @return Dispute
     */
    public function setUserDisputeStatus(string $userDisputeStatus): Dispute
    {
        $this->userDisputeStatus = $userDisputeStatus;
        return $this;
    }

    /**
     * @param string $clearanceDisputeStatus
     * @return Dispute
     */
    public function setClearanceDisputeStatus(string $clearanceDisputeStatus): Dispute
    {
        $this->clearanceDisputeStatus = $clearanceDisputeStatus;
        return $this;
    }


    /**
     * @param $repostedAmount
     * @return $this
     */
    public function setRepostedAmount($repostedAmount)
    {
        $this->repostedAmount = $repostedAmount;
        return $this;
    }


    /**
     * @param $repostedStatus
     * @return $this
     */
    public function setRepostedStatus($repostedStatus)
    {
        $this->repostedStatus = $repostedStatus;
        return $this;
    }


    /**
     * @param $repostedHandler
     * @return $this
     */
    public function setRepostedHandler($repostedHandler)
    {
        $this->repostedHandler = $repostedHandler;
        return $this;
    }

    /**
     * @param null $description
     * @return Dispute
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function createDispute()
    {
        foreach ($this->transactionID as $transactionId)
        {
           $dispute = [
                'transaction_id' => $transactionId,
                'transaction_type' => $this->transactionType,
                'dispute_type' =>$this->disputeType ,
                'vendor_type' =>$this->vendorType ,
                'vendor_status' =>$this->vendorStatus ,
                'vendor_amount' => ($this->vendorAmount * 100) ?? 0,
                'clearance_id' =>$this->clearanceId ,
                'user_amount' =>$this->userAmount * 100 ,
                'user_status' =>$this->userStatus ,
                'source' =>$this->source ,
                //'handler' =>$this->handler ,
                'user_dispute_status' => $this->userDisputeStatus ?? 'STARTED',
                'clearance_dispute_status' => $this->clearanceDisputeStatus ?? 'STARTED',
                'reposted_amount' =>$this->repostedAmount ,
                'reposted_status' =>$this->repostedStatus ,
                'reposted_handler' =>$this->repostedHandler ,
                'admin_id' => auth()->user()->id,
                'created_at' => now(),
                'description' => $this->description
            ];

           //dd($dispute);

            try {
                \App\Models\Dispute::create($dispute);
            } catch (\Exception $e) {
                Log::info('Error while creating dispute');
                Log::error($e);

                return false;
            }
        }
        return true;
    }

    private function isPresentInDispute($transaction, $transactionType) {

        $dispute = \App\Models\Dispute::where('transaction_id', $transaction->id)->where('transaction_type', $transactionType)->first();

        if ($dispute) {
            $dispute->clearance_id = $this->clearanceId;
            $dispute->handler = \App\Models\Dispute::HANDLER_CLEARANCE;
            $dispute->save();

            return true;
        }
        return false;

    }

    public function createClearanceDispute($disputeTransactionList)
    {
        $disputes = [];
        $transactionType = '';
        $handler = false;
        if ($this->vendorType == \App\Models\Dispute::VENDOR_TYPE_NPAY) {
            $transactionType = 'App\Models\UserLoadTransaction';
            $handler = new BNPayClearanceDisputeHandle();
        } elseif($this->vendorType == \App\Models\Dispute::VENDOR_TYPE_PAYPOINT) {
            $transactionType = 'App\Models\UserTransaction';
            $handler = new BPPClearanceDisputeHandle();
        }

        //update clearance transaction table
        foreach ($disputeTransactionList as $key => $transaction) {
            ClearanceTransaction::where('clearance_id', $this->clearanceId)
                ->where('transaction_id', $transaction['id'])
                ->where('Transaction_type', $transactionType)
                ->update(['dispute_status' => 1]);
        }

        //create dispute
        foreach ($disputeTransactionList as $transaction) {

            if ($this->isPresentInDispute($transaction, $transactionType)) {
                continue;
            }

            array_push($disputes, [
                'transaction_id' => $transaction->id,
                'transaction_type' => $transactionType,
                'dispute_type' => $this->disputeType,
                'vendor_type' => $this->vendorType,
                'vendor_status' => $transaction->vendor_status,
                'vendor_amount' => $transaction->vendor_amount ?? 0,
                'clearance_id' =>$this->clearanceId ,
                'user_amount' =>$this->userAmount * 100 ,
                'user_status' =>$this->userStatus ,
                'source' =>$this->source ,
                'handler' => \App\Models\Dispute::HANDLER_CLEARANCE ,
                'user_dispute_status' => $this->userDisputeStatus ,
                'clearance_dispute_status' => $this->clearanceDisputeStatus,
                'reposted_amount' =>$this->repostedAmount ,
                'reposted_status' =>$this->repostedStatus ,
                'reposted_handler' =>$this->repostedHandler ,
                'admin_id' => auth()->user()->id,
                'created_at' => now(),
                'description' => $this->description

            ]);
        }

        if(\App\Models\Dispute::insert($disputes)){
            $handler->setClearanceId($this->clearanceId);
            return $handler->createDisputeHandler();
        }
        return false;
    }

    public function getDisputeDetail()
    {
        return DisputeModel::with('disputeable', 'disputeHandler')->where('id', $this->disputeId)->firstOrFail();
    }

    public function handleDispute()
    {
        //dd($this->description);
        $dispute = \App\Models\Dispute::where('id', $this->disputeId)->firstOrFail();

        if ($dispute->dispute_type == \App\Models\Dispute::DISPUTE_TYPE_SINGLE ) {

            $disputeHandler = (new TransactionTypeHandleDisputeResolver($dispute))->resolve();

            $disputeHandler->setDisputeId($this->disputeId)
                ->setHandler($this->handler)
                ->setSource($this->source)
                ->setDescription($this->description);

            return $disputeHandler->selectDisputeHandler();


        } elseif ($dispute->dispute_type == \App\Models\Dispute::DISPUTE_TYPE_CLEARANCE) {

            $disputeHandler = false;
            if ($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_NPAY)
            {
                $disputeHandler = new BNPayClearanceDisputeHandle();

            } elseif ($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_PAYPOINT)
            {
                $disputeHandler = new BPPClearanceDisputeHandle();
            }

            $disputeHandler->setDisputeId($this->disputeId)
                ->setHandler($this->handler)
                ->setVendorType($this->vendorType)
                ->setSource($this->source)
                ->setDescription($this->description)
                ->setClearedClearanceId($this->clearanceId);

            return $disputeHandler->selectDisputeHandler();

        }
        return false;
    }

    public function acceptHandleDispute()
    {
        $dispute = \App\Models\Dispute::where('id', $this->disputeId)->firstOrFail();

        $disputeHandler = false;

        if ($dispute->dispute_type == \App\Models\Dispute::DISPUTE_TYPE_CLEARANCE) {
            if ($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_NPAY)
            {
                $disputeHandler = new BNpayCLearanceDisputeHandle();

            } elseif ($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_PAYPOINT)
            {
                $disputeHandler = new BPPCLearanceDisputeHandle();
            }
            $disputeHandler->setDisputeId($this->disputeId)->setClearanceId($this->clearanceId);

        } else {
            if ($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_NPAY)
            {
                $disputeHandler = new BNpaySingleDisputeHandle();

            } elseif ($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_PAYPOINT)
            {
                $disputeHandler = new BPPSingleDisputeHandle();
            }
            $disputeHandler->setDisputeId($this->disputeId);

        }


        return $disputeHandler->acceptDisputeHandler();
    }

    public function rejectHandleDispute()
    {
        $dispute = \App\Models\Dispute::where('id', $this->disputeId)->firstOrFail();
        $disputeHandler = false;

        if ($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_NPAY)
        {
            $disputeHandler = new BNpaySingleDisputeHandle();

        } elseif ($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_PAYPOINT)
        {
            $disputeHandler = new BPPSingleDisputeHandle();
        }

        $disputeHandler->setDisputeId($this->disputeId);
        return $disputeHandler->rejectDisputeHandler();

    }

    public function clearanceHandleDispute()
    {

        $dispute = \App\Models\Dispute::where('id', $this->disputeId)->firstOrFail();
        $disputeHandler = false;
        if ($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_NPAY)
        {
            $disputeHandler = new BNPayClearanceDisputeHandle();

        } elseif ($dispute->vendor_type == \App\Models\Dispute::VENDOR_TYPE_PAYPOINT)
        {
            $disputeHandler = new BPPClearanceDisputeHandle();
        }



        try {
            DisputeHandler::where('dispute_id', $this->disputeId)->update(['cleared_clearance_id' => $this->clearanceId]);
            \App\Models\Dispute::where('id', $this->disputeId)->update(['status' => \App\Models\Dispute::STATUS_CLEARED_CLEARANCE]);

            return true;
        } catch (\Exception $e) {
            dd($e);
        }
        return false;


    }




}
