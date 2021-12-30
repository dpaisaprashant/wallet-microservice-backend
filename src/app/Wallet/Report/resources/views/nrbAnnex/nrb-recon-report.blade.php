@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NRB Reconciliation Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>NRB Reconciliation Report</strong>
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
                                <form role="form" method="get" action="{{ route('report.nrb.annex.reconciliation') }}"
                                      id="filter">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Balance per Statement</label>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="Insert Amount for Balance per Statement"
                                                               name="balanceAmount" autocomplete="off"
                                                               value="{{ !empty($_GET['balanceAmount']) ? $_GET['balanceAmount'] : '' }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="transaction_amount">Success in NCHL not in Settlement
                                                Bank</label>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="Insert Amount for Success in NCHL not in Settlement Bank"
                                                               name="nchlAmount" autocomplete="off"
                                                               value="{{!empty($_GET['nchlAmount']) ? $_GET['nchlAmount'] : '' }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="transaction_amount">Success in NPS not in Settlement
                                                Bank</label>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="Insert Amount for Success in NPS not in Settlement Bank"
                                                               name="npsAmount" autocomplete="off"
                                                               value="{{!empty($_GET['npsAmount']) ? $_GET['npsAmount'] : '' }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="transaction_amount">NPAY Settled Amount</label>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="Insert Amount for NPAY Settled Amount"
                                                               name="npaySettledAmount" autocomplete="off"
                                                               value="{{!empty($_GET['npaySettledAmount']) ? $_GET['npaySettledAmount'] : '' }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="transaction_amount">Card Settled Amount</label>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="Insert Amount for Card Settled Amount"
                                                               name="cardSettledAmount" autocomplete="off"
                                                               value="{{!empty($_GET['cardSettledAmount']) ? $_GET['cardSettledAmount'] : '' }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="transaction_amount">Select From Date</label>

                                            <div class="row">
                                                <div class="col-12">
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
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="transaction_amount">Select To Date</label>

                                            <div class="row">
                                                <div class="col-12">
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
                                        </div>
                                    </div>
                                    <br>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.nrb.annex.reconciliation') }}">
                                            <strong>Generate Report</strong>
                                        </button>
                                    </div>

                                    {{--                                    <div>--}}
                                    {{--                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"--}}
                                    {{--                                                type="submit" style="margin-right: 10px;"--}}
                                    {{--                                                formaction="{{ route('transaction.complete.excel') }}">--}}
                                    {{--                                            <strong>Excel</strong></button>--}}
                                    {{--                                    </div>--}}
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
                            <h5>List Generated for Reconciliation Report for Date from {{request()->from}}
                                to {{request()->to}}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover {{--dataTables-example--}}"
                                       title="active inactive list">
                                    @if(!is_array($nrbReconciliationReport))
                                        <div class="alert alert-warning">
                                            <i class="fa fa-info-circle"></i>
                                            {{$nrbReconciliationReport}}
                                        </div>
                                    @else
                                        @foreach($nrbReconciliationReport as $title => $reports)
                                            <thead>
                                            <tr class="gradeX">
                                                <td colspan="2" style="text-align: center"><h2><strong><b>{{$title}}</b></strong>
                                                    </h2></td>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if(is_array($reports))
                                                @foreach($reports as $reportTitle => $report)
                                                    <tr class="gradeX">
                                                        <td style="font-size: 16px">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $reportTitle }}</strong>
                                                        </td>
                                                        @if(!is_array($report))
                                                            <td>{{$report}}</td>
                                                        @endif
                                                    </tr>
                                                    @if(is_array($report))
                                                        @foreach($report as $valueTitle => $value)
                                                            <tr class="gradeX">
                                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <strong>{{ $valueTitle }}: </strong>
                                                                </td>
                                                                <td></td>

                                                            </tr>
                                                            @if(is_array($value))
                                                                @foreach($value as $subValueTitle => $subValue)
                                                                    <tr class="gradeX">
                                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                                                            <strong>{{ $subValueTitle }}: </strong>
                                                                        </td>
                                                                        <td>{{$subValue}}</td>
                                                                    </tr>
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @else

                                            @endif
                                            </tbody>
                                        @endforeach
                                    @endif
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


