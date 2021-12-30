@if(!empty($transaction->id))
<a data-toggle="modal" href="#modal-form-npay-detail{{$transaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
<div id="modal-form-npay-detail{{ $transaction->id }}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Transaction Detailed Information</h3>
                        <hr>
                        <dl class="row m-t-md">
                            <dt class="col-md-3 text-right">Transaction ID</dt>
                            <dd class="col-md-8">
                                {{ $transaction->transaction_id }}
                            </dd>

                            <dt class="col-md-3 text-right">Process Id</dt>
                            <dd class="col-md-8">
                                {{ $transaction->process_id }}
                            </dd>

                            <dt class="col-md-3 text-right">Gateway Ref No.</dt>
                            <dd class="col-md-8">
                                {{ $transaction->gateway_ref_no }}
                            </dd>

                            <dt class="col-md-3 text-right">Payment Mode</dt>
                            <dd class="col-md-8">{{ $transaction->payment_mode}}</dd>

                            <dt class="col-md-3 text-right">Description</dt>
                            <dd class="col-md-8">{{ $transaction->description}}</dd>

                            <dt class="col-md-3 text-right">Amount</dt>
                            <dd class="col-md-8">Rs.{{ $transaction->amount }}</dd>

                            <dt class="col-md-3 text-right">Commission</dt>
                            <dd class="col-md-8">Rs.9</dd>

                            <dt class="col-md-3 text-right">Date</dt>
                            <dd class="col-md-8">{{ $transaction->created_at }}</dd>

                            <dt class="col-md-3 text-right">Account</dt>
                            <dd class="col-md-8">{{ $transaction->account }}</dd>

                            <dt class="col-md-3 text-right">User</dt>
                            <dd class="col-md-8">{{ $transaction->user['name'] ?? null }}</dd>

                            <dt class="col-md-3 text-right">KYC Status</dt>
                            <dd class="col-md-8">
                                @if(empty($transaction->user->kyc))
                                    <i style="color: red;" class="fa fa-times-circle"></i> Not Filled
                                @elseif($transaction->user->kyc->status == 0)
                                    <i style="color: red;" class="fa fa-times-circle"></i> KYC not verified
                                @elseif($transaction->user->kyc->status == 1)
                                    <i style="color: green;" class="fa fa-check-circle"></i> KYC verified
                                @endif
                            </dd>
                        </dl>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
