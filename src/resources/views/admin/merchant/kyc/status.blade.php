@if(empty($kyc))
    <span class="badge badge-danger">not filled</span>
@elseif($kyc->accept === null)
    <span class="badge badge-warning">not verified</span>
@elseif($kyc->accept === 0)
    <span class="badge badge-danger">kyc rejected</span>
@elseif($kyc->accept == 1)
    <span class="badge badge-primary">verified</span>
@endif
