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
use App\Traits\DateConverter;

class UserKYC extends Model
{
    use BelongsToUser, LogsActivity, BelongsToMerchant,DateConverter;

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

    protected $guarded = ['id'];

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'fathers_name',
        'mothers_name',
        'grand_fathers_name',
        'spouse_name',
        'email',
        'occupation',
        'province',
        'zone',
        'district',
        'municipality',
        'ward_no',
        'tmp_province',
        'tmp_zone',
        'tmp_district',
        'tmp_municipality',
        'tmp_ward_no',
        'document_type',
        'id_no',
        'c_issued_date',
        'c_issued_from',
        'p_photo',
        'id_photo_front',
        'id_photo_back',
        'o_photo',
        'gender',
        'user_id',
        'status',
        'accept',
        'created_at',
        'updated_at',
        'deleted_at',
        'company_name',
        'company_address',
        'company_vat_pin_number',
        'company_document',
        'company_logo',
        'company_vat_document',
        'company_tax_clearance_document',
        ];

    protected $appends = [
        "date_of_birth_bs", "c_issued_date_bs"
    ];

    public function getDateOfBirthBsAttribute()
    {
        $nepaliDate = $this->EnglishToNepali(date('Y-m-d',strtotime(str_replace(',','',$this->date_of_birth))));
        if ($nepaliDate) {
                $formattedNepaliDate = $nepaliDate['year'] . "-" . $nepaliDate['month'] . "-" . $nepaliDate['date'];
                return $formattedNepaliDate;
            }
            return null;
    }

    public function getCIssuedDateBsAttribute()
    {
        $nepaliDate = $this->EnglishToNepali(date('Y-m-d',strtotime(str_replace(',','',$this->c_issued_date))));
            if ($nepaliDate) {
                $formattedNepaliDate = $nepaliDate['year'] . "-" . $nepaliDate['month'] . "-" . $nepaliDate['date'];
                return $formattedNepaliDate;
            }
            return null;

    }

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

    public function notFilledKYCCount()
    {
        return (new User())->kycNotFilledUsersCount();
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
