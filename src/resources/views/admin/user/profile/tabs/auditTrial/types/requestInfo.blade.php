<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{ $event->description }}</td>
    <td>
        {{ $event->vendor }}
    </td>
    <td>
        @include('admin.transaction.requestInfo.status', ['transaction' => $event])
    </td>
    <td></td>
    <td></td>

    <td>Rs. {{ $event->current_balance }}</td>

    <td>
        @if($event->microservice_type == 'PAYPOINT')
            @if(!empty($event->userCheckPayment))
                @include('admin.transaction.paypoint.request', ['transaction' => $event->userCheckPayment])
                @include('admin.transaction.paypoint.response', ['transaction' => $event->userCheckPayment])
                <a href="{{ route('paypoint.detail', $event->userCheckPayment->id) }}" title="Transaction Detail">
                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                </a>
            @endif
        @elseif($event->microservice_type == 'NCHL' && $event->service_type == 'BANK_TRANSFER')
            @include('admin.transaction.nchlBankTransfer.response', ['transaction' => $event])
        @elseif($event->microservice_type == 'NCHL')
            @include('admin.transaction.nchlLoadTransaction.response', ['transaction' => $event])
        @endif
    </td>
</tr>
