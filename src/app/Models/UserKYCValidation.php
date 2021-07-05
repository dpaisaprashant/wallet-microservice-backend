<?php

namespace App\Models;

use App\Filters\UserKyc\UserKycFilters;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;

class UserKYCValidation extends Model
{
    use BelongsToUser, LogsActivity;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'User KYC';

    protected $table = "user_k_y_c_validations";
    protected $connection = 'dpaisa';

    protected $guarded = [];

    public function kyc()
    {
        return $this->belongsTo(UserKYC::class, 'kyc_id');
    }
}
