<?php


namespace App\Wallet\WalletAPI\Cron;

use App\Wallet\PayPoint\Repository\PayPointRepository;
use App\Wallet\WalletAPI\Repositories\PaypointApiValidationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Wallet\WalletAPI\Http\Controllers\NchlControllers;

class PaypointApiCompareTransactions
{

    public function __invoke()
    {
        $repo = new PayPointRepository(request());

        $repository = new PaypointApiValidationRepository();
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
