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
                    <strong>Reconciliation</strong>
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
                        <h5>Filter</h5>
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

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="individual_user_number" type="text" class="form-control individual_user_number" placeholder="Mobile Number" name="individual_user_number" autocomplete="off" value="{{ !empty($_GET['individual_user_number']) ? $_GET['individual_user_number'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('report.reconciliation') }}"><strong>Generate Report</strong></button>
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
                @if(!empty($_GET))
                    <div class="ibox ">
                        <div class="ibox-title">
                            @if(!empty($_GET['individual_user_number']))
                            <h5>Reconciliation report of user {{ $_GET['individual_user_number']  }}</h5>
                            @else
                                <h5>Reconciliation report</h5>
                                @endif
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" title="Reconciliation Report">
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

                                    @foreach($totalAmounts as $title => $service)
                                        <tr class="gradeX">
                                            <td>{{ $loop->index +  1 }}</td>
                                            <td>
                                                {{ $title }}
                                            </td>
                                            <td>{{$service['transaction_type']}}</td>
                                            <td>{{ $service['count'] }}</td>

                                            <td>Rs. {{ $service['amount'] }}</td>


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
                                        <td><b>Total Wallet Balance</b></td>
                                        <td>Rs. {{ $totalWalletBalance }}</td>
                                        <td></td>
                                        <td><b>Total Amount Loaded to Wallet</b></td>
                                        <td>Rs. {{ $totalLoadAmount }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Total Bonus Balance</b></td>
                                        <td>Rs. {{ $totalBonusBalance }}</td>
                                        <td></td>
                                        <td><b>Total Payment from Wallet</b></td>
                                        <td>Rs. {{ $totalPaymentAmount }}</td>
                                    </tr>

                                    <tr>
                                        <td><b>Total Main Balance</b></td>
                                        <td> Rs. {{ $mainBalance }}</td>
                                        <td></td>
                                        <td><b>Total Loaded - Total Payment</b></td>
                                        <td>Rs. {{ $totalLoadAmount - $totalPaymentAmount }}</td>
                                    </tr>


                                    </tfoot>
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





