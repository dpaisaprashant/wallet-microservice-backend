<?php


namespace App\Wallet\WalletAPI\Cron;

use App\Wallet\NCHL\Repository\NchlBankTransferRepository;
use App\Wallet\WalletAPI\Repositories\NchlApiValidationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Wallet\WalletAPI\Http\Controllers\NCHLController;

class NchlApiCompareTransactions
{

    public function __invoke()
    {
        $repo = new NchlBankTransferRepository(request());

        $repository = new NchlApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions(request(), $repo);

        foreach($disputedTransactions['wallet_status_mismatches'] as $disputedTransaction){
            //notify developers
            Log::info("Transaction in which status is success in wallet but not in API: PreTransactionID =", [$disputedTransaction->pre_transaction_id]);
            Log::info("BatchID =", [$disputedTransaction->transaction_id]);
        }
        foreach($disputedTransactions['nchl_status_mismatches'] as $disputedTransaction){
            //notify developers
            if(!empty($disputedTransaction->transaction_id)){
                Log::info("Transaction in which status is success in API but not in Wallet: BatchID =", [$disputedTransaction->transaction_id]);
            }
        }

    }
}
