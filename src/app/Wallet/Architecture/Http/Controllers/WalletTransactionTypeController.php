<?php


namespace App\Wallet\Architecture\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\AgentType;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantType;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class WalletTransactionTypeController extends Controller
{
    public function vendorTransactions(Request $request, $vendorName)
    {
        $walletTransactionTypes = WalletTransactionType::where('vendor', $vendorName)->get();
        return view('Architecture::walletTransactionTypes')->with(compact('walletTransactionTypes', 'vendorName'));
    }

    public function getUserTransactionTypeList(Request $request)
    {

        $userType = $request->user_type;
        \Log::info(User::class);
        \Log::info(UserType::class);
        if ($userType == UserType::class) {
            \Log::info('ok');
            $list =  UserType::get();
        } elseif ($userType == AgentType::class) {
            $list = AgentType::get();
        } elseif ($userType == MerchantType::class) {
            $list =  MerchantType::get();
        }

        if (isset($list)) {
            return $list->transform(function ($value) {
                return ["id" => $value->id, "name" => $value->name];
            });
        }
        return false;
    }


    public function getUserList(Request $request)
    {
        $userType = $request->user_type;
        if ($userType == User::class) {
            $list = User::latest()->get();
        }elseif ($userType == Merchant::class) {
            $list =  Merchant::latest()->get();
        }

        if (isset($list)) {
            return $list->transform(function ($value) {
                return ["id" => $value->id, "name" => $value->name . " (" . $value->mobile_no . ")"];
            });
        }
        return false;
    }
}
