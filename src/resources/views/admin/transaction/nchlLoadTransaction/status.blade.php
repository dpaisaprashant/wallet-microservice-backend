@if(strtoupper($transaction->status) == 'SUCCESS')
    <span class="badge badge-primary">{{ strtoupper($transaction->status) }}</span>
@elseif(empty($transaction->status))
    <span class="badge badge-warning">NOT COMPLETED</span>
@else
    <span class="badge badge-danger">{{ $transaction->status }}</span>
@endif
