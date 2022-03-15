<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{$event->pre_transaction_id == null ? '---' : $event->pre_transaction_id}}</td>
    <td style="color: green; font-weight: bold">
        CASHBACK Id: {{ $event->transactions['id'] }}
        @if(optional($event->transactions)->cashbackPull)
            <br>
            <span style="color: orange">Cashback pull pre transaction id: </span> {{ $event->transactions->cashbackPull->pre_transaction_id }}
        @endif
    </td>
    <td>{{ $event->transactions['vendor'] }}</td>
    <td>
        @if(optional($event->transactions)->cashbackPull)
            <span class="badge badge-inverse">CASHBACK PULLED</span>
        @else
            ---
        @endif
    </td>
    <td></td>
    <td style="color: green">
        Rs.{{ $event->transactions['amount'] }}
    </td>
    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>
    <td></td>
</tr>
