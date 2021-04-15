<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>
        @if($user->id == $event->to_user)
            RECEIVE FUND REQUEST
        @elseif($user->id == $event->from_user)
            SEND FUND REQUEST
        @endif
    </td>
    <td>---</td>
    <td>
        @if($event->response === 0 && $event->status == 1)
            <span class="badge badge-danger">Rejected</span>
        @elseif($event->response === 0 && $event->status === 0)
            <span class="badge badge-warning">Pending</span>
        @elseif($event->status == 1 && $event->response == 1)
            <span class="badge badge-primary">Accepted</span>
        @endif
    </td>
    @if($user->id == $event->from_user)
        @if($event->response == 1 && $event->status == 1)
            <td></td>
            <td style="color: green">Rs.{{ $event->amount }}</td>
        @else
            <td></td>
            <td>Rs.{{ $event->amount }}</td>
        @endif
    @else
        @if($event->response == 1 && $event->status == 1)
            <td style="color: red">Rs.{{ $event->amount }}</td>
            <td></td>
        @else
            <td>Rs.{{ $event->amount }}</td>
            <td></td>
        @endif

    @endif
    <td>
        Rs. {{ $event->current_balance }}
    </td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>
    <td>
        @include('admin.transaction.fundRequest.detail', ['transaction' => $event])
        @can('Fund request detail')
            <a href="{{ route('fundRequest.detail', $event->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @endcan
    </td>
</tr>
