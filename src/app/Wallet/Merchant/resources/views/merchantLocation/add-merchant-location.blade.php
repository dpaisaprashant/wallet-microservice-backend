@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Add Merchant Address</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant Address</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Add Merchant Address</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form method="post" action="{{ route('merchant.location.create') }}" id="merchantLocationForm">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Add Merchant Address</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="col-md-12">
                                @include('admin.asset.notification.notify')
                            </div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Location Name</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4 col-sm-offset-2">
                    <button class="btn btn-primary btn-sm" type="submit">Add</button>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('styles')

    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datatable')
    {{--    @include('admin.asset.css.jsonbubble')--}}
    {{--    @include('admin.asset.css.jsoneditor')--}}


@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datatable')
    {{--    @include('admin.asset.js.jsonbubble')--}}
    {{--    @include('admin.asset.js.jsoneditor')--}}


@endsection

