@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Scheme </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Create Scheme</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Create Scheme</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('scheme.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Scheme Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" name="scheme_name" placeholder="Scheme Name">
                                </div>
                            </div>


                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Allow Cashback</label>
                                <div class="col-sm-10">
                                    <select id="selectUserType" data-placeholder="Allow Cashback..."
                                            class="chosen-select" tabindex="2" name="allow_cashback" >
                                        <option value="" selected disabled>-- Allow Cashback --</option>
                                        <option value="1">True</option>
                                        <option value="0">False</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Allow Commission</label>
                                <div class="col-sm-10">
                                    <select id="selectUserType" data-placeholder="Allow Commission..."
                                            class="chosen-select" tabindex="2" name="allow_commission" >
                                        <option value="" selected disabled>-- Allow Commission --</option>
                                        <option value="1">True</option>
                                        <option value="0">False</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Validate KYC</label>
                                <div class="col-sm-10">
                                    <select id="selectUserType" data-placeholder="Validate KYC..."
                                            class="chosen-select" tabindex="2" name="validate_kyc" >
                                        <option value="" selected disabled>-- Validate KYC --</option>
                                        <option value="1">True</option>
                                        <option value="0">False</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select id="selectUserType" data-placeholder="ChooseUser Type..."
                                            class="chosen-select" tabindex="2" name="status" >
                                        <option value="" selected disabled>-- Select status --</option>
                                        <option value="1">Active</option>
                                        <option value="0">In-active</option>
                                    </select>
                                </div>
                            </div>

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

