<?php

namespace App\Models\Merchant;

use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCashback;
use Illuminate\Database\Eloquent\Model;

class MerchantType extends Model
{
    protected $connection = 'dpaisa';

    CONST TYPE_NORMAL = 'normal';

    protected $fillable = ['name'];

    public function merchants()
    {
        return $this->hasMany(Merchant::class, 'merchant_type_id');
    }

    public function walletTransactionTypeCashbacks()
    {
        return $this->morphMany(WalletTransactionTypeCashback::class, 'transactionCashbackable' , 'user_type', 'user_type_id');
    }

    public function getNormalUserTypeId()
    {
        $userType = $this->where('name', self::TYPE_NORMAL)->first();
        if (empty($userType)) {
            $userType = $this->create(['name' => self::TYPE_NORMAL]);
        }
        return $userType->id;
    }
}
