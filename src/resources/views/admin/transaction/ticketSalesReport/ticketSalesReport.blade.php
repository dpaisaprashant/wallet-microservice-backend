@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Ticket Sale Reports</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Ticket Sale</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
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
                        <h5>Filter Report</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('transactions.ticketSalesReport') }}" id="filter">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="pre_transaction_id"
                                                       placeholder="Pre Transaction Id" class="form-control"
                                                       value="{{ !empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="From Amount"
                                                       name="from_amount" autocomplete="off"
                                                       value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="To Amount"
                                                       name="to_amount" autocomplete="off"
                                                       value="{{ !empty($_GET['to_amount']) ? $_GET['to_amount'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div style="padding-top: 15px">
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('transactions.ticketSalesReport') }}"><strong>Filter</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{route('ticket_sales_report.excel')}}">
                                            <strong>Excel</strong></button>
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
                            <h5>Ticket Sale Report</h5>

                        </div>
                        <div class="ibox-content">
{{--                            <h5><b>Total Count:</b> {{ $totalTransactionCount }}</h5>--}}
{{--                            <h5><b>Total Amount Sum:</b> Rs. {{ $totalTransactionAmountSum }}</h5>--}}
{{--                            <h5><b>Total Fee Sum:</b> Rs. {{ $totalTransactionFeeSum }}</h5>--}}
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Ticket Sales Report">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction ID</th>
                                        <th>Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                        <th>Amount (Rs.)</th>
                                        <th>Date</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($ticket_sales_reports as $ticket_sales_report)
                                        <tr class="gradeC">
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$ticket_sales_report->pre_transaction_id}}</td>
                                            <td>{{optional($ticket_sales_report->user)->name}}</td>
                                            <td>{{optional($ticket_sales_report->user)->mobile_no}}</td>
                                            <td>{{optional($ticket_sales_report->user)->email}}</td>
                                            <td>{{$ticket_sales_report->amount}}</td>
                                            <td>{{$ticket_sales_report->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
{{--                                {{ $transactions->appends(request()->query())->links() }}--}}
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
{{--        @if(!empty($_GET))--}}
{{--        $(document).ready(function (e) {--}}
{{--            let a = "Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries";--}}
{{--            $('.dataTables_info').text(a);--}}
{{--        });--}}
{{--        @endif--}}
{{--    </script>--}}

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`;
        @else '0;100000'; @endif
        let split = amount.split(';');
        $(".ionrange_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });
    </script>

    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection


