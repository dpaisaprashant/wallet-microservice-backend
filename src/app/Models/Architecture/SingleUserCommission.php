<?php

namespace App\Models\Architecture;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SingleUserCommission extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Single user commission';

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

    public function userCommissionable()
    {
        return $this->morphTo('userCommissionable', 'user_type', 'user_id');
    }
}
