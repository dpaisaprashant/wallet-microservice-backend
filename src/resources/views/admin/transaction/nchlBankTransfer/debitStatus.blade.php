@if(strtoupper($transaction->debit_response_message) == 'SUCCESS')
    <span class="badge badge-primary">{{ strtoupper($transaction->debit_response_message) }}</span>
@elseif(empty($transaction->debit_response_message))
    <span class="badge badge-warning">NOT COMPLETED</span>
@elseif(strtoupper($transaction->debit_response_message) == 'ERROR')
    <span class="badge badge-danger">{{ $transaction->debit_response_message }}</span>
@else
    <span class="badge badge-warning">{{ $transaction->debit_response_message }}</span>
@endif
