<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{$event->pre_transaction_id == null ? '---' : $event->pre_transaction_id}}</td>
    <td>PAYPOINT</td>
    <td>{{ $event->userTransaction['vendor'] ?? '' }}</td>

    <td>
        @include('admin.transaction.paypoint.status', ['transaction' => $event])
    </td>

    <td style="color: red">
        @if(!empty($event->userTransaction))
            Rs.{{ $event->userTransaction['amount'] }}
        @endif
    </td>
    <td></td>

    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>

@if(!empty($event->userTransaction)) {{--Debit--}}
        <?php global $walletAmount; $walletAmount += $event->userTransaction['amount'] ?>
    @endif


    <td>
        @can('Paypoint request view')
            @include('admin.transaction.paypoint.request', ['transaction' => $event])
        @endcan

        @if(count($event->userExecutePayment) > 1)
                <br><br>
        @endif

        @can('Paypoint response view')
            @include('admin.transaction.paypoint.response', ['transaction' => $event])
        @endcan

        @can('Paypoint detail')
            <a href="{{ route('paypoint.detail', $event->id) }}" title="Transaction Detail"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @endcan
    </td>
</tr>
