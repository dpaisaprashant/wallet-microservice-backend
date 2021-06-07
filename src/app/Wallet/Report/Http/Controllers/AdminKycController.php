<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Traits\CollectionPaginate;

use App\Wallet\Report\Repositories\AdminKycRepository;
use Illuminate\Http\Request;

class AdminKycController extends Controller
{
    use CollectionPaginate;

    public function getAdminData(Request $request){
        $repository = new AdminKycRepository($request);
        $fromData = $request->get('from');
        $getAdminDatas = $repository->getAdminAllData($fromData);
        return view('WalletReport::AdminKyc.report',compact('getAdminDatas'));
    }

}
