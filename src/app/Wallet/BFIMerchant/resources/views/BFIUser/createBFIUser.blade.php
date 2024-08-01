@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create BFI User </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Create BFI User</a>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add new BFI User</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('bfi.user.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">BFI Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" name="bfi_name">
                                </div>
                            </div>


                            <div class="form-group  row"><label class="col-sm-2 col-form-label">BFI Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control form-control-sm" name="bfi_password">
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group row"><label class="col-sm-2 col-form-label">API User Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" name="api_username">
                                </div>
                            </div>

                            <div class="form-group row"><label class="col-sm-2 col-form-label">API Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control form-control-sm" name="api_password">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row"><label class="col-sm-2 col-form-label">Portal User Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" name="portal_username">
                                </div>
                            </div>


                            <div class="form-group row"><label class="col-sm-2 col-form-label">Portal Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control form-control-sm" name="portal_password">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row"><label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control form-control-sm" name="email">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select id="selectUserType" data-placeholder="ChooseUser Type..."
                                            class="chosen-select" tabindex="2" name="bfi_id" >
                                        <option value="" selected disabled>-- Select status --</option>
                                        <option value="1">Active</option>
                                        <option value="0">In-active</option>
                                    </select>
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

