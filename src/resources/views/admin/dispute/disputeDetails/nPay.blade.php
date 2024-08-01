@isset($disputeDetail->disputeable->gateway_ref_no)
    <input type="hidden" value="{{ \App\Models\Dispute::VENDOR_TYPE_NPAY }}" name="vendor_type">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Dispute Details</h5>
                </div>
                <div class="ibox-content">
                    <div id="nPayTransactionDetailDiv">
                        <h2>NPay Transaction Details</h2>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>User: {{ $disputeDetail->disputeable->user['name'] }}</h4>
                                <h4>Email: {{ $disputeDetail->disputeable->user['email'] }}</h4>
                                <h4>Contact: {{ $disputeDetail->disputeable->user['mobile_no'] }}</h4>
                            </div>

                            <div class="col-md-5">
                                <h4>Process Id: {{ $disputeDetail->disputeable->process_id }}</h4>
                                <h4>Payment Mode: {{ $disputeDetail->disputeable->payment_mode }}</h4>
                                <h4>Amount: Rs. {{ $disputeDetail->disputeable->amount }}</h4>
                                <h4>Transaction Fee:
                                    Rs. {{ $disputeDetail->disputeable->transaction_fee ?? 0 }}</h4>
                            </div>

                            <div class="col-md-4">
                                <h4>Transaction Id: {{ $disputeDetail->disputeable->transaction_id }}</h4>
                                <h4>Gateway Ref no: {{ $disputeDetail->disputeable->gateway_ref_no }}</h4>
                                <h4>Status:
                                    @if($disputeDetail->disputeable->status == 'COMPLETED')
                                        <span
                                            class="badge badge-primary">{{ $disputeDetail->disputeable->status }}</span>
                                    @elseif($disputeDetail->disputeable->status == 'VALIDATED')
                                        <span
                                            class="badge badge-warning">{{ $disputeDetail->disputeable->status }}</span>
                                    @else
                                        <span
                                            class="badge badge-danger">{{ $disputeDetail->disputeable->status }}</span>
                                    @endif
                                </h4>
                                <h4>Created at: {{ $disputeDetail->disputeable->created_at }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Transaction Response</h5>
                </div>
                <div class="ibox-content">
                    @isset($disputeDetail->disputeable->loadTransactionResponse)
                        <div id="nPayTransactionDetailDiv">
                            <dl class="row m-t-md">

                                <?php $request = json_decode($disputeDetail->disputeable->loadTransactionResponse['response'], true)?>

                                <?php foreach (json_decode($request) as $key => $value) { ?>

                                <dt class="col-md-3 text-right">{{ $key }}</dt>

                                <dd class="col-md-8">{{ $value }}</dd>
                                <?php }?>

                            </dl>
                        </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endisset
