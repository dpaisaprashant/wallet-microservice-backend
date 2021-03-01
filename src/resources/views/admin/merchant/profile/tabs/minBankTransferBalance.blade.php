<div role="tabpanel" id="minBankTransferBalance" class="tab-pane">
    <div class="panel-body">
        <form method="post" action="{{ route('merchant.minBankTransferBalance', $merchant) }}">
            @csrf
            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Merchant default min amount in wallet for Bank Transfer</label>
                <div class="col-sm-10">
                    <input value="{{ $merchant->min_balance_for_bank_transfer }}" name="min_balance_for_bank_transfer" type="text" class="form-control">
                    <small>*Value should be in paisa</small>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group row">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                </div>
            </div>
        </form>

    </div>
</div>
