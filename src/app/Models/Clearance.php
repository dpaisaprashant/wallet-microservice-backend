<?php

namespace App\Models;

use App\Filters\Clearance\ClearanceFilters;
use App\Models\TransactionEvent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;

class Clearance extends Model
{

    use LogsActivity;

    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'Clearance';


    protected $table = 'clearances';
	protected $connection = "dpaisa";

    const STATUS_CLEARED = 0;
    const STATUS_SIGNED = 1;

    const TYPE_PAYPOINT = 'payPoint';
    const TYPE_NPAY = 'nPay';
    const TYPE_KHALTI = 'khalti';
    const TYPE_NPS = 'nps';
    const TYPE_NEPALQR = 'nepalQr';

    protected $fillable = [
        'admin_id',
        'clearance_status',
        'dispute_status',
        'total_transaction_count',
        'total_transaction_amount',
        'total_transaction_commission',
        'transaction_to_date',
        'transaction_from_date',
        'clearance_type',
        'created_at',
        'updated_at'
    ];

    public function getTotalTransactionAmountAttribute($totalTransactionAmount)
    {
        return ($totalTransactionAmount/100);
    }

    public function getTotalTransactionCommissionAttribute($totalTransactionCommission)
    {
        return ($totalTransactionCommission/100);
    }

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new ClearanceFilters($request))->add($filters)->filter($builder);
    }


    public function npayClearedTransactions()
    {
        return $this->with('clearanceTransactions')
            ->where('admin_id', auth()->user()->id)
           ->whereClearanceType('nPay')
            ->withCount('clearanceTransactions')
            ->latest()
            ->get();

    }

    public function paypointClearedTransactions()
    {
        return $this->with('clearanceTransactions', 'admin')
            ->where('admin_id', auth()->user()->id)
            ->whereClearanceType('payPoint')
            ->withCount('clearanceTransactions')
            ->latest()
            ->get();

    }

    public function clearanceTransactions() {
        return $this->hasMany(ClearanceTransaction::class);
    }


    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function dispute()
    {
        return $this->hasMany(Dispute::class, 'clearance_id');
    }

    public function paypointExcelTransactions()
    {
        return $this->hasMany(PaypointToDpaisaClearanceTransaction::class);
    }

    public function getStatus()
    {
        $status = 'not available';
        if ($this->clearanceTransactions()->count() == 0) {
            $status = 'Not Cleared';
        } elseif ($this->clearance_status === 0) {
            $status = 'Cleared';
        } elseif ($this->clearance_status === 1) {
            $status = 'Signed';
        } else {
            $status = 'Dispute in transaction';
        }
        return $status;
    }

}
