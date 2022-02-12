<?php

namespace App\Models\Architecture;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class WalletService extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Wallet Service';

    protected $connection = 'dpaisa';
    protected $guarded = [];
    protected $table = 'wallet_services';

    public function walletTransactionType()
    {
        return $this->belongsTo(WalletTransactionType::class);
    }
}
