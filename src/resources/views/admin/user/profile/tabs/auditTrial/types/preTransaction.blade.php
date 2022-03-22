<tr class="gradeC">
    @php
        $json_response = $event->json_response;
        $json_response = json_decode($json_response,true);
        $tx_id = $json_response['trxnId'] ?? null;
    @endphp
{{--    @php dd($event); @endphp--}}
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>@if(empty($tx_id))
            {{$event->pre_transaction_id == null ? '---' : $event->pre_transaction_id}}
            <br>
        @endif
        @if(isset($event->userTransaction) )
            <b>RefStan :</b> {{ $event->userTransaction['refStan']  }}
        @elseif(isset($event->userLoadTransaction))
            <b>Gateway Ref
                No:</b> {{ $event->userLoadTransaction['gateway_ref_no'] }}
        @elseif(isset($event->nchlLoadTransaction))
            <b>Transaction
                Id:</b> {{  $event->nchlLoadTransaction['transaction_id'] }}
        @elseif(isset($event->nicAsiaCyberSourceLoad) )
            <b>Reference
                No:</b>{{ $event->nicAsiaCyberSourceLoad['reference_number'] }}
            <br>
            <b>Transaction
                UID:</b>{{$event->nicAsiaCyberSourceLoad['transaction_uuid'] }}
        @elseif(isset($event->nchlBankTransfer))
            <b>Transaction Id:</b>{{ $event->nchlBankTransfer['transaction_id'] }}
            @elseif(isset($event->nchlAggregatePayment))
            <b>Transaction Id:</b>{{ $event->nchlAggregatePayment['transaction_id'] }}<br>
            <b>Ref Id:</b>{{  $event->nchlAggregatePayment['ref_id']  }}<br>
        {{--@elseif(isset($event->khaltiUserTransaction))
            <b>Account : </b>{{  $event->khaltiUserTransaction['account'] }}--}}
        @endif


        @if(!empty($tx_id))
            <b>SFACL Txn id:</b> {{ $tx_id }}
        @endif
    </td>
    <td>
        {{ $event->description }}
        @if(!empty($tx_id))
            <br>
            <b>Pre Transaction Id: </b> {{ $event->pre_transaction_id }}
        @endif

    </td>

    <td>
        <?php $transaction = json_decode($event->json_response, true) ?>
        @if(is_array($transaction) && isset($transaction['transaction']) && isset($transaction['transaction']['vendor']))
            {{ $transaction['transaction']['vendor'] }}
        @else
            @if(is_string($transaction))
                <?php $transaction = json_decode($transaction, true) ?>
            @endif
            @if(is_array($transaction) && isset($transaction['transaction']) && isset($transaction['transaction']['vendor']))
                {{ $transaction['transaction']['vendor'] }}
            @else
                {{ $event->vendor }}
            @endif
        @endif
    </td>
    <td>
        @include('admin.transaction.preTransaction.status', ['transaction' => $event])
    </td>
    @if($event->transaction_type == 'debit')
        @if(strtoupper($event->status) == 'SUCCESS')
            <td style="color: red">Rs.{{ $event->amount }}</td>
        @else
            <td>Rs.{{ $event->amount }}</td>
        @endif
    @else
        <td></td>
    @endif

    @if($event->transaction_type == 'credit')
        @if(strtoupper($event->status) == 'SUCCESS')
            <td style="color: green">Rs.{{ $event->amount }}</td>
        @else
            <td>Rs.{{ $event->amount }}</td>
        @endif
    @else
        <td></td>
    @endif

    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>
    <td>
        @if($event->status == 'FAILED')
            @include('admin.transaction.preTransaction.response', ['transaction' => $event])
        @endif
        @if($event->microservice_type == 'PAYPOINT')
            @if(!empty($event->userCheckPayment))
                @include('admin.transaction.paypoint.request', ['transaction' => $event->userCheckPayment])
                @include('admin.transaction.paypoint.response', ['transaction' => $event->userCheckPayment])
                <a href="{{ route('paypoint.detail', $event->userCheckPayment->id) }}" title="Transaction Detail">
                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                </a>
            @endif
            {{--          @elseif($event->microservice_type == 'NCHL' && $event->service_type == 'BANK_TRANSFER')
                          @if(!empty($event->nchlBankTransfer))
                              @include('admin.transaction.nchlBankTransfer.response', ['transaction' => $event->nchlBankTransfer])
                              <a href="{{ route('nchl.bankTransfer.detail', $event->nchlBankTransfer->id) }}">
                                  <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                              </a>
                          @endif
                      @elseif($event->microservice_type == 'NCHL')
                          @if(!empty($event->nchlLoadTransaction))
                              @include('admin.transaction.nchlLoadTransaction.response', ['transaction' => $event->nchlLoadTransaction])
                              <a href="{{ route('nchl.loadTransaction.detail', $event->nchlLoadTransaction->id) }}">
                                  <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                              </a>
                          @endif--}}
       {{-- @elseif($event->microservice_type == 'KHALTI')
            @if(!empty($event->khaltiUserTransaction))
                --}}{{--                    {{ dd($event->khaltiUserTransaction) }}--}}{{--
                <a href="{{ route('khalti.payment.detail', $event->khaltiUserTransaction->id) }}">
                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>

                </a>
            @endif--}}
        @elseif(!empty($event->transactionEvent))
            @if($event->transactionEvent instanceof \App\Models\UserToUserFundTransfer)
                @include('admin.transaction.fundTransfer.detail', [$event->transactionEvent->transactionable])
                <a href="{{ route('userToUserFundTransfer.detail', $event->transactionEvent->transaction_id) }}">
                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                </a>
            @endif
        @endif

        {{--        @if($event->vendor == "KHALTI")--}}
        {{--            @if(isset($event->khaltiUserTransaction))--}}
        {{--                <a href="{{ route('khalti.specific',$event->khaltiUserTransaction->id) }}">--}}
        {{--                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-info"></i></button>--}}
        {{--                </a>--}}
        {{--            @endif--}}
        {{--        @endif--}}

        @if($event->microservice_type == "BFI")
            @if(!empty($event->userToBFIFundTransfer))
                <a href="{{ route('user.to.bfi.fund.transfer.check.payment', $event->userToBFIFundTransfer->id) }}">
                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                </a>
            @endif

            @if(!empty($event->bfiToUserFundTransfer))
                <a href="{{ route('view.bfi.to.user.check.payment', $event->bfiToUserFundTransfer->id) }}">
                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                </a>
            @endif

        @endif

        @if($event->nicAsiaCyberSourceLoad)
            <a href="{{route('nicAsia.detailCyberSourceLoad',$event->nicAsiaCyberSourceLoad->id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @elseif($event->userloadTransaction)
            <a href="{{ route('eBanking.detail', $event->userLoadTransaction->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @elseif($event->userTransaction)
            <a href="{{ route('paypoint.detail', $event->userTransaction->id) }}">    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        {{--@elseif($event->khaltiUserTransaction)
            <a href="{{ route('khalti.payment.detail', $event->khaltiUserTransaction->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>--}}
        @elseif($event->nchlBankTransfer)
            <a href="{{ route('nchl.bankTransfer.detail', $event->nchlBankTransfer->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @elseif($event->nchlLoadTransaction)
            <a href="{{ route('nchl.loadTransaction.detail', $event->nchlLoadTransaction->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @elseif($event->nchlAggregatePayment)
            <a href="{{route('nchl.aggregatedPayment.detail',$event->nchlAggregatePayment->id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        {{--@elseif($event->cellPayUserTransaction)
            <a href="{{route('cellPayUserTransaction.detail',$event->cellPayUserTransaction->id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>--}}
        @elseif(optional($event->transactionEvent)->transaction_type == \App\Models\UserToUserFundTransfer::class)
            <a href="{{ route('userToUserFundTransfer.detail', $event->transactionEvent->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @elseif(optional($event->transactionEvent)->transaction_type == \App\Models\FundRequest::class)
            <a href="{{ route('fundRequest.detail', $event->transactionEvent->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @elseif($event->npsLoadTransaction)
                <a href="{{route('nps.detail',$event->npsLoadTransaction->id)}}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @endif

{{--            without details page--}}
{{--            @elseif($event->refundTransaction)--}}
{{--            @elseif($event->userToBFIFundTransfer)--}}
{{--            @elseif($event->bfiToUserFundTransfer)--}}
{{--        without details page ends--}}

    </td>
</tr>
