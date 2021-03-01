<tr class="gradeC">
    <td>{{ $loop->index + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }} <br><br>
    {{ $date[1] }}</td>
    <td>{{ "NCHL BANK TRANSFER" }}</td>
    <td>{{ $event->bank }}</td>
    <td>{{ $event->transaction_id }}</td>

    <td>
       @include('admin.transaction.nchlBankTransfer.creditStatus', ['transaction' => $event])
    </td>

    <td> <span style="color: red">Rs. {{ $event->vendor_commission ?? 0}} </span></td>

    <td>
        <span style="color: green">Rs. {{ $event->user_commission ?? 0 }}</span>
    </td>
    <td>
        <span style="color: red">Rs. {{ $event->user_cashback ?? 0 }}</span>
    </td>

    <td>Rs.{{ $event->amount }}</td>
    @if($event->successfulBankTransfer() )
        <td style="color: red">Rs. {{ $event->debit }}</td>
    @else
        <td>Rs. {{ $event->debit }}</td>
    @endif

    @if($event->successfulBankTransfer())
        <td style="color: green">Rs. {{ $event->credit }}</td>
    @else
        <td>Rs. {{ $event->credit }}</td>
    @endif

    <td>Rs. {{ round($event->balance, 3) }}</td>

    <td>
        @include('admin.transaction.nchlBankTransfer.account', ['transaction' => $event])
        <a href="{{ route('nchl.bankTransfer.detail', $event->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
    </td>
</tr>
