<?php


namespace App\Wallet\Microservice\Cron;


use App\Models\Microservice\PreTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Wallet\Architecture\Builders\WalletTransactionTypeValidationBuilder;
use App\Wallet\Microservice\MicroserviceJSONAbstract;
use App\Wallet\Microservice\RequestInfoMicroservice;
use App\Wallet\Microservice\Response\DebitResponse;
use Illuminate\Support\Facades\Log;

class NchlAggregatedPaymentAddToTransactionEventCron
{
    use DebitResponse;

    public function __invoke()
    {
        $preTransactions = PreTransaction::where('microservice_type', 'NCHL')
            ->where('service_type', '!=' ,'BANK_TRANSFER')
            ->where('service_type', '!=' ,'NCHL_LOAD')
            ->latest()->take(15)->get();

        Log::info("nchl ap cron");

        foreach ($preTransactions as $preTransaction) {

            $user = User::where('id', $preTransaction->userId)->first();

            $microservice = new MicroserviceJSONAbstract();
            $microservice->setBaseUrl(config('microservices.' . 'NCHL'))
                ->setUrl("/wallet-transaction/aggregated-payment/get")
                ->addParam("pre_transaction_id", $preTransaction->pre_transaction_id);

            $response = json_decode($microservice->makeRequest(), true);

            if (isset($response['pre_transaction_status'])) {

                $preTransactionStatus = $response['pre_transaction_status'];

                if ($preTransactionStatus === "false" || $preTransactionStatus === false) {
                    continue;
                }

                $transactionEvent = TransactionEvent::where('pre_transaction_id', $preTransaction->pre_transaction_id)->first();
                if ($transactionEvent) {
                    continue;
                }

                Log::info("Transaction added: ", [$response]);
                $validator = new WalletTransactionTypeValidationBuilder($user, $preTransaction->amount);
                $walletTransactionType = $validator->nchlAggregatedPaymentValidation(request())->getWalletTransactionType();

                $response['transaction'] = $response;
                $this->handleDebitResponse(request(), $response, $walletTransactionType);
            }
        }
    }
}
