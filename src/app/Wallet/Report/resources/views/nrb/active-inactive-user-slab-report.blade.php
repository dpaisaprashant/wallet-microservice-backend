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
                                <form role="form" method="get" action="{{ route('report.active.inactive.user.slab') }}"
                                      id="filter">

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Amount</label>
                                        <div class="col-sm-5">
                                            <select data-placeholder="Choose Amount Range..." class="chosen-select"  tabindex="2" name="amount_range" required>
                                                <option value="" selected disabled>-- Select Amount Range --</option>
                                                    <option value='{"fromAmount":"0","toAmount":"1000"}' @if(isset($_GET['amount_range']) && $_GET['amount_range']=='{"fromAmount":"0","toAmount":"1000"}') selected @endif>0 - 1,000</option>
                                                    <option value='{"fromAmount":"1001","toAmount":"5000"}' @if(isset($_GET['amount_range']) && $_GET['amount_range']=='{"fromAmount":"1001","toAmount":"5000"}') selected @endif>1,000 - 5,000</option>
                                                    <option value='{"fromAmount":"5001","toAmount":"10000"}' @if(isset($_GET['amount_range']) && $_GET['amount_range']=='{"fromAmount":"5001","toAmount":"10000"}') selected @endif >5,000 - 10,000</option>
                                                    <option value='{"fromAmount":"10001","toAmount":"20000"}' @if(isset($_GET['amount_range']) && $_GET['amount_range']=='{"fromAmount":"10001","toAmount":"20000"}') selected @endif>10,000 - 20,000</option>
                                                    <option value='{"fromAmount":"20001","toAmount":"25000"}' @if(isset($_GET['amount_range']) && $_GET['amount_range']=='{"fromAmount":"20001","toAmount":"25000"}') selected @endif>20,000 - 25,000</option>
                                                    <option value='{"fromAmount":"25001","toAmount":"1000000"}' @if(isset($_GET['amount_range']) && $_GET['amount_range']=='{"fromAmount":"25001","toAmount":"1000000"}') selected @endif >> 25,000</option>
                                            </select>
                                        </div>
                                    </div>

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
                                                       name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}"
                                                       required>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <br>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.active.inactive.user.slab') }}">
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
                            <h5>List Generated for Active/Inactive User Report for Date {{request()->from}} and Amount Range of (Rs. {{request()->fromAmount}} to Rs. {{request()->toAmount}})</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover {{--dataTables-example--}}"
                                       title="active inactive list">
                                    @if(!is_array($activeInactiveUserReports))
                                        <div class="alert alert-warning">
                                            <i class="fa fa-info-circle"></i>
                                            {{$activeInactiveUserReports}}
                                        </div>
                                    @else
                                        @foreach($activeInactiveUserReports as $title => $reports)
                                            <thead>
                                            <tr class="gradeX">
                                                <td colspan="2"><h2><strong><b>{{ $title }}</b></strong></h2></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($reports as $reportTitle => $report)
                                                <tr class="gradeX">
                                                    <td style="font-size: 16px">
                                                        &nbsp;&nbsp;&nbsp;&nbsp;<strong>{{ $reportTitle }}</strong></td>
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


