<div role="tabpanel" id="bankDetails" class="tab-pane">
    <div class="panel-body">

        @if($user->bankAccount)
        <form method="post" action="{{ route('merchant.bankAccount', $user) }}">
            @csrf

            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Account Number</label>
                <div class="col-sm-10">
                    <input value="{{ $user->bankAccount->account_number }}" name="account_number" type="text" class="form-control">
                </div>
            </div>

            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Account Name</label>
                <div class="col-sm-10">
                    <input value="{{ $user->bankAccount->account_name }}" name="account_name" type="text" class="form-control">
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Bank Name</label>
                <div class="col-sm-10">
                    <input value="{{ $user->bankAccount->bank_name }}" name="bank_name" type="text" class="form-control">
                </div>
            </div>

            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Branch Name</label>
                <div class="col-sm-10">
                    <input value="{{ $user->bankAccount->branch_name }}" name="branch_name" type="text" class="form-control">
                </div>
            </div>

            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Bank ID</label>
                <div class="col-sm-10">
                    <input value="{{ $user->bankAccount->bank_id }}" name="bank_id" type="text" class="form-control">
                </div>
            </div>

            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Branch ID</label>
                <div class="col-sm-10">
                    <input value="{{ $user->bankAccount->branch_id }}" name="branch_id" type="text" class="form-control">
                </div>
            </div>
            <div class="hr-line-dashed"></div>

            <div class="form-group row">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                </div>
            </div>
        </form>
        @endif

    </div>
</div>
