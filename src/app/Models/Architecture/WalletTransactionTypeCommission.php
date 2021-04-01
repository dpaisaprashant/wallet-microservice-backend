<?php

namespace App\Models\Architecture;

use Illuminate\Database\Eloquent\Model;

class WalletTransactionTypeCommission extends Model
{
    protected $connection = 'dpaisa';

    protected $guarded = [];

    public function resolveCommissionBuilder($walletTransactionTypeId, $userTypeId, $userType)
    {
        return $this->where('wallet_transaction_type_id', $walletTransactionTypeId)
            ->where('user_type_id', $userTypeId)
            ->where('user_type', $userType);
    }

    public function getCurrentUserCommissionBuilder($userTypeId, $userType)
    {
        return $this->where('user_type_id', $userTypeId)
            ->where('user_type', $userType);
    }}
