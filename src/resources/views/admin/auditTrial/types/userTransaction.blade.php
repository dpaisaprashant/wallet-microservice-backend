<tr class="gradeC">
    <td>{{ $loop->index  + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }} <br><br>
    {{ $date[1] }}</td>
    <td>PAYPOINT</td>
    <td>{{ $event->userTransaction['vendor'] ?? '' }}</td>
    <td>{{ $event->refStan }}</td>
    <td>
        @include('admin.transaction.paypoint.status', ['transaction' => $event])
    </td>

    <td> <span style="color: red">Rs. {{ $event->vendor_commission ?? 0}} </span></td>

    <td>
        <span style="color: green">Rs. {{ $event->user_commission ?? 0 }}</span>
    </td>
    <td>
        <span style="color: red">Rs. {{ $event->user_cashback ?? 0 }}</span>
    </td>

    <td>
        @if(!empty($event->userTransaction))
            Rs. {{ $event->userTransaction['amount'] }}
        @else
            Rs. 0
        @endif
    </td>

    <td style="color: red">
        @if(!empty($event->userTransaction))
            Rs.{{ $event->debit}}
        @endif
    </td>

    <td style="color: green">
        @if(!empty($event->userTransaction))
            Rs.{{ $event->credit}}
        @endif
    </td>


    <td>
       Rs.{{ round($event->balance, 3)}}
    </td>

    <td>
        @can('Paypoint request view')
            @include('admin.transaction.paypoint.request', ['transaction' => $event])
        @endcan

        @if(count($event->userExecutePayment) > 1)
            <br>
            <br>
        @endif

        @can('Paypoint response view')
                @include('admin.transaction.paypoint.response', ['transaction' => $event])
            @endcan
        @can('Paypoint detail')
            <a href="{{ route('paypoint.detail', $event->id) }}" title="Transaction Detail"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @endcan
    </td>
</tr>
