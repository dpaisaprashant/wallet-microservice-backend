@if($transaction->response === 0 && $transaction->status == 1)
    <span class="badge badge-danger">Rejected</span>
@elseif($transaction->response === 0 && $transaction->status === 0)
    <span class="badge badge-warning">Pending</span>
@elseif($transaction->status == 1 && $transaction->response == 1)
    <span class="badge badge-primary">Accepted</span>
@endif
