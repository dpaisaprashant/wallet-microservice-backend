<?php

namespace App\Models;

use App\Filters\Dispute\DisputeFilters;
use App\Filters\User\UserFilters;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Builder;

class Dispute extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Dispute';

    protected $table = 'disputes';
    protected $connection = "dpaisa";

    CONST DISPUTE_TYPE_CLEARANCE = 'CLEARANCE';
    CONST DISPUTE_TYPE_SINGLE = 'SINGLE';

    CONST VENDOR_TYPE_NPAY = 'NPAY';
    CONST VENDOR_TYPE_PAYPOINT = 'PAYPOINT';
    CONST VENDOR_TYPE_NCHL_BANK_TRANSFER = 'NCHL_BANK_TRANSFER';
    CONST VENDOR_TYPE_NCHL_LOAD_TRANSACTION = 'NCHL_LOAD_TRANSACTION';

    CONST SOURCE_SAJILOPAY = 'SAJILOPAY';
    CONST SOURCE_NPAY = 'NPAY';
    CONST SOURCE_PAYPOINT = 'PAYPOINT';

    CONST HANDLER_AUTOMATIC = 'AUTOMATIC';
    CONST HANDLER_MANUAL_REIMBURSE = 'MANUAL_REIMBURSE';
    CONST HANDLER_MANUAL_DEDUCTION = 'MANUAL_DEDUCTION';
    CONST HANDLER_CLEARANCE = 'CLEARANCE';
    CONST HANDLER_DO_NOTHING = 'DO_NOTHING';

    CONST USER_DISPUTE_STATUS_STARTED = 'STARTED';
    CONST USER_DISPUTE_STATUS_PROCESSING = 'PROCESSING';
    CONST USER_DISPUTE_STATUS_CLEARED = 'CLEARED';
    CONST USER_DISPUTE_STATUS_REPOSTED = 'REPOSTED';
    CONST USER_DISPUTE_STATUS_REJECTED = 'REJECTED';

    CONST CLEARANCE_DISPUTE_STATUS_STARTED = 'STARTED';
    CONST CLEARANCE_DISPUTE_STATUS_PROCESSING = 'PROCESSING';
    CONST CLEARANCE_DISPUTE_STATUS_CLEARED = 'CLEARED';

    CONST REPOSTED_HANDLER_DEDUCTION = 'DEDUCTION';
    CONST REPOSTED_HANDLER_REIMBURSE = 'REIMBURSE';

    protected $fillable = [
        'transaction_id',
        'transaction_type',
        'dispute_type',
        'vendor_type',
        'vendor_status',
        'vendor_amount',
        'clearance_id',
        'user_amount',
        'user_status',
        'source',
        'handler',
        'user_dispute_status',
        'clearance_dispute_status',
        'reposted_amount',
        'reposted_status',
        'reposted_ref_no',
        'reposted_handler',
        'description',
        'admin_id'
    ];

    /**
     * @param $amount
     * @return float|int
     */
    public function getVendorAmountAttribute($amount)
    {
        return ($amount /100);
    }

    /**
     * @param $amount
     * @return float|int
     */
    public function getUserAmountAttribute($amount)
    {
        return ($amount/100);
    }

    /**
     * @param $amount
     * @return float|int
     */
    public function getRepostedAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new DisputeFilters($request))->add($filters)->filter($builder);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function disputeHandler()
    {
        return $this->hasOne(DisputeHandler::class, 'dispute_id');
    }

    public function disputeHandlers()
    {
        return $this->hasMany(DisputeHandler::class, 'dispute_id');
    }


    public function clearance()
    {
        return $this->belongsTo(Clearance::class, 'clearance_id');
    }

    public function disputeable()
    {
        return $this->morphTo('disputeable', 'transaction_type', 'transaction_id');
    }

    public function disputeTransaction()
    {
        return $this->hasOne(DisputeTransaction::class, 'dispute_id');
    }




}
