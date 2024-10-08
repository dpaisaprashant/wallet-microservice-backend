@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Load Test Fund</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Load Test Fund</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Load Test Fund</strong>
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
                        <form method="post" action="{{ route('loadTestFund.create') }}" enctype="multipart/form-data" id="transactionIdForm">
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Mobile No.</label>
                                <div class="col-sm-10">
                                    <select id="selectTransaction" data-placeholder="Choose Mobile No..." class="chosen-select"  tabindex="2" name="user_id" required>
                                        <option value="" selected disabled>Mobile No.</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" >{{ $user->name . ' - ' . $user->mobile_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-10">
                                    <input name="amount" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="hr-line-dashed"></div>

                            <button id="handleBtn" class="btn btn-sm btn-primary m-t-n-xs" type="submit" formaction="{{ route('loadTestFund.create') }}"><strong>Create</strong></button>
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
        /*$('form').on('submit', function (e) {

            e.preventDefault();

            swal({
                title: "Are you sure?",
                text: "Load Test Fund for this transaction will be created",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, approve",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                console.log(this)
                $('#handleBtn').click();
                swal.close();
            })
        });*/
    </script>



@endsection

