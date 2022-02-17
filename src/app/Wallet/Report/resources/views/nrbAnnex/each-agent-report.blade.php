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
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Non bank payment report">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Agent Code</th>
                                        <th>Agent Name</th>
                                        <th>Over the counter transaction type</th>
                                        <th>Number of Transactions</th>
                                        <th>Amount</th>
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
                                                {{$nrbAgentReport['totalCashOutAmount'] ?? 0}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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


