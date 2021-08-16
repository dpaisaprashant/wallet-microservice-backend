<?php

use App\Models\AgentType;
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

class UserTypeWalletTransactionTypePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $walletTransactionTypes = WalletTransactionType::all();
        foreach ($walletTransactionTypes as $walletTransactionType) {
            if ($walletTransactionType->user_type == User::class) {
                UserTypeWalletTransactionTypePermission::create([
                    'user_type' => UserType::class,
                    'user_type_id' => (new UserType())->getNormalUserTypeId(),
                    'wallet_transaction_type_id' => $walletTransactionType->id,
                ]);
            }

            if ($walletTransactionType->user_type == Merchant::class) {
                UserTypeWalletTransactionTypePermission::create([
                    'user_type' => MerchantType::class,
                    'user_type_id' => (new MerchantType())->getNormalUserTypeId(),
                    'wallet_transaction_type_id' => $walletTransactionType->id,
                ]);
            }
        }
    }
}
