@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>BFI Repost</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
{{--                    <a href="{{ route('admin.dashboard') }}">Home</a>--}}
                </li>
                <li class="breadcrumb-item">
                    <a>Repost</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>BFI Repost</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            @include('admin.asset.notification.notify')
            <div class="col-lg-12">
                <form target="_blank" method="POST" enctype="multipart/form-data" action="{{ route("repost.khalti") }}">
                    @csrf
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>BFI Repost</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Reference Id</label>
                                <div class="col-sm-10">
                                    <input name="reference" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-10">
                                    <input name="amount" type="number" step="0.1" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
{{--                                    <select>--}}
{{--                                        <option>Success</option>--}}
{{--                                        <option>Failed</option>--}}
{{--                                    </select>--}}
                                    <input name="status" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Detail</label>
                                <div class="col-sm-10">
                                    <input name="detail" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Response Id</label>
                                <div class="col-sm-10">
                                    <input name="response_id" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Repost Transaction</button>
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

@endsection

