@isset($detail->refStan)
    <div id="payPointTransactionDetailDiv">
        <h2>PayPoint Transaction Details</h2>
        <div class="row">
            <div class="col-md-3">
                <h4>User: {{ $detail->user['name'] }}</h4>
                <h4>Email: {{ $detail->user['email'] }}</h4>
                <h4>Contact: {{ $detail->user['mobile_no'] }}</h4>
            </div>

            <div class="col-md-5">
                <h4>RefStan: {{ $detail->refStan }}</h4>
                <h4>Bill Number: {{ $detail->checkTransaction->bill_number }}</h4>
                <h4>Code:  {{ $detail->checkTransaction->code }}</h4>
            </div>

            <div class="col-md-4">
                <h4>Vendor: {{ $detail->vendor }}</h4>
                <h4>Amount: Rs. {{ $detail->amount }}</h4>
                <h4>Created at: {{ $detail->created_at }}</h4>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
    </div>
@endisset
