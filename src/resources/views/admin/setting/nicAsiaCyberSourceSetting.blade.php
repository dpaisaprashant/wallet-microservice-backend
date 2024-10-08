@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>CyberSource Load Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>CyberSource Load Settings</strong>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('settings.nicAsiaCyberSource') }}">
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
                                <label class="col-sm-2 col-form-label">CyberSource Redirect Url</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nic_asia_cybersource_redirect_url'] ?? ''}}" name="nic_asia_cybersource_redirect_url" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">CyberSource Profile Id</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nic_asia_cybersource_profile_id'] ?? ''}}" name="nic_asia_cybersource_profile_id" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">CyberSource Access Key</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nic_asia_cybersource_access_key'] ?? '' }}" name="nic_asia_cybersource_access_key" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>

                            {{--<div class="form-group  row">
                                <label class="col-sm-2 col-form-label">CyberSource Secret Key</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['nic_asia_cybersource_secret_key'] ?? '' }}" name="nic_asia_cybersource_secret_key" type="text" class="form-control">
                                </div>
                            </div>--}}
                        </div>
                    </div>
                    {{--<div class="ibox ">
                        <div class="ibox-title">
                            <h5>Commission</h5>
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
                                <label class="col-sm-2 col-form-label">Card Load Commission Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="nic_asia_cybersource_commission_type">
                                        @if(!empty($settings['nic_asia_cybersource_commission_type']))
                                            <option value="FLAT" @if($settings['nic_asia_cybersource_commission_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings['nic_asia_cybersource_commission_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
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
                                    <input value="{{ $settings['nic_asia_cybersource_commission_value'] ?? ''}}" name="nic_asia_cybersource_commission_value" type="text" class="form-control">
                                </div>
                            </div>


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

