<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{$event->pre_transaction_id == null ? '---' : $event->pre_transaction_id}}</td>
    <td>MERCHANT TRANSACTION</td>
    <td>{{ $event->vendor }}</td>
    <td>
        @include('admin.transaction.merchantTransaction.status', ['transaction' => $event])
    </td>

    @if(strtoupper($event->status) == 'COMPLETE')
        <td style="color: red">Rs.{{ $event->amount }}</td>
    @else
        <td>Rs.{{ $event->amount }}</td>
    @endif
    <td></td>

    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>

    <td>
    </td>
</tr>
