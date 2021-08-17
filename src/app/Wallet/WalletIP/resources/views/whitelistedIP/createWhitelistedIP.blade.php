@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Block an IP</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('blockedip.view') }}">Whitelisted IPs</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Whitelist an IP</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" enctype="multipart/form-data" id="blockedIPForm">
                            @csrf                            

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">IP</label>
                                <div class="col-sm-10">
                                    <input name="ip" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">   
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="title" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <input name="status" type="text" class="form-control" required>
                                </div>
                            </div> 

                            <div class="form-group  row" style="display:none">
                                <label class="col-sm-2 col-form-label">Created At</label>
                                <div class="col-sm-10">
                                    <input name="blocked_at" type="datetime" class="form-control" value="{{\Carbon\Carbon::now()->format('Y-m-d\TH:i')}}"  required>
                                </div>
                            </div>
                              

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Whitelist IP</button>
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
    @include('admin.asset.css.select2')
    @include('admin.asset.css.datepicker')
@endsection

@section('scripts')
    @include('admin.asset.js.select2')
    @include('admin.asset.js.datepicker')
@endsection

