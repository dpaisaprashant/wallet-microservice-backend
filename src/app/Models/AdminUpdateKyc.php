<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUpdateKyc extends Model
{
    protected $connection = 'mysql';
    protected $guarded = [];
    protected $table = 'admin_update_kycs';

    public function admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }

    public function userKyc(){
        return $this->belongsTo(UserKYC::class,'user_kyc_id');
    }


}
