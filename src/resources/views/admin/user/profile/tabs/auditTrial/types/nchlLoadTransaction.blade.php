<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{$event->pre_transaction_id == null ? '---' : $event->pre_transaction_id}}</td>
    <td>NCHL LOAD TRANSACTION</td>
    <td></td>
    <td>
       @include('admin.transaction.nchlLoadTransaction.status', ['transaction' => $event])
    </td>
    <td></td>
    @if(strtoupper($event->status) == 'SUCCESS')
        <td style="color: green">Rs.{{ $event->amount }}</td>
    @else
        <td>Rs.{{ $event->amount }}</td>
    @endif

    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>

    <td>
        @include('admin.transaction.nchlLoadTransaction.response', ['transaction' => $event])
        <a href="{{ route('nchl.loadTransaction.detail', $event->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
    </td>
</tr>
