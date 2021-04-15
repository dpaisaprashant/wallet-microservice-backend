<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{ $event->description }}</td>
    <td>{{ $event->payment_mode }}</td>
    <td>
        @if($event->status == 'COMPLETED')
            <span class="badge badge-primary">{{ $event->status }}</span>
        @elseif($event->status == 'VALIDATED')
            <span class="badge badge-warning">{{ $event->status }}</span>
        @else
            <span class="badge badge-danger">{{ $event->status }}</span>
        @endif
    </td>
    <td></td>
    @if($event->status == 'COMPLETED')
        <td style="color: green">Rs.{{ $event->amount }}</td>
    @else
        <td>Rs.{{ $event->amount }}</td>
    @endif

    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>

    <td>
        @include('admin.transaction.npay.detail', ['transaction' => $event])
        @can('Fund transfer detail')
            <a href="{{ route('eBanking.detail', $event->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @endcan
    </td>
</tr>
