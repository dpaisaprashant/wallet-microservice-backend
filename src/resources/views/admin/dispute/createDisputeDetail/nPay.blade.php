@isset($detail->gateway_ref_no)
    <div id="nPayTransactionDetailDiv">
        <h2>NPay Transaction Details</h2>
        <div class="row">
            <div class="col-md-3">
                <h4>User: {{ $detail->user['name'] }}</h4>
                <h4>Email: {{ $detail->user['email'] }}</h4>
                <h4>Contact: {{ $detail->user['mobile_no'] }}</h4>
            </div>

            <div class="col-md-5">
                <h4>Process Id: {{ $detail->process_id }}</h4>
                <h4>Payment Mode: {{ $detail->payment_mode }}</h4>
                <h4>Amount: Rs. {{ $detail->amount }}</h4>
                <h4>Transaction Fee: Rs. {{ $detail->transaction_fee ?? 0 }}</h4>
            </div>

            <div class="col-md-4">
                <h4>Gateway Ref no: {{ $detail->gateway_ref_no }}</h4>
                <h4>Status:
                    @if($detail->status == 'COMPLETED')
                        <span class="badge badge-primary">{{ $detail->status }}</span>
                    @elseif($detail->status == 'VALIDATED')
                        <span class="badge badge-warning">{{ $detail->status }}</span>
                    @else
                        <span class="badge badge-danger">{{ $detail->status }}</span>
                    @endif
                </h4>
                <h4>Created at: {{ $detail->created_at }}</h4>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
    </div>
@endisset
