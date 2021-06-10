<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>
        @if($event->pre_transaction_id)
            REFUND For: {{ $event->pre_transaction_id }}
        @else
            TEST LOAD FUND
        @endif
    </td>
    <td>
        @if($event->pre_transaction_id)
            REFUND
        @else
            TEST LOAD FUND
        @endif
    </td>
    <td>
        <span class="badge badge-primary">{{ 'COMPLETE' }}</span>
    </td>
    <td></td>
    <td style="color: green">
        @if($event->bonus_amount > 0)
            Rs.{{ $event->amount }} + Rs.{{ $event->bonus_amount }}
        @else
            Rs.{{ $event->amount }}
        @endif
    </td>
    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>

    <td>
    </td>
</tr>
