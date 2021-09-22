@if($transaction->transaction_type == 'App\Models\UserToUserFundTransfer')
    @include('admin.transaction.fundTransfer.detail', ['transaction' => $transaction->transactionable])
    <a href="{{ route('userToUserFundTransfer.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@elseif($transaction->transaction_type == 'App\Models\UserLoadTransaction')
    @include('admin.transaction.npay.detail', ['transaction' => $transaction->transactionable])
    <a href="{{ route('eBanking.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@elseif($transaction->transaction_type == \App\Models\UserTransaction::class)
    @include('admin.transaction.paypoint.detail', ['transaction' => $transaction->transactionable])
    @if(optional(optional($transaction->transactionable)->checkTransaction)->id != null)
        <a href="{{ route('paypoint.detail', $transaction->transactionable->checkTransaction->id) }}">    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
    @endif
@elseif($transaction->transaction_type == \App\Models\FundRequest::class)
    @include('admin.transaction.fundRequest.detail', ['transaction' => $transaction->transactionable])
    <a href="{{ route('fundRequest.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@elseif($transaction->transaction_type == 'App\Models\NchlBankTransfer')
    @include('admin.transaction.nchlBankTransfer.account', ['transaction' => $transaction->transactionable])
    <a href="{{ route('nchl.bankTransfer.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@elseif($transaction->transaction_type == \App\Models\NchlLoadTransaction::class)
    @include('admin.transaction.nchlLoadTransaction.response', ['transaction' => $transaction->transactionable])
    <a href="{{ route('nchl.loadTransaction.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@elseif($transaction->transaction_type == 'App\Models\KhaltiUserTransaction')
    <a href="{{ route('khalti.payment.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@elseif($transaction->transaction_type == \App\Models\CellPayUserTransaction::class)
    <a href="{{route('cellPayUserTransaction.detail',$transaction->transaction_id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@elseif($transaction->transaction_type == \App\Models\LoadTestFund::class)
    <a href="{{route('loadTestFund.detail',$transaction->transaction_id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@elseif($transaction->transaction_type == \App\Models\NchlAggregatedPayment::class)
    <a href="{{route('nchl.aggregatedPayment.detail',$transaction->transaction_id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@elseif($transaction->transaction_type == \App\Models\NICAsiaCyberSourceLoadTransaction::class)
    <a href="{{route('nicAsia.detailCyberSourceLoad',$transaction->transaction_id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@elseif($transaction->transaction_type == \App\Models\NpsLoadTransaction::class)
    <a href="{{route('nps.detail',$transaction->transaction_id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

{{--    todo: need to make view and detilaspage--}}
{{--@elseif($transaction->transaction_type == \App\Models\NtcRetailerToCustomerTransaction::class)--}}
{{--    <a href="{{route('nps.detail',$transaction->transaction_id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>--}}
{{--todo ends--}}

@elseif($transaction->transaction_type == \App\Models\MerchantTransaction::class)
    <a href="{{route('merchant-transaction.detail',$transaction->transaction_id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

@endif
