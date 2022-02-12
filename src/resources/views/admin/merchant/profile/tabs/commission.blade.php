<div role="tabpanel" id="commission" class="tab-pane">
    <div class="panel-body">
        <form method="post" action="{{ route('merchant.commission', $user) }}">
            @csrf
            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Merchant commission type</label>
                <div class="col-sm-10">
                    <select class="form-control" name="commission_type">
                        @if(!empty($user->merchant->commission_type))
                            <option value="FLAT" @if($user->merchant->commission_type == 'FLAT') selected @endif>Flat</option>
                            <option value="PERCENTAGE" @if($user->merchant->commission_type == 'PERCENTAGE') selected @endif>Percentage</option>
                        @else
                            <option value="FLAT">Flat</option>
                            <option value="PERCENTAGE">Percentage</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Merchant commission value</label>
                <div class="col-sm-10">
                    <input value="{{ $user->merchant->commission_value }}" name="commission_value" type="text" class="form-control">
                    <small>*If FLAT value should be in paisa</small>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Merchant to user scan cashback type</label>
                <div class="col-sm-10">
                    <select class="form-control" name="scan_cashback_type">
                        @if(!empty($user->merchant->scan_cashback_type))
                            <option value="FLAT" @if($user->merchant->scan_cashback_type == 'FLAT') selected @endif>Flat</option>
                            <option value="PERCENTAGE" @if($user->merchant->scan_cashback_type == 'PERCENTAGE') selected @endif>Percentage</option>
                        @else
                            <option value="FLAT">Flat</option>
                            <option value="PERCENTAGE">Percentage</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Merchant to user scan cashback value</label>
                <div class="col-sm-10">
                    <input value="{{ $user->merchant->scan_cashback_value }}" name="scan_cashback_value" type="text" class="form-control">
                    <small>*If FLAT value should be in paisa</small>
                </div>
            </div>

            <div class="hr-line-dashed"></div>

            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Merchant to user portal cashback type</label>
                <div class="col-sm-10">
                    <select class="form-control" name="portal_cashback_type">
                        @if(!empty($user->merchant->portal_cashback_type))
                            <option value="FLAT" @if($user->merchant->portal_cashback_type == 'FLAT') selected @endif>Flat</option>
                            <option value="PERCENTAGE" @if($user->merchant->portal_cashback_type == 'PERCENTAGE') selected @endif>Percentage</option>
                        @else
                            <option value="FLAT">Flat</option>
                            <option value="PERCENTAGE">Percentage</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group  row">
                <label class="col-sm-2 col-form-label">Merchant to user portal cashback value</label>
                <div class="col-sm-10">
                    <input value="{{ $user->merchant->portal_cashback_value }}" name="portal_cashback_value" type="text" class="form-control">
                    <small>*If FLAT value should be in paisa</small>
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
