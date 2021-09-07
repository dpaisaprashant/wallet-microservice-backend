@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Add Merchant Credential</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Add Merchant Credential</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add Merchant Credential</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('merchant.reseller') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $id }}">
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">API Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" name="api_username" placeholder="API Username">
                                </div>
                            </div>


                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Api Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control form-control-sm" name="api_password" placeholder="API Password">
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
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.summernote')
    @include('admin.asset.css.chosen')

@endsection

@section('scripts')
    @include('admin.asset.js.summernote')
    @include('admin.asset.js.chosen')

@endsection

