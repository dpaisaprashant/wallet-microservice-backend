@if($disputeDetail->disputeable instanceof \App\Models\NchlBankTransfer)
    <input type="hidden" value="{{ \App\Models\Dispute::VENDOR_TYPE_NCHL_BANK_TRANSFER }}" name="vendor_type">
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
                                <h4>Bank: {{ $disputeDetail->disputeable->bank }}</h4>
                                <h4>Credit Status: @include('admin.transaction.nchlBankTransfer.creditStatus', ['transaction' => $disputeDetail->disputeable])</h4>
                                <h4>Debit Status: @include('admin.transaction.nchlBankTransfer.debitStatus', ['transaction' => $disputeDetail->disputeable])</h4>
                                <h4>Amount: Rs. {{ $disputeDetail->disputeable->amount }}</h4>
                            </div>

                            <div class="col-md-4">
                                <h4>Account:
                                    @include('admin.transaction.nchlBankTransfer.account', ['transaction' => $disputeDetail->disputeable])
                                </h4>
                                <h4>Request:
                                    @include('admin.transaction.nchlBankTransfer.request', ['transaction' => $disputeDetail->disputeable])
                                </h4>
                                <h4>Response:
                                    @include('admin.transaction.nchlBankTransfer.response', ['transaction' => $disputeDetail->disputeable])
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
