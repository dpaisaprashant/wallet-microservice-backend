@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Handle Dispute</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Dispute</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Handle Dispute</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form action="{{ route('dispute.createHandle') }}" method="post">
            @csrf
            @isset($disputeDetail->disputeable)
                @include('admin.dispute.disputeDetails.nPay')
                @include('admin.dispute.disputeDetails.payPoint')
                @include('admin.dispute.disputeDetails.nchlLoadTransaction')
                @include('admin.dispute.disputeDetails.nchlBankTransfer')
            @endisset

            {{--Dispute Details--}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Dispute Details</h5>
                        </div>
                        <div class="ibox-content">
                            <div id="nPayTransactionDetailDiv">
                                <div class="row">
                                    <div class="col-md-3">
                                        <h4>User Dispute
                                            Status: @include('admin.dispute.status.userStatus', ['dispute' => $disputeDetail])</h4>
                                        <h4>Clearance Dispute
                                            Status: @include('admin.dispute.status.clearanceStatus', ['dispute' => $disputeDetail])</h4>
                                    </div>

                                    <div class="col-md-3">
                                        <h4>Vendor Status: {{ $disputeDetail->vendor_status }}</h4>
                                        <h4>Vendor Amount: Rs. {{ $disputeDetail->vendor_amount }}</h4>
                                    </div>

                                    <div class="col-md-3">
                                        <h4>User Status: {{ $disputeDetail->user_status ?? 'Unknown' }}</h4>
                                        @isset($disputeDetail['user_amount'])
                                            <h4>User Amount: {{ 'Rs. ' . $disputeDetail['user_amount'] ?? 'null' }}</h4>
                                        @else
                                            <h4>User Amount: Unknown</h4>
                                        @endisset
                                    </div>

                                    <div class="col-md-3">
                                        @isset($disputeDetail->source)
                                            <h4>Error Source: {{ $disputeDetail->source }} </h4>
                                        @endif

                                        @isset($disputeDetail->handler)
                                            <h4>Handler: {{ $disputeDetail->handler }} </h4>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="dispute_id" value="{{ $disputeDetail->id  }}">

            {{--SELECT PROBLEM SOURCE--}}
            <div class="row">
                @if($disputeDetail->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_STARTED)
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Error Source</h5>
                            </div>
                            <div class="ibox-content">
                                    <div class="form-group  row">
                                        <div class="col-sm-12">
                                            <select id="source" data-placeholder="Select Mistake Source.."
                                                    class="chosen-select" tabindex="2" name="problem_source" required>
                                                <option value="" selected disabled>Select Problem Source</option>
                                                @if($disputeDetail->vendor_type == \App\Models\Dispute::VENDOR_TYPE_NPAY)
                                                    <option value="NPAY">NPAY</option>
                                                @endif
                                                @if($disputeDetail->vendor_type == \App\Models\Dispute::VENDOR_TYPE_PAYPOINT)
                                                    <option value="PAYPOINT">PAYPOINT</option>
                                                @endif
                                                <option value="DPAISA">DPAISA</option>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    {{--user handle--}}
                    <div class="col-lg-6">
                        <div class="ibox ">
                            <div class="ibox-title">
                                <h5>Dispute Handler</h5>
                            </div>
                            <div class="ibox-content">
                                @if($disputeDetail->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_STARTED)
                                    <div class="form-group  row">
                                        <div class="col-sm-12">
                                            <select id="userStatus" data-placeholder="Select Dispute handler.."
                                                    class="chosen-select" tabindex="2" name="dispute_handler" required>
                                                <option value="" selected disabled>Select Dispute Handler</option>
                                                <option value="{{ \App\Models\Dispute::HANDLER_AUTOMATIC }}">Automatic
                                                </option>
                                                <option value="{{ \App\Models\Dispute::HANDLER_MANUAL_REIMBURSE }}">
                                                    Manual Reimburse
                                                </option>
                                                <option value="{{ \App\Models\Dispute::HANDLER_MANUAL_DEDUCTION }}">
                                                    Manual Deduct
                                                </option>
                                                {{--  <option value="{{ \App\Models\Dispute::HANDLER_CLEARANCE }}">Clearance</option>--}}
                                                <option value="{{ \App\Models\Dispute::HANDLER_DO_NOTHING }}">Do
                                                    Nothing
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            {{--DESCRIPTION--}}
            <div class="row" style="margin-bottom: 50px;">
                <div class="col-lg-12">
                    <div class="ibox-title">
                        <h5>Description</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group  row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="ibox ">
                                    <div class="{{--ibox-content no-padding--}}">
                                        @if($disputeDetail->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_STARTED)
                                            <textarea style="height: 100px; width: 100%"
                                                      placeholder="Dispute description" name="description"></textarea>
                                        @else
                                            {!! $disputeDetail->description !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($disputeDetail->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_STARTED)
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button id="handle" class="btn btn-primary btn-sm" style="float: right">Handle
                                        Dispute
                                    </button>
                                    <button id="handleBtn" class="btn btn-primary btn-sm" type="submit"
                                            style="display: none">Handle Dispute
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>

        {{--HANDLE AUTOMATIC--}}
        @if($disputeDetail->handler == \App\Models\Dispute::HANDLER_AUTOMATIC)
            <div class="row" style="margin-bottom: 50px; margin-top: -20px">
                <div class="col-lg-12">
                    <div class="ibox-title">
                        <h5>Automatic Handle Approval</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group  row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="ibox ">
                                    <div class="{{--ibox-content no-padding--}}">
                                        @if($disputeDetail->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_PROCESSING)
                                            <h4>Waiting for automatic delivery URL</h4>
                                        @elseif ($disputeDetail->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_REPOSTED)
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4>Ref
                                                        No.: {{ $disputeDetail->disputeHandler->reposted_ref_no }}</h4>
                                                    <h4>Reposted
                                                        Status: {{ $disputeDetail->disputeHandler->reposted_status }}</h4>
                                                    <h4>Reposted Amount:
                                                        Rs. {{ $disputeDetail->disputeHandler->reposted_amount }}</h4>
                                                    <h4>Reposted
                                                        Handler: {{ $disputeDetail->disputeHandler->reposted_handler }}</h4>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <form id="acceptAutoForm" action="{{ route('dispute.accept') }}"
                                                      method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $disputeDetail->id }}"
                                                           name="dispute_id">
                                                    <button rel="{{ route('dispute.accept') }}" id="accept"
                                                            class="btn btn-primary btn-sm" type="submit"
                                                            style="margin: 20px;">Accept
                                                    </button>
                                                    <button id="acceptBtn1" class="btn btn-primary" type="submit"
                                                            style="display: none">Verify KYC
                                                    </button>
                                                </form>

                                                <form action="{{ route('dispute.reject') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $disputeDetail->id }}"
                                                           name="dispute_id">
                                                    <button rel="{{ route('dispute.reject') }}" id="reject"
                                                            class="btn btn-danger btn-sm" type="submit"
                                                            style="margin: 20px;">Reject
                                                    </button>
                                                    <button id="rejectBtn" class="btn btn-primary" type="submit"
                                                            style="display: none">Verify KYC
                                                    </button>
                                                </form>
                                            </div>
                                        @else

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h4>Reposted
                                                        Status: {{ $disputeDetail->disputeHandler->reposted_ref_no }}</h4>
                                                    <h4>Reposted
                                                        Status: {{ $disputeDetail->disputeHandler->reposted_status }}</h4>
                                                    <h4>Reposted Amount:
                                                        Rs. {{ $disputeDetail->disputeHandler->reposted_amount }}</h4>
                                                    <h4>Reposted
                                                        Handler: {{ $disputeDetail->disputeHandler->reposted_handler }}</h4>
                                                </div>
                                            </div>

                                            @if($disputeDetail->user_dispute_status == \App\Models\Dispute::USER_DISPUTE_STATUS_REJECTED)
                                                <h4 class="badge badge-danger">Automatic dispute handler rejected</h4>
                                            @else
                                                <h4 class="badge badge-primary">Automatic dispute handler approved</h4>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('styles')
    <link href="{{ asset('admin/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">

    <style>
        .note-editing-area {
            height: 150px;
        }

        .dt-title {
            display: inline-block;
            padding-left: 20px;
        }

        .dd-description {
            display: inline-block;
            margin-left: 20px;
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
        $(document).ready(function () {

            $('.summernote').summernote();

        });
    </script>

    @include('admin.asset.js.chosen')

    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $('#accept').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "Dispute handle for this transaction will be approved",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1E78A2",
                confirmButtonText: "Yes, approve",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#acceptBtn1').trigger('click');
                swal.close();
            })
        });


        $('#reject').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "Dispute handle for this transaction will be rejected",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ed5565",
                confirmButtonText: "Yes, reject",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#rejectBtn').trigger('click');
                swal.close();

            })
        });

        $('#handle').on('click', function (e) {

            e.preventDefault();

            swal({
                title: "Are you sure?",
                text: "Dispute handle for this transaction will be approved",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1E78A2",
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

