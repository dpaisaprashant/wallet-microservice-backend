<?php


namespace App\Wallet\Merchant\Repositories;


use App\Models\AdminUserKYC;
use App\Models\Merchant\MerchantKYC;
use App\Models\UserKYC;
use App\Models\UserKYCValidation;
use App\Traits\CollectionPaginate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;

class MerchantKYCRepository
{
    use CollectionPaginate;

    private $request;

    private $length = 15;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param int $length
     * @return MerchantKYCRepository
     */
    private function sendNotification($user, $title, $description, $type)
    {
        $user->notify(new \App\Notifications\FCMNotification(
            $user,
            $title,
            $description,
            $type
        ));
    }

    private function kycValidationFields()
    {
        return $validationFields = [
            'first_name' => (bool) $this->request->first_name,
            'middle_name' => (bool) $this->request->middle_name,
            'last_name' => (bool) $this->request->last_name,
            'date_of_birth' => (bool) $this->request->date_of_birth,
            'fathers_name' => (bool) $this->request->fathers_name,
            'mothers_name' => (bool) $this->request->mothers_name,
            'grand_fathers_name' => (bool) $this->request->grand_fathers_name,
            'spouse_name' => (bool) $this->request->spouse_name,
            'email' => (bool) $this->request->email,
            'occupation' => (bool) $this->request->occupation,

            'province' => (bool) $this->request->province,
            'zone' => (bool) $this->request->zone,
            'district' => (bool) $this->request->district,
            'municipality' => (bool) $this->request->municipality,
            'ward_no' => (bool) $this->request->ward_no,

            'tmp_province' => (bool) $this->request->tmp_province,
            'tmp_zone' => (bool) $this->request->tmp_zone,
            'tmp_district' => (bool) $this->request->tmp_district,
            'tmp_municipality' => (bool) $this->request->tmp_municipality,
            'tmp_ward_no' => (bool) $this->request->tmp_ward_no,

            'document_type' => (bool) $this->request->document_type,
            'id_no' => (bool) $this->request->id_no,
            'c_issued_date' => (bool) $this->request->c_issued_date,
            'c_issued_from' => (bool) $this->request->c_issued_from,
            'p_photo' => (bool) $this->request->p_photo,
            'id_photo_front' => (bool) $this->request->id_photo_front,
            'id_photo_back' => (bool) $this->request->id_photo_back,
            //'o_photo' => (bool) $this->request->o_photo,
            'o_photo' => true,
            'gender' => (bool) $this->request->gender,
            'company_name' => (bool) $this->request->company_name,
            'company_address' => (bool) $this->request->company_address,
            'company_vat_pin_number' => (bool) $this->request->company_vat_pin_number,

            'company_document' => (bool) $this->request->company_document,
            'company_logo' => (bool) $this->request->company_logo,
            'company_vat_document' => (bool) $this->request->company_vat_document,
            'company_tax_clearance_document' => (bool) $this->request->company_tax_clearance_document
        ];

    }

    public function setLength(int $length)
    {
        $this->length = $length;
        return $this;
    }

    public function merchantKYC($kycID)
    {
        $kycId = $kycID;
        if(isset($kycId)){
            $user =  User::with('merchant','kyc')->whereHas('merchant')->whereHas('kyc',function($query) use ($kycId){
                return $query->where('id',$kycId);
            })->first();
            return $user->kyc()->first();
        }
        return false;
    }

    public function acceptKYC(UserKYC $kyc)
    {
        $validationFields = $this->kycValidationFields();

        foreach ($validationFields as $fieldName => $field) {
            if (! $field) {
                return redirect()->route('user.kyc', $kyc->user_id)->with("error", $fieldName ." is not verified. All information should be verified to accept KYC.");
            }
        }

        $validationFields = UserKYCValidation::updateOrCreate(
            ["kyc_id" => $kyc->id],
            $validationFields
        );

        if (! $validationFields) {
            return redirect()->route('user.kyc', $kyc->user_id)->with("error", "Error while updating validation fields for kyc");
        }
        $kyc->status = 1;
        $kyc->accept = 1;


        $adminKyc = new AdminUserKYC();
        $adminKyc->admin_id = auth()->user()->id;
        $adminKyc->kyc_id = $kyc->id;
        $adminKyc->status = 'ACCEPTED';
        $adminKyc->save();


        $notificationRequest = [
            'user_id' => $kyc->first()->id,
            'title' => 'KYC Accepted',
            'message' => 'Your KYC form has been accepted',
            'data' => json_encode(['a_data' => 'my_data']),
            'notification_type' => 'KYCAccepted',
            'backend_user_id' => auth()->user()->id
        ];

        $user = $kyc->merchant()->first();


        $kyc->save();
    }

    public function rejectKYC(UserKYC $kyc)
    {
        $validationFields = $this->kycValidationFields();

        $validationFields = UserKYCValidation::updateOrCreate(
            ["kyc_id" => $kyc->id],
            $validationFields
        );

        if (! $validationFields) {
            return redirect()->route('user.kyc', $kyc->user_id)->with("error", "Error while updating validation fields for kyc");
        }


        $kyc->status = 1;
        $kyc->accept = 0;

        $adminKyc = new AdminUserKYC();
        $adminKyc->admin_id = auth()->user()->id;
        $adminKyc->kyc_id = $kyc->id;
        $adminKyc->status = 'REJECTED';
        $adminKyc->save();

        $notificationRequest = [
            'user_id' => $kyc->first()->id,
            'title' => 'KYC Rejected',
            'message' => $this->request->reason ?? 'Your KYC form has been rejected',
            'data' => json_encode(['a_data' => 'my_data']),
            'notification_type' => 'KYCRejected',
            'backend_user_id' => auth()->user()->id
        ];

        $user = $kyc->merchant()->first();

        $kyc->save();
    }

    public function paginatedUnverifiedMerchantKYC(){
        return User::with('merchant', 'kyc')->whereHas('kyc',function($query){
            return $query->where('accept',MerchantKYC::ACCEPT_UNVERIFIED);
        })->whereHas('merchant')->latest()->paginate($this->length);
    }
}
