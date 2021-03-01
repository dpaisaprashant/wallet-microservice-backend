<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>TEST LOAD FUND</td>
    <td>TEST LOAD FUND</td>
    <td>
        <span class="badge badge-primary">{{ 'COMPLETE' }}</span>
    </td>
    <td></td>
    <td style="color: green">Rs.{{ $event->amount }}</td>
    <td>Rs. {{ $event->current_balance }}</td>

    <td>
    </td>
</tr>
