<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>MERCHANT TRANSACTION</td>
    <td>{{ $event->vendor }}</td>
    <td>
        @include('admin.transaction.merchantTransaction.status', ['transaction' => $event])
    </td>

    <td>

    </td>

    @if(strtoupper($event->status) == 'COMPLETE')
        <td style="color: green">Rs.{{ $event->amount }}</td>
    @else
        <td>Rs.{{ $event->amount }}</td>
    @endif

    <td>Rs. {{ $event->current_balance }}</td>

    <td>
    </td>
</tr>
