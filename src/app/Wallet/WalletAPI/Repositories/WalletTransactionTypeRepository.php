<?php


namespace App\Wallet\WalletAPI\Repositories;


use App\Models\Architecture\WalletTransactionType;

class WalletTransactionTypeRepository
{
    public function nchlBankTransferTransactionType()
    {
        return WalletTransactionType::where('vendor', 'NCHL')
            ->where('transaction_category', 'BANK_TRANSFER')
            ->where('service_type', 'NCHL_BANK_TRANSFER')
            ->where('service', null)
            ->first();
    }

    public function cybersourceCardLoadTransactionType()
    {
        return WalletTransactionType::where('vendor', 'CYBERSOURCE')
            ->where('transaction_category', 'LOAD')
            ->where('service_type', null)
            ->where('service', null)
            ->first();
    }

    public function paymentNepalCardLoadTransactionType()
    {
        return WalletTransactionType::where('vendor', 'PAYMENT_NEPAL')
            ->where('transaction_category', 'LOAD')
            ->where('service_type', null)
            ->where('service', null)
            ->first();
    }

    public function bankTransferIds()
    {
        return WalletTransactionType::where('transaction_category', 'BANK_TRANSFER')
            ->pluck('id')
            ->toArray();
    }
}
