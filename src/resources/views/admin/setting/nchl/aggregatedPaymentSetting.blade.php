@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Aggregated Payment Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Aggregated Payment Settings</strong>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('settings.nchl.aggregatedPayments') }}">
                    @csrf
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Payment's App Group Id</h5>
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
                                <label class="col-sm-2 col-form-label">Add App Service Id</label>
                                <div class="col-sm-10">
                                    <a id="resetDailyLimit" href="{{ route('settings.nchl.aggregatedService.list') }}" class="btn btn-primary"><b>Add App Service Id</b></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Payment's App Group Id</h5>
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
                                <label class="col-sm-2 col-form-label">GOVERNMENT REVENUE PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_government_revenue'] ?? ''}}" name="nchl_ap_group_id_government_revenue" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">
                                    WALLET INTEROPERABILITY PAYMENT
                                </label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_wallet_interoperability'] ?? ''}}" name="nchl_ap_group_id_wallet_interoperability" type="text" class="form-control">
                                </div>
                            </div>


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">SOCIAL SECURITY PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_social_security'] ?? ''}}" name="nchl_ap_group_id_social_security" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">CITIZEN INVESTMENT TRUST PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_citizen_investment_trust'] ?? ''}}" name="nchl_ap_group_id_citizen_investment_trust" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">CREDIT CARD PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_credit_card'] ?? ''}}" name="nchl_ap_group_id_credit_card" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">MERO SHARE PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_mero_share'] ?? ''}}" name="nchl_ap_group_id_mero_share" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">DMAT PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_dmat'] ?? ''}}" name="nchl_ap_group_id_dmat" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">BONUS TAX PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_bonus_tax'] ?? ''}}" name="nchl_ap_group_id_bonus_tax" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">BROKER PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_broker'] ?? ''}}" name="nchl_ap_group_id_broker" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">LIFE INSURANCE PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_life_insurance'] ?? ''}}" name="nchl_ap_group_id_life_insurance" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">SCHOOL PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_school'] ?? ''}}" name="nchl_ap_group_id_school" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">COLLEGE PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_college'] ?? ''}}" name="nchl_ap_group_id_college" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">TOUR AND TRAVEL PAYMENT</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nchl_ap_group_id_tours_and_travel'] ?? ''}}" name="nchl_ap_group_id_tours_and_travel" type="text" class="form-control">
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

