<?php


namespace App\Wallet\NPSAccountLinkLoad\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Traits\CollectionPaginate;
use Illuminate\Http\Request;
use App\Models\NPSAccountLinkLoad;
use Illuminate\Support\Facades\View;
use App\Models\Microservice\PreTransaction;
use App\Traits\BelongsToUser;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class NPSAccountLinkLoadController extends Controller
{


    public function view(Request $request)
    {

        $load_status = NPSAccountLinkLoad::groupBy('load_status')->pluck('load_status')->toArray();

        View::share('load_status', $load_status);

        $npsAccountLinkLoads = NPSAccountLinkLoad::with('preTransaction')->filter($request)->paginate(20);

        return view('NPSAccountLinkLoad::viewNPSAccountLinkLoad',compact('npsAccountLinkLoads'));
    }

    public function viewDetails(Request $request, $id)
    {
        $npsAccountLinkLoad = NPSAccountLinkLoad::with('preTransaction')->find($id);
        return view('NPSAccountLinkLoad::transactionReport')->with(compact('npsAccountLinkLoad'));
    }



}
