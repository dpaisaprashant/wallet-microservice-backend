@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Merchant Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Merchant Settings</strong>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="{{ route('settings.merchant') }}">
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
                                <label class="col-sm-2 col-form-label">Merchant Commission enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="merchant_commission_enable">
                                        @if(!empty($settings['merchant_commission_enable']))
                                            <option value=0 @if($settings['merchant_commission_enable'] == 0) selected @endif>FALSE</option>
                                            <option value=1 @if($settings['merchant_commission_enable'] == 1) selected @endif>TRUE</option>
                                        @else
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Merchant default min amount in wallet for Bank Transfer</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['merchant_default_min_amount_for_bank_transfer'] ?? ''}}" name="merchant_default_min_amount_for_bank_transfer" type="text" class="form-control">

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Merchant default commission type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="merchant_default_commission_type">
                                        @if(!empty($settings['merchant_default_commission_type']))
                                            <option value="FLAT" @if($settings['merchant_default_commission_type'] == 'FLAT') selected @endif>Flat</option>
                                            <option value="PERCENTAGE" @if($settings['merchant_default_commission_type'] == 'PERCENTAGE') selected @endif>Percentage</option>
                                        @else
                                            <option value="FLAT">Flat</option>
                                            <option value="PERCENTAGE">Percentage</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Merchant default commission value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['merchant_default_commission_value'] ?? ''}}" name="merchant_default_commission_value" type="text" class="form-control">
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
    @include('admin.asset.js.summernote')
    @include('admin.asset.js.passwordToggle')
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection

