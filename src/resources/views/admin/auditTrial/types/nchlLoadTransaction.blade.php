<tr class="gradeC">
    <td>{{ $loop->index + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }} <br><br>
    {{ $date[1] }}</td>
    <td>{{ $event->remark }}</td>
    <td>{{ 'ConnectIPS' }}</td>
    <td>{{ $event->transaction_id }}</td>

    <td>
       @include('admin.transaction.nchlLoadTransaction.status', ['transaction' => $event])
    </td>

    <td> <span style="color: red">Rs. {{ $event->vendor_commission ?? 0}} </span></td>

    <td>
        <span style="color: green">Rs. {{ $event->user_commission ?? 0 }}</span>
    </td>
    <td>
        <span style="color: red">Rs. {{ $event->user_cashback ?? 0 }}</span>
    </td>

    <td>Rs.{{ $event->amount }}</td>
    @if($event->status == 'SUCCESS')
        <td style="color: red">Rs. {{ $event->debit }}</td>
    @else
        <td>Rs. {{ $event->debit }}</td>
    @endif

    @if($event->status == 'SUCCESS')
        <td style="color: green">Rs. {{ $event->credit }}</td>
    @else
        <td>Rs. {{ $event->credit }}</td>
    @endif

    <td>Rs. {{ round($event->balance, 3) }}</td>

    <td>
        @include('admin.transaction.nchlLoadTransaction.response', ['transaction' => $event])
        <a href="{{ route('nchl.loadTransaction.detail', $event->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

    </td>
</tr>
