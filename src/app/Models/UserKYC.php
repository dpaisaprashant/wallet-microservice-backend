<?php

namespace App\Models;

use App\Filters\UserKyc\UserKycFilters;
use App\Models\Merchant\Merchant;
use App\Traits\BelongsToMerchant;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Activitylog\Traits\LogsActivity;

class UserKYC extends Model
{
    use BelongsToUser, LogsActivity, BelongsToMerchant;

    protected static $logAttributes = ['*'];
    //protected static $logOnlyDirty = true;
    protected static $logName = 'User KYC';

    protected $table = "user_k_y_c_s";
    protected $connection = 'dpaisa';

    const STATUS_VERIFIED = 1;

    const ACCEPT_ACCEPTED = 1;
    const ACCEPT_REJECTED = 0;
    const ACCEPT_UNVERIFIED = null;

    const MALE = 'm';
    const FEMALE = 'f';
    const OTHER = 'o';

    const DOCUMENT_CITIZENSHIP = 'c';
    const DOCUMENT_PASSPORT = 'p';
    const DOCUMENT_LICENSE = 'l';

    protected $guarded = [];

    public function scopeFilter(Builder $builder, Request $request, array $filters = [])
    {
        return (new UserKycFilters($request))->add($filters)->filter($builder);
    }

    public function admin()
    {
        $db = config('database.connections.mysql.database');
        return $this->belongsToMany(Admin::class, $db . '.admin_user_k_y_c', 'kyc_id', 'admin_id')->withPivot('status', 'created_at', 'updated_at');
    }

    public function kycValidation()
    {
        return $this->hasOne(UserKYCValidation::class, 'kyc_id');
    }

    public function unverifiedKYC()
    {
        return User::whereHas('kyc', function ($query) {
            $query->where('accept', UserKYC::ACCEPT_UNVERIFIED);
        })->latest()->get();
    }


    public function notFilledKYC()
    {
        return (new User())->kycNotFilledUsers()->get();
    }

    public function acceptedKYC()
    {
        return User::whereHas('kyc', function ($query) {
            return $query->where('user_k_y_c_s.status', '=', UserKYC::ACCEPT_ACCEPTED);
        })->get();
    }

    public function rejectedKYC()
    {
        return User::whereHas('kyc', function ($query) {
            return $query->where('user_k_y_c_s.status', '=', UserKYC::ACCEPT_ACCEPTED);
        })->get();
    }

    public function documentationType()
    {
        if ($this->document_type == self::DOCUMENT_CITIZENSHIP) {
            return 'Citizenship';
        } elseif ($this->document_type == self::DOCUMENT_LICENSE) {
            return 'License';
        } elseif ($this->document_type == self::DOCUMENT_PASSPORT) {
            return 'Passport';
        }
    }

    public function adminUpdateKyc(){
        return $this->hasMany(AdminUpdateKyc::class,'user_kyc_id');
    }

}
