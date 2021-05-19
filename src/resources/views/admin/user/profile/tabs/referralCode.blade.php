<div role="tabpanel" id="referralCode" class="tab-pane @if($activeTab == 'referralCode') active @endif">

    <div class="panel-body" id="referralCode">

            <div class="row">
                <div class="col-lg-12">

                                <form method="post" enctype="multipart/form-data" id="notificationForm" action="{{ route('user.referralCode', $user->id) }}">
                                    @csrf
                                    <h3>Referral Code</h3>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Referral Code</label>
                                        <div class="col-sm-10">
                                            <input value="{{ $user->userReferral->code ?? ''}}" name="referral_code" type="text" class="form-control">
                                            <small>*Referral code must be unique</small>
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
        </div>


</div>
