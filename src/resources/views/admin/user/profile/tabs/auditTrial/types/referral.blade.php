<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td style="color: green; font-weight: bold">
        @if($user->id == $event->referred_from)
            REFERRED FROM BONUS (user referred new user)
        @elseif($user->id == $event->referred_to)
            REFERRED TO BONUS (user used referral code)
        @endif
    </td>
    <td>DPAISA</td>
    <td>---</td>
    <td></td>
    <td style="color: green">
        @if($user->id == $event->referred_from)
            Rs.{{ $event->referred_from_amount }}
        @elseif($user->id == $event->referred_to)
            Rs.{{ $event->referred_to_amount }}
        @endif

    </td>
    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>
    <td>
        @include('admin.transaction.referral.detail', ['transaction' => $event])
    </td>
</tr>
