<?php


namespace App\Wallet\Report\Repositories;


use App\Models\Admin;
use App\Models\AdminUserKYC;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use App\Traits\CollectionPaginate;

class AdminKycRepository extends AbstractReportRepository
{
    use CollectionPaginate;

    public function getAdminAllData(){
        $getAdminData = AdminUserKYC::pluck('admin_id');
        $getAdminDataPersonalDetails = Admin::whereIn('id',$getAdminData)

            ->get()
            ->transform(function ($value) {
                //query to get latest row ids from adminUserKyc where groupBy kyc_id
                $adminUsersKycIds = AdminUserKYC::pluck('id');

                //query to count accepted/rejected Kyc whereIn ids from above query
                $value->accept_count = AdminUserKYC::where('admin_id',$value->id)->where('status', AdminUserKYC::ACCEPTED)->whereIn('id',$adminUsersKycIds)->filter(request())->count();
                $value->reject_count = AdminUserKYC::where('admin_id',$value->id)->where('status',AdminUserKYC::REJECTED)->whereIn('id',$adminUsersKycIds)->filter(request())->count();
                return $value;
            });


        return $getAdminDataPersonalDetails;
    }

//    public function getAdminPersonalDetails(){
//
//    }

}
