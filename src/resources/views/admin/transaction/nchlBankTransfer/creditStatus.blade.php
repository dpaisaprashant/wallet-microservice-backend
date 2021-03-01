@if(strtoupper($transaction->credit_response_message) == 'SUCCESS')
    <span class="badge badge-primary">{{ strtoupper($transaction->credit_response_message) }}</span>
@elseif(empty($transaction->credit_response_message))
    <span class="badge badge-warning">NOT COMPLETED</span>
@elseif(strtoupper($transaction->credit_response_message) == 'ERROR')
    <span class="badge badge-danger">{{ $transaction->credit_response_message }}</span>
@else
    <span class="badge badge-warning">{{ $transaction->credit_response_message }}</span>
@endif
