<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{$event->pre_transaction_id == null ? '---' : $event->pre_transaction_id}}</td>
    <td>NCHL AGGREGATED PAYMENTS</td>
    <td>{{ $event->service_type }}</td>
    <td>
       @include('admin.transaction.nchlAggregatedPayment.responseStatus', ['transaction' => $event])
    </td>

    @if(strtoupper($event->credit_status) == '000')
        <td style="color: red">Rs.{{ $event->amount }}</td>
    @else
        <td>Rs.{{ $event->amount }}</td>
    @endif
    <td></td>

    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>

    <td>
        @include('admin.transaction.nchlAggregatedPayment.account', ['transaction' => $event])
        <a href="{{ route('nchl.aggregatedPayment.detail', $event->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
    </td>
</tr>
