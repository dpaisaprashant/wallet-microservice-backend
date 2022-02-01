<?php

use App\Models\Admin;
use App\Models\EventTicketSale;
use App\Models\MerchantRevenueRecord;
use App\Models\Microservice\PreTransaction;
use App\Models\TicketSale;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserKYC;
use App\Models\UserKYCValidation;
use App\Models\Wallet;
use App\Wallet\Helpers\TransactionIdGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EventTicketSalesAddToMerchantSeeder extends Seeder
{

    public function run()
    {
        dd("not enabled");
        $ticketTransactions = TransactionEvent::with('user')
            ->where('transaction_type', EventTicketSale::class)
            ->get();

        $merchantUser = User::where('mobile_no', '9801919659')
            ->first();

        $createdAtDate = Illuminate\Support\Carbon::now()->subSeconds(180);

        foreach ($ticketTransactions as $ticketTransaction) {

            //check if revenue transaction exists
            $oldRevenue = MerchantRevenueRecord::where('user_transaction_event_id', $ticketTransaction->id)
                ->first();

            if ($oldRevenue) {
                Log::info("Revenue already exists for " . $ticketTransaction->pre_transaction_id);
                continue;
            }

            $createdAt = $createdAtDate->format("Y-m-d H:i:s");

            $currentBalance = $merchantUser->wallet()->first();
            $amount = $ticketTransaction->amount * 100;

            //crate pre transaction
            $preTransaction = [
                'amount' => $amount,
                'pre_transaction_id' => TransactionIdGenerator::generate(19),
                'description' => 'Merchant Revenue Added from EVENT_TICKETING for ' . $ticketTransaction->pre_transaction_id,
                'vendor' => 'Wallet',
                'service_type' => 'Merchant Revenue payment',
                'microservice_type' => 'WALLET',
                'transaction_type' => 'credit',
                'url' => '/merchantRevenuePayment',
                'status' => 'SUCCESS',
                'user_id' => $merchantUser->id,
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ];

            $preTransaction = PreTransaction::create($preTransaction);


            //create merchant revenue
            $merchantRevenue = [
                'user_transaction_event_id' => $ticketTransaction->id,
                'user_id' => $merchantUser->id,
                'pre_transaction_id' => $preTransaction->pre_transaction_id,
                'amount' => $amount,
                'description' => 'merchant revenue',
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ];

            $merchantRevenue = MerchantRevenueRecord::create($merchantRevenue);

            //create transaction event
            $transactionEvent = [
                'pre_transaction_id' => $preTransaction->pre_transaction_id,
                'amount' => $amount,
                'account' => $merchantUser->mobile_no,
                'description' => 'Merchant Revenue',
                'vendor' => 'REVENUE',
                'service_type' => $ticketTransaction->service_type,
                'user_id' => $merchantUser->id,
                'transaction_id' => $merchantRevenue->id,
                'transaction_type' => MerchantRevenueRecord::class,
                'uid' => TransactionIdGenerator::generateAlphaNumeric(8),
                'balance' => ($currentBalance->balance * 100) + $amount,
                'bonus_balance' => $currentBalance->bonus_balance * 100,
                'created_at' => $createdAt,
                'updated_at' => $createdAt
            ];

            $transactionEvent = TransactionEvent::create($transactionEvent);
            Wallet::where('user_id', $merchantUser->id)->increment('balance', $amount);

            $createdAtDate = $createdAtDate->addSeconds(2);
        }
    }
}
