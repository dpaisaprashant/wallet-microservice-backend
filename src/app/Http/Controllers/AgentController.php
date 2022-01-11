<?php

namespace App\Http\Controllers;

use App\Models\AdminAlteredAgent;
use App\Models\Agent;
use App\Models\AgentType;
use App\Models\Role;
use App\Models\User;
use App\Wallet\Agent\Repositories\AgentRepository;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    private $repository;

    public function __construct(AgentRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function view()
    {
        $users = $this->repository->paginatedUsers();
        $agentStatus = Agent::select('status')->distinct()->get();
        return view('admin.agent.view')->with(compact('users','agentStatus'));
    }

    public function create(Request $request)
    {

        $roles = Role::where('name', 'like', '%agent')->get();
        $users = User::doesnthave('agent')
            ->doesnthave('merchant')
            ->whereHas('kyc', function ($query) {
                return $query->where('accept', 1);
            })
            ->latest()
            ->get();
        $agentTypes = AgentType::with('parentAgentType')->latest()->get();
        $parentAgents = Agent::with('user')->latest()->get();
        if ($request->isMethod('POST')) {
            if ( ! $this->repository->create()) {
                return redirect()->back()->with('error', 'Unsuccessful please try again');
            }
            return redirect()->route('agent.view')->with('success', 'Agent has been created');
        }

        return view('admin.agent.create')->with(compact('roles', 'users', 'agentTypes','parentAgents'));
    }

    public function edit(Request $request, $id)
    {
        $agent = Agent::with('user', 'agentType', 'createdBy', 'codeUsed')->findOrFail($id);
        $agentTypes = AgentType::latest()->get();
        $parentAgents = Agent::with('user')->latest()->get();
        if ($request->isMethod('POST')) {
            if($this->repository->edit($agent)) {
                return redirect()->route('agent.view')->with('success', 'Agent updated successfully');
            }
            else{
                return redirect()->back()->with('error', 'Unsuccessful please try again');
            }
        }

        return view('admin.agent.edit')->with(compact('agent', 'agentTypes','parentAgents'));
    }

    public function delete(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->detach();
        Agent::where('code_used_id', $userId)->update(["code_used_id" => null]);
        Agent::whereUserId($userId)->delete();
        return redirect()->back();
    }

    public function showAdminAlteredAgents()
    {
        $adminAlteredAgents = AdminAlteredAgent::filter(request())->with('admin','agent')->latest()->paginate(10);
        return view('admin.agent.AdminAlteredAgent')->with(compact('adminAlteredAgents'));
    }

}
