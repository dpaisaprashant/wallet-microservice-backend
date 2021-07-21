<?php


namespace App\Wallet\User\Repositories;


use App\Events\SaveFCMNotificationEvent;
use App\Events\SendFcmNotification;
use App\Models\AdminUserKYC;
use App\Models\User;
use App\Models\UserKYC;
use App\Models\UserKYCValidation;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

class UserKYCRepository
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
     * @return UserKYCRepository
     */
    public function setLength(int $length): UserKYCRepository
    {
        $this->length = $length;
        return $this;
    }

    private function sortedKycNotFilledUsers()
    {
        return (new User())->kycNotFilledUsers()->filter($this->request)->paginate($this->length);
    }

    private function latestKycNotFilledUsers()
    {
        return (new User())->kycNotFilledUsers()->latest()->filter($this->request)->paginate($this->length);
    }

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
            'gender' => (bool) $this->request->gender
        ];

    }

    public function paginatedKycNotFilledUsers()
    {
        if(empty($this->request->sort))
        {
            return $this->latestKycNotFilledUsers();
        }else{
            return $this->sortedKycNotFilledUsers();
        }
    }

    public function paginatedUnverifiedKycUsers()
    {
//        return User::whereHas('kyc', function ($query) {
//            $query->where('accept', UserKyc::ACCEPT_UNVERIFIED);
//        })->latest()->filter($this->request)->paginate($this->length);
        return User::whereHas('userType')->whereHas('kyc',function($query){
            $query->where('accept',UserKYC::ACCEPT_UNVERIFIED);
        })->latest()->filter($this->request)->paginate($this->length);
    }

    public function userKYC($id = null)
    {
        if (!empty($id)) {
            return UserKYC::with('user', 'kycValidation')->where('user_id', $id)->firstOrFail();
        }
        return UserKYC::with('user', 'kycValidation')->where('id', $this->request->kyc)->firstOrFail();
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
            'user_id' => $kyc->user()->first()->id,
            'title' => 'KYC Accepted',
            'message' => 'Your KYC form has been accepted',
            'data' => json_encode(['a_data' => 'my_data']),
            'notification_type' => 'KYCAccepted',
            'backend_user_id' => auth()->user()->id
        ];

        $user = $kyc->user()->first();

        $this->sendNotification($user, 'KYC Accepted','Your KYC form has been accepted', 'KYCAccepted');
        //event(new SendFcmNotification($kyc->user()->first(), "KYC Accepted", "Your KYC form has been accepted", ['a_data' => 'my_data'], 'KYC'));

        event(new SaveFCMNotificationEvent($notificationRequest));

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
            'user_id' => $kyc->user()->first()->id,
            'title' => 'KYC Rejected',
            'message' => $this->request->reason ?? 'Your KYC form has been rejected',
            'data' => json_encode(['a_data' => 'my_data']),
            'notification_type' => 'KYCRejected',
            'backend_user_id' => auth()->user()->id
        ];

        $user = $kyc->user()->first();
        $this->sendNotification($user, 'KYC Rejected',$notificationRequest['message'], 'KYCRejected');
        //event(new SendFcmNotification($kyc->user()->first(), "KYC Rejected", "Your kyc form has been rejected", ['a_data' => 'my_data'], 'KYC'));
        event(new SaveFCMNotificationEvent($notificationRequest));

        $kyc->save();
    }



}
