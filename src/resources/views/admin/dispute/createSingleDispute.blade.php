@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Dispute</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Dispute</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create single dispute</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Select transaction ID</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('dispute.singleTransaction') }}" enctype="multipart/form-data" id="transactionIdForm">
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Transaction ID</label>
                                <div class="col-sm-10">
                                <select id="selectTransaction" data-placeholder="Choose Transaction ID..." class="chosen-select"  tabindex="2" name="transaction_id" onchange="this.form.submit()">
                                    <option value="" selected disabled>Choose Transaction ID</option>
                                    @foreach($transactionIDs as $transactionId)
                                        <option value="{{ $transactionId }}" @if($transactionId == $selectedId) selected @endif>{{ $transactionId }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            @isset($detail)
                                @include('admin.dispute.createDisputeDetail.nPay')
                                @include('admin.dispute.createDisputeDetail.payPoint')
                                @include('admin.dispute.createDisputeDetail.nchlLoadTransaction')
                                @include('admin.dispute.createDisputeDetail.nchlBankTransfer')
                            @endisset
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('dispute.createSingleTransaction') }}" method="post">
        @csrf
            @isset($detail)
                @isset($detail->refStan)
                        <input type="hidden" name="transaction_id" value="{{ $detail->id }}">
                        <input type="hidden" name="transaction_type" value="payPoint">
                @elseif($detail->gateway_ref_no)
                        <input type="hidden" name="transaction_id" value="{{ $detail->id }}">
                        <input type="hidden" name="transaction_type" value="nPay">
                @endisset
                @if($detail instanceof \App\Models\NchlBankTransfer)
                        <input type="hidden" name="transaction_id" value="{{ $detail->id }}">
                        <input type="hidden" name="transaction_type" value="nchlBankTransfer">
                @elseif($detail instanceof \App\Models\NchlLoadTransaction)
                        <input type="hidden" name="transaction_id" value="{{ $detail->id }}">
                        <input type="hidden" name="transaction_type" value="nchlLoadTransaction">
                @endif
            @endisset


        @isset($detail)
        <div class="row">
            {{--Mpanel Information--}}
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Vendor Information</h5>
                    </div>
                    <div class="ibox-content">

                            <div class="form-group  row">
                                <div class="col-sm-12">
                                    <select id="vendorStatus" data-placeholder="Select Vendor status.." class="chosen-select"  tabindex="2" name="vendor_status" required>
                                        <option value="" selected disabled>Select Vendor Panel Status</option>
                                        <option value="COMPLETED" >Completed</option>
                                        <option value="ERROR">Error</option>
                                    </select>
                                </div>
                            </div>

                        <div class="form-group  row">
                            <div class="col-sm-12">
                                <input type="number" name="vendor_amount" placeholder="Vendor Amount" class="form-control">
                            </div>
                        </div>



                            <div class="hr-line-dashed"></div>

                    </div>
                </div>
            </div>

            {{--USer Information--}}
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>User Information</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group  row">
                            <div class="col-sm-12">
                                <select id="userStatus" data-placeholder="Select User status.." class="chosen-select"  tabindex="2" name="user_status">
                                    <option value="" selected disabled>Select User Status</option>
                                    <option value="COMPLETED" >Completed</option>
                                    <option value="ERROR">Error</option>
                                    <option value="UNKNOWN">Unknown</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group  row">
                            <div class="col-sm-12">
                                <input type="number" name="user amount" placeholder="User Amount" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                    </div>
                </div>
            </div>
        </div>
        @endisset

        @isset($detail)
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content">
                    <div class="form-group row" style="margin: 0px;">
                        <div class="col-sm-12" >
                            <button id="handle" class="btn btn-primary btn-sm" style="float: right">Handle Dispute</button>
                            <button id="handleBtn"  class="btn btn-primary btn-sm" type="submit" style="display: none">Handle Dispute</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endisset

        </form>
    </div>



@endsection

@section('styles')
    <link href="{{ asset('admin/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">

    <style>
        .note-editing-area{
            height: 150px;
        }
    </style>

    @include('admin.asset.css.chosen')

    <!-- Sweet Alert -->
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

@endsection

@section('scripts')
    <!-- SUMMERNOTE -->
    <script src="{{ asset('admin/js/plugins/summernote/summernote-bs4.js') }}"></script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

        });
    </script>

    @include('admin.asset.js.chosen')


    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $('#handle').on('click', function (e) {

            e.preventDefault();

            swal({
                title: "Are you sure?",
                text: "Dispute for this transaction will be created",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3366ff",
                confirmButtonText: "Yes, approve",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#handleBtn').trigger('click');
                swal.close();
            })
        });
    </script>



@endsection

