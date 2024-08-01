@if(strtoupper($NicTransaction->status) == 'SUCCESS')
    <span class="badge badge-primary">{{ strtoupper($NicTransaction->status) }}</span>
@elseif(strtoupper($NicTransaction->status) == 'PROCESSING')
    <span class="badge badge-warning">PROCESSING</span>
@elseif(empty($NicTransaction->status))
    <span class="badge badge-warning">NOT COMPLETED</span>
@else
    <span class="badge badge-danger">{{ $NicTransaction->status }}</span>
@endif
