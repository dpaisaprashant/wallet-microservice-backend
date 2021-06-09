@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Load For Paypoint</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Load for Paypoint</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Load for Paypoint</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Select User</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('loadTestFund.create') }}" enctype="multipart/form-data" id="loadForPayppointForm">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">User</label>
                                <div class="col-sm-10">
                                    <input name="user" value="{{ $user->name . " ({$user->mobile_no})" }}" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Amount in Rs.</label>
                                <div class="col-sm-10">
                                    <input name="amount" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <button id="handleBtn" class="btn btn-sm btn-primary m-t-n-xs" type="submit" formaction="{{ route('paypoint.loadTestFund.create') }}"><strong>Create</strong></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('styles')
    @include('admin.asset.css.chosen')

    <!-- Sweet Alert -->
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

@endsection

@section('scripts')
    @include('admin.asset.js.chosen')


    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $('form').on('submit', function (e) {

            e.preventDefault();
            let formObj = $(this);

            swal({
                title: "Are you sure?",
                text: "Amount will be loaded to this user's wallet",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, approve",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                console.log(formObj)
                formObj.submit()
            })
        });
    </script>



@endsection

