<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{$event->pre_transaction_id == null ? '---' : $event->pre_transaction_id}}</td>
    <td>
        @if($event->pre_transaction_id)
            REFUND For: {{ $event->pre_transaction_id }}
        @else
            @if(!empty($event->description))
                {{ $event->description }}
            @else
                TEST LOAD FUND
            @endif
        @endif
    </td>
    <td>
        @if($event->pre_transaction_id)
            REFUND
        @else
            @if(!empty($event->description))
                LUCKY WINNER
            @else
                TEST LOAD FUND
            @endif
        @endif
    </td>
    <td>
        <span class="badge badge-primary">{{ 'COMPLETE' }}</span>
    </td>
    <td></td>
    <td style="color: green">
        @if($event->bonus_amount > 0 && $event->amount > 0)
            Rs.{{ $event->amount }} + Rs.{{ $event->bonus_amount }}
        @elseif($event->bonus_amount > 0)
            Rs.{{ $event->bonus_amount }}
        @else
            Rs.{{ $event->amount }}
        @endif
    </td>
    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>

    <td>
    </td>
</tr>
