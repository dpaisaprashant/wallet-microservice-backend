<?php

namespace App\Models\Architecture;

use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class WalletTransactionTypeMerchantRevenue extends Model
{
    use LogsActivity, BelongsToUser;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Wallet Transaction Type Merchant Revenue';

    protected $connection = 'dpaisa';
    protected $table = 'wallet_transaction_type_merchant_revenues';

    protected $guarded = [];
    protected $fillable = [];

}
