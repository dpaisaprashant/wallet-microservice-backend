<?php


namespace App\Wallet\User\Repositories;


use App\Events\SaveFCMNotificationEvent;
use App\Events\SendFcmNotification;
use App\Models\AdminUserKYC;
use App\Models\User;
use App\Models\UserKYC;
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
        return User::whereHas('kyc', function ($query) {
            $query->where('accept', UserKyc::ACCEPT_UNVERIFIED);
        })->latest()->filter($this->request)->paginate($this->length);
    }

    public function userKYC($id = null)
    {
        if (!empty($id)) {
            return UserKYC::with('user')->where('user_id', $id)->firstOrFail();
        }
        return UserKYC::with('user')->where('id', $this->request->kyc)->firstOrFail();
    }

    public function acceptKYC(UserKYC $kyc)
    {
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
