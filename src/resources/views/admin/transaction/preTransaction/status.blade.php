@if(strtoupper($transaction->status) == 'SUCCESS')
    @if(isset($transaction->transactionEvent))
        @if($transaction->transactionEvent->refundTransaction)
            <span class="badge badge-dark">{{ strtoupper("DISPUTE") }}</span>
        @else
            <span class="badge badge-primary">{{ strtoupper($transaction->status) }}</span>
        @endif
    @endif
@elseif(strtoupper($transaction->status) == 'FAILED')
    <span class="badge badge-danger">{{ strtoupper($transaction->status) }}</span>
@else
    <span class="badge badge-warning">NO RESPONSE</span>
@endif
