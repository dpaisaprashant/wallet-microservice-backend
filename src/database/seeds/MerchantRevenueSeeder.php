<?php

use App\Models\AgentType;
use App\Models\Architecture\SingleUserCommission;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCashback;
use App\Models\Architecture\WalletTransactionTypeCommission;
use App\Models\Architecture\WalletTransactionTypeMerchantRevenue;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantType;
use App\Models\Permission\UserTypeWalletTransactionTypePermission;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\Seeder;

class MerchantRevenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wallet_transaction_types = WalletTransactionType::where('vendor','=','PAYPOINT')->get();
        foreach ($wallet_transaction_types as $wallet_transaction_type){
            WalletTransactionTypeMerchantRevenue::create([
                'title'=>$wallet_transaction_type->vendor. " ". $wallet_transaction_type->service_type. " ".$wallet_transaction_type->service,
                'wallet_transaction_type_id'=>$wallet_transaction_type->id,
                'merchant_revenue_type'=>'PERCENTAGE',
                'merchant_revenue_value'=>100,
                'user_id'=>21,
            ]);
        }
    }
}
