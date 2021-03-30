<?php

namespace App\Models\Architecture;

use Illuminate\Database\Eloquent\Model;

class SingleUserCashback extends Model
{
    protected $connection = 'dpaisa';

    public function resolveCashbackBuilder($walletTransactionTypeId, $userId, $userType)
    {
        return $this->where('wallet_transaction_type_id', $walletTransactionTypeId)
            ->where('user_id', $userId)
            ->where('user_type', $userType);
    }

    public function getCurrentUserCashbackBuilder($userId, $userType)
    {
        return $this->where('user_id', $userId)
            ->where('user_type', $userType);
    }
}
