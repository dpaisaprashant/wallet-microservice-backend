@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Referral Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Referral Settings</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form method="post" enctype="multipart/form-data" id="notificationForm">
            @csrf
            <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Settings</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Referral Service Enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="referral_service_enable">
                                        @if(!empty($settings['referral_service_enable']))
                                            <option value=0 @if($settings['referral_service_enable'] == 0) selected @endif>FALSE</option>
                                            <option value=1 @if($settings['referral_service_enable'] == 1) selected @endif>TRUE</option>
                                        @else
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <h3>Register</h3>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Referral Old user amount on register(Code owner)</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['referral_old_user_amount'] ?? ''}}" name="referral_old_user_amount" type="text" class="form-control">
                                    <small>*amount in paisa</small>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Referral New user amount on register (Code user)</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['referral_new_user_amount'] ?? ''}}" name="referral_new_user_amount" type="text" class="form-control">
                                    <small>*amount in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h3>KYC Accept</h3>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Referral Old user amount on KYC accept(Code owner)</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['referral_old_user_amount_on_kyc_accept'] ?? ''}}" name="referral_old_user_amount_on_kyc_accept" type="text" class="form-control">
                                    <small>*amount in paisa</small>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Referral New user amount on KYC accept (Code user)</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['referral_new_user_amount_on_kyc_accept'] ?? ''}}" name="referral_new_user_amount_on_kyc_accept" type="text" class="form-control">
                                    <small>*amount in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h3>First Transaction</h3>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Referral Old user amount on first transaction(Code owner)</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['referral_old_user_amount_on_first_transaction'] ?? ''}}" name="referral_old_user_amount_on_first_transaction" type="text" class="form-control">
                                    <small>*amount in paisa</small>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Referral New user amount on first transaction (Code user)</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['referral_new_user_amount_on_first_transaction'] ?? ''}}" name="referral_new_user_amount_on_first_transaction" type="text" class="form-control">
                                    <small>*amount in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Referral Min Limit</h5>
                    </div>
                    <div class="ibox-content">


                            <h3>Min Load Limit</h3>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Referral Min Load Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['referral_min_load_limit'] ?? ''}}" name="referral_min_load_limit" type="text" class="form-control">
                                    <small>*amount in paisa</small>
                                </div>
                            </div>

                            <h3>Min Payment Limit</h3>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Referral Min Payment Limit</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['referral_min_payment_limit'] ?? ''}}" name="referral_min_payment_limit" type="text" class="form-control">
                                    <small>*amount in paisa</small>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>


                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                    </div>
                </div>

                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Referral Hold Amount</h5>
                    </div>
                    <div class="ibox-content">


                        <h3>Hold amount</h3>
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Hold amount before 1st transaction</label>
                            <div class="col-sm-10">
                                <input value="{{ $settings['referral_hold_amount'] ?? ''}}" name="referral_hold_amount" type="text" class="form-control">
                                <small>*amount in paisa</small>
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                        <h3>First Transaction Amount</h3>
                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Utility Payment >= than this amount is considered to be 1st transaction</label>
                            <div class="col-sm-10">
                                <input value="{{ $settings['referral_first_transaction_amount'] ?? ''}}" name="referral_first_transaction_amount" type="text" class="form-control">
                                <small>*amount in paisa</small>
                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>


                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
