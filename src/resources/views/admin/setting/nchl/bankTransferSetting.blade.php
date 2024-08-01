@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NCHL Bank Transfer Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>NCHL Bank Transfer Settings</strong>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('settings.nchl.bankTransfer') }}">
                    @csrf
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
                                <label class="col-sm-2 col-form-label">Base URL</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_base_url'] ?? ''}}" name="nchl_bank_transfer_base_url" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Client Username</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_client_username'] ?? '' }}" name="nchl_bank_transfer_client_username" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Client Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="pp_userPassword" value="{{ $settings['nchl_bank_transfer_client_password'] ?? ''}}" name="nchl_bank_transfer_client_password" type="text" class="form-control">
                                        <span class="input-group-append">
                                        <button type="button" rel="pp_userPassword" class="btn btn-white toggle-password"><i class="fa fa-eye passwordIcon"></i></button>
                                    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">User Username</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_user_username'] ?? '' }}" name="nchl_bank_transfer_user_username" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">User Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="pp_userPassword" value="{{ $settings['nchl_bank_transfer_user_password'] ?? ''}}" name="nchl_bank_transfer_user_password" type="text" class="form-control">
                                        <span class="input-group-append">
                                        <button type="button" rel="pp_userPassword" class="btn btn-white toggle-password"><i class="fa fa-eye passwordIcon"></i></button>
                                    </span>
                                    </div>
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
                            <h5>Debtor Bank Setting</h5>
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
                                <label class="col-sm-2 col-form-label">Debtor Agent</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_debtor_agent'] ?? ''}}" name="nchl_bank_transfer_debtor_agent" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Debtor Branch</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_debtor_branch'] ?? ''}}" name="nchl_bank_transfer_debtor_branch" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Debtor Name</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_debtor_name'] ?? ''}}" name="nchl_bank_transfer_debtor_name" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Debtor Account</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_debtor_account'] ?? ''}}" name="nchl_bank_transfer_debtor_account" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Debtor Id Type</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_debtor_id_type'] ?? ''}}" name="nchl_bank_transfer_debtor_id_type" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Debtor Id Value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_debtor_id_value'] ?? ''}}" name="nchl_bank_transfer_debtor_id_value" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Debtor Address</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_debtor_address'] ?? ''}}" name="nchl_bank_transfer_debtor_address" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Debtor Phone</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_debtor_phone'] ?? ''}}" name="nchl_bank_transfer_debtor_phone" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Debtor Mobile</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_debtor_mobile'] ?? ''}}" name="nchl_bank_transfer_debtor_mobile" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Debtor Email</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_debtor_email'] ?? ''}}" name="nchl_bank_transfer_debtor_email" type="text" class="form-control">
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

                    {{--COMMISSION--}}
                    {{--<div class="ibox ">
                        <div class="ibox-title">
                            <h5>Bank Transfer Commission (Input Currency in paisa)</h5>
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

                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Commission Upto Rs.500</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_upto_500_commission'] ?? ''}}" name="nchl_bank_transfer_upto_500_commission" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Commission from Rs.500 to Rs.5000</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_500_to_5000_commission'] ?? ''}}" name="nchl_bank_transfer_500_to_5000_commission" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Commission from Rs.5000 to Rs.50000</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_5000_to_50000_commission'] ?? ''}}" name="nchl_bank_transfer_5000_to_50000_commission" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Commission greater than Rs.50000</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_bank_transfer_greater_than_50000_commission'] ?? ''}}" name="nchl_bank_transfer_greater_than_50000_commission" type="text" class="form-control">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>--}}
                </form>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.summernote')

    <style>
        select {
            height: 35.6px !important;
        }
    </style>
@endsection

@section('scripts')
    @include('admin.asset.js.passwordToggle')
@endsection

