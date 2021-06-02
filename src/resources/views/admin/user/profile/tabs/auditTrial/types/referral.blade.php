<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    @if($event->status == \App\Models\UsedUserReferral::STATUS_COMPLETE)
    <td style="color: green; font-weight: bold">
        @if($user->id == $event->referred_from)
            REFERRED FROM BONUS (user referred new user)
        @elseif($user->id == $event->referred_to)
            REFERRED TO BONUS (user used referral code)
        @endif
    </td>
    @elseif($event->status == \App\Models\UsedUserReferral::STATUS_PROCESSING)
        <td style="color: orangered; font-weight: bold">
            @if($user->id == $event->referred_from)
                REFERRED FROM BONUS (user referred new user)
            @elseif($user->id == $event->referred_to)
                REFERRED TO BONUS (user used referral code)
            @endif
        </td>
    @else
        <td style="color: red; font-weight: bold">
            @if($user->id == $event->referred_from)
                REFERRED FROM BONUS (user referred new user)
            @elseif($user->id == $event->referred_to)
                REFERRED TO BONUS (user used referral code)
            @endif
        </td>
    @endif
    <td>SAJILOPAY</td>
    <td>
        @if($event->status == \App\Models\UsedUserReferral::STATUS_COMPLETE)
            <span class="badge badge-primary">{{$event->status}}</span>
        @elseif($event->status == \App\Models\UsedUserReferral::STATUS_PROCESSING)
            <span class="badge badge-warning">{{$event->status}}</span>
        @else
            <span class="badge badge-danger">{{$event->status}}</span>
        @endif
    </td>
    <td></td>
    @if($event->status == \App\Models\UsedUserReferral::STATUS_COMPLETE)
    <td style="color: green">
        @if($user->id == $event->referred_from)
            Rs.{{ $event->referred_from_amount }}
        @elseif($user->id == $event->referred_to)
            Rs.{{ $event->referred_to_amount }}
        @endif

    </td>
    @else
        <td>
            @if($user->id == $event->referred_from)
                Rs.{{ $event->referred_from_amount }}
            @elseif($user->id == $event->referred_to)
                Rs.{{ $event->referred_to_amount }}
            @endif

        </td>
    @endif
    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>
    <td>
        @include('admin.transaction.referral.detail', ['transaction' => $event])
    </td>
</tr>
