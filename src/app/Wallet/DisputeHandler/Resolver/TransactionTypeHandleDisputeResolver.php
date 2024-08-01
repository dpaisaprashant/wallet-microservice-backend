<?php


namespace App\Wallet\DisputeHandler\Resolver;


use App\Models\Dispute;
use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Wallet\DisputeHandler\Behaviors\BNchlBankTransferDisputeHandler;
use App\Wallet\DisputeHandler\Behaviors\BNchlLoadTransactionDisputeHandler;
use App\Wallet\DisputeHandler\Behaviors\BNpaySingleDisputeHandle;
use App\Wallet\DisputeHandler\Behaviors\BPPSingleDisputeHandle;

class TransactionTypeHandleDisputeResolver
{
    private $dispute;

    public function __construct(Dispute $dispute)
    {
        $this->dispute = $dispute;
    }

    public function resolve()
    {
        switch ($this->dispute['vendor_type']) {
            case Dispute::VENDOR_TYPE_NPAY:
                return new BNpaySingleDisputeHandle();
                break;
            case Dispute::VENDOR_TYPE_PAYPOINT:
                return new BPPSingleDisputeHandle();
                break;
            case  Dispute::VENDOR_TYPE_NCHL_LOAD_TRANSACTION:
                return new BNchlLoadTransactionDisputeHandler();
                break;
            case Dispute::VENDOR_TYPE_NCHL_BANK_TRANSFER:
                return new BNchlBankTransferDisputeHandler();
                break;
            default:
               return false;
        }
    }

}
