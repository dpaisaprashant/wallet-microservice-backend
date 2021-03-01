@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Clearance Handle Dispute</h2>
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

            <form action="{{ route('dispute.accept') }}" method="post">
                @csrf
                @isset($disputeDetail->disputeable->gateway_ref_no)
                    <input type="hidden" value="{{ \App\Models\Dispute::VENDOR_TYPE_NPAY }}" name="vendor_type">
                    <div class="row">
                    <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Dispute Details</h5>
                        </div>
                        <div class="ibox-content">
                            <div id="nPayTransactionDetailDiv">
                                    <h2>NPay Transaction Details</h2>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <h4>User: {{ $disputeDetail->disputeable->user['name'] }}</h4>
                                            <h4>Email: {{ $disputeDetail->disputeable->user['email'] }}</h4>
                                            <h4>Contact: {{ $disputeDetail->disputeable->user['mobile_no'] }}</h4>
                                        </div>

                                        <div class="col-md-5">
                                            <h4>Process Id: {{ $disputeDetail->disputeable->process_id }}</h4>
                                            <h4>Payment Mode: {{ $disputeDetail->disputeable->payment_mode }}</h4>
                                            <h4>Amount: Rs. {{ $disputeDetail->disputeable->amount }}</h4>
                                            <h4>Transaction Fee: Rs. {{ $disputeDetail->disputeable->transaction_fee ?? 0 }}</h4>
                                        </div>

                                        <div class="col-md-4">
                                            <h4>Transaction Id: {{ $disputeDetail->disputeable->transaction_id }}</h4>
                                            <h4>Gateway Ref no: {{ $disputeDetail->disputeable->gateway_ref_no }}</h4>
                                            <h4>Status:
                                                @if($disputeDetail->disputeable->status == 'COMPLETED')
                                                    <span class="badge badge-primary">{{ $disputeDetail->disputeable->status }}</span>
                                                @elseif($disputeDetail->disputeable->status == 'VALIDATED')
                                                    <span class="badge badge-warning">{{ $disputeDetail->disputeable->status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $disputeDetail->disputeable->status }}</span>
                                                @endif
                                            </h4>
                                            <h4>Created at: {{ $disputeDetail->disputeable->created_at }}</h4>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Transaction Response</h5>
                        </div>
                        <div class="ibox-content">
                            @isset($disputeDetail->disputeable->loadTransactionResponse)
                                <div id="nPayTransactionDetailDiv">
                                    <dl class="row m-t-md">

                                        <?php
                                        $request =  json_decode($disputeDetail->disputeable->loadTransactionResponse['response'], true);
                                        if (is_string($request)) {
                                            $request = json_decode($request, true);
                                        }
                                        ?>

                                        <?php foreach (($request) as $key => $value) { ?>

                                        <dt class="col-md-3 text-right">{{ $key }}</dt>

                                        <dd class="col-md-8">{{ $value }}</dd>
                                        <?php }?>

                                    </dl>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
                @endisset

                @isset($disputeDetail->disputeable->refStan)
                    <input type="hidden" value="{{ \App\Models\Dispute::VENDOR_TYPE_PAYPOINT }}" name="vendor_type">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Dispute Details</h5>
                                </div>
                                <div class="ibox-content">
                                    <div id="nPayTransactionDetailDiv">
                                        <h2>PayPoint Transaction Details</h2>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4>User: {{ $disputeDetail->disputeable->user['name'] }}</h4>
                                                <h4>Email: {{ $disputeDetail->disputeable->user['email'] }}</h4>
                                                <h4>Contact: {{ $disputeDetail->disputeable->user['mobile_no'] }}</h4>
                                            </div>

                                            <div class="col-md-5">
                                                <h4>RefStan: {{ $disputeDetail->disputeable->refStan }}</h4>
                                                <h4>Bill Number: {{ $disputeDetail->disputeable->checkTransaction->bill_number }}</h4>
                                                <h4>Code: {{ $disputeDetail->disputeable->checkTransaction->code }}</h4>

                                            </div>

                                            @isset($disputeDetail->disputeable->userTransaction)
                                            <div class="col-md-4">
                                                <h4>Vendor: {{ $disputeDetail->disputeable->vendor }}</h4>
                                                <h4>Amount: {{ $disputeDetail->disputeable->amount }}</h4>
                                                <h4>Created at: {{ $disputeDetail->disputeable->created_at }}</h4>
                                            </div>
                                            @endisset
                                        </div>
                                        <div class="hr-line-dashed"></div>
                                        <h2>Create Dispute Transaction Detail</h2>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h4>Vendor Status: {{ $disputeDetail->vendor_status }}</h4>
                                                <h4>Vendor Amount: Rs. {{ $disputeDetail->vendor_amount }}</h4>
                                            </div>

                                            <div class="col-md-3">
                                                <h4>User Status: {{ $disputeDetail->user_status ?? 'null' }}</h4>
                                                <h4>User Amount: {{ 'Rs. ' . $disputeDetail['user_amount'] ?? 'null' }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Transaction Response</h5>
                                </div>
                                <div class="ibox-content">

                                        <div class="row">
                                            @isset($disputeDetail->disputeable->checkTransaction->request)
                                            <div class="col-md-6">
                                                <h3>Check Payment Request</h3>
                                                <dl class="row m-t-md">
                                                    <?php
                                                    $request =  json_decode($disputeDetail->disputeable->checkTransaction->request, true);
                                                    if (is_string($request)) {
                                                        $request = json_decode($request, true);
                                                    }
                                                    ?>

                                                    <?php foreach (($request) as $key => $value) { ?>

                                                    <dt class="col-md-3 text-right">{{ $key }}</dt>

                                                    <dd class="col-md-8">{{ $value }}</dd>
                                                    <?php }?>

                                                </dl>
                                            </div>
                                             <div class="col-md-6"></div>
                                            @endisset
                                        </div>
                                    <div class="hr-line-dashed"></div>
                                        <div class="row">

                                                @isset($disputeDetail->disputeable->executeTransaction)
                                                @foreach($disputeDetail->disputeable->executeTransaction as $execute)
                                                    <div class="col-md-6">
                                                        <h3>Execute Payment Request</h3>
                                                        <dl class="row m-t-md">
                                                            <?php
                                                            $request =  json_decode($execute->request, true);
                                                            if (is_string($request)) {
                                                                $request = json_decode($request, true);
                                        }
                                                            ?>

                                                            <?php foreach (($request) as $key => $value) { ?>

                                                            <dt class="col-md-3 text-right">{{ $key }}</dt>

                                                            <dd class="col-md-8">{{ $value }}</dd>
                                                            <?php }?>

                                                        </dl>
                                                    </div>

                                                    <div class="hr-line-dashed"></div>

                                                    <div class="col-md-6">
                                                        <h3>Execute Payment Response</h3>
                                                        <dl class="row m-t-md">
                                                            <?php
                                                            $request =  json_decode($execute->response, true);
                                                            if (is_string($request)) {
                                                                $request = json_decode($request, true);
                                                            }
                                                            ?>

                                                            <?php foreach (($request) as $key => $value) { ?>

                                                            <dt class="col-md-3 text-right">{{ $key }}</dt>

                                                            <dd class="col-md-8">{{ $value }}</dd>
                                                            <?php }?>

                                                        </dl>
                                                    </div>
                                                @endforeach
                                                @endisset

                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <h4>User Dispute Status: @include('admin.dispute.status.userStatus', ['dispute' => $disputeDetail])</h4>
                                                <h4>Clearance Dispute Status: @include('admin.dispute.status.clearanceStatus', ['dispute' => $disputeDetail])</h4>
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
                                                @isset($disputeDetail->handler)
                                                        <h4>Handler: {{ $disputeDetail->handler }} </h4>
                                                @endif

                                                @isset($disputeDetail->clearance->created_at)
                                                    <h4>Error Clearance date: {{ date('d M, Y', strtotime($disputeDetail->clearance->created_at)) }} </h4>
                                                @endif
                                            </div>
                                        </div>

                                        @if(!empty($disputeDetail->disputeHandler->clearedClearance))
                                        <div class="row" style="margin-top: 15px;">
                                            <div class="col-md-12">
                                                <h4> {{ $disputeDetail->reposted_clearance_ref_no ? 'Reposted clearance ref no: '.$disputeDetail->reposted_clearance_ref_no : ''}}</h4>
                                                <h4> {{ $disputeDetail->reposted_clearance_status ? 'Reposted clearance Status: '.$disputeDetail->reposted_clearance_status : ''}}</h4>
                                                <h4> {{ $disputeDetail->reposted_clearance_amount ? 'Reposted clearance Amount: Rs. ' . $disputeDetail->reposted_clearance_amount : '' }}</h4>
                                                <br>
                                                <h4>Handled clearance date:
                                                    {{ date('d M, Y', strtotime($disputeDetail->disputeHandler->clearedClearance->created_at)) . ', Transaction Date: ' . $disputeDetail->disputeHandler->clearedClearance->transaction_from_date . ' to ' . $disputeDetail->disputeHandler->clearedClearance->transaction_to_date}}
                                                </h4>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <input type="hidden" name="dispute_id" value="{{ $disputeDetail->id  }}">

                <div class="row">

                    {{--Problem Source--}}
                    @if($disputeDetail->clearance_dispute_status == \App\Models\Dispute::CLEARANCE_DISPUTE_STATUS_PROCESSING)

                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5>Vendor Dispute Handler</h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="form-group  row">
                                        <div class="col-sm-12">
                                            <select id="userStatus" data-placeholder="Select Cleared Clearance Date.." class="chosen-select"  tabindex="2" name="clearance_id">
                                                <option value="" selected disabled>Select Cleared Clearance Date</option>
                                                @foreach($clearances as $clearance)
                                                    <option value="{{ $clearance->id }}" >{{ 'Clearance Date: ' . date('d M, Y', strtotime($clearance->created_at)) . ', Transaction Date: ' . $clearance->transaction_from_date . ' to ' . $clearance->transaction_to_date}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{--<div class="form-group  row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="ibox ">
                                                <div class="--}}{{--ibox-content no-padding--}}{{--">
                                                    @if(empty($disputeDetail->description))
                                                        <textarea style="height: 100px; width: 100%" placeholder="Dispute description" name="description"></textarea>
                                                    @else
                                                        {!! $disputeDetail->description !!}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>--}}

                                    @if($disputeDetail->clearance_dispute_status == \App\Models\Dispute::CLEARANCE_DISPUTE_STATUS_PROCESSING)
                                        <div class="form-group row">
                                            <div class="col-sm-12" >
                                                <button id="handle" class="btn btn-primary btn-sm" style="float: right">Handle Dispute</button>
                                                <button id="handleBtn"  class="btn btn-primary btn-sm" type="submit" style="display: none">Handle Dispute</button>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                    @endif


                </div>

            </form>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('admin/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">

    <style>
        .note-editing-area{
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

