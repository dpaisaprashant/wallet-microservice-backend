@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NRB Annex 10.1.11</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>NRB Annex 10.1.11</strong>
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
                                <form role="form" method="get" action="{{ route('report.nrb.annex.agent.payment') }}"
                                      id="filter">
                                    <br>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Select Date</label>
                                        <div class="col-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text"
                                                       class="form-control date_from" placeholder="From"
                                                       name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}"
                                                       required>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text"
                                                       class="form-control date_to" placeholder="To" name="to"
                                                       autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}" required>
                                            </div>
                                        </div>

                                    </div>

                                    <br>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.nrb.annex.agent.payment') }}">
                                            <strong>Generate Report</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('report.nrb.annex.agent.payment.excel') }}">
                                            <i class="fa fa-table" aria-hidden="true"></i>
                                            <strong>Export to Excel</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <a class="btn btn-sm btn-warning float-right m-t-n-xs"
                                           style="margin-right: 10px;"
                                           href="{{ route('report.nrb.annex.agent.payment.generated') }}">
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
                            <h5>List Generated for NRB Annex 10.1.11 Report</h5>
                        </div>

                        <div class="ibox-content">
                            @if(!is_array($agentPaymentReports))
                                <div class="alert alert-warning">
                                    <i class="fa fa-info-circle"></i>
                                    {{$agentPaymentReports}}
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example"
                                           title="NRB Annex 10.1.11 Report">
                                        <thead>
                                        <tr>
                                            <th rowspan="2">S.No.</th>
                                            <th rowspan="2">Agent Code</th>
                                            <th rowspan="2">Agent Name</th>
                                            <th rowspan="2">Total Sub Agents</th>
                                            <th colspan="2" style="text-align: center">Amount in Agent Wallet</th>
                                            <th colspan="5" style="text-align: center">Over The Counter Transaction Type
                                                - Amount In The Reporting Period
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Previous Reporting Period Balance</th>
                                            <th>Current Reporting Period Balance</th>
                                            <th>Bill Payments Including Top-up</th>
                                            <th>P2P Transfer</th>
                                            <th>Cash In</th>
                                            <th>Others</th>
                                            <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($agentPaymentReports as $agentPaymentReport)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$agentPaymentReport['agent_code']}}</td>
                                                <td>{{$agentPaymentReport['agent_name']}}</td>
                                                <td>{{$agentPaymentReport['sub_agents']}}</td>
                                                <td>{{$agentPaymentReport['balance']}}</td>
                                                <td>{{$agentPaymentReport['balance']}}</td>
                                                <td>{{$agentPaymentReport['bill_payments']}}</td>
                                                <td>{{$agentPaymentReport['p2p']}}</td>
                                                <td>{{$agentPaymentReport['cash_in']}}</td>
                                                <td>{{$agentPaymentReport['others']}}</td>
                                                <td>{{$agentPaymentReport['total']}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
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


