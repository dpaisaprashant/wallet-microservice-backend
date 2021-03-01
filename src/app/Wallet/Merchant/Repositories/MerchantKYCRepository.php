<?php


namespace App\Wallet\Merchant\Repositories;


use App\Models\AdminMerchantKYC;
use App\Models\Merchant\MerchantKYC;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;

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
    public function setLength(int $length)
    {
        $this->length = $length;
        return $this;
    }

    public function merchantKYC($id = null)
    {
        if (!empty($id)) {
            return MerchantKYC::with('merchant')->where('merchant_id', $id)->firstOrFail();
        }
        return MerchantKYC::with('merchant')->where('id', $this->request->kyc)->firstOrFail();
    }

    public function acceptKYC(MerchantKYC $kyc)
    {
        $kyc->status = 1;
        $kyc->accept = 1;

        $adminKyc = new AdminMerchantKYC();
        $adminKyc->admin_id = auth()->user()->id;
        $adminKyc->kyc_id = $kyc->id;
        $adminKyc->status = 'ACCEPTED';
        $adminKyc->save();

        $notificationRequest = [
            'user_id' => $kyc->merchant()->first()->id,
            'title' => 'KYC Accepted',
            'message' => 'Your KYC form has been accepted',
            'data' => json_encode(['a_data' => 'my_data']),
            'notification_type' => 'KYCAccepted',
            'backend_user_id' => auth()->user()->id
        ];

        $user = $kyc->merchant()->first();


        $kyc->save();
    }

    public function rejectKYC(MerchantKYC $kyc)
    {
        $kyc->status = 1;
        $kyc->accept = 0;

        $adminKyc = new AdminMerchantKYC();
        $adminKyc->admin_id = auth()->user()->id;
        $adminKyc->kyc_id = $kyc->id;
        $adminKyc->status = 'REJECTED';
        $adminKyc->save();

        $notificationRequest = [
            'user_id' => $kyc->merchant()->first()->id,
            'title' => 'KYC Rejected',
            'message' => $this->request->reason ?? 'Your KYC form has been rejected',
            'data' => json_encode(['a_data' => 'my_data']),
            'notification_type' => 'KYCRejected',
            'backend_user_id' => auth()->user()->id
        ];

        $user = $kyc->merchant()->first();

        $kyc->save();
    }
}
