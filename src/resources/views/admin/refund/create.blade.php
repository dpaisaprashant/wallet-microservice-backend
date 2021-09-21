@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Refund</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Refund</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Refund</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Enter user Mobile Number</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('loadTestFund.create') }}" enctype="multipart/form-data" id="transactionIdForm">
                            @csrf

                            @isset($_GET["amount"])
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-sm-12">
                                        <div class="alert alert-warning" style="width: 100%">
                                            <i class="fa fa-info-circle"></i>&nbsp; Total Refunding amount (bonus balance + main balance) should be <b>Rs. {{ $_GET["amount"] }}</b>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            <div class="row" style="margin-top: 10px">
                                <div class="col-sm-12">
                                    <div class="alert alert-danger" style="width: 100%">
                                        <i class="fa fa-exclamation-triangle"></i>&nbsp; Please check the user's audit trial page before refunding the transaction!!. Once refunded the amount is added to user's wallet. The process cannot be undone if user spends the amount from their wallet.</b>
                                    </div>
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Mobile No</label>
                                <div class="col-sm-10">
                                    <input name="mobile_no" type="text" class="form-control" required @isset($_GET["mobile_no"]) value="{{ $_GET["mobile_no"] }}" @endisset>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Amount (in Rs.)</label>
                                <div class="col-sm-10">
                                    <input name="amount" type="text" class="form-control">
                                    <small>Amount Should be in Rs.</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Bonus Amount (in Rs.)</label>
                                <div class="col-sm-10">
                                    <input name="bonus_amount" type="text" class="form-control">
                                    <small>Amount Should be in Rs.</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Pre Transaction Id</label>
                                <div class="col-sm-10">
                                    <input name="pre_transaction_id" type="text" class="form-control" required @isset($_GET["pre_transaction_id"]) value="{{ $_GET["pre_transaction_id"] }}" @endisset>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <button id="handleBtn" class="btn btn-sm btn-primary m-t-n-xs" type="submit" formaction="{{ route('refund.create') }}"><strong>Create</strong></button>
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
                text: "Refund for this transaction will be created",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3366ff",
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

