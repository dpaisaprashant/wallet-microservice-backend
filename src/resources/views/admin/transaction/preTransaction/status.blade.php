@if(strtoupper($transaction->status) == 'SUCCESS')
    @if(isset($transaction->transactionEvent))
        @if($transaction->transactionEvent->refundTransaction)
            <span class="badge badge-inverse">{{ strtoupper("Success Tran. DISPUTE & REFUNDED") }}</span>
        @else
            <span class="badge badge-primary">{{ strtoupper($transaction->status) }}</span>
        @endif
    @endif
@elseif(strtoupper($transaction->status) == 'FAILED')
    @if(isset($transaction->refundTransaction))
        <span class="badge badge-inverse">{{ strtoupper("Failed Tran. DISPUTE & REFUNDED") }}</span>
    @else
        <span class="badge badge-danger">{{ strtoupper($transaction->status) }}</span>
    @endif
@else
    <span class="badge badge-warning">NO RESPONSE</span>
@endif
