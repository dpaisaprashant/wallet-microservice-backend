<tr class="gradeC">
    <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td>{{ $date[0] }}</td>
    <td>{{ $date[1] }}</td>
    <td>{{$event->pre_transaction_id == null ? '---' : $event->pre_transaction_id}}</td>
    <td>
        @if($user->id == $event->from_user)
            SEND TRANSFER FUND
        @elseif($user->id == $event->to_user)
            RECEIVE TRANSFER FUND
        @endif
    </td>
    <td>
        ---
    </td>
    <td>
        <span class="badge badge-primary">Successful</span>
    </td>
    {{--Send or receive transfer fund--}}
    @if($user->id == $event->from_user)
        <td style="color: red">Rs.{{ $event->amount }}</td>
        <td></td>
    @else
        <td></td>
        <td style="color: green">Rs.{{ $event->amount }}</td>
    @endif
    {{--<td>Rs. {{ $event->commission['before_amount'] -  $event->commission['after_amount']}}</td>--}}

    <td>Rs. {{ $event->current_balance }}</td>
    <td>Rs. {{ $event->current_bonus_balance }}</td>

@if($user->id == $event->from_user) {{--Debit--}}
        <?php global $walletAmount; $walletAmount += $event->amount ?>
    @else {{--Credit--}}
        <?php global $walletAmount; $walletAmount -= $event->amount ?>
    @endif

    <td>
        <a data-toggle="modal" href="#modal-form-fund-transfer{{$event->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
        @can('Fund transfer detail')
            <a href="{{ route('userToUserFundTransfer.detail', $event->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        @endcan

        <div id="modal-form-fund-transfer{{ $event->id }}" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">Transaction Detailed Information</h3>
                                <hr>
                                <dl class="row m-t-md">
                                    <dt class="col-md-3 text-right">Service Type</dt>
                                    <dd class="col-md-8">Fund Request</dd>

                                    <dt class="col-md-3 text-right">Amount</dt>
                                    <dd class="col-md-8">Rs.{{ $event->amount }}</dd>

                                    <dt class="col-md-3 text-right">Commission</dt>
                                    <dd class="col-md-8">Rs.9</dd>

                                    <dt class="col-md-3 text-right">Date</dt>
                                    <dd class="col-md-8">{{ $event->created_at }}</dd>


                                    <dt class="col-md-3 text-right">From User</dt>
                                    <dd class="col-md-8">{{ $event->fromUser['name'] }}</dd>

                                    <dt class="col-md-3 text-right">To User</dt>
                                    <dd class="col-md-8">{{ $event->toUser['name'] }}</dd>

                                </dl>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--<a href="{{route('transactionDetail')}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>View Details</strong></a>--}}
    </td>
</tr>
