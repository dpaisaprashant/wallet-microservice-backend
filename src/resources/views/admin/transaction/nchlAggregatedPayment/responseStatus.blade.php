@if($transaction->successfulPayment())
    <span class="badge badge-primary">{{ strtoupper($transaction->response_description) }}</span>
@elseif(empty($transaction->response_description))
    <span class="badge badge-warning">NOT COMPLETED</span>
@elseif(strtoupper($transaction->response_description) == 'ERROR')
    <span class="badge badge-danger">{{ $transaction->response_description }}</span>
@else
    <span class="badge badge-warning">{{ $transaction->response_description }}</span>
@endif
