@if(strtoupper($transaction->status) == 'SUCCESS')
    <span class="badge badge-primary">{{ strtoupper($transaction->status) }}</span>
@elseif(strtoupper($transaction->status) == 'FAILED')
    <span class="badge badge-danger">{{ strtoupper($transaction->status) }}</span>
@else
    <span class="badge badge-warning">NO RESPONSE</span>
@endif
