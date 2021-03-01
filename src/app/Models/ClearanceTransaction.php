<?php

namespace App\Models;

use App\Filters\ClearanceTransaction\ClearanceTransactionFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;

class ClearanceTransaction extends Model
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;

    protected static $logName = 'Clearance Transaction';

    protected $table = 'clearance_transactions';
    protected $connection = 'dpaisa';

    protected $fillable = [
        'clearance_id',
        'transaction_id',
        'transaction_type',
        'dispute_status'
    ];


    public function scopeFilter(Builder $builder, Request $request, array $filters =[])
    {
        return (new ClearanceTransactionFilters($request))->add($filters)->filter($builder);
    }

    public function clearanceable()
    {
        return $this->morphTo('clearanceable', 'transaction_type', 'transaction_id');
    }

    public function clearances() {
        return $this->belongsTo('App\Models\Clearance', 'clearance_id', 'id');
    }

    public function getDisputeStatus()
    {
        $status = 'not available';
        if (empty($this->dispute_status) || $this->dispute_status === 0) {
            $status = 'Cleared';
        } elseif ($this->dispute_status == 1) {
            $status = 'Dispute';
        }
        return $status;
    }
}
