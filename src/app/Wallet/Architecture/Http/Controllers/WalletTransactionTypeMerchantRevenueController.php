<?php

namespace App\Wallet\Architecture\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AgentType;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeMerchantRevenue;
use App\Models\Merchant\MerchantType;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class WalletTransactionTypeMerchantRevenueController extends Controller
{
    public function index($walletTransactionTypeId, Request $request)
    {
        $walletTransactionType = WalletTransactionType::with('walletTransactionTypeMerchantRevenue')
            ->where('id', $walletTransactionTypeId)
            ->first();
        return view('Architecture::merchantRevenue.index')->with(compact('walletTransactionType'));
    }

    public function create(Request $request, $id)
    {
        $walletTransactionType = WalletTransactionType::where('id', $id)
            ->first();

        $user = $request->user();
        $userTypes = [];

        if($user->hasAnyPermission('Add commission to user type')){
            $userTypes['User Type'] = UserType::class;
        }

        if($user->hasAnyPermission('Add commission to merchant type')){
            $userTypes['Merchant Type'] = MerchantType::class;
        }

        if($user->hasAnyPermission('Add commission to agent type')){
            $userTypes['Agent Type'] = AgentType::class;
        }

        $availableTitles = WalletTransactionTypeMerchantRevenue::where('wallet_transaction_type_id', $walletTransactionType->id)
            ->distinct()
            ->pluck('title')->all();

        $merchants = User::with('merchant')->has('merchant')->get();


        if ($request->isMethod('POST')) {
            $merchantRevenue = WalletTransactionTypeMerchantRevenue::updateorCreate(
                [
                    'wallet_transaction_type_id' => $walletTransactionType->id,
                    'slab_from' => $request->slab_from ?? null,
                    'slab_to' => $request->slab_to ?? null
                ],
                [
                    'title' => $request->title,
                    'merchant_revenue_type' => $request->merchant_revenue_type,
                    'merchant_revenue_value' => $request->merchant_revenue_value,
                    'description' => $request->description ?? null,
                    'user_id' => $request->user_id,
                ]
            );


            return redirect()->route('architecture.wallet.merchantRevenue', $id)->with('success', 'Merchant Revenue created successfully');
        }

        return view('Architecture::merchantRevenue.create')->with(compact('walletTransactionType', 'userTypes', 'availableTitles','merchants'));
    }

    public function delete(Request $request)
    {
        $merchantRevenue = WalletTransactionTypeMerchantRevenue::where('id', $request->id)->firstOrFail();
        $merchantRevenue->delete();

        return redirect()->back()->with('success', 'Merchant Revenue Deleted Successfully deleted successfully');
    }

}
