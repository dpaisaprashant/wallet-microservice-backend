<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class NeaSettlement extends Model
{
    use LogsActivity;

    protected static $logName = 'NEA Settlement';
    protected static $logAttributes = ['*'];
//    public function bankTransfer(){
//        $this->belongsTo(NonRealTimeBankTransfer::class);
//    }
protected $guarded = [];
}
