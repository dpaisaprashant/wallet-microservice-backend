@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Inactive User Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Inactive User Report</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title collapse-link">
                        <h5>Select Date</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">

                                    <div class="row">


                                        <div class="col-md-12">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input class="select_date form-control" placeholder="Select Date" name="select_date" autocomplete="off" value="{{ !empty($_GET['select_date']) ? $_GET['select_date'] : '' }}">
                                            </div>
                                        </div>


                                        {{--                                        <div class="col-md-6">--}}
                                        {{--                                            <div class="input-group date">--}}
                                        {{--                                                    <span class="input-group-addon">--}}
                                        {{--                                                        <i class="fa fa-calendar"></i>--}}
                                        {{--                                                    </span>--}}
                                        {{--                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to_transaction_event" autocomplete="off" value="{{ !empty($_GET['to_transaction_event']) ? $_GET['to_transaction_event'] : '' }}">--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    </div>

                                    <br>
                                    <div class="alert alert-warning" style="width: 100%">
                                        <i class="fa fa-info-circle"></i>&nbsp; Note: <br>
                                        <b>For Inactive Users</b><br>
                                        <b>Number</b> represents total number of inactive users for time periods (6-12 months) and (greater than 12 months) before the selected date. <br>
                                        <b>Value</b> represents the sum of latest transaction balance of all inactive users for the respective time periods.<br>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('report.nrb.inactiveUser') }}"><strong>Generate Report</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                    {{-- <div>
                                         <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>
                                     </div>--}}
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                @if(!empty($_GET['select_date']))
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Inactive User report from {{ \Carbon\Carbon::parse($_GET['select_date'])->subMonths(6)->format('d F, Y') . ' to ' . $_GET['select_date'] }}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover {{--dataTables-example--}}" title="Wallet user's list">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($activityReports as $title => $reports)
                                        <tr class="gradeX">
                                            <td><h2><strong>{{ $title }}</strong></h2></td>
                                            <td></td>
                                        </tr>
                                        @foreach($reports as $reportTitle => $report)
                                            <tr class="gradeX">
                                                <td style="font-size: 16px">&nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $reportTitle }}</strong></td>
                                                <td></td>
                                            </tr>
                                            @foreach($report as $valueTitle => $value)
                                                <tr class="gradeX">
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <strong>{{ $valueTitle }}: </strong>
                                                    </td>
                                                    <td>{{ $value }}</td>
                                                </tr>

                                            @endforeach
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('styles')


    @include('admin.asset.css.datepicker')

    @include('admin.asset.css.chosen')

    @include('admin.asset.css.datatable')

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

@endsection





