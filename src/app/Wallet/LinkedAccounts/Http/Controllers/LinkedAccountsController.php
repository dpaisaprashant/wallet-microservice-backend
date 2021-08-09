<?php


namespace App\Wallet\LinkedAccounts\Http\Controllers;


use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use App\Models\LinkedAccounts;
use Illuminate\Support\Facades\View;

class LinkedAccountsController extends Controller
{
   

    public function view(Request $request)
    {
        
        $verified_status = LinkedAccounts::groupBy('verified_status')->pluck('verified_status')->toArray();
       
        View::share('verified_status', $verified_status);

        $register_status = LinkedAccounts::groupBy('register_status')->pluck('register_status')->toArray();
       
        View::share('register_status', $register_status);

        $LinkedAccounts = LinkedAccounts::filter($request)->paginate(20);
        
        return view('LinkedAccounts::viewLinkedAccounts',compact('LinkedAccounts'));
    }

   
    
}
