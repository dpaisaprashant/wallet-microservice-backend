<div class="ibox ">
    <div class="ibox-title">
        <h5>USER TRANSACTION DISPUTE</h5>
    </div>

    <?php $transaction = $disputeTransaction->disputeable ?>
    <div class="ibox-content">

        @csrf
        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">Transaction ID</label>
            <div class="col-sm-10">
                <input value="{{ $transaction->id }}" name="transaction_id" type="text" class="form-control" disabled>
            </div>
        </div>

        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">Ref Stan</label>
            <div class="col-sm-10">
                <input value="{{ $transaction->refStan }}" name="refStan" type="text" class="form-control" disabled>
            </div>
        </div>

        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">Vendor</label>
            <div class="col-sm-10">
                <input value="{{ $transaction->vendor }}" name="vendor" type="text" class="form-control" disabled>
            </div>
        </div>

        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">Dispute created on</label>
            <div class="col-sm-10">
                <input value="{{ $disputeTransaction->dispute->clearance->created_at }}" name="dispute_date" type="text" class="form-control" disabled>
            </div>
        </div>

        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">Dispute Amount</label>
            <div class="col-sm-10">
                <input value="Rs. {{ $transaction->amount }}" name="dispute_amount" type="text" class="form-control" disabled style="color: red">
                <input type="hidden" value="{{ $transaction->amount }}" name="dispute_amount">
            </div>
        </div>

        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10">
                <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2" name="status">
                    <option value="DISPUTED"
                            @if($disputeTransaction->dispute_status == \App\Models\DisputeTransaction::DISPUTE_STATUS_DISPUTED)
                            selected
                        @endif>DISPUTED</option>
                    <option value="HANDLED"
                            @if($disputeTransaction->dispute_status == \App\Models\DisputeTransaction::DISPUTE_STATUS_HANDLED)
                            selected
                        @endif>HANDLED</option>
                    <option value="CLEARED"
                            @if($disputeTransaction->dispute_status == \App\Models\DisputeTransaction::DISPUTE_STATUS_CLEARED)
                            selected
                        @endif>CLEARED</option>
                </select>
            </div>
        </div>


        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">Handled On</label>
            <div class="col-sm-10">
                <select required data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2" name="clearance_id">
                    @foreach($clearances as $clearance)
                        <option value="" disabled selected>Select Clearance Date</option>
                        <option value="{{ $clearance->id }}" @if($clearance->id == $disputeTransaction->cleared_clearance_id) selected @endif>
                            {{ date('d M, Y   H:i:s', strtotime($clearance->created_at)) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group  row">
            <label class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">

                <textarea name="description" id="" placeholder="Description/Note" style="width: 100%; height: 150px">

                </textarea>

            </div>

        </div>

        <div class="hr-line-dashed"></div>

        <div class="form-group row">
            <div class="col-sm-4 col-sm-offset-2">
                <button class="btn btn-primary btn-sm" type="submit">Handle Transaction</button>
            </div>
        </div>

    </div>
</div>
