@if($agent->status === \App\Models\Agent::STATUS_PROCESSING)
    <span class="badge badge-warning">Processing</span>
@elseif($agent->status === \App\Models\Agent::STATUS_REJECTED)
    <span class="badge badge-danger">Rejected</span>
@elseif($agent->status == \App\Models\Agent::STATUS_ACCEPTED)
    <span class="badge badge-primary">Accepted</span>
@endif
