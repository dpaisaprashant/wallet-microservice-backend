<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class DisputeTransaction extends Model
{

    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Dispute Transaction';

    protected $table = 'dispute_transactions';
    protected $connection = "dpaisa";

    const DISPUTE_STATUS_CLEARED = 'CLEARED';
    const DISPUTE_STATUS_DISPUTED = 'DISPUTED';
    const DISPUTE_STATUS_HANDLED = 'HANDLED';

    protected $fillable = [
        'dispute_id',
        'transaction_id',
        'transaction_type',
        'dispute_type',
        'description',
        'disputed_amount',
        'refund_amount',
        'cleared_clearance_id'
    ];


    public function dispute()
    {
        return $this->belongsTo(Dispute::class, 'dispute_id');
    }
}
