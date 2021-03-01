<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td style="color: green; font-weight: bold">
        {{ $event->description }}
    </td>
    <td>DPAISA</td>
    <td>---</td>
    <td></td>
    <td style="color: green">
        Rs.{{ $event->amount ?? 0 }}
    </td>
    <td>Rs. {{ $event->current_balance }}</td>
    <td>
        @include('admin.transaction.referral.detail', ['transaction' => $event])
    </td>
</tr>
