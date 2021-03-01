<div role="tabpanel" id="cardLoadCommission" class="tab-pane @if($activeTab == 'cardLoadCommission') active @endif">

    <div class="panel-body" id="cardLoadCommission">

            <div class="row">
                <div class="col-lg-12">

                                <form method="post" enctype="multipart/form-data" id="notificationForm" action="{{ route('user.cardLoadCommission', $user->id) }}">
                                    @csrf
                                    <h3>Card Load Commission</h3>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Card Load Commission Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="commission_type">
                                                @if(!empty(optional($userLoadCommission)->commission_type))
                                                    <option value="FLAT" @if(optional($userLoadCommission)->commission_type == 'FLAT') selected @endif>Flat</option>
                                                    <option value="PERCENTAGE" @if(optional($userLoadCommission)->commission_type == 'PERCENTAGE') selected @endif>Percentage</option>
                                                @else
                                                    <option value="FLAT">Flat</option>
                                                    <option value="PERCENTAGE">Percentage</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Card Load Commission Value</label>
                                        <div class="col-sm-10">
                                            <input value="{{ optional($userLoadCommission)->commission_value ?? ""}}" name="commission_value" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


            </div>
        </div>


</div>
