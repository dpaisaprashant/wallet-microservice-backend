@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Agent Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>User Activity Bonus Settings</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
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
                        <form method="post" enctype="multipart/form-data" id="agentForm">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On Registration Bonus Enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="user_activity_bonus_register_enabled">
                                        @if(!empty($settings['user_activity_bonus_register_enabled']))
                                            <option value=0 @if($settings['user_activity_bonus_register_enabled'] == 0) selected @endif>FALSE</option>
                                            <option value=1 @if($settings['user_activity_bonus_register_enabled'] == 1) selected @endif>TRUE</option>
                                        @else
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On registration Bonus Amount</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['user_activity_bonus_register_amount'] ?? ''}}" name="user_activity_bonus_register_amount" type="text" class="form-control">
                                    <small>**Amount should be in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On Kyc Accept Bonus Enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="user_activity_bonus_kyc_accept_enabled">
                                        @if(!empty($settings['user_activity_bonus_kyc_accept_enabled']))
                                            <option value=0 @if($settings['user_activity_bonus_kyc_accept_enabled'] == 0) selected @endif>FALSE</option>
                                            <option value=1 @if($settings['user_activity_bonus_kyc_accept_enabled'] == 1) selected @endif>TRUE</option>
                                        @else
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On Kyc Accept Bonus Amount</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['user_activity_bonus_kyc_accept_amount'] ?? ''}}" name="user_activity_bonus_kyc_accept_amount" type="text" class="form-control">
                                    <small>**Amount should be in paisa</small>
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">First Load Transaction Bonus Enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="user_activity_bonus_first_load_transaction_enabled">
                                        @if(!empty($settings['user_activity_bonus_first_load_transaction_enabled']))
                                            <option value=0 @if($settings['user_activity_bonus_first_load_transaction_enabled'] == 0) selected @endif>FALSE</option>
                                            <option value=1 @if($settings['user_activity_bonus_first_load_transaction_enabled'] == 1) selected @endif>TRUE</option>
                                        @else
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On First Load Transaction Bonus Amount</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['user_activity_bonus_first_load_transaction_amount'] ?? ''}}" name="user_activity_bonus_first_load_transaction_amount" type="text" class="form-control">
                                    <small>**Amount should be in paisa</small>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On First Load Transaction Bonus Min Amount</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['user_activity_bonus_first_load_transaction_min_amount'] ?? ''}}" name="user_activity_bonus_first_load_transaction_min_amount" type="text" class="form-control">
                                    <small>**Amount should be in paisa</small>
                                    <small>**The minimum amount the user should load to be eligible to get the bonus.</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('General setting update')
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    @endcan
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.summernote')
@endsection

@section('scripts')
   @include('admin.asset.js.summernote')

    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
    @include('admin.asset.js.passwordToggle')
@endsection

