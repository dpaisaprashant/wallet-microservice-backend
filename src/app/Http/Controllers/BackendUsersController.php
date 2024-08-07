<?php

namespace App\Http\Controllers;


use App\Models\AdminUserKYC;
use App\Traits\CollectionPaginate;
use App\Wallet\BackendUser\Repository\BackendUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Mail\OTPMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\AdminOTP;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;


class BackendUsersController extends Controller
{
    use CollectionPaginate;

    private $repository;

    public function __construct(BackendUserRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function view()
    {
        $users = Admin::with('roles')->where('status', 1)->paginate(10);
        return view('admin.backendUser.view')->with(compact('users'));
    }

    public function create(Request $request)
    {
        $allRoles = Role::get();

        if ($request->isMethod('post')) {
            $this->repository->create();
            return redirect()->route('backendUser.view')->with('success', 'Backend User Successfully Created');
        }

        return view('admin.backendUser.create')->with(compact('allRoles'));
    }

    public function permission($id, Request $request)
    {
        $user = Admin::where('id', $id)->firstOrFail();
        $permissions = $user->getAllPermissions();
        $allPermissions = Permission::get();

        if ($request->isMethod('post'))
        {
            $this->repository->updatePermission($allPermissions, $user);
            return redirect(route('backendUser.view'))->with('success', 'Permissions updated successfully');
        }

        return view('admin.backendUser.permissions')->with(compact('user', 'permissions', 'allPermissions'));
    }

    public function role($id, Request $request)
    {
        $user = Admin::with('roles')->where('id', $id)->firstOrFail();
        $allRoles = Role::get();

        if ($request->isMethod('post'))
        {
            $this->repository->updateRole($allRoles, $user);
            return redirect(route('backendUser.view'))->with('success', 'Roles updates successfully');
        }

        return view('admin.backendUser.roles')->with(compact('user', 'allRoles'));
    }

   public function kycList(Request $request)
    {
        $user = Admin::whereId(auth()->user()->id)->firstOrFail();
        $lists = $user->kycList($user, $request);
        return view('admin.backendUser.kycList')->with(compact('lists'));
    }


    public function resetPassword(Request $request)
    {
        Admin::where('id', $request->admin_id)->update(['password' => Hash::make('password')]);

        return redirect()->back();
    }

    public function profile(Request $request)
    {
        $admin = Admin::where('id', auth()->user()->id)->firstOrFail();

        if ($request->isMethod('post')) {
            $this->repository->updateProfile($admin);
            return redirect()->route('backendUser.profile');
        }

        return view('admin.backendUser.profile')->with(compact('admin'));
    }

    public function changePasswords (Request $request)
    {
        $admin = Admin::where('id', auth()->user()->id)->firstOrFail();
        if ($request->isMethod('post')) {
            //get opt

            $otpRecord = AdminOtp::where('admin_id', $admin->id)
                         ->first();

            
            if (!$otpRecord || $otpRecord->expires_on < now() || $otpRecord->status == 0) {
                return redirect()->route('backendUser.changePasswords')->with('error', 'Your OTP has expired created a new one to change your password');  
            }
            
            $changedPasswordSuccessful = $this->repository->changePassword();

            if (!$changedPasswordSuccessful) {
             

                return redirect()->route('backendUser.changePasswords')->with('error', 'Current password was invalid');
            }
            
            $otpRecord->update(['status' => 0]);
            
            return redirect()->route('backendUser.changePasswords')->with('success','Password updated Successfully!');
        }

        // dd('hello');
        return view('admin.backendUser.changePasswords')->with(compact('admin'));
    }



    public function changePassword(Request $request)
    {
        $admin = Admin::where('id', auth()->user()->id)->firstOrFail();

        if ($request->isMethod('post')) {
            $request->validate([
                'email' => 'required|email'
            ]);

            if ($admin->email === $request->input('email')) {
                $otp = Str::random(6); // You can use any method to generate OTP

                // Update and Create  OTP to admin_otps table
                $exp_time = now()->addSeconds(120);
                AdminOTP::updateOrCreate(
                    ['admin_id' => $admin->id], // Condition to check if the record exists
                    [
                        'token' => $otp,
                        'expires_on' => $exp_time, // OTP valid for 120 seconds
                        'status' => 0,
                    ]
                );
                
                // Send OTP to email
                Mail::to($admin->email)->send(new OTPMail($otp));
                    return redirect()->route('backendUser.verifyOtp')->with('success', 'Email send successfully at ' . $admin->email);

            } else {
                return redirect()->route('backendUser.changePassword')->with('error', 'Invalid email address.');
            }
        }

        return view('admin.backendUser.changePassword')->with(compact('admin'));
    }



    
    public function showOtpForm()
    {
        return view('admin.backendUser.verifyOtp');
    }

    public function verifyOtp(Request $request)
    {
        $admin = Admin::where('id', auth()->user()->id)->firstOrFail();
    
        $request->validate([
            'otp' => 'required|string',
        ]);
        $current_time = now();
        // dd($admin->id, $request->otp);

        $otpRecord = AdminOtp::where('admin_id', $admin->id)
                             ->where('token', $request->otp)
                             ->where('expires_on', '>', $current_time)
                             ->first();
    
        if ($otpRecord) {
            #Check otp status
            if ($otpRecord->status == 1) {
                return redirect()->route('backendUser.verifyOtp')->with('error', 'OTP has already been used.');
            }
            // Mark OTP as used
            $otpRecord->update(['status' => 1]);
            
            Log::info('After updating OTP status:', ['expires_on' => $otpRecord->expires_on]);

            // Redirect to the change password form
            return redirect()->route('backendUser.changePasswords')->with('success', 'OTP verified successfully! You can now change your password.');
        }
    
        return redirect()->route('backendUser.verifyOtp')->with('error', 'Invalid or expired OTP.');
    }
}

