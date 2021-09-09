@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Update Merchant Type</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Update Merchant Type</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Update Merchant Type</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('merchant.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Merchant name : </label>
                                <div class="col-sm-10">
                                    <select id="selectUserType" data-placeholder="Merchant name..."
                                            class="chosen-select" tabindex="2" name="merchant_name">
                                        <option value="" selected disabled>-- Select merchant name--</option>
                                        @foreach($merchantNames as $key=>$merchantName)
                                            <option value="{{ $merchantName->id }}">{{ $merchantName->name }} &nbsp; ({{ $merchantName->mobile_no }}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Merchant type : </label>
                                <div class="col-sm-10">
                                    <select id="merchant_type" data-placeholder="Merchant type..."
                                            class="chosen-select" tabindex="2" name="merchant_type">
                                        <option value="" selected disabled>-- Select merchant type --</option>
                                        @foreach($merchantTypes as $key=>$merchantType)
                                            <option value="{{ $merchantType->id }}#{{ $merchantType->name }}">{{ $merchantType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="api_username" style="display: none" class="form-group  row"><label class="col-sm-2 col-form-label">API Username : </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" name="api_username" placeholder="API Username">
                                </div>
                            </div>

                            <div id="api_password"  style="display: none" class="form-group  row"><label class="col-sm-2 col-form-label">Api Password : </label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control form-control-sm" name="api_password" placeholder="API Password">
                                </div>
                            </div>

                            <div id="apiUsername"></div>
                            <div id="apiPassword"></div>

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
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.summernote')
    @include('admin.asset.css.chosen')

@endsection

@section('scripts')
    @include('admin.asset.js.summernote')
    @include('admin.asset.js.chosen')
    <script>
        $('#merchant_type').change(function(){
            var merchantType = $('#merchant_type').find(':selected').text();
            if(merchantType == 'reseller'){

                $('#api_username').css('display','flex');
                $('#api_password').css('display','flex');
            }
            if(merchantType == 'normal'){
                $('#api_username').css('display','none');
                $('#api_password').css('display','none');
            }

        });
    </script>
@endsection

