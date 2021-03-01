@if($transaction->status == 'COMPLETED')
    <span class="badge badge-primary">{{ $transaction->status }}</span>
@elseif($transaction->status == 'VALIDATED')
    <span class="badge badge-warning">{{ $transaction->status }}</span>
@else
    <span class="badge badge-danger">{{ $transaction->status }}</span>
@endif
