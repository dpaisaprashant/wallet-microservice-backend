@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>PayPoint Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>PayPoint Settings</strong>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('settings.paypoint') }}">
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
                                <label class="col-sm-2 col-form-label">PayPoint Service enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="paypoint_service_enable">
                                        @if(!empty($settings['paypoint_service_enable']))
                                            <option value=0 @if($settings['paypoint_service_enable'] == 0) selected @endif>FALSE</option>
                                            <option value=1 @if($settings['paypoint_service_enable'] == 1) selected @endif>TRUE</option>
                                        @else
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">PayPoint Base URL</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['pp_base_url'] ?? ''}}" name="pp_base_url" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">PayPoint User ID</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['pp_userId'] ?? '' }}" name="pp_userId" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">PayPoint User Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="pp_userPassword" value="{{ $settings['pp_userPassword'] ?? ''}}" name="pp_userPassword" type="text" class="form-control">
                                        <span class="input-group-append">
                                        <button type="button" rel="pp_userPassword" class="btn btn-white toggle-password"><i class="fa fa-eye passwordIcon"></i></button>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">SalePoint Type</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['pp_salePointType'] ?? ''}}" name="pp_salePointType" type="text" class="form-control">
                                </div>
                            </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        @can('Paypoint setting update')
                                            <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                        @endcan
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
    @include('admin.asset.js.summernote')
    @include('admin.asset.js.passwordToggle')
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection

