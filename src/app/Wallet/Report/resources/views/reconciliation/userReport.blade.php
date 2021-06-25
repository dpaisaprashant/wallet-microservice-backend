@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Reconciliation Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Users Reconciliation</strong>
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

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-user"></i>
                                                    </span>
                                                <input type="text" class="form-control" placeholder="User Name" name="name" autocomplete="off" value="{{ !empty($_GET['name']) ? $_GET['name'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('report.user.reconciliation') }}"><strong>Generate Report</strong></button>
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

                @if(!empty($_GET['from']) && !empty($_GET['to']))
                    @foreach($userReconciliationReport as $report)
                        <div class="ibox ">
                        <div class="ibox-title">
                            <h5><strong>{{ $loop->index + ($users->perPage() * ($users->currentPage() - 1)) + 1 }}. {{ $report['user']['name']  }} (User Id: {{ $report['user']['id'] }})</strong> Reconciliation report from {{ $_GET['from'] . ' to ' . $_GET['to'] }}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" title="SajiloPay user's list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Service List</th>
                                        <th>Transaction Type</th>
                                        <th>Total Trans. count</th>
                                        <th>Total Trans. amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($report['payment_amounts'] as $title => $service)
                                        <tr class="gradeX">
                                            <td>{{ $loop->index +  1 }}</td>
                                            <td>
                                                {{ $title }}
                                            </td>
                                            <td>{{$service['transaction_type']}}</td>
                                            <td>{{ $service['count'] }}</td>

                                            @if($service['transaction_type'] == 'balance')
                                                <td><b>Rs. {{ $service['amount'] }}</b></td>
                                            @else
                                                <td>Rs. {{ $service['amount'] }}</td>
                                            @endif


                                        </tr>

                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total Amount Loaded to Wallet</b></td>
                                        <td>Rs. {{ $report['total_amounts']['load'] }}</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total Payment from Wallet</b></td>
                                        <td>Rs. {{ $report['total_amounts']['payment']  }}</td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        @if((((float) $report['total_amounts']['load_minus_payment']) - (float)($report['payment_amounts']['WalletBalance']['amount']) == 0))
                                            <td style="color: green"><b>Total Loaded - Total Payment</b></td>
                                            <td style="color: green"><b>Rs. {{ $report['total_amounts']['load'] - $report['total_amounts']['payment'] }}</b></td>
                                        @else
                                            <td style="color: red"><b>Total Loaded - Total Payment</b></td>
                                            <td style="color: red"><b>Rs. {{ $report['total_amounts']['load'] - $report['total_amounts']['payment'] }}</b></td>
                                        @endif
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                    @endforeach
                        {{ $users->appends(request()->query())->links() }}
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





