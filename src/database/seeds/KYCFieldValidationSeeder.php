<?php

use App\Models\Admin;
use App\Models\UserKYC;
use App\Models\UserKYCValidation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class KYCFieldValidationSeeder extends Seeder
{
    private function kycValidationFields()
    {
        return $validationFields = [
            'first_name' => true,
            'middle_name' => true,
            'last_name' => true,
            'date_of_birth' => true,
            'fathers_name' => true,
            'mothers_name' => true,
            'grand_fathers_name' => true,
            'spouse_name' => true,
            'email' => true,
            'occupation' => true,

            'province' => true,
            'zone' => true,
            'district' => true,
            'municipality' => true,
            'ward_no' => true,

            'tmp_province' => true,
            'tmp_zone' => true,
            'tmp_district' => true,
            'tmp_municipality' => true,
            'tmp_ward_no' => true,

            'document_type' => true,
            'id_no' => true,
            'c_issued_date' => true,
            'c_issued_from' => true,
            'p_photo' => true,
            'id_photo_front' => true,
            'id_photo_back' => true,
            'o_photo' => true,
            'gender' => true
        ];

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userKycs = UserKYC::where('accept', 1)->get();
        foreach ($userKycs as $kyc) {
            UserKYCValidation::updateOrCreate(
                ['kyc_id' => $kyc->id],
                $this->kycValidationFields()
            );
        }
    }
}
