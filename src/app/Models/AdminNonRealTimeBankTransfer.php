<?php

namespace App\Models;

use App\Traits\StoreSetting;
use App\Traits\UploadImage;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class AdminNonRealTimeBankTransfer extends Model
{
    protected $table = 'non_real_time_bank_transfer';

    protected $guarded = [];

    public function admin(){
        return $this->belongsTo(Admin::class,'user_id','id');
    }



}

