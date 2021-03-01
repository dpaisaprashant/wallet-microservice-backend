<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DisputeHandler extends Model
{

    use LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'Dispute Handler';

    protected $table = 'dispute_handlers';
    protected $connection = 'dpaisa';

    CONST HANDLER_AUTOMATIC = 'AUTOMATIC';
    CONST HANDLER_MANUAL_REIMBURSE = 'MANUAL_REIMBURSE';
    CONST HANDLER_MANUAL_DEDUCTION = 'MANUAL_DEDUCTION';
    CONST HANDLER_CLEARANCE = 'CLEARANCE';

    protected $fillable = [
        'admin_id',
        'dispute_id',
        'handler',
        'reposted_status',
        'reposted_amount',
        'reposted_ref_no',
        'reposted_handler',
        'cleared_clearance_id',
        'reposted_clearance_status',
        'reposted_clearance_amount',
        'reposted_clearance_ref_no'
    ];

    /**
     * @param $amount
     * @return float|int
     */
    public function getRepostedAmountAttribute($amount)
    {
        return ($amount/100);
    }

    /**
     * @param $amount
     * @return float|int
     */
    public function getRepostedClearanceAmountAttribute($amount)
    {
        return ($amount/100);
    }

    public function dispute()
    {
        return $this->belongsTo(Dispute::class, 'dispute_id');
    }

    public function clearedClearance()
    {
        return $this->belongsTo(Clearance::class, 'cleared_clearance_id');
    }
}
