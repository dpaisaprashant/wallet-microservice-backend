<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NeaSettlement extends Model
{
    use LogsActivity;

    protected static $logName = 'NEA Settlement';
    protected static $logAttributes = ['*'];

    CONST STATUS_STARTED = 'STARTED';
    CONST STATUS_SUCCESS = 'SUCCESS';
    CONST STATUS_FAILED = 'ERROR';


//    public function bankTransfer(){
//        $this->belongsTo(NonRealTimeBankTransfer::class);
//    }
protected $guarded = [];

    public function nchl(){
       return $this->hasOne(NchlBankTransfer::class,'pre_transaction_id','pre_transaction_id');
    }

}
