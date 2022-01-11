<?php

namespace App\Models\Architecture;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class SingleUserCashback extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Single User Cashback';

    protected $connection = 'dpaisa';

    protected $guarded = [];

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

    public function userCashbackable()
    {
        return $this->morphTo('userCashbackable', 'user_type', 'user_id');
    }
}
