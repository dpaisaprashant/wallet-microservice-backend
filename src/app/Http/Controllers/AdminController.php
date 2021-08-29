<?php

namespace App\Http\Controllers;

use App\Events\SendOTPCodeEvent;
use App\Models\AdminOTP;
use App\Models\Clearance;
use App\Models\TransactionEvent;
use App\Models\Admin;
use App\Models\User;
use App\Models\UserExecutePayment;
use App\Wallet\Dashboard\Repository\DashboardRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index(DashboardRepository $repository)
    {
        $kycNotFilledUserCount = $repository->totalKYCNotFilledUsersCount();
        $kycFilledUserCount = $repository->totalKYCFilledUsersCount();

//        $successfulTransactionCount = $repository->successfulTransactionCount();
//        $successfulTransactionSum = $repository->successfulTransactionSum();

        //$npayClearedTransactions = (new Clearance())->npayClearedTransactions();
        //$paypointClearedTransactions = (new Clearance())->paypointClearedTransactions();

       /* $acceptedKycs = (new Admin())->acceptedKycs();
        $rejectedKycs = (new Admin())->rejectedKycs();*/

        $acceptedKycsCount = (new Admin())->acceptedKycsCount();
        $rejectedKycsCount = (new Admin())->rejectedKycsCount();


        $now = Carbon::now();
        $month = $now->format('m');
        $year = $now->format('Y');

        //Npay graph
//        $nPayTransactions = $repository->monthNPayTransactions($year, $month);
//        $nPayGraph = json_encode($repository->transactionGraph($nPayTransactions));

        //payPoint graph
//        $transactions = $repository->monthPayPointTransactions($year, $month);
//        $graph = json_encode($repository->transactionGraph($transactions));

//        $monthTransactionCount = [
//          'npay' => $nPayTransactions->count(),
//          'paypoint' => $transactions->count()
//        ];

//        $monthTransactionAmount = [
//            'npay' => $nPayTransactions->sum('amount'),
//            'paypoint' => $transactions->sum('amount')
//        ];
//
//        $yearTransactionCount = $repository->yearTransactionCounts($year);
//        $yearTransactionAmount = $repository->yearTransactionSums($year);


        //Highest Transactions
//        $highestTransactions = TransactionEvent::with('user')->orderBy('amount', 'DESC')->take(7)->get();

        //Execute Payment
        //$executePayments = UserExecutePayment::latest()->take(30)->pluck('time_elapsed', 'refStan_request');
        //$executePayments = json_encode($executePayments);

        return view('admin.dashboard')
            ->with(compact(
//                'yearTransactionAmount', 'yearTransactionCount',
//                'monthTransactionAmount','monthTransactionCount',
                'kycFilledUserCount', 'kycNotFilledUserCount',
//                'successfulTransactionCount',
//                'successfulTransactionSum',
                'month', 'year',
//                'graph','nPayGraph',
//                'highestTransactions',
//                 'executePayments',
                'acceptedKycsCount', 'rejectedKycsCount'));
    }

    public function payPointYearly(Request $request)
    {
        $now = Carbon::now();
        $year = $now->format('Y');

        //get current year transaction
        $transactions = TransactionEvent::whereYear('created_at', '=', $year)
            ->whereTransactionType('App\Models\UserTransaction')
            ->with('transactionable')
            ->get();

        $groupedTransactions =  $transactions
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('F');
            });

        //return num of transactions and sum of transaction amount in each grouped date
        $groupedTransactions->transform(function ($value, $key) {
            return [
                'count' => round(count($value), 0),
                'amount' => round($value->sum('amount'), 2),
                'userCount' =>  round($value->groupBy('user_id')->count(), 0) //number of unique users involved
            ];
        });

        return [
            'graph' => $groupedTransactions,
        ];
    }

    public function nPayYearly(Request $request)
    {
        $now = Carbon::now();
        $year = $now->format('Y');

        //get current year transaction
        $transactions = TransactionEvent::whereYear('created_at', '=', $year)
            ->whereTransactionType('App\Models\UserLoadTransaction')
            ->with('transactionable')
            ->get();

        $groupedTransactions =  $transactions
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('F');
            });

        //return num of transactions and sum of transaction amount in each grouped date
        $groupedTransactions->transform(function ($value, $key) {
            return [
                'count' => round(count($value), 0),
                'amount' => round($value->sum('amount'), 2),
                'userCount' =>  round($value->groupBy('user_id')->count(), 0) //number of unique users involved
            ];
        });

        return [
            'graph' => $groupedTransactions,
        ];
    }

    private function checkOldSession($userId)
    {
        $admin = Admin::with('session')->whereId($userId)->firstOrFail();
        $nowInTimeStamp = strtotime(now() . '- '. config('session.lifetime').' minutes');

        $oldSessions = \App\Models\Session::where('user_id', $admin->id)->where('expired', '=', null)->where('last_activity', '<', $nowInTimeStamp )
            ->update(['expired' => 1]);

        $userSessionCount = \App\Models\Session::whereUserId($userId)->whereExpired(null)->count();

        if ($userSessionCount) {
            return false;
        }
        return true;


    }

    public function login(Request $request){
        if ($request->isMethod('post'))
        {
            $data = $request->input();
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                $admin = Admin::whereId(auth()->user()->id)->first();
               /* event(new SendOTPCodeEvent($admin));
                Auth::logout();
                return redirect()->route('admin.login.otp');*/

                if (!$this->checkOldSession($admin->id)) {
                    Auth::logout();
                    return redirect()->route('admin.login')->with('error', 'Already logged in from another session');
                }

                return redirect()->route('admin.dashboard');

            } else {
                return redirect()->back()->with('error', 'Invalid Username or Password');
            }
        }
        return view('admin.login');
    }

    public function loginOTP(Request $request)
    {
        if ($request->isMethod('post')) {

            $otp = (new AdminOTP)->checkValidToken($request->otp);

            if (!$otp) {
                return redirect()->back()->with('error', 'Invalid OTP');
            }

            if ($otp->admin_id) {
                $user = Admin::where('id', $otp->admin_id)->first();

                if (!$user) {
                    return redirect()->back()->with('error', 'User not found');
                }

                if (!$this->checkOldSession($otp->admin_id)) {
                    return redirect()->route('admin.login')->with('error', 'Already logged in from another session');
                }
                Auth::loginUsingId($user->id);
            }
            return redirect()->route('admin.login')->with('error', 'Invalid OTP');
        }
        return view('admin.otp');
    }

    public function logout()
    {
        \App\Models\Session::where('user_id', auth()->user()->id)->where('expired', '=', null)
            ->update(['expired' => 1]);
        Auth::logout();
        Session::Migrate(false); // prevents user_id from being destroyed in session table
        return redirect()->route('admin.login')->with('flash_message_success', 'Logout Successful');
    }

}
