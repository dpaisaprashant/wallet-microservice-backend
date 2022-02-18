<?php


namespace App\Wallet\BFIMerchant\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\BFI\BFIUser;
use App\Models\BFI\UserApiDetail;
use App\Models\BFI\UserApprovedIp;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantBFI;
use App\Traits\CollectionPaginate;
use App\Wallet\Helpers\TransactionIdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PDF;

class BFIUserController extends Controller
{

    public function index()
    {
        $bfiUsers = BFIUser::with('UserApiDetail', 'UserApprovedIp')->orderBy('created_at', 'DESC')->get();
        return view('BFIMerchant::BFIUser.viewBFIUser', compact('bfiUsers'));
    }

    public function createIp(Request $request, $id)
    {
        $bfiUserId = $id;

        if ($request->isMethod('POST')) {
            $status = UserApprovedIp::create([
                'user_id' => $id,
                'ip' => $request->get('ip_address')
            ]);

            if ($status == true) {
                return redirect()->route('bfi.user.view')->with('success', 'IP address added successfully');
            } else {
                return redirect()->route('bfi.user.view')->with('error', 'Something went wrong!Please try again later');
            }
        }

        return view('BFIMerchant::BFIUser.createBFIIP', compact('bfiUserId'));
    }

    public function createBFIUser()
    {
        return view('BFIMerchant::BFIUser.createBFIUser');
    }

    public function storeBFIUser(Request $request)
    {
        $bfiNumber = TransactionIdGenerator::generateBFIId();

        $checkBFINumber = BFIUser::where('bfi_id', $bfiNumber)->count();

        if ($checkBFINumber > 0) {
            return redirect()->route('bfi.user.view')->with('error', 'BFI number already exists in the table');
        }

        $secretKey = TransactionIdGenerator::generateAlphaNumeric(64);

        $checkSecretKey = UserApiDetail::where('secret_key')->count();

        if ($checkSecretKey > 0) {
            return redirect()->route('bfi.user.view')->with('error', 'Secret key already exists in the table');
        }

        $bfiUser = BFIUser::create([
            'bfi_id' => $bfiNumber,
            'bfi_name' => $request->get('bfi_name'),
            'api_username' => $request->get('api_username'),
            'api_password' => Hash::make($request->get('api_password')),
            'portal_username' => $request->get('portal_username'),
            'portal_password' => Hash::make($request->get('portal_password')),
            'email' => $request->get('email'),
            'status' => $request->get('bfi_id')
        ]);

        if (!$bfiUser) {
            return redirect()->route('bfi.user.view')->with('error', 'Problem occured while storing bfi user data');
        }

        $userApiDetail = UserApiDetail::create([
            'user_id' => $bfiUser->id,
            'secret_key' => $secretKey,
        ]);

        if(!$userApiDetail) {
            return redirect()->route('bfi.user.view')->with('error', 'Problem occured while storing secret key data');
        }

        return redirect()->route('bfi.user.view')->with('success', 'BFI user created successfully');
    }

    public function editStatus($id){
        $bfiUser = BFIUser::findOrFail($id);
        return view('BFIMerchant::BFIUser.editBFIUserStatus',compact('bfiUser'));
    }

    public function updateStatus(Request $request,$id){
        $bfiUser = BFIUser::findOrFail($id);
        $bfiUser->status = $request->bfi_id;
        $ifSuccess = $bfiUser->save();
        if($ifSuccess){
            return redirect()->route('bfi.user.view')->with('success', 'Status updated successfully');
        }else{
            return redirect()->route('bfi.user.view')->with('error', 'Something went wrong please try again later');
        }
    }

    public function createPDF(Request $request,$id){
        $bfiUsers = BFIUser::with('UserApiDetail')->findOrFail($id);
        $entered_api_password = $request->get('api_password');
        $entered_portal_password = $request->get('portal_password');

        if(Hash::check($entered_api_password , $bfiUsers->api_password)){
            if(Hash::check($entered_portal_password , $bfiUsers->portal_password)){
                view()->share('bfiUser',$bfiUsers);
                $pdf = PDF::loadView('BFIMerchant::BFIUser.Pdf.bfiUserPdf',['bfiUsers'=>$bfiUsers,'api_password'=>$entered_api_password,'portal_password'=>$entered_portal_password]);
                return $pdf->download($bfiUsers->bfi_name.'.pdf');
            }else{
                return redirect()->route('bfi.user.view')->with('error','Incorrect Portal Password');
            }
        }else{
            return redirect()->route('bfi.user.view')->with('error','Incorrect Api Password');
        }


    }

}
