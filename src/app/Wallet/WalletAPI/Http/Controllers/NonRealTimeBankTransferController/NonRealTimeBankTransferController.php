<?php

namespace App\Wallet\WalletAPI\Http\Controllers\NonRealTimeBankTransferController;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\NonRealTimeBankTransfer;
use App\Models\AdminNonRealTimeBankTransfer;
use App\Wallet\WalletAPI\Microservice\NchlNonRealTimeBankTransferMicroservice;
use Illuminate\Http\Request;

class NonRealTimeBankTransferController extends Controller {

    public function index(Request $request){
        $nonRealTimeBankTransfer = new NchlNonRealTimeBankTransferMicroservice();
        $bankList = $nonRealTimeBankTransfer->getBankList($request);
        return view("WalletAPI::NonRealTimeBankTransfer.nonRealTimeBankTransfer",compact('bankList'));
    }

    public function getBranchList(Request $request){
        $bankCode = $request->bankCode;
        $nonRealTimeBankTransfer = new NchlNonRealTimeBankTransferMicroservice();
        $branchList = $nonRealTimeBankTransfer->getBranchList($bankCode,$request);
        return $branchList;
    }

    public function processBankRequest(Request $request){
        $bankId = $request->get('bank_list');
        $bankBranch = $request->get('branch_list');
        $bankIdName = explode('#',$bankId);
        $branchIdName = explode('#',$bankBranch);
        $amount = $request->get('amount');
        $accountNumber = $request->get('account_number');
        $accountName = $request->get('account_name');

        $nonRealTimeBankTransfer = new NchlNonRealTimeBankTransferMicroservice();
        $processRequest = $nonRealTimeBankTransfer->processPayment($bankIdName[0],$bankIdName[1],$branchIdName[0],$branchIdName[1],$amount,$accountNumber,$accountName,$request);
        $nonRealTime = NonRealTimeBankTransfer::where('transaction_id',$processRequest['cipsBatchResponse']['batchId'])->pluck('id')->first();
        if(isset($processRequest)){
            AdminNonRealTimeBankTransfer::create([
                'user_id' => auth()->user()->id,
                'non_real_time_id' => $nonRealTime,
                'transaction_id' => $processRequest['cipsBatchResponse']['batchId']
            ]);
        }
        return redirect()->route('nonRealTime.index');
    }

    public function viewNonBankTransferRequest(){
        $nonRealTimeBankTransferDetails = NonRealTimeBankTransfer::with('backendNonRealTime')->filter(request())->orderBy('created_at','DESC')->paginate(15);
        $admins = Admin::all();
        return view('WalletAPI::NonRealTimeBankTransfer.viewNonRealBankTransfer',compact('nonRealTimeBankTransferDetails','admins'));
    }

    public function checkStatus(Request $request,$id){
        $nonRealTimeBankTransfer = new NchlNonRealTimeBankTransferMicroservice();
        $responseStatus = $nonRealTimeBankTransfer->getTransactionResponse($id,$request);
        return redirect()->back()->with('success','Transaction status updated successfully');
    }

}
