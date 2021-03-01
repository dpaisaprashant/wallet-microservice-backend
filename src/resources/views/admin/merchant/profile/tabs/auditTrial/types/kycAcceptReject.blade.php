<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>

    @if($event->status == \App\Models\AdminUserKYC::ACCEPTED)
        <td style="color: green; font-weight: bold">KYC ACCEPTED</td>
    @elseif($event->status == \App\Models\AdminUserKYC::REJECTED)
        <td style="color: red; font-weight: bold">KYC REJECTED</td>
    @endif

    <td>---</td>
    <td>---</td>
    <td>---</td>
    <td>---</td>
    <td>Rs. {{ $event->current_balance }}</td>
    <td>
        @include('admin.merchant.kyc.detail', ['merchant' => $merchant])
    </td>
</tr>
