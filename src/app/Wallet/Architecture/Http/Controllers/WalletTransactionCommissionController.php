<?php


namespace App\Wallet\Architecture\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\AgentType;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCashback;
use App\Models\Architecture\WalletTransactionTypeCommission;
use App\Models\Merchant\MerchantType;
use App\Models\UserType;
use Illuminate\Http\Request;

class WalletTransactionCommissionController extends Controller
{
    public function index($walletTransactionTypeId, Request $request)
    {
        $walletTransactionType = WalletTransactionType::with('walletTransactionTypeCashbacks')
            ->where('id', $walletTransactionTypeId)
            ->first();

        return view('Architecture::commission.index')->with(compact('walletTransactionType'));
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

        $availableTitles = WalletTransactionTypeCommission::where('wallet_transaction_type_id', $walletTransactionType->id)
            ->distinct()
            ->pluck('title')->all();

        if ($request->isMethod('POST')) {

            $commission = WalletTransactionTypeCommission::updateorCreate(
                [
                    'wallet_transaction_type_id' => $walletTransactionType->id,
                    'user_type' => $request->user_type,
                    'user_type_id' => $request->user_type_id,
                    'slab_from' => $request->slab_from ?? null,
                    'slab_to' => $request->slab_to ?? null
                ],
                [
                    'title' => $request->title,
                    'commission_type' => $request->commission_type,
                    'commission_value' => $request->commission_value,
                    'description' => null
                ]
            );

            return redirect()->route('architecture.transaction.commission', $id)->with('success', 'Commission created successfully');
        }

        return view('Architecture::commission.create')->with(compact('walletTransactionType', 'userTypes', 'availableTitles'));
    }

    public function update(Request $request, $id)
    {
        dd($id);
    }

    public function delete(Request $request)
    {
        $cashback = WalletTransactionTypeCommission::where('id', $request->id)->firstOrFail();
        $cashback->delete();

        return redirect()->back()->with('success', 'Commission deleted successfully');
    }
}
