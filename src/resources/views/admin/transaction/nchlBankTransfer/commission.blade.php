@if(empty($transaction->commission))
    Rs. 0
@else
    Rs. {{ $transaction->commission->before_amount -  $transaction->commission->after_account}}
@endif
