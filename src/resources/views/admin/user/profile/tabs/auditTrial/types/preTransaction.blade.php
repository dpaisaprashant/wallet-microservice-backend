<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{$event->pre_transaction_id == null ? '---' : $event->pre_transaction_id}}</td>
    <td>{{dd($event)}}</td>
    <td>{{ $event->description }}</td>
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
        @elseif($event->microservice_type == 'NCHL' && $event->service_type == 'BANK_TRANSFER')
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
            @endif
        @elseif($event->microservice_type == 'KHALTI')
                @if(!empty($event->khaltiUserTransaction))
                    <a href="{{ route('khalti.payment.detail', $event->khaltiUserTransaction->id) }}">
                        <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                    </a>
                @endif
        @endif


    </td>
</tr>
