<?php

namespace App\Http\Controllers;

use App\Events\SaveFCMNotificationEvent;
use App\Events\SendFcmNotification;
use App\Models\Admin;
use App\Models\AdminUpdateKyc;
use App\Models\AdminUserKYC;
use App\Models\Agent;
use App\Models\AgentType;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantType;
use App\Models\NICAsiaCyberSourceLoadTransaction;
use App\Models\TransactionEvent;
use App\Models\User;
use App\Models\UserBonus;
use App\Models\UserCommissionValue;
use App\Models\UserKYC;
use App\Models\UserLoadTransaction;
use App\Models\UserReferral;
use App\Models\UserReferralBonus;
use App\Models\UserReferralLimit;
use App\Models\UserType;
use App\Models\Wallet;
use App\Traits\CollectionPaginate;
use App\Traits\UploadImage;
use App\Wallet\AuditTrail\AuditTrial;
use App\Wallet\AuditTrail\Behaviors\BAll;
use App\Wallet\AuditTrail\Behaviors\BLoginHistory;
use App\Wallet\AuditTrail\Behaviors\BNpay;
use App\Wallet\AuditTrail\Behaviors\BPayPoint;
use App\Wallet\User\Repositories\UserKYCRepository;
use App\Wallet\User\Repositories\UserRepository;
use App\Wallet\WalletAPI\Microservice\UploadImageToCoreMicroservice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use App\Traits\DateConverter;


class UserController extends Controller
{

    use CollectionPaginate;
    use UploadImage;
    use DateConverter;


    public $admin_data;

    private function allAudits($user, $request)
    {
        $IBehaviour = new BAll(); //get audit data from all transactions/user activity tables
        $auditTrial = new AuditTrial($IBehaviour);
        return $this->collectionPaginate(50, $auditTrial->setRequest($request)->createTrial($user), $request, 'all-audit-trials');
    }

    private function nPayAudits($user)
    {
        $IBehaviour = new BNpay();
        $auditTrial = new AuditTrial($IBehaviour);
        return $auditTrial->createTrial($user);
    }

    private function payPointAudits($user)
    {
        $IBehaviour = new BPayPoint();
        $auditTrial = new AuditTrial($IBehaviour);
        return $auditTrial->createTrial($user);
    }

    private function loginHistoryAudits($user)
    {
        $IBehaviour = new BLoginHistory();
        $auditTrial = new AuditTrial($IBehaviour);
        return $auditTrial->createTrial($user);
    }

    public function view(UserRepository $repository)
    {
        $users = $repository->paginatedUsers();
        return view('admin.user.view')->with(compact('users'));
    }

    public function rejectKycUsers(UserRepository $repository){
        $rejectedKycUsers = $repository->rejectedKycUsers();
        return view('admin.user.rejectedKycUser')->with(compact('rejectedKycUsers'));
    }

    public function acceptedKycUsers(UserRepository $repository){
        $accpetedKycUsers = $repository->acceptedKycUsers();
        return view('admin.user.acceptedKycUser')->with(compact('accpetedKycUsers'));
    }

    public function pendingKycUsers(UserRepository $repository){
        $pendingKycUsers = $repository->pendingKycUsers();
        return view('admin.user.pendingKycUser')->with(compact('pendingKycUsers'));
    }

    public function kycNotFilledUsers(UserRepository $repository){
        $kycNotFilledUsers = $repository->kycNotFilledUsers();
        return view('admin.user.kycNotFilledUser')->with(compact('kycNotFilledUsers'));
    }

    public function kycNotFilledView(UserKYCRepository $repository)
    {
        $users = $repository->paginatedKycNotFilledUsers();
        return view('admin.user.kycNotFilledView')->with(compact('users'));
    }

    public function unverifiedKYCView(UserKYCRepository $repository)
    {
        $users = $repository->paginatedUnverifiedKycUsers();
        return view('admin.user.unverifiedKYCView')->with(compact('users'));
    }

    public function changeKYCStatus(Request $request, UserKYCRepository $repository)
    {
        $kyc = $repository->userKYC();

        if (isset($request->accept_status)) {
            $repository->acceptKYC($kyc);
            return redirect()->back();
        }

        if ($request->status == 'accepted') {
            $repository->acceptKYC($kyc);
        } elseif ($request->status = 'rejected') {
            $repository->rejectKYC($kyc);
        }

        return redirect()->back();
    }


    public function profile($id, Request $request)
    {

        $length = 15;
        $activeTab = 'kyc';
        if ($request->has('user-load-fund') || $request->transaction_type === 'user-load-fund') {
            $activeTab = 'loadFund';
        }
        if ($request->has('user-transaction-event') || $request->transaction_type === 'user-transaction-event') {
            $activeTab = 'transaction';
        }
        if ($request->has('all-audit-trials') || $request->transaction_type === 'all-audit-trials') {
            $activeTab = 'allAuditTrial';
        }

        if ($request->has('user-login-history-audit') || $request->transaction_type === 'user-login-history-audit') {
            $activeTab = 'userLoginHistoryAudit';
        }



        //$user = User::with(['userLoadTransactions', 'userLoginHistories', 'userCheckPayment', 'fromFundTransfers', 'receiveFundTransfers', 'fromFundRequests', 'receiveFundRequests', 'kyc', 'wallet'])->findOrFail($id);
        $user = User::with(['userReferral', 'userReferralLimit','merchant','bankAccount','preTransactions', 'requestInfos', 'userLoginHistories', 'fromFundTransfers', 'receiveFundTransfers', 'fromFundRequests', 'receiveFundRequests', 'kyc', 'wallet', 'agent', 'userReferralBonus'])->findOrFail($id);
        $userBonus = UserBonus::whereHas('user')->where('user_id',$id)->first()->bonus;
        $userBonusBalance = Wallet::whereHas('user')->where('user_id',$id)->first()->bonus_balance;
        $admin = $request->user();
        if (!$admin->hasPermissionTo('User profile')) {

            //merchant
            if ($user->merchant) {
                if (!$admin->hasPermissionTo('Merchant profile')) {
                    abort(403,'User does not have the right permissions to view merchant profile.');
                }
            }

            //agent
            if ($user->agent) { //has row in agents table but is a verified agent
                if (!$admin->hasPermissionTo('View agent profile')) {
                    abort(403,'User does not have the right permissions to view agent profile');
                }
            }

            //normal user
            if (empty($user->agent) && empty($user->merchant)) {
                abort(403,'User does not have the right permissions to view user profile');
            }
        }

            //Audit Trial section
            $allAudits = $this->allAudits($user, $request);
            //$nPayAudits = $this->nPayAudits($user);
            // $payPointAudits = $this->payPointAudits($user);
            $loginHistoryAudits = $this->loginHistoryAudits($user);

            //$userLoadTransactions = UserLoadTransaction::with('commission')->where('user_id', $user->id)->where('status', 'COMPLETED')->latest()->filter($request)->paginate($length,['*'], 'user-load-fund');
            $loadPTIds = TransactionEvent::where('transaction_type', UserLoadTransaction::class)->where('user_id', $user->id)->pluck('pre_transaction_id');
            $userTransactionEvents = TransactionEvent::where('user_id', $user->id)->latest()->filter($request)->paginate($length, ['*'], 'user-transaction-event');
            $userTransactionStatements = TransactionEvent::where('user_id', $user->id)->latest()->filter($request)->paginate($length, ['*'], 'user-transaction-statement');
            $loadFundSum = $user->loadedFundSum();
            $userLoadCommission = (new UserCommissionValue())->getUserCommission($user->id, NICAsiaCyberSourceLoadTransaction::class);
            $user_id = UserKYC::where('user_id', $id)->first();

            if ($user_id != null) {
                $ids = $user_id->id;
                $admin = AdminUserKYC::where('kyc_id', $ids)->orderBy('created_at', 'DESC')->first();
                $admin_id = optional($admin)->admin_id;
                $admin_details = Admin::where('id', $admin_id)->first();
            } else {
                $admin_details = collect(array('nodata'));
                $admin = collect(array('nodata'));
                $admin_data = collect(array('nodata'));
            }
        return view('admin.user.profile')->with(compact('userLoadCommission', 'admin_details', 'admin', 'loginHistoryAudits', 'allAudits', 'user', 'loadFundSum', 'activeTab', 'userTransactionStatements', 'userTransactionEvents','userBonus','userBonusBalance'));
    }

    public function createUserKyc($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.createUserKyc')->with(compact('user'));
    }

    public function storeUserKyc(Request $request, $id)
    {

        $disk = "kyc_images";
        $kycRequest = $request->all();

        if($kycRequest['date_format'] == "BS"){
            $dateAD = $this->ConvertNepaliDateFromRequest($kycRequest,'yearDob','monthDob','dayDob');
            $kycRequest['date_of_birth'] = $dateAD;
        }

        if($kycRequest['date_format_issueDate'] == "BS_issue"){
            $dateAD = $this->ConvertNepaliDateFromRequest($kycRequest,'yearIssue','monthIssue','dayIssue');
            $kycRequest['c_issued_date'] = $dateAD;
        }

//        dd($kycRequest);
        $responseData = $this->uploadImageToCoreBase64($disk, $kycRequest, $request);

        if (!empty($responseData['date_of_birth'])) {
            $dateConvert = strtotime(str_replace(',','',$responseData['date_of_birth']));
            $convertedDate = date('Y-m-d', $dateConvert);
            $responseData['date_of_birth'] = $convertedDate;
        }

        if (!empty($responseData['c_issued_date'])) {
            $dateConvert = strtotime(str_replace(',','',$responseData['c_issued_date']));
            $convertedDate = date('Y-m-d', $dateConvert);
            $responseData['c_issued_date'] = $convertedDate;
        }

//        foreach ($kycRequest as $key => $value) {
//            if ($request->hasFile($key)) {
//                $encoded_image = base64_encode(file_get_contents($request->file($key)->path()));
//                $uploadImage = new UploadImageToCoreMicroservice($encoded_image, $disk);
//                $uploadResponse = $uploadImage->uploadImageToCore();
//                $decodedUploadResponse = json_decode($uploadResponse);
//                $image_file_name = $decodedUploadResponse->filename;
//                $kycRequest[$key] = $image_file_name;
//            }
//        }
        $responseData['user_id'] = $id;
        $responseData['status'] = 1;
        $userKycs = UserKYC::where('user_id', '=', $id)->first();

        if ($userKycs) {
            return back()->with('error', 'User KYC Already Exists');
        }
        try {
            $userKyc = UserKYC::create($responseData);
            $user = User::with('kyc')->findOrFail($id); //to pass to view
            $kyc_after_change = json_encode($userKyc); //for adminUpdateKyc
            $adminId = auth()->user()->getAuthIdentifier(); //for adminUpdateKyc
            $user_kyc_id = $userKyc->id; //for adminUpdateKyc
            $admin = 'admin';
            $adminUpdateKyc = new AdminUpdateKyc();
            $adminUpdateKyc->admin_id = $adminId;
            $adminUpdateKyc->user_kyc_id = $user_kyc_id;
            $adminUpdateKyc->kyc_after_change = $kyc_after_change;
            $adminUpdateKyc->save();
            return redirect()->route('user.kyc', $id)->with(compact('user', 'admin'))->with('success', 'User Kyc created successfully');
        }
        catch (\Exception $e){
            return back()->with('error', 'Something went wrong!Please try again later');
        }

    }


    public function kyc($id)
    {
        $user = User::with('kyc')->findOrFail($id);
        $admin = 'admin';
        return view('admin.user.kyc')->with(compact('user', 'admin'));
    }

    public function EditKyc($id)
    {
        $user = User::with('kyc')->findOrFail($id);
        $admin = 'admin';
        $yearDob = date('Y',strtotime($user->kyc->date_of_birth));
        if ($yearDob > 1944 && $yearDob < 2022) {
            $DobBs = $this->EnglishToNepali($user->kyc->date_of_birth);
        }
        else{
            $DobBs = null;
        }
        $yearIssueDate = date('Y',strtotime($user->kyc->c_issued_date));
        if ($yearIssueDate > 1944 && $yearIssueDate < 2022) {
            $DateOfIssueBs = $this->EnglishToNepali($user->kyc->c_issued_date);
        }
        else{
            $DateOfIssueBs = null;
        }
        $date_of_birth = strtotime($user->kyc->date_of_birth);
        $date_of_birth_formatted = date('j F, Y',$date_of_birth);
        $date_of_issue = strtotime($user->kyc->c_issued_date);
        $date_of_issue_formatted = date('j F, Y',$date_of_issue);
        return view('admin.user.EditKyc')->with(compact('user','admin','DobBs','DateOfIssueBs','date_of_birth_formatted','date_of_issue_formatted'));
    }

    public function UpdateKyc(Request $request, $id)
    {
        $selectedUserKYC = UserKYC::where('user_id','=',$id)->first();
        $kyc_before_change = json_encode($selectedUserKYC);
        $disk = "kyc_images";
        $kycRequest = $request->all();

        if($kycRequest['date_format'] == "BS"){
            $dateAD = $this->ConvertNepaliDateFromRequest($kycRequest,'yearDob','monthDob','dayDob');
            $kycRequest['date_of_birth'] = $dateAD;
        }

        if($kycRequest['date_format_issueDate'] == "BS_issue"){
            $dateAD = $this->ConvertNepaliDateFromRequest($kycRequest,'yearIssue','monthIssue','dayIssue');
            $kycRequest['c_issued_date'] = $dateAD;
        }

        $responseData = $this->uploadImageToCoreBase64($disk, $kycRequest,$request); // this is more efficient that the commented out code below

        //note: the below code works just fine but is tedious can be deleted, for now i have just commented it out
//        $kycImageOnly = $request->allFiles();
//        foreach ($kycImageOnly as $key => $value) {
//            if ($request->hasFile($key)) {
//                $encoded_image = base64_encode(file_get_contents($request->file($key)->path()));
//                $uploadImage = new UploadImageToCoreMicroservice($encoded_image, $disk);
//                $uploadResponse = $uploadImage->uploadImageToCore();
//                $decodedUploadResponse = json_decode($uploadResponse);
//                $image_file_name = $decodedUploadResponse->filename;
//                $kycRequest[$key] = $image_file_name;
//            }
//            else{
//                $kycRequest[$key] = $selectedUserKYC->$key;
//            }
//        }
        //note: the above code works just fine but is tedious can be deleted, for now i have just commented it out

        if(!empty($responseData['date_of_birth'])){
            $dateConvert = strtotime(str_replace(',','',$responseData['date_of_birth']));
            $convertedDate = date('Y-m-d', $dateConvert);
            $responseData['date_of_birth']=$convertedDate;
        }

        if (!empty($responseData['c_issued_date'])) {
            $dateConvert = strtotime(str_replace(',','',$responseData['c_issued_date']));
            $convertedDate = date('Y-m-d', $dateConvert);
            $responseData['c_issued_date'] = $convertedDate;
        }

        $adminId = auth()->user()->id;
        $user_kyc_id = $selectedUserKYC->id; // for Admin Update KYC
        $selectedUserKYC->update($responseData);
        $status = $selectedUserKYC->save();
        $kyc_after_change = json_encode($selectedUserKYC);
        $user = User::with('kyc')->findOrFail($id);
        $admin = 'admin';
        if($status == true){
            $adminUpdateKyc = new AdminUpdateKyc();
            $adminUpdateKyc->admin_id = $adminId;
            $adminUpdateKyc->user_kyc_id = $user_kyc_id;
            $adminUpdateKyc->kyc_before_change = $kyc_before_change;
            $adminUpdateKyc->kyc_after_change = $kyc_after_change;
            $adminUpdateKyc->save();
            return redirect()->route('user.kyc',$id)->with(compact('user','admin'))->with('success','User Kyc updated successfully');
        }else{
            return redirect()->route('user.kyc',$id)->with(compact('user','admin'))->with('error', 'Something went wrong!Please try again later');
        }
    }

    public function showAdminUpdatedKyc()
    {
        $adminUpdatedKycs = AdminUpdateKyc::filter(request())->with('admin','userKyc')->latest()->paginate(10);
//        dd($adminUpdatedKycs);
        return view('admin.user.AdminUpdatedKyc')->with(compact('adminUpdatedKycs'));
    }



    public function userYearlyGraph(Request $request)
    {
        $now = Carbon::now();
        $year = $now->format('Y');
        //get current year transaction
        $transactions = TransactionEvent::where('user_id', $request->user_id)
            ->with('transactionable')
            ->filter($request)
            ->get();

        $groupedTransactions = $transactions
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('F');
            });

        //return num of transactions and sum of transaction amount in each grouped date
        $groupedTransactions->transform(function ($value, $key) {
            return [
                'count' => count($value),
                'amount' => round($value->sum('amount'), 2)
            ];
        });

        return [
            'graph' => $groupedTransactions,
        ];
    }

    public function userYearlyVendorGraph(Request $request)
    {
        $now = Carbon::now();
        $year = $now->format('Y');

        //get current year transaction
        $transactions = TransactionEvent::where('user_id', $request->user_id)
            ->with('transactionable')
            ->filter($request)
            ->get();

        $groupedTransactions = $transactions
            ->groupBy('vendor');

        //return num of transactions and sum of transaction amount in each grouped date
        $groupedTransactions->transform(function ($value, $key) {
            return [
                'count' => count($value),
                'amount' => round($value->sum('amount'), 2)
            ];
        });

        return json_encode($groupedTransactions);
    }

    public function transaction($id, UserRepository $repository)
    {
        $transactions = $repository->paginatedUserTransactions($id);
        $user = User::where('id', $id)->first();

        return view('admin.user.transaction')->with(compact('transactions', 'user'));
    }

    public function filterTransaction(Request $request)
    {
        dd($request->all());
    }

    public function deactivateUser(Request $request)
    {
        User::where('id', $request->user_id)->update(['status' => 0]);
        return redirect()->back();
    }

    public function activateUser(Request $request)
    {
        User::where('id', $request->user_id)->update(['status' => 1]);
        return redirect()->back();
    }

    public function deactivateUsersList(UserRepository $repository)
    {
        $users = $repository->paginatedDeactivateUsers();
        return view('admin.user.deactivateUsersView')->with(compact('users'));
    }

    public function bankAccount(UserRepository $repository, $id)
    {
        $user = User::where('id', $id)->first();
        $accounts = $repository->bankAccounts($id);
        return view('admin.user.bankAccount')->with(compact('accounts', 'user'));
    }

    public function referralCode(Request $request, $id)
    {
        if (empty($request->referral_code)) {
            return redirect()->back()->with('error', 'Referral code cannot be empty');
        }

        $user = User::with('userReferral')->where('id', $id)->first();
        $oldReferralCode = $user->userReferral->code;
        $newReferralCode = $request->referral_code;

        if ($oldReferralCode == $newReferralCode) {
            return redirect()->back()->with('error', 'Same referral code');
        }

        $duplicateReferralCount = UserReferral::where('code', $newReferralCode)->count();
        if ($duplicateReferralCount) {
            return redirect()->back()->with('error', 'Duplicate referral code');
        }

        UserReferral::updateorCreate(
            ['user_id' => $user->id],
            [
                'code' => $newReferralCode
            ]
        );

        return redirect()->back()->with('success', 'referral code update successfully');

    }

    public function referralBonus(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        UserReferralBonus::updateOrCreate(
            ['user_id' => $user->id],
            [
                'code_owner_register_accept_value' => $request->code_owner_register_accept_value,
                'code_user_register_accept_value' => $request->code_user_register_accept_value,

                'code_owner_kyc_accept_value' => $request->code_owner_kyc_accept_value,
                'code_user_kyc_accept_value' => $request->code_user_kyc_accept_value,

                'code_owner_first_transaction_value' => $request->code_owner_first_transaction_value,
                'code_user_first_transaction_value' => $request->code_user_first_transaction_value,
            ]
        );

        UserReferralLimit::updateOrCreate(
            ['user_id' => $user->id],
            [
                'min_load_limit' => $request->min_load_limit,
                'min_payment_limit' => $request->min_payment_limit,
                'min_bank_transfer_limit' => $request->min_bank_transfer_limit,

                'hold_amount' => $request->hold_amount,
                'first_transaction_amount' => $request->first_transaction_amount
            ]
        );


        return redirect()->back()->with('success', 'referral bonus update successfully');
    }

    public function cardLoadCommission(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        UserCommissionValue::updateOrCreate(
            ['user_id' => $user->id, 'transaction_type' => NICAsiaCyberSourceLoadTransaction::class],
            [
                'commission_type' => $request->commission_type,
                'commission_value' => $request->commission_value
            ]
        );

        return redirect()->back()->with('success', 'Commission update successfully');

    }

}
