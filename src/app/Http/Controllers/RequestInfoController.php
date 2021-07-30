<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\RequestInfo;
use Illuminate\Support\Facades\View;

class RequestInfoController extends Controller
{
    public function index(Request $request)
    {
        $microServiceTypes = RequestInfo::groupBy('microservice_type')->pluck('microservice_type')->toArray();
   
        View::share('microServiceTypes', $microServiceTypes);

        $serviceTypes = RequestInfo::groupBy('service_type')->pluck('service_type')->toArray();
   
        View::share('serviceTypes', $serviceTypes);

        $getAllUniqueVendors = RequestInfo::groupBy('vendor')->pluck('vendor')->toArray();
   
        View::share('getAllUniqueVendors', $getAllUniqueVendors);

        $status = RequestInfo::groupBy('status')->pluck('status')->toArray();
   
        View::share('status', $status);

        $requestInfos = RequestInfo::filter($request)->paginate(20);
        
        return view('admin.transaction.requestInfo.index')->with(compact('requestInfos'));

    }

}
