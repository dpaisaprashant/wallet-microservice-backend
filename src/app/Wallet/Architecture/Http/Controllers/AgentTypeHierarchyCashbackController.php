<?php


namespace App\Wallet\Architecture\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Models\AgentType;
use App\Models\Architecture\AgentTypeHierarchyCashback;
use App\Models\Architecture\SingleUserCashback;
use App\Models\Architecture\WalletTransactionType;
use App\Models\Architecture\WalletTransactionTypeCashback;
use App\Models\Merchant\Merchant;
use App\Models\Merchant\MerchantType;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AgentTypeHierarchyCashbackController extends Controller
{
    public function index()
    {
        $agentTypeHierarchyCashbacks = AgentTypeHierarchyCashback::filter(request())->with('agentType', 'parentAgentType', 'walletTransactionType')->orderBy('created_at', 'DESC')->get();
        $agentTypes = AgentType::orderBy('created_at','DESC')->get();
        $walletTransactionTypes = WalletTransactionType::orderBy('created_at','DESC')->get();
        return view('Architecture::AgentTypeHierarchyCashback.viewAgentTypeHierarchyCashback', compact('agentTypeHierarchyCashbacks','agentTypes','walletTransactionTypes'));
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == 'edit') {

                if ($request->cashback_value < 0) {
                    return response()->json(['status' => false, 'message' => 'Cashback value cannot be in negative value'], 400);
                }

                if($request->cashback_value > 1000){
                    return response()->json(['status' => false, 'message' => 'Cashback value cannot be in greater than 1000'], 400);
                }

                if ($request->slab_from < 0) {
                    return response()->json(['status' => false, 'message' => 'Slab from cannot be in negative value'], 400);
                }

                if ($request->slab_to < 0) {
                    return response()->json(['status' => false, 'message' => 'Slab to cannot be in negative value'], 400);
                }

                if ($request->cashback_type == "PERCENTAGE") {
                    $cashback_value = $request->cashback_value;
                } elseif ($request->cashback_type == "FLAT") {
                    $cashback_value = $request->cashback_value * 100;
                }

                $agentTypeHierarchyCashback = AgentTypeHierarchyCashback::find($request->id);
                $oldSlabFrom = $agentTypeHierarchyCashback->slab_from;
                $oldSlabTo =$agentTypeHierarchyCashback->slab_to;

                if($oldSlabFrom != $request->slab_from || $oldSlabTo != $request->slab_to){
                    $agentTypeHierarchyCashback->create([
                        'agent_type_id' => $agentTypeHierarchyCashback->agent_type_id,
                        'parent_agent_type_id' => $agentTypeHierarchyCashback->parent_agent_type_id,
                        'cashback_value' => $agentTypeHierarchyCashback->cashback_value,
                        'cashback_type' => $agentTypeHierarchyCashback->cashback_type,
                        'slab_from' => $request->slab_from,
                        'slab_to' => $request->slab_to,
                        'description' => $agentTypeHierarchyCashback->description,
                        'wallet_transaction_type_id' => $agentTypeHierarchyCashback->wallet_transaction_type_id
                    ]);
                }else {
                    $agentTypeHierarchyCashback->title = $request->title;
                    $agentTypeHierarchyCashback->cashback_type = $request->cashback_type;
                    if(is_numeric($cashback_value) || $cashback_value == null) {
                        $agentTypeHierarchyCashback->cashback_value = $cashback_value;
                    }else{
                        return response()->json(['status' => false, 'message' => 'Cashback value should be an integer'], 400);
                    }
                    if(is_numeric($request->slab_from) || $request->slab_from == null) {
                        $agentTypeHierarchyCashback->slab_from = $request->slab_from;
                    }else{
                        return response()->json(['status' => false, 'message' => 'Slab from should be an integer'], 400);
                    }
                    if(is_numeric($request->slab_to) || $request->slab_to == null) {
                        $agentTypeHierarchyCashback->slab_to = $request->slab_to;
                    }else{
                        return response()->json(['status' => false, 'message' => 'Slab to should be an integer'], 400);
                    }
                    $agentTypeHierarchyCashback->description = $request->description;
                    $agentTypeHierarchyCashback->save();
                }
                return response()->json(['updated_data' => $agentTypeHierarchyCashback]);

            }

            if ($request->action == "delete") {
                Log::info('delete function bhitra');
                $agentTypeHierarchyCashback = AgentTypeHierarchyCashback::where('id', $request->id)->delete();
                return response()->json(['deleted_data' => $agentTypeHierarchyCashback, 'id' => $request->id]);
            }
        }
    }
}
