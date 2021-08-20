<?php


namespace App\Wallet\Report\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Wallet\Report\Repositories\IndividualReconciliationReportRepositry;
use App\Wallet\Report\Repositories\MismatchedReconciliationRepository;
use App\Wallet\Report\Repositories\NchlLoadReportRepository;
use App\Wallet\Report\Repositories\ReconciliationReportRepository;
use App\Wallet\Report\Traits\IndividualReconciliationReportGenerator;
use App\Wallet\Report\Traits\ReconciliationReportGenerator;
use Illuminate\Http\Request;

class WalletReportController extends Controller
{

    use ReconciliationReportGenerator;

    public function reconciliationReport(Request $request)
    {
        $repository = new ReconciliationReportRepository($request);
        $usersId = User::pluck('id');
        $totalAmounts = $this->generateReport($repository,$usersId);

        $totalLoadAmount = $repository->totalLoadAmount() / 100;
        $totalPaymentAmount = $repository->totalPaymentAmount() / 100;

        $totalWalletBalance = $repository->totalWalletBalanceAmount() / 100;
        $totalBonusBalance = $repository->totalBonusBalanceAmount() / 100;

        $mainBalance = $repository->totalMainBalanceAmount() / 100;

        return view('WalletReport::reconciliation.report')->with(compact('totalAmounts', 'totalLoadAmount', 'totalPaymentAmount','totalWalletBalance','totalBonusBalance','mainBalance'));
    }


    public function mismatchedReport(Request $request){

        //1. get list of all users
        //2. for each  user calculate main balance
        //3. for each user calculate reconciliation report main (total load - total payments)
        //4.if value of step 2 != value of step3
            //4.1. Store the mismatched user in a new array
        //5. Display the mismatched users array

      /*  $users = User::with('wallet')->latest()->get();
        foreach ($users as $user) {

            $userWalletMainBalance = $user->wallet->main_balance;
            $request->merge([
                'individual_user_number' => $user->mobile_no
            ]);
            $repository = new ReconciliationReportRepository($request);
            $userReportMainBalance = $repository->totalLoadAmount() - $repository->totalPaymentAmount();
            dd($userReportMainBalance,$userWalletMainBalance,$user);
            if ($userWalletMainBalance != $userReportMainBalance) {

            }*/
  /*      $userId = User::pluck('id');
        $walletBalance = User::with('wallet')->latest()->get();
        foreach($walletBalance as $value){
            $item[$value->wallet->id] = $value->wallet->balance + $value->wallet->bonus_balance;
        }*/
//        dd($item);
      /*  $users = User::with('wallet')->latest()->get();
        $misMatchArray = [];
        $repository = new ReconciliationReportRepository($request);


        foreach($users as $user){
            $walletMainBalance = $user->wallet->main_balance;
            $request->merge([
                'individual_user_number' => $user->mobile_no,
            ]);
            $repository = new ReconciliationReportRepository($request);

            $userMainBalance = $repository->totalLoadAmount() - $repository->totalPaymentAmount();
            if($walletMainBalance != $userMainBalance){
                $misMatchArray[] = array(
                    'walletMainBalance' => $walletMainBalance / 100,
                    'userMainBalance' => $userMainBalance / 100,
                    'mobileNumber' => $user->mobile_no
                );
            }

        }

        return view('WalletReport::reconciliation.misMatchReconciliation',compact('misMatchArray'));*/
    }

    public function customerActivityReport(Request $request)
    {
        return view('WalletReport::customerActivity.report');
    }

    public function nchlLoadReport(Request $request)
    {
        $repository = new NchlLoadReportRepository($request);
        $services = $repository->generateServiceReport();

        return view('WalletReport::nchlLoad.report')->with(compact('services'));
    }
}
