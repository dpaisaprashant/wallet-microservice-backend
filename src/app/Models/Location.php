<?php

namespace App\Models;
use App\Models\Merchant\MerchantAddress;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Spatie\Activitylog\Traits\LogsActivity;

class Location extends Model
{
//    use LogsActivity;

//    protected static $logFillable = true;
//    protected static $logName = 'User';

    protected $connection = 'dpaisa';
    protected $table = 'locations';

    protected $fillable = [
        'name',
    ];

    protected $casts = [

    ];


    public function rules(){
        $rules = array(
            'name' => 'required|unique:dpaisa.locations',
        );
        return $rules;
    }

    public function merchantAddressLocation(){
        return $this->hasMany(MerchantAddress::class,'id','location_id',);
    }
}
