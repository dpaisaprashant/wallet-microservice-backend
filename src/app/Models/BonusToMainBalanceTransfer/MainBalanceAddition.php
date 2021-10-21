<?php


namespace App\Models\BonusToMainBalanceTransfer;


use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class MainBalanceAddition extends Model
{
    use LogsActivity, BelongsToUser;

    protected $connection = "dpaisa";
    protected $table = "bonus_to_main_balance_fund_transfers";

    protected $guarded = ['id'];
    protected $fillable = [
        'user_id',
        'amount',
        'description',
        'created_at',
        'updated_at',
    ];

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Main Balance Addition';




}
