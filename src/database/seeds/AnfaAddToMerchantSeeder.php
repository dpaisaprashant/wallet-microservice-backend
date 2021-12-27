<?php

use App\Models\Admin;
use App\Models\MerchantRevenueRecord;
use App\Models\Microservice\PreTransaction;
use App\Models\TicketSale;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserKYC;
use App\Models\UserKYCValidation;
use App\Wallet\Helpers\TransactionIdGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AnfaAddToMerchantSeeder extends Seeder
{

    public function run()
    {
        $ticketTransactions = TransactionEvent::with('user')
            ->where('transaction_type', TicketSale::class)
            ->get();

        $merchantUser = User::where('mobile_no', '')
            ->first();

        foreach ($ticketTransactions as $ticketTransaction) {

            //check if revenue transaction exists
            $oldRevenue = MerchantRevenueRecord::where('user_transaction_event_id', $ticketTransaction->id)
                ->first();

            if ($oldRevenue) {
                Log::info("Revenue already exists for " . $ticketTransaction->pre_transaction_id);
                continue;
            }


            $currentBalance = $merchantUser->wallet()->first();

            //crate pre transaction
            $preTransaction = [
                'amount' => $amount = $ticketTransaction->getOriginal('amount'),
                'pre_transaction_id' => TransactionIdGenerator::generate(19),
                'description' => 'Merchant Revenue Added from TICKETING for ' . $ticketTransaction->pre_transaction_id,
                'vendor' => 'Wallet',
                'service_type' => 'Merchant Revenue payment',
                'microservice_type' => 'WALLET',
                'transaction_type' => 'credit',
                'url' => '/merchantRevenuePayment',
                'status' => 'SUCCESS',
                'user_id' => $merchantUser->id
            ];

            $preTransaction = PreTransaction::create($preTransaction);


            //create merchant revenue
            $merchantRevenue = [
                'user_transaction_event_id' => $ticketTransaction->id,
                'user_id' => $merchantUser->id,
                'pre_transaction_id' => $preTransaction->pre_transaction_id,
                'amount' => $amount,
                'description' => 'merchant revenue'
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
                'user_id' => $merchantUser->user_id,
                'transaction_id' => $merchantRevenue->id,
                'transaction_type' => MerchantRevenueRecord::class,
                'uid' => TransactionIdGenerator::generateAlphaNumeric(8),
                'balance' => $currentBalance->getOriginal('balance'),
                'bonus_balance' => $currentBalance->getOriginal('bonus_balance'),
            ];

            $transactionEvent = TransactionEvent::create($transactionEvent);
        }
    }
}
