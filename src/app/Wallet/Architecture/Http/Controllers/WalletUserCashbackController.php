<?php


namespace App\Wallet\Architecture\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\AgentType;
use App\Models\Architecture\SingleUserCashback;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCashback;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantType;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;

class WalletUserCashbackController extends Controller
{
    public function index($walletTransactionTypeId, Request $request)
    {
        $walletTransactionType = WalletTransactionType::with('singleUserCashbacks')
            ->where('id', $walletTransactionTypeId)
            ->first();

        return view('Architecture::cashback.user.index')->with(compact('walletTransactionType'));
    }

    public function create(Request $request, $id)
    {
        $walletTransactionType = WalletTransactionType::where('id', $id)
            ->first();

        $userTypes = [
            "User Type" => User::class,
            "Merchant Type" => Merchant::class
        ];

        if ($request->isMethod('POST')) {

            SingleUserCashback::updateOrCreate(
                [
                    'wallet_transaction_type_id' => $walletTransactionType->id,
                    'user_id' => $request->user_id,
                    'user_type' => $request->user_type,
                    'slab_from' => $request->slab_from,
                    'slab_to' => $request->slab_to,
                ],
                [
                    'title' => $request->title,
                    'cashback_type' => $request->cashback_type,
                    'cashback_value' => $request->cashback_value,
                    'description' => $request->description
                ]
            );

            return redirect()->route('architecture.user.cashback', $id)->with('success', 'CashBack created successfully');
        }

        return view('Architecture::cashback.user.create')->with(compact('walletTransactionType', 'userTypes'));
    }

    public function update(Request $request, $id)
    {
        dd($id);
    }

    public function delete(Request $request)
    {
        $cashback = SingleUserCashback::firstOrFail($request->id);
        $cashback->delete();

        return redirect()->back()->with('success', 'Cashback deleted successfully');
    }
}
