<?php

namespace App\Models\Architecture;

use Illuminate\Database\Eloquent\Model;

class SingleUserCommission extends Model
{
    protected $connection = 'dpaisa';

    protected $guarded = [];

    public function resolveCommissionBuilder($walletTransactionTypeId, $userId, $userType)
    {
        return $this->where('wallet_transaction_type_id', $walletTransactionTypeId)
            ->where('user_id', $userId)
            ->where('user_type', $userType);
    }

    public function getCurrentUserCommissionBuilder($userId, $userType)
    {
        return $this->where('user_id', $userId)
            ->where('user_type', $userType);
    }
}
