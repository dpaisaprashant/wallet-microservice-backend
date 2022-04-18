@extends('admin.layouts.admin_design')

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>System Repost</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Refund</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>System Repost</strong>
                </li>
            </ol>
        </div>
    </div>

    @include('admin.asset.notification.notify')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Enter user and Transaction Details</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{route('create.system.repost')}}" enctype="multipart/form-data"
                              id="transactionIdForm">
                            @csrf

                            @isset($_GET["amount"])
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-sm-12">
                                        <div class="alert alert-warning" style="width: 100%">
                                            <i class="fa fa-info-circle"></i>&nbsp; Total Refunding amount (bonus
                                            balance + main balance) should be <b>Rs. {{ $_GET["amount"] }}</b>
                                        </div>
                                    </div>
                                </div>
                            @endisset

                            <div class="row" style="margin-top: 10px">
                                <div class="col-sm-12">
                                    <div class="alert alert-danger" style="width: 100%">
                                        <i class="fa fa-exclamation-triangle"></i>&nbsp; Please check the user's audit
                                        trial page before refunding the transaction!!. Once refunded the amount is added
                                        to user's wallet. The process cannot be undone if user spends the amount from
                                        their wallet.</b>
                                    </div>
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Mobile No</label>
                                <div class="col-sm-10">
                                    <input name="mobile_no" type="text" class="form-control" required
                                           @isset($_GET["mobile_no"]) value="{{ $_GET["mobile_no"] }}" @endisset>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Pre Transaction Id</label>
                                <div class="col-sm-10">
                                    <input name="pre_transaction_id" type="text" class="form-control" required
                                           @isset($_GET["pre_transaction_id"]) value="{{ $_GET["pre_transaction_id"] }}" @endisset>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Transaction Type</label>
                                <div class="col-sm-10">
                                    <select name="transaction_type" class="chosen-select" id="" required>
                                        <option value="" disabled selected>Select Transaction Type</option>
                                        @foreach($transaction_types as $transaction_type)
                                            <option
                                                value="{{$transaction_type->transaction_type}}">{{$transaction_type->transaction_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Update Balance</label>
                                <div class="col-sm-10 i-checks">
                                    <label style="">
                                        <input type="checkbox" name="update_balance">
                                        <i></i> <span>&nbsp;Check if the balance needs to be updated</span>
                                    </label>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Update Timestamp</label>
                                <div class="col-sm-10 i-checks">
                                    <label style="">
                                        <input type="checkbox" name="update_timestamp">
                                        <i></i> <span>&nbsp;Check if the timestamp needs to be updated to now</span>
                                    </label>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <button id="manual_refund" class="btn btn-sm btn-primary m-t-n-xs" type="submit"
                                    formaction="{{route('create.system.repost')}}"><strong>System Repost</strong></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.icheck')

    <style>
        .icheckbox_square-green {
            margin-top: 5px;
        }
    </style>

    <!-- Sweet Alert -->
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.icheck')
    @include('admin.asset.js.datatable')



    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

        <script>
            $('#manual_refund').on("click",function (e){
                $('#overlay').fadeIn(300);
                $('overlay').fadeOut(300);
            })
        </script>



@endsection
