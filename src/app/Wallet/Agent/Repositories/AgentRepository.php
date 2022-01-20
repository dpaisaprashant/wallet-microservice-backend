<?php


namespace App\Wallet\Agent\Repositories;


use App\Models\AdminAlteredAgent;
use App\Models\Agent;
use App\Models\AgentType;
use App\Models\Role;
use App\Models\User;
use App\Traits\CollectionPaginate;
use App\Wallet\Helpers\TransactionIdGenerator;
use App\Wallet\User\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadImage;

class AgentRepository
{
    use UploadImage;
    private $disk = "agent_images";

    use CollectionPaginate;

    private $request;

    private $length = 10;

    private $user;

    public function __construct(Request $request,$length = 10)
    {
        $this->request = $request;
        $this->user = User::whereHas('agent');
        $this->length = $length;
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

    private function latestUsers($pagination_length = null)
    {
        return $this->user->with('agent', 'wallet', 'userTransactionEvents')->latest()->filter($this->request)->paginate($pagination_length ?? $this->length);
    }

    public function paginatedUsers($pagination_length = null)
    {

            $user = $this->latestUsers($pagination_length);

        return $this->addRoleToUser($user);
    }

    public function create()
    {
        try {
            DB::beginTransaction();
            $user = User::whereId($this->request->user_id)->firstOrFail();
            if ($user->isAgent()) return false;
            if (Agent::where('user_id', $user->id)->count()) return false;

            $data = [
                'role_id' => (new Role())->agentRole()->id
            ];
            $user->roles()->sync($data);

            $uploadToCoreData = Arr::except($this->request->allFiles(), '_token');
            $responseData = $this->uploadImageToCoreBase64($this->disk, $uploadToCoreData, $this->request);
            $agentType = AgentType::whereId($this->request->agent_type_id)->first();
            $agentData = [
                'user_id' => $user->id,
                'business_pan' => $this->request->business_pan,
                'business_name' => $this->request->business_name,
                'status' => $this->request->status,
                'agent_type_id' => $this->request->agent_type_id,
                'reference_code' => 'A' . TransactionIdGenerator::generateAlphaNumeric(7),
                'cash_out_type' => $agentType->default_cash_out_type,
                'cash_out_value' => $agentType->default_cash_out_value,
                'cash_in_type' => $agentType->default_cash_in_type,
                'cash_in_value' => $agentType->default_cash_in_value,
                'institution_type' => $this->request->institution_type,
                'code_used_id' => $this->request->code_used_id,
                'business_document' => $responseData['business_document'],
                'business_owner_citizenship_front' => $responseData['business_owner_citizenship_front'],
                'business_owner_citizenship_back' => $responseData['business_owner_citizenship_back'],
                'pp_photo' => $responseData['pp_photo'],
                'tax_clearance_certificate' => $responseData['tax_clearance_certificate'],
                'pan_vat_document' => $responseData['pan_vat_document'],
            ];
            $agent = Agent::create($agentData);
            $adminAlteredAgent = new AdminAlteredAgent();
            $adminAlteredAgent->admin_id = auth()->user()->getAuthIdentifier();
            $adminAlteredAgent->agent_id = $agent->id;
            $adminAlteredAgent->agent_after = json_encode($agent);
            $adminAlteredAgent->save();
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
        $uploadToCoreData = Arr::except($this->request->allFiles(), '_token');
        $responseData = $this->uploadImageToCoreBase64($this->disk, $uploadToCoreData, $this->request);

//        $agent->status = $this->request->status;
//        $agent->agent_type_id = $this->request->agent_type_id;
//
//        $agent->cash_out_type = $this->request->cash_out_type;
//        $agent->cash_out_value = $this->request->cash_out_value;
//
//        $agent->cash_in_type = $this->request->cash_in_type;
//        $agent->cash_in_value = $this->request->cash_in_value;
//
//        $agent->institution_type = $this->request->institution_type;
//        $agent->save();


        $agentData = [
            'business_pan' => $this->request->business_pan,
            'business_name' => $this->request->business_name,
            'status' => $this->request->status,
            'agent_type_id' => $this->request->agent_type_id,
            'reference_code' => 'A' . TransactionIdGenerator::generateAlphaNumeric(7),
            'cash_out_type' => $agentType->default_cash_out_type,
            'cash_out_value' => $agentType->default_cash_out_value,
            'cash_in_type' => $agentType->default_cash_in_type,
            'cash_in_value' => $agentType->default_cash_in_value,
            'institution_type' => $this->request->institution_type,
            'code_used_id' => $this->request->code_used_id,
            'business_document' => $responseData['business_document'] ?? null,
            'business_owner_citizenship_front' => $responseData['business_owner_citizenship_front'] ?? null,
            'business_owner_citizenship_back' => $responseData['business_owner_citizenship_back'] ?? null,
            'pp_photo' => $responseData['pp_photo'] ?? null,
            'tax_clearance_certificate' => $responseData['tax_clearance_certificate'] ?? null,
            'pan_vat_document' => $responseData['pan_vat_document'] ?? null,
            'use_parent_balance' => $this->request->use_parent_balance ?? 0
        ];
        // if empty then unset.
        if (empty($agentData['business_owner_citizenship_front'])){
            unset($agentData['business_owner_citizenship_front']);
        }

        if (empty($agentData['business_owner_citizenship_back'])){
            unset($agentData['business_owner_citizenship_back']);
        }

        if (empty($agentData['pp_photo'])){
            unset($agentData['pp_photo']);
        }

        if (empty($agentData['tax_clearance_certificate'])){
            unset($agentData['tax_clearance_certificate']);
        }

        if (empty($agentData['pan_vat_document'])){
            unset($agentData['pan_vat_document']);
        }

        $status = Agent::whereId($agent->id)->update($agentData);
        $updatedAgent = Agent::find($agent->id);
        $adminAlteredAgent = new AdminAlteredAgent();
        $adminAlteredAgent->admin_id = auth()->user()->getAuthIdentifier();
        $adminAlteredAgent->agent_id = $agent->id;
        $adminAlteredAgent->agent_before = json_encode($agent->unsetRelation('user')->unsetRelation('agentType')->unsetRelation('createdBy')->unsetRelation('codeUsed'));
        $adminAlteredAgent->agent_after = json_encode($updatedAgent);
        $adminAlteredAgent->save();
        return $status;
    }
}
