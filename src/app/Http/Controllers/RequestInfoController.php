<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RequestInfo;

class RequestInfoController extends Controller
{
    
    public function index(Request $request)
    {
        $requestInfos = RequestInfo::paginate(20);
        
        return view('admin.transaction.requestInfo.index')->with(compact('requestInfos'));

    }

    public function detail(Request $request,$id)
    {
        $requestInfo = $repository->detail($id);

        dd($requestInfo);
        
        return view('admin.transaction.requestInfo.detail')->with(compact('requestInfo'));

    }

}
