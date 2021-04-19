<?php


namespace App\Wallet\Agent\Repositories;


use App\Models\Agent;
use App\Models\AgentType;
use App\Models\Role;
use App\Models\User;
use App\Traits\CollectionPaginate;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\User\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentRepository
{
    use CollectionPaginate;

    private $request;

    private $length = 15;

    private $user;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->user = User::whereHas('agent');
    }

    /**
     * @param int $length
     * @return AgentRepository
     */
    public function setLength(int $length)
    {
        $this->length = $length;
        return $this;
    }

    private function addRoleToUser($users)
    {
        if (count($users)) {
            foreach ($users as $user) {
                //$role = $user->roles()->where('name', 'like', '%agent')->first();
                $user['agent_type'] = 'agent';
            }
        }

        return $users;
    }

    private function sendNotification($user, $title, $description, $type)
    {
        $user->notify(new \App\Notifications\FCMNotification(
            $user,
            $title,
            $description,
            $type
        ));
    }

    private function wallerBalanceSorted()
    {
        $unsortedUsers = $this->user->with('agent', 'wallet', 'userTransactionEvents')->filter($this->request)->get();

        $users = $unsortedUsers->map(function ($value, $key) {
            $value['balance'] = $value->wallet->balance;
            return $value;
        })->sortByDesc('balance');

        return $this->collectionPaginate($this->length, $users, $this->request);
    }

    private function transactionPaymentSorted()
    {
        $unsortedUsers = $this->user->with('agent', 'wallet', 'userTransactionEvents')->filter($this->request)->get();

        $users = $unsortedUsers->map(function (User $value, $key) {
            $value['amount_sum'] = $value->totalTransactionPaymentAmount();
            return $value;
        })->sortByDesc('amount_sum');

        return $this->collectionPaginate($this->length, $users, $this->request);
    }

    private function transactionLoadSorted()
    {
        $unsortedUsers = $this->user->with('agent', 'wallet', 'userTransactionEvents')->filter($this->request)->get();

        $users = $unsortedUsers->map(function (User $value, $key) {
            $value['amount_sum'] = (float)$value->totalLoadFundAmount();
            return $value;
        })->sortByDesc('amount_sum');

        return $this->collectionPaginate($this->length, $users, $this->request);
    }


    private function sortedUsers()
    {
        return $this->user->with('agent', 'wallet', 'userTransactionEvents')->filter($this->request)->paginate($this->length);
    }

    private function latestUsers()
    {
        return $this->user->with('agent', 'wallet', 'userTransactionEvents')->latest()->filter($this->request)->paginate($this->length);
    }

    public function paginatedUsers()
    {
        if ($this->request->sort == 'wallet_balance') {
            $user = $this->wallerBalanceSorted();
        } elseif ($this->request->sort == 'transaction_payment') {
            $user = $this->transactionPaymentSorted();
        } elseif ($this->request->sort == 'transaction_loaded') {
            $user = $this->transactionLoadSorted();
        } elseif (empty($this->request->sort)) {
            $user = $this->latestUsers();
        } else {
            $user = $this->sortedUsers();
        }
        return $this->addRoleToUser($user);
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            $user = User::whereId($this->request->user_id)->firstOrFail();
            if ($user->isAgent()) return false;

            $data = [
                'role_id' => (new Role())->agentRole()->id
            ];
            $user->roles()->sync($data);

            $agentType = AgentType::whereId($this->request->agent_type_id)->first();

            $agentData = [
                'user_id' => $user->id,
                'business_pan' => $this->request->business_pan,
                'business_name' => $this->request->business_name,
                'status' => Agent::STATUS_ACCEPTED,
                'agent_type_id' => $this->request->agent_type_id,
                'reference_code' => 'A' . TransactionIdGenerator::generateAlphaNumeric(7),
                'cash_out_type' => $agentType->default_cash_out_type,
                'cash_out_value' => $agentType->default_cash_out_value,
                'cash_in_type' => $agentType->default_cash_in_type,
                'cash_in_value' => $agentType->default_cash_in_value,
                'institution_type' => $this->request->institution_type
            ];

            $agent = Agent::create($agentData);
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function edit($agent)
    {
        if ($this->request->status != Agent::STATUS_ACCEPTED) {
            $user = User::findOrFail($agent->user_id);
            $user->roles()->detach();
            $status  = strtolower($this->request->status);
            $reason = $this->request->reason ?? "Your agent request has been {$status}." ;

            $this->sendNotification($user, 'Agent Request ' . $status , $reason, 'AgentNotification');
        }

        if ($this->request->status == Agent::STATUS_ACCEPTED) {
            $user = User::findOrFail($agent->user_id);
            $data = [
                'role_id' => (new Role())->agentRole()->id
            ];
            $user->roles()->sync($data);

            $this->sendNotification($user, 'Agent Request Accepted', 'Your agent request has been accepted', 'AgentNotification');
        }

        $agentType = AgentType::whereId($this->request->agent_type_id)->first();

        $agent->status = $this->request->status;
        $agent->agent_type_id = $this->request->agent_type_id;

        $agent->cash_out_type = $this->request->cash_out_type;
        $agent->cash_out_value = $this->request->cash_out_value;

        $agent->cash_in_type = $this->request->cash_in_type;
        $agent->cash_in_value = $this->request->cash_in_value;

        $agent->institution_type = $this->request->institution_type;
        $agent->save();

        return true;
    }
}
