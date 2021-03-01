@if($detail instanceof \App\Models\NchlLoadTransaction)
    <div>
        <h2>NCHL Load Transaction Details</h2>
        <div class="row">
            <div class="col-md-3">
                <h4>User: {{ $detail->user['name'] }}</h4>
                <h4>Email: {{ $detail->user['email'] }}</h4>
                <h4>Contact: {{ $detail->user['mobile_no'] }}</h4>
            </div>

            <div class="col-md-5">
                <h4>Reference Id: {{ $detail->reference_id }}</h4>
                <h4>Payment Mode: ConnectISP</h4>
                <h4>Amount: Rs. {{ $detail->amount }}</h4>
            </div>

            <div class="col-md-4">
                <h4>Status:
                    @include('admin.transaction.nchlLoadTransaction.status', ['transaction' => $detail])
                </h4>
                <h4>Created at: {{ $detail->created_at }}</h4>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
    </div>
@endif
