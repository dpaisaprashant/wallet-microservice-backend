<?php


namespace App\Wallet\Architecture\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\AgentType;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCashback;
use App\Models\Merchant\MerchantType;
use App\Models\UserType;
use Illuminate\Http\Request;

class WalletTransactionCashbackController extends Controller
{
    public function index($walletTransactionTypeId, Request $request)
    {
        $walletTransactionType = WalletTransactionType::with('walletTransactionTypeCashbacks')
            ->where('id', $walletTransactionTypeId)
            ->first();

        return view('Architecture::cashback.index')->with(compact('walletTransactionType'));
    }

    public function create(Request $request, $id)
    {
        $walletTransactionType = WalletTransactionType::where('id', $id)
            ->first();
        $user = $request->user(); //currently logged in user

        $userTypes = [];
        if ($user->hasAnyPermission('Add cashback to user type')) {
            $userTypes["User Type"] = UserType::class;
        }

        if ($user->hasAnyPermission('Add cashback to merchant type')) {
            $userTypes["Merchant Type"] = MerchantType::class;
        }

        if($user->hasAnyPermission('Add cashback to agent type')){
            $userTypes['Agent Type'] = AgentType::class;
        }


        $availableTitles = WalletTransactionTypeCashback::where('wallet_transaction_type_id', $walletTransactionType->id)
            ->distinct()
            ->pluck('title')->all();

        if ($request->isMethod('POST')) {

            $cashback = WalletTransactionTypeCashback::updateorCreate(
                [
                    'wallet_transaction_type_id' => $walletTransactionType->id,
                    'user_type' => $request->user_type,
                    'user_type_id' => $request->user_type_id,
                    'slab_from' => $request->slab_from ?? null,
                    'slab_to' => $request->slab_to ?? null
                ],
                [
                    'title' => $request->title,
                    'cashback_type' => $request->cashback_type,
                    'cashback_value' => $request->cashback_value,
                    'description' => null
                ]
            );

            return redirect()->route('architecture.transaction.cashback', $id)->with('success', 'CashBack created successfully');
        }

        return view('Architecture::cashback.create')->with(compact('walletTransactionType', 'userTypes', 'availableTitles'));
    }

    public function update(Request $request, $id)
    {
        dd($id);
    }

    public function delete(Request $request)
    {
        $cashback = WalletTransactionTypeCashback::where('id', $request->id)->firstOrFail();
        $cashback->delete();

        return redirect()->back()->with('success', 'Cashback deleted successfully');
    }
}
