<?php

namespace App\Wallet\WalletAPI;



use App\Wallet\Helpers\TransactionIdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NeaSettlementAPIMicroservice
{
    private Request $request;
    public function processBankTransferRequest($nea_settlement)
    {
        $this->request = request();
        $microservice = new BackendWalletAPIMicroservice($this->request);
        $microservice->setServiceType("BANK_TRANSFER")
            ->setDescription("bank transfer")
            ->setVendor("NCHL BANK TRANSFER")
            ->setMicroservice("NCHL")
            ->setUrl("/api/microservice/nchl/process-bank-transfer")
            ->setRequestId($nea_settlement['pre_transaction_id'])
            ->setRequestParam([
                "amount" => $nea_settlement['transaction_sum'],
                "bank_id" => $nea_settlement['bank_code'],
                "account_name" => $nea_settlement['bank_account_name'],
                "account_number" => $nea_settlement['bank_account_number'],
                "branch_id" => $nea_settlement['branch_id'] ?? null,
                "bank_name" => $nea_settlement['bank_name'],
                "branch_name" => $nea_settlement['branch_name'] ?? null,
                "account_id" => $nea_settlement['account_id'] ?? null,
                "pre_transaction_id" => $nea_settlement['pre_transaction_id']
            ]);

        return $microservice->processRequest();
    }
}
