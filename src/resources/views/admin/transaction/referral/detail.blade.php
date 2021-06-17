<a data-toggle="modal" href="#modal-form-referral{{$transaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
<div id="modal-form-referral{{ $transaction->id }}" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Referral Detailed Information</h3>
                        <hr>
                        <dl class="row m-t-md">
                            <dt class="col-md-3 text-right">Service Type</dt>
                            <dd class="col-md-8">Referral</dd>

                            <dt class="col-md-3 text-right">Id</dt>
                            <dd class="col-md-8">
                                    Rs.{{ $transaction->id }}
                            </dd>
                            <dt class="col-md-3 text-right">Amount</dt>
                            <dd class="col-md-8">
                                    @if($user->id == $transaction->referred_to)
                                        Rs.{{ $transaction->referred_to_amount }}
                                    @endif

                                    @if($user->id == $transaction->referred_from)
                                            Rs.{{ $transaction->referred_from_amount }}
                                    @endif
                            </dd>

                            <dt class="col-md-3 text-right">Date</dt>
                            <dd class="col-md-8">{{ $transaction->created_at }}</dd>


                            <dt class="col-md-3 text-right">From User</dt>
                            <dd class="col-md-8">{{ $transaction->referredFrom['mobile_no']  ?? "" }}</dd>

                            <dt class="col-md-3 text-right">To User</dt>
                            <dd class="col-md-8">{{ $transaction->referredTo['mobile_no'] ?? ""}}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
