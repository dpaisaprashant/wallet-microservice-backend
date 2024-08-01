<?php


namespace App\Wallet\DisputeHandler\Resolver;


use App\Models\NchlBankTransfer;
use App\Models\NchlLoadTransaction;
use App\Models\UserLoadTransaction;
use App\Models\UserTransaction;
use App\Wallet\DisputeHandler\Dispute;
use \App\Models\Dispute as DisputeModel;

class DisputeTransactionTypeResolver
{
    private $dispute;
    private $transactionType;

    public function __construct(Dispute $dispute, $transactionType)
    {
        $this->dispute = $dispute;
        $this->transactionType = $transactionType;
    }

    public function resolve()
    {

        switch ($this->transactionType) {
            case 'nPay':
                $this->dispute->setTransactionType(UserLoadTransaction::class)
                    ->setVendorType(DisputeModel::VENDOR_TYPE_NPAY);
                break;
            case 'payPoint':
                $this->dispute->setTransactionType(UserTransaction::class)
                    ->setVendorType(DisputeModel::VENDOR_TYPE_PAYPOINT);
                break;
            case  'nchlLoadTransaction':
                $this->dispute->setTransactionType(NchlLoadTransaction::class)
                    ->setVendorType(DisputeModel::VENDOR_TYPE_NCHL_LOAD_TRANSACTION);
                break;
            case 'nchlBankTransfer':
                $this->dispute->setTransactionType(NchlBankTransfer::class)
                    ->setVendorType(DisputeModel::VENDOR_TYPE_NCHL_BANK_TRANSFER);
                break;
            default:
                dd('Transaction type not resolved');
        }
    }
}
