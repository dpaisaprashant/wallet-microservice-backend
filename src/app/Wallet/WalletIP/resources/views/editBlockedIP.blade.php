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
                    <a href="{{ route('blockedip.view') }}">Blocked IPs</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Edit Blocked IP</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('blockedip.update',$blockedIP->id) }}"  enctype="multipart/form-data" id="blockedIPForm">
                            @csrf                            
                            @method('PUT')
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">IP</label>
                                <div class="col-sm-10">
                                    <input name="ip" type="text" class="form-control" value="{{$blockedIP->ip}}" required>
                                </div>
                            </div>

                            <div class="form-group  row">   
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input name="description" type="text" class="form-control" value="{{$blockedIP->description}}" required>
                                </div>
                            </div>

                            <div class="form-group  row" style="display:none">
                                <label class="col-sm-2 col-form-label">Blocked At</label>
                                <div class="col-sm-10">
                                    <input name="blocked_at" type="datetime" class="form-control" value="{{$blockedIP->blocked_at}}"  required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Blocked Until</label>
                                <div class="col-sm-10">
                                    <input name="block_duration" type="date" class="form-control" value="{{ Carbon\Carbon::parse($blockedIP->block_duration)->format('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <input name="status" type="text" class="form-control" value="{{$blockedIP->status}}" required>
                                </div>
                            </div>              

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Update</button>
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

