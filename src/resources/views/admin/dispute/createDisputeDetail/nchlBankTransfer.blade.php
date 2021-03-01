@if($detail instanceof \App\Models\NchlBankTransfer)
    <div>
        <h2>NCHL Load Transaction Details</h2>
        <div class="row">
            <div class="col-md-3">
                <h4>User: {{ $detail->user['name'] }}</h4>
                <h4>Email: {{ $detail->user['email'] }}</h4>
                <h4>Contact: {{ $detail->user['mobile_no'] }}</h4>
            </div>

            <div class="col-md-5">
                <h4>Bank: {{ $detail->bank }}</h4>
                <h4>Credit Status: @include('admin.transaction.nchlBankTransfer.creditStatus', ['transaction' => $detail])</h4>
                <h4>Debit Status: @include('admin.transaction.nchlBankTransfer.debitStatus', ['transaction' => $detail])</h4>
                <h4>Amount: Rs. {{ $detail->amount }}</h4>
            </div>

            <div class="col-md-4">
                <h4>Account:
                    @include('admin.transaction.nchlBankTransfer.account', ['transaction' => $detail])
                </h4>
                <h4>Request:
                    @include('admin.transaction.nchlBankTransfer.request', ['transaction' => $detail])
                </h4>
                <h4>Response:
                    @include('admin.transaction.nchlBankTransfer.response', ['transaction' => $detail])
                </h4>


            </div>
        </div>
        <div class="hr-line-dashed"></div>
    </div>
@endif
