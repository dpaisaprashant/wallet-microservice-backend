<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    protected $connection = "mysql";

    use Notifiable, HasRoles, LogsActivity, CausesActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'mobile_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static $logAttributes = ['*'];

    protected static $logOnlyDirty = true;

    protected static $logName = 'Backend user';

    public function userKYC()
    {
        $db = config('database.connections.mysql.database');
        return $this->belongsToMany(UserKYC::class, $db . '.admin_user_k_y_c', 'admin_id', 'kyc_id')
            ->withPivot('status');
    }

    public function FCMNotifications()
    {
        return $this->hasMany(FCMNotification::class, 'backend_user_id');
    }

    public function otpCode()
    {
        return $this->hasMany(AdminOTP::class, 'admin_id');
    }

    public function session()
    {
        return $this->hasMany(Session::class, 'user_id');
    }

    public function acceptedKycs()
    {
        /*return $this->with('userKYC')
            ->whereHas('userKYC', function ($query) {
                return $query->whereStatus('ACCEPTED');
            })
            ->latest()
            ->get();*/

        //$admin = Admin::where('id', auth()->user()->id)->first();
        //return $admin->userKYC()->where('user_k_y_c_s.status', 1)->where('user_k_y_c_s.accept', 1)->get();
        return UserKYC::where('status', 1)->where('accept', 1)->get();

    }

    public function acceptedKycsCount()
    {
        /*return $this->with('userKYC')
            ->whereHas('userKYC', function ($query) {
                return $query->whereStatus('ACCEPTED');
            })
            ->latest()
            ->get();*/

        //$admin = Admin::where('id', auth()->user()->id)->first();
        //return $admin->userKYC()->where('user_k_y_c_s.status', 1)->where('user_k_y_c_s.accept', 1)->get();
        return UserKYC::where('status', 1)->where('accept', 1)->count();

    }

    public function rejectedKycs()
    {
        //$admin = Admin::where('id', auth()->user()->id)->first();
        //return $admin->userKYC()->where('user_k_y_c_s.accept', 0)->get();
        return UserKYC::where('user_k_y_c_s.accept', 0)->get();
    }

    public function rejectedKycsCount()
    {
        //$admin = Admin::where('id', auth()->user()->id)->first();
        //return $admin->userKYC()->where('user_k_y_c_s.accept', 0)->get();
        return UserKYC::where('user_k_y_c_s.accept', 0)->count();
    }

    public function kycList(Admin $user, $request)
    {
        //return $user->userKYC()->orderBy('admin_user_k_y_c.updated_at', 'desc')->filter($request)->get();
        return UserKYC::orderBy('updated_at', 'desc')->filter($request)->get();
    }




}
