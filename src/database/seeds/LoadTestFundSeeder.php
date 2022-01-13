<?php

use App\Models\LoadTestFund;
use App\Models\Microservice\PreTransaction;
use App\Models\Wallet;
use App\Wallet\Helpers\TransactionIdGenerator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LoadTestFundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $load_test_funds = LoadTestFund::with('preTransaction')->get();
        foreach($load_test_funds as $load_test_fund){
//            $pre_transaction = PreTransaction::where('pre_transaction_id','=',$load_test_fund->pre_transaction_id)->first();
//            $currentBalance = Wallet::whereUserId($load_test_fund->user_id)->first()->balance * 100;
//            $currentBonusBalance = Wallet::whereUserId($load_test_fund->user_id)->first()->bonus_balance * 100;
            if (! $load_test_fund->preTransaction){
                $for_pre_transaction = [
                    'pre_transaction_id' => TransactionIdGenerator::generate(20),
                    'user_id' => $load_test_fund->user_id,
                    'amount' => ($load_test_fund->amount + $load_test_fund->bonus_amount)*100,
                    'description' => $load_test_fund->description,
                    'vendor' => 'WALLET',
                    'service_type' => 'REFUND',
                    'microservice_type' => 'WALLET',
                    'transaction_type' => PreTransaction::TRANSACTION_TYPE_CREDIT,
                    'url' => '/refund',
                    'status' => PreTransaction::STATUS_STARTED,
                    'before_balance' => $load_test_fund->before_amount,
                    'after_balance' => $load_test_fund->after_amount,
                    'before_bonus_balance' => $load_test_fund->before_bonus_balance,
                    'after_bonus_balance' => $load_test_fund->after_bonus_balance,
                    'special1' => $load_test_fund->pre_transaction_id,
                    'created_at' => $load_test_fund->created_at,
                ];
                DB::beginTransaction();
                try {
                    $self_pre_transaction = PreTransaction::create($for_pre_transaction);
                    if ($self_pre_transaction){
                        $self_pre_transaction->update([
                            'status' => PreTransaction::STATUS_SUCCESS
                        ]);
                    }
                    $update_self_pre_transaction_id = LoadTestFund::where('id','=',$load_test_fund->id)->update([
                      'self_pre_transaction_id' => $self_pre_transaction->pre_transaction_id
                    ]);
                    DB::commit();
                    Log::info('Seeding Successful', $for_pre_transaction);
                }catch (\Exception $e){
                    Log::info('Seeding Failed',$for_pre_transaction);
                }

            }
        }
    }
}
