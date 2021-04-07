<?php

namespace App\Models;

use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCashback;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $guarded = [];

    CONST TYPE_NORMAL = 'normal';

    public function users()
    {
        return $this->hasMany(User::class, 'user_type_id');
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
