<?php


namespace App\Wallet\WalletAPI\Cron;

use App\Wallet\PayPoint\Repository\PayPointRepository;
use App\Wallet\WalletAPI\Repositories\PaypointApiValidationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Wallet\WalletAPI\Http\Controllers\NchlControllers;
use App\Models\DisputedApiTransaction;

class PaypointApiCompareTransactions
{

    public function __invoke()
    {
        $repo = new PayPointRepository(request());

        $repository = new PaypointApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions(request(), $repo);

        try {
            $this->create();
            $this->update();
            Log::info('Successfully added to disputed_api_transactions table');
        } catch (\Exception $e) {
            Log::info('Adding to disputed_api_transactions table failed');
        }

        if (!empty($disputedTransactions['wallet_success_mismatches'])) {
            foreach ($disputedTransactions['wallet_success_mismatches'] as $disputedTransaction) {
                //notify developers
                $data = [
                    'Transaction in which status is success in Wallet but not in API',
                    'Pre-Transaction ID' => $disputedTransaction->pre_transaction_id,
                    'RefStan' => $disputedTransaction->refStan
                ];
                $val = json_encode($data);
                Log::info($val . PHP_EOL);
            }
        }

        if(!empty($disputedTransactions['paypoint_success_mismatches'])) {
            foreach ($disputedTransactions['paypoint_success_mismatches'] as $disputedTransaction) {
                //notify developers
                if (!empty($disputedTransaction->transaction_id)) {

                    $data = [
                        'Transaction in which status is success in Wallet but not in API',
                        'Pre-Transaction ID' => $disputedTransaction->pre_transaction_id,
                        'RefStan' => $disputedTransaction->refStan
                    ];
                    $val = json_encode($data);
                    Log::info($val . PHP_EOL);
                }
            }
        }
    }

    public function create()
    {
        $repo = new PayPointRepository(request());

        $repository = new PaypointApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions(request(), $repo);
        Log::info('===================================================================Adding into disputed_api_transactions Table======================================================');
        Log::info('tessasdasd',[$disputedTransactions['wallet_status_mismatches']]);
        foreach ($disputedTransactions['wallet_status_mismatches'] as $disputedTransaction) {
            DisputedApiTransaction::firstOrCreate([
                'pre_transaction_id' => $disputedTransaction->pre_transaction_id,
                'ref_stan' => $disputedTransaction->refStan,
            ]);
        }
    }

    public function update()
    {
        $repo = new PayPointRepository(request());

        $repository = new PaypointApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions(request(), $repo);

        foreach ($disputedTransactions['wallet_status_mismatches_api'] as $disputedTransaction) {
            $jsonResponse = json_encode($disputedTransaction);
            DisputedApiTransaction::where('ref_stan','=',$disputedTransaction['RefStan'])->update([
                'api_response' => $jsonResponse,
            ]);
        }
    }
}
