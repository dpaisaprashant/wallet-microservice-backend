@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NRB Each Agent Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>NRB Each Agent Report</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    {{--                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>--}}
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('report.nrb.annex.agent.each') }}"
                                      id="filter">

                                    <br>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Select Date</label>
                                        <div class="col-5">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text"
                                                       class="form-control date_from" placeholder="From"
                                                       name="from_date" autocomplete="off"
                                                       value="{{ !empty($_GET['from_date']) ? $_GET['from_date'] : '' }}"
                                                       required>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-5">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text"
                                                       class="form-control date_to" placeholder="To" name="to_date"
                                                       autocomplete="off"
                                                       value="{{ !empty($_GET['to_date']) ? $_GET['to_date'] : '' }}"
                                                       required>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.nrb.annex.agent.each') }}">
                                            <strong>Generate Report</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('report.nrb.annex.agent.each.excel') }}">
                                            <i class="fa fa-table" aria-hidden="true"></i>
                                            <strong>Export to Excel</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <a class="btn btn-sm btn-warning float-right m-t-n-xs"
                                           style="margin-right: 10px;"
                                           href="{{ route('report.nrb.annex.agent.each.generated') }}">
                                            <strong><i class="fa fa-bar-chart"></i>&nbsp; View Generated
                                                Reports</strong></a>
                                    </div>

                                    @include('admin.asset.components.clearFilterButton')
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($_GET))
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List Generated for NRB Each Agent Report</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                @if(!is_array($nrbAgentReports))
                                    <div class="alert alert-warning">
                                        <i class="fa fa-info-circle"></i>
                                        {{$nrbAgentReports}}
                                    </div>
                                @else
                                    <table class="table table-striped table-bordered table-hover dataTables-example"
                                           title="Non bank payment report">
                                        <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Agent Code</th>
                                            <th>Agent Name</th>
                                            <th>Over the counter transaction type</th>
                                            <th>Number of Transactions</th>
                                            <th>Amount (Rs.)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($nrbAgentReports as $nrbAgentReport)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$nrbAgentReport['agent_code']}}</td>
                                                <td>{{$nrbAgentReport['agent_name']}}</td>
                                                <td>
                                                    TOPUP <br>
                                                    <hr>
                                                    TRANSFER TO WALLET <br>
                                                    <hr>
                                                    TRANSFER TO BANK<br>
                                                    <hr>
                                                    CASH IN<br>
                                                    <hr>
                                                    CASH OUT
                                                    <hr>
                                                    Merchant Payment<br>
                                                    <hr>
                                                    Government Payment<br>
                                                </td>
                                                <td>
                                                    {{$nrbAgentReport['totalTopUpCount']}}<br>
                                                    <hr>
                                                    {{$nrbAgentReport['totalTransferToWalletCount']}}<br>
                                                    <hr>
                                                    {{$nrbAgentReport['totalTransferToBankCount']}}<br>
                                                    <hr>
                                                    {{$nrbAgentReport['totalCashInCount']}}<br>
                                                    <hr>
                                                    {{$nrbAgentReport['totalCashOutCount']}}
                                                    <hr>
                                                    {{$nrbAgentReport['totalMerchantPaymentCount']}}
                                                    <hr>
                                                    {{$nrbAgentReport['totalGovernmentPaymentCount'] ?? 0}}
                                                </td>
                                                <td>
                                                    {{$nrbAgentReport['totalTopUpAmount']}}<br>
                                                    <hr>
                                                    {{$nrbAgentReport['totalTransferToWalletAmount']}}<br>
                                                    <hr>
                                                    {{$nrbAgentReport['totalTransferToBankAmount']}}<br>
                                                    <hr>
                                                    {{$nrbAgentReport['totalCashInAmount']}}<br>
                                                    <hr>
                                                    {{$nrbAgentReport['totalCashOutAmount'] ?? 0}} <br>
                                                    <hr>
                                                    {{$nrbAgentReport['totalMerchantPaymentAmount'] ?? 0}} <br>
                                                    <hr>
                                                    {{$nrbAgentReport['totalGovernmentPaymentAmount'] ?? 0}}<br>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection


@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    {{--    <script>--}}
    {{--        $(document).ready(function (e) {--}}
    {{--            let a = "Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries";--}}
    {{--            $('.dataTables_info').text(a);--}}
    {{--        });--}}
    {{--    </script>--}}


    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection


