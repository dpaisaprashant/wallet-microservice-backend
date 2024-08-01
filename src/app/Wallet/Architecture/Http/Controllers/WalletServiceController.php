<?php


namespace App\Wallet\Architecture\Http\Controllers;
use App\Traits\CollectionPaginate;
use App\Http\Controllers\Controller;
use App\Models\Architecture\WalletService;
use App\Models\Architecture\WalletTransactionType;
use Illuminate\Http\Request;

class WalletServiceController extends Controller{

    public function index(){
        $services = WalletService::latest()->paginate(10);
        return view('Architecture::WalletService.viewWalletService')->with(compact('services'));
    }

    public function create(){
        $all_wallet_transaction_id = WalletTransactionType::latest()->get();
        return view('Architecture::WalletService.createWalletService')->with(compact('all_wallet_transaction_id'));
    }

    public function store(Request $request){

        $all_wallet_transaction_id = WalletTransactionType::get();

        //setting the boolean values
        // if($request->get('validate_payment')== "Valid"){
        //     $validate_payment = 1;
        // }else{
        //     $validate_payment = 0;
        // }

        // if($request->get('handle_payment')=="Handle"){
        //     $handle_payment = 1;
        // }else{
        //     $handle_payment = 0;
        // }

        $valid = FALSE;
        foreach($all_wallet_transaction_id as $wallet_transaction_id)
        {
            if($request->get('wallet_transaction_type_id')== $wallet_transaction_id->id){
                $valid = TRUE;
                break;
            }
            else{
                $valid = FALSE;
            }
        }

        if($valid == FALSE){
            return redirect()->back()->with('error','Wallet Transaction Id not valid');
        }

        $walletService = new WalletService();
        $walletService->service = $request->get('service');
        $walletService->core_to_microservice_url = $request->get('microservice_url');
        $walletService->wallet_transaction_type_id = $request->get('wallet_transaction_type_id');
        $walletService->validate_payment = $request->get('validate_payment');
        $walletService->handle_payment = $request->get('handle_payment');
        
        $status = $walletService->save();

        if($status == true){
            return redirect()->route('wallet.service.view')->with('success','Wallet Service created successfully');
        }else{
            return redirect()->route('wallet.service.view')->with('error', 'Something went wrong!Please try again later');
        }

    }

    public function edit($id){
        $selectedWalletService = WalletService::findorFail($id);
        $all_wallet_transaction_id = WalletTransactionType::select('id','transaction_type')->groupBy('transaction_type')->get();
        return view('Architecture::WalletService.editWalletService')->with(compact('all_wallet_transaction_id','selectedWalletService'));
    }

    public function update(Request $request,$id){
        $all_wallet_transaction_id = WalletTransactionType::get();

        $valid = FALSE;
        foreach($all_wallet_transaction_id as $wallet_transaction_id)
        {
            if($request->get('wallet_transaction_type_id')== $wallet_transaction_id->id){
                $valid = TRUE;
                break;
            }
            else{
                $valid = FALSE;
            }
        }

        if($valid == FALSE){
            return redirect()->back()->with('error','Wallet Transaction Id not valid');
        }

        $selectedWalletService = WalletService::findorFail($id);
        $selectedWalletService->service = $request->get('service');
        $selectedWalletService->core_to_microservice_url = $request->get('microservice_url');
        $selectedWalletService->wallet_transaction_type_id = $request->get('wallet_transaction_type_id');
        $selectedWalletService->validate_payment=$request->get('validate_payment');
        $selectedWalletService->handle_payment=$request->get('handle_payment');


        $status = $selectedWalletService->save();
        if($status == true){
            return redirect()->route('wallet.service.view')->with('success','Wallet Service updated successfully');
        }else{
            return redirect()->route('wallet.service.view')->with('error', 'Something went wrong!Please try again later');
        }
    }

    public function delete($id){
        $selectedWalletService = WalletService::findorFail($id);
        $status = $selectedWalletService->delete();
        if($status == true){
            return redirect()->route('wallet.service.view')->with('success','Wallet Service deleted successfully');
        }else{
            return redirect()->route('wallet.service.view')->with('error', 'Something went wrong!Please try again later');
        }
    }
}
