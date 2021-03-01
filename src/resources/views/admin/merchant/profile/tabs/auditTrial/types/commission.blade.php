<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td style="color: green; font-weight: bold">COMMISSION</td>
    <td>{{ $event->merchantTransactions['vendor'] }}</td>
    <td>---</td>
    <td style="color: red">Rs.{{ $event->merchantTransactions['amount'] }}</td>
    <td>

    </td>
    <td>Rs. {{ $event->current_balance }}</td>
    <td></td>
</tr>
