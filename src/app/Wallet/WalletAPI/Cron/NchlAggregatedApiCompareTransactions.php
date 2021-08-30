<?php


namespace App\Wallet\WalletAPI\Cron;

use App\Wallet\NCHL\Repository\NchlAggregatedPaymentRepository;
use App\Wallet\WalletAPI\Repositories\NchlAggregatedApiValidationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Wallet\WalletAPI\Http\Controllers\NchlControllers;

class NchlAggregatedApiCompareTransactions
{

    public function __invoke()
    {
        $repo = new NchlAggregatedPaymentRepository(request());

        $repository = new NchlAggregatedApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions(request(), $repo);

        foreach ($disputedTransactions['wallet_success_mismatches'] as $disputedTransaction) {
            //notify developers
            $data = [
                'Transaction in which status is success in Wallet but not in API',
                'Pre-Transaction ID' => $disputedTransaction->pre_transaction_id,
                'Batch ID' => $disputedTransaction->transaction_id
            ];
            $val = json_encode($data);
            Log::info($val . PHP_EOL);
        }
        foreach ($disputedTransactions['nchl_success_mismatches'] as $disputedTransaction) {
            //notify developers
            if (!empty($disputedTransaction->transaction_id)) {

                $data = [
                    'Transaction in which status is success in API but not in Wallet',
                    'Pre-Transaction ID' => $disputedTransaction->pre_transaction_id,
                    'Batch ID' => $disputedTransaction->transaction_id
                ];
                $val = json_encode($data);
                Log::info($val . PHP_EOL);
            }
        }

    }
}
