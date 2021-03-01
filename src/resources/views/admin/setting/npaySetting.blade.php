@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NPay Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Npay Settings</strong>
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
                        <form method="post" enctype="multipart/form-data" id="notificationForm">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NPAY Service enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="npay_service_enable">
                                        @if(!empty($settings['npay_service_enable']))
                                            <option value=0 @if($settings['npay_service_enable'] == 0) selected @endif>FALSE</option>
                                            <option value=1 @if($settings['npay_service_enable'] == 1) selected @endif>TRUE</option>
                                        @else
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">API Key</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['npay_api_key'] ?? ''}}" name="npay_api_key" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Merchant ID</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['npay_merchant_id'] ?? ''}}" name="npay_merchant_id" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['npay_username'] ?? ''}}" name="npay_username" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="npay_password" value="{{ $settings['npay_password'] ?? ''}}" name="npay_password" type="text" class="form-control">
                                        <span class="input-group-append">
                                        <button type="button" rel="npay_password" class="btn btn-white toggle-password"><i class="fa fa-eye passwordIcon"></i></button>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">API Password</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['npay_api_password'] ?? '' }}" name="npay_api_password" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Signature Passcode</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="npay_signature_passcode" type="text" class="form-control" value="{{ $settings['npay_signature_passcode'] ?? '' }}" name="npay_signature_passcode">
                                        <span class="input-group-append">
                                            <button type="button" rel="npay_signature_passcode" class="btn btn-white toggle-password"><i class="fa fa-eye passwordIcon"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Merchant URL</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['npay_merchant_url'] ?? ''}}" name="npay_merchant_url" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    @can('Npay setting update')
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

