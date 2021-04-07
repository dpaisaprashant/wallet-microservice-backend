<?php

namespace App\Models\Merchant;

use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCashback;
use Illuminate\Database\Eloquent\Model;

class MerchantType extends Model
{

    public function merchants()
    {
        return $this->hasMany(Merchant::class, 'merchant_type_id');
    }

    public function walletTransactionTypeCashbacks()
    {
        return $this->morphMany(WalletTransactionTypeCashback::class, 'transactionCashbackable' , 'user_type', 'user_type_id');
    }
}
