<?php

namespace App\Http\Controllers;

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
        return view('admin.agent.view')->with(compact('users'));
    }

    public function create(Request $request)
    {
        $roles = Role::where('name', 'like', '%agent')->get();
        $users = User::doesnthave('agent')->doesnthave('merchant')->latest()->get();
        $agentTypes = AgentType::with('parentAgentType')->latest()->get();

        if ($request->isMethod('POST')) {
            if ( ! $this->repository->create()) {
                return redirect()->back()->with('error', 'Unsuccessful please try again');
            }
            return redirect()->route('agent.view');
        }

        return view('admin.agent.create')->with(compact('roles', 'users', 'agentTypes'));
    }

    public function edit($request, $id)
    {
        $agent = Agent::with('user', 'agentType', 'createdBy', 'codeUsed')->findOrFail($id);
        $agentTypes = AgentType::latest()->get();
        if ($request->isMethod('POST')) {
            $this->repository->edit($agent);

            return redirect()->route('agent.view')->with('success', 'Agent updated successfully');
        }

        return view('admin.agent.edit')->with(compact('agent', 'agentTypes'));
    }

    public function delete(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->detach();
        Agent::whereUserId($userId)->delete();
        return redirect()->back();
    }
}
