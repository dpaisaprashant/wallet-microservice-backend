@if($dispute->clearance_dispute_status == \App\Models\Dispute::CLEARANCE_DISPUTE_STATUS_STARTED)
    <span class="badge badge-info">{{ $dispute->clearance_dispute_status }}</span>
@elseif($dispute->clearance_dispute_status == \App\Models\Dispute::CLEARANCE_DISPUTE_STATUS_PROCESSING)
    <span class="badge badge-warning">{{ $dispute->clearance_dispute_status }}</span>
@elseif($dispute->clearance_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_CLEARED)
    <span class="badge badge-primary">{{ $dispute->clearance_dispute_status }}</span>
@endif
