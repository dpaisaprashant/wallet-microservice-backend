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

        $userTypes = [
            "User Type" => UserType::class,
            "Agent Type" => AgentType::class,
            "Merchant Type" => MerchantType::class
        ];

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

        return view('Architecture::cashback.create')->with(compact('walletTransactionType', 'userTypes'));
    }

    public function update(Request $request, $id)
    {
        dd($id);
    }

    public function delete(Request $request)
    {
        dd($request->all());
    }
}
