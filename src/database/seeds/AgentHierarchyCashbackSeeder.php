<?php

use App\Models\AgentType;
use App\Models\Architecture\AgentTypeHierarchyCashback;
use App\Models\Architecture\SingleUserCommission;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCashback;
use App\Models\Architecture\WalletTransactionTypeCommission;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantType;
use App\Models\Permission\UserTypeWalletTransactionTypePermission;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class AgentHierarchyCashbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add cashback for agent types that do not exist

        $agentTypes = AgentType::get();
        $walletTransactionTypes = WalletTransactionType::get();

        foreach ($agentTypes as $agentType) {

            $allParentAgentTypesList = $agentType->getAllParentAgentTypes();


            foreach ($walletTransactionTypes as $walletTransactionType) {

                $title = null;
                $cashbacks = WalletTransactionTypeCashback::where('wallet_transaction_type_id', $walletTransactionType->id)->get();
                foreach ($cashbacks as $cashback) {
                    if (isset($cashback->title)) {
                        Log::info("cashback has title", [$cashback]);
                        $title = $cashback->title;
                        break;
                    }
                }


                AgentTypeHierarchyCashback::updateOrCreate([
                    'agent_type_id' => $agentType->id,
                    'parent_agent_type_id' => null,
                    'wallet_transaction_type_id' => $walletTransactionType->id
                ], ['title' => $title]);

                foreach ($allParentAgentTypesList as $parentAgentType) {
                    AgentTypeHierarchyCashback::updateOrCreate([
                        'agent_type_id' => $agentType->id,
                        'parent_agent_type_id' => $parentAgentType->id,
                        'wallet_transaction_type_id' => $walletTransactionType->id
                    ], ['title' => $title]);
                }
            }
        }
    }
}
