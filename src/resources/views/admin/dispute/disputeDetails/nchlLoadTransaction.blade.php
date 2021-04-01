@if($disputeDetail->disputeable instanceof \App\Models\NchlLoadTransaction)
    <input type="hidden" value="{{ \App\Models\Dispute::VENDOR_TYPE_NCHL_LOAD_TRANSACTION }}" name="vendor_type">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Dispute Details</h5>
                </div>
                <div class="ibox-content">
                    <div id="nPayTransactionDetailDiv">
                        <h2>NCHL Load Transaction Details</h2>
                        <div class="row">
                            <div class="col-md-3">
                                <h4>User: {{ $disputeDetail->disputeable->user['name'] }}</h4>
                                <h4>Email: {{ $disputeDetail->disputeable->user['email'] }}</h4>
                                <h4>Contact: {{ $disputeDetail->disputeable->user['mobile_no'] }}</h4>
                            </div>

                            <div class="col-md-5">
                                <h4>Reference Id: {{ $disputeDetail->disputeable->reference_id }}</h4>
                                <h4>Bank: ConnectISP</h4>
                                <h4>Amount: Rs. {{ $disputeDetail->disputeable->amount }}</h4>
                            </div>

                            <div class="col-md-4">
                                <h4>Status:
                                   @include('admin.transaction.nchlLoadTransaction.status', ['transaction' => $disputeDetail->disputeable])
                                </h4>
                                <h4>Created at: {{ $disputeDetail->disputeable->created_at }}</h4>
                                <h4>Validation Response: @include('admin.transaction.nchlLoadTransaction.response', ['transaction' => $disputeDetail->disputeable])</h4>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
