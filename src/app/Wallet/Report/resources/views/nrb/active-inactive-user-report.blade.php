@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Active Inactive User Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Active Inactive User Report</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('report.active.inactive.user') }}"
                                      id="filter">
                                    <br>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Select Date</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text"
                                                       class="form-control date_from" placeholder="As of Date"
                                                       name="from" autocomplete="off"
                                                       value="{{ request()->get('from', '') }}" required>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.active.inactive.user') }}">
                                            <strong>Generate Report</strong>
                                        </button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('report.active.inactive.user.excel') }}">
                                            <i class="fa fa-table" aria-hidden="true"></i>
                                            <strong>Export to Excel</strong>
                                        </button>
                                    </div>
                                    <div>
                                        <a class="btn btn-sm btn-warning float-right m-t-n-xs"
                                           style="margin-right: 10px;"
                                           href="{{ route('report.active.inactive.user.generated') }}">
                                            <strong><i class="fa fa-bar-chart"></i>&nbsp; View Generated Reports</strong>
                                        </a>
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
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>List Generated for Active/Inactive User Report for date {{ request()->get('from') }}</h5>
                        </div>
                        <div class="ibox-content">
                            <div><b>Total Users:</b> {{ $totalUsers ?? 0 }}</div>
                            <div><b>Total Balance:</b> Rs. {{ round($totalBalance ?? 0, 2) }}</div>
                            <div><b>Opening Balance:</b> Rs. {{ round($openingBalance ?? 0, 2) }}</div>
                            <div><b>(Active + Inactive) - Opening Balance:</b> Rs. {{ round($shouldBeZero ?? 0, 2) }}</div>

                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    @if(!is_array($activeInactiveUserReports))
                                        <div class="alert alert-warning">
                                            <i class="fa fa-info-circle"></i>
                                            {{ $activeInactiveUserReports }}
                                        </div>
                                    @else
                                        @foreach($activeInactiveUserReports as $title => $reports)
                                            <thead>
                                                <tr class="gradeX">
                                                    <td colspan="3">
                                                        <h2><strong><b>{{ $title }}</b></strong></h2>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Number</th>
                                                    <th>Total Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($reports as $reportTitle => $report)
                                                    <tr class="gradeX">
                                                        <td style="font-size: 16px" colspan="3">
                                                            <strong>{{ $reportTitle }}</strong>
                                                        </td>
                                                    </tr>
                                                    @foreach($report as $key => $value)
                                                        @if(is_array($value))
                                                            <tr class="gradeX">
                                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <strong>{{ ucfirst($key) }}:</strong>
                                                                </td>
                                                                <td>{{ $value['Number'] ?? 0 }}</td>
                                                                <td>{{ $value['Total Balance'] ?? '0.00' }}</td>
                                                            </tr>
                                                        @else
                                                            <tr class="gradeX">
                                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <strong>{{ ucfirst($key) }}:</strong>
                                                                </td>
                                                                <td colspan="2">{{ $value }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                                {{-- @if(isset($reports['Grand Total']))
                                                    <tr class="gradeX">
                                                        <td><strong>Grand Total:</strong></td>
                                                        <td>{{ $reports['Grand Total']['Number'] ?? 0 }}</td>
                                                        <td>Rs. {{ $reports['Grand Total']['Total Balance'] ?? '0.00' }}</td>
                                                    </tr>
                                                @endif --}}
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

    <script>
        $('#excelBtn').click(function(e) {
            e.preventDefault();
            // Add your logic to handle Excel export if needed
        });
    </script>
@endsection
