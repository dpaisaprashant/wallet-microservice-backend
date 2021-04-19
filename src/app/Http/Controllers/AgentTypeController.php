<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\AgentType;

use App\Models\Setting;
use App\Wallet\Agent\Repositories\AgentTypeRepository;
use App\Wallet\Setting\Traits\UpdateSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Validator;

class AgentTypeController extends Controller
{

    use UpdateSetting;

    public function view()
    {
        $agentTypes = AgentType::latest()->paginate(15);
        return view('admin.agentType.view')->with(compact('agentTypes'));
    }

    public function create(Request $request)
    {
        if ($request->isMethod('POST')) {

            try {
                DB::beginTransaction();
                $repository = new AgentTypeRepository($request);
                $repository->createAgentType();
            } catch (\Exception $e) {
                DB::rollBack();
                Log::info($e);
                return redirect()->route('agent.type.view')->with('error', 'Error while creating agent type');

            }
            DB::commit();

            return redirect()->route('agent.type.view')->with('success', 'Agent Type created successfully');
        }

        $parentAgents = AgentType::where('agent_type_id', null)->latest()->get();

        return view('admin.agentType.create')->with(compact('parentAgents'));
    }

    public function update(Request $request, AgentType $agentType)
    {
        if ($request->isMethod('POST')) {

            $agentType->update([
                'agent_type_id' => $request->agent_type_id,
                'default_cash_out_type' => $request->default_cash_out_type,
                'default_cash_out_value' => $request->default_cash_out_value,
                'default_cash_in_type' => $request->default_cash_in_type,
                'default_cash_in_value' => $request->default_cash_in_value,
            ]);

            return redirect()->back()->with('success', 'Agent Type updated successfully');

        }
        $parentAgents = AgentType::where('agent_type_id', null)->where('id', '!=', $agentType->id)->latest()->get();

        return view('admin.agentType.update')->with(compact('agentType', 'parentAgents'));

    }

    public function cashback($id, Request $request)
    {
        $agentType = AgentType::findOrFail($id);
        $agent = str_replace(" ", "_", $agentType->name);
        $agent = strtolower($agent);
        $agent = $agent . "_";

        $settings = $this->updatedSettingsCollection($request);
        if ($request->isMethod('POST')) {
            return redirect()->route('agent.type.cashback', $agentType->id);
        }

        return view('admin.agentType.cashbackSetting')->with(compact('agentType', 'settings', 'agent'));
    }

    public function limit($id, Request $request)
    {
        $agentType = AgentType::findOrFail($id);
        $agent = str_replace(" ", "_", $agentType->name);
        $agent = strtolower($agent);
        $agent = $agent . "_";

        $settings = $this->updatedSettingsCollection($request);
        if ($request->isMethod('POST')) {
            return redirect()->route('agent.type.limit', $agentType->id);
        }

        return view('admin.agentType.limitSetting')->with(compact('agentType', 'settings', 'agent'));
    }

    public function delete(Request $request, $id)
    {
        $agentType = AgentType::findOrFail($id);
        //dd($agentType, AgentType::where('agent_type_id', $id)->count() == 0);
        if (AgentType::where('agent_type_id', $id)->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete agent type containing sub agent types. Remove sub agent types before deleting this agent type');
        }

        if (Agent::where('agent_type_id', $id)->count() > 0) {
            return redirect()->back()->with('error', 'Cannot delete agent type because there are users belonging to this agent type. Remove agents from this agent type before deleting the agent type');
        }

        $agentType->delete();
        return redirect()->back()->with('success', 'Agent deleted successfully');
    }
}
