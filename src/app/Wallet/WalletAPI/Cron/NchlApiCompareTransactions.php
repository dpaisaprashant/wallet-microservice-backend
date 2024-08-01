<?php


namespace App\Wallet\WalletAPI\Cron;

use App\Wallet\NCHL\Repository\NchlBankTransferRepository;
use App\Wallet\WalletAPI\Repositories\NchlApiValidationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Wallet\WalletAPI\Http\Controllers\NchlControllers;
use App\Models\DisputedApiTransaction;

class NchlApiCompareTransactions
{

    public function __invoke()
    {
        $repo = new NchlBankTransferRepository(request());

        $repository = new NchlApiValidationRepository();
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
                    'Batch ID' => $disputedTransaction->transaction_id
                ];
                $val = json_encode($data);
                Log::info($val . PHP_EOL);
            }
        }

        if (!empty($disputedTransactions['nchl_success_mismatches'])) {
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

    public function create()
    {
        $repo = new NchlBankTransferRepository(request());

        $repository = new NchlApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions(request(), $repo);
        Log::info('===================================================================Adding into disputed_api_transactions Table======================================================');
        foreach ($disputedTransactions['wallet_status_mismatches'] as $disputedTransaction) {
            DisputedApiTransaction::firstOrCreate([
                'pre_transaction_id' => $disputedTransaction->pre_transaction_id,
                'transaction_id' => $disputedTransaction->transaction_id,
            ]);
        }
    }

    public function update()
    {
        $repo = new NchlBankTransferRepository(request());

        $repository = new NchlApiValidationRepository();
        $disputedTransactions = $repository->getDisputedTransactions(request(), $repo);

        foreach ($disputedTransactions['wallet_status_mismatches_api'] as $disputedTransaction) {
            $jsonResponse = json_encode($disputedTransaction);
            DisputedApiTransaction::where('transaction_id','=',$disputedTransaction['cipsBatchDetail']['batchId'])->update([
                'api_response' => $jsonResponse,
            ]);
        }
    }

}
