<?php


namespace App\Wallet\Architecture\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\AgentType;
use App\Models\Architecture\WalletTransactionBonus;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCashback;
use App\Models\Merchant\MerchantType;
use App\Models\UserType;
use Illuminate\Http\Request;

class WalletBonusController extends Controller
{
    public function index($walletTransactionTypeId){
        $walletTransactionType = WalletTransactionType::with('walletTransactionBonus')
            ->where('id',$walletTransactionTypeId)
            ->first();
        return view('Architecture::bonus.user.index',compact('walletTransactionType'));
    }

    public function create($id){
        $titleArray = array();
        $walletTransactionType = WalletTransactionType::where('id',$id)->first();
        $availableTitles = WalletTransactionBonus::where('wallet_transaction_type_id', $walletTransactionType->id)
            ->distinct()
            ->pluck('title')->all();



        $cashBackTitle = WalletTransactionTypeCashback::where('wallet_transaction_type_id',$walletTransactionType->id)
            ->distinct()
            ->pluck('title')
            ->all();
        $merge = array_merge($availableTitles,$cashBackTitle);
        $titleArray = $merge;
        /*dd($titleArray);*/
        $userTypes = [
            "User Type" => UserType::class,
            "Merchant Type" => MerchantType::class,
            "Agent Type" => AgentType::class
        ];
        return view('Architecture::bonus.create',compact('walletTransactionType','titleArray','userTypes'));
    }

    public function store($id,Request $request){
        $bonusPoint = WalletTransactionBonus::create([
            'title' => $request->title,
            'wallet_transaction_type_id' => $id,
            'user_type_id' => $request->user_type_id,
            'user_type' => $request->user_type,
            'point_type' => $request->bonus_point_type,
            'point_value' => $request->bonus_point_value,
            'slab_from' => $request->slab_from,
            'slab_to' => $request->slab_to,
            'description' => $request->description
        ]);
        return redirect()->route('walletBonus.index', $id)->with('success', 'Bonus Point created successfully');
    }

    public function delete($id){
        $bonusPoint = WalletTransactionBonus::where('id',$id)->firstOrFail();
        $bonusPoint->delete();
        return redirect()->back()->with('success', 'Bonus point deleted successfully');
    }

}
