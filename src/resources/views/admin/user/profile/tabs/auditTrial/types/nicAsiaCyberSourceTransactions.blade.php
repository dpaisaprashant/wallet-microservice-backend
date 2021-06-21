<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{$event->pre_transaction_id == null ? '---' : $event->pre_transaction_id}}</td>
    <td>NIC Asia CyberSource Load Transaction</td>
    <td></td>
    <td>
       @include('admin.transaction.nicAsiaCyberSourceTransaction.status', ['transaction' => $event])
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
        @include('admin.transaction.nicAsiaCyberSourceTransaction.request', ['transaction' => $event])
        @include('admin.transaction.nicAsiaCyberSourceTransaction.response', ['transaction' => $event])
        <a href="{{ route('nicasia.cyberSourceLoadTransaction.detail', $event->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
    </td>
</tr>
