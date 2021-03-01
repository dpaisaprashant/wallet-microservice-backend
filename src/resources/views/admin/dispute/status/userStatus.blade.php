@if($dispute->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_STARTED)
    <span class="badge badge-info">{{ $dispute->user_dispute_status }}</span>
@elseif($dispute->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_PROCESSING)
    <span class="badge badge-warning">{{ $dispute->user_dispute_status }}</span>
@elseif($dispute->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_REPOSTED)
    <span class="badge badge-dark">{{ $dispute->user_dispute_status }}</span>
@elseif($dispute->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_CLEARED)
    <span class="badge badge-primary">{{ $dispute->user_dispute_status }}</span>
@elseif($dispute->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_REJECTED)
    <span class="badge badge-danger">{{ $dispute->user_dispute_status }}</span>
@endif
