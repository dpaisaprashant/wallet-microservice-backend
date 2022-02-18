<?php

namespace App\Models\Architecture;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class WalletTransactionTypeCommission extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Wallet Transaction Type Commission';

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
    }

    public function transactionCommissionable()
    {
        return $this->morphTo('transactionCommissionable', 'user_type', 'user_type_id');
    }
}
