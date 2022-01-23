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
                    <strong>NRB Reconciliation</strong>
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


                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
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
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.nrb.reconciliation') }}"><strong>Generate
                                                Report</strong></button>
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
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Reconciliation report from {{ $_GET['from'] . ' to ' . $_GET['to'] }}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="alert alert-warning" style="width: 100%">
                                <i class="fa fa-info-circle"></i>&nbsp;<b> Note: <br></b>
                                <b>Total Credit Amount</b> is the sum of total of NPay Transaction Amount, NPS Transaction Amount, Cashback Amount, Referral Amount, and NicAsia CyberSource Load Amount. <br>
                                <b>Total Debit Amount</b> is the sum of total of PayPoint Transaction Amount, NCHL Bank Transfer Amount, Commission Amount, User Fund Transferred to Merchant, NCHL Aggregated Payment Amount and User To Merchant Event Ticket Payment Amount and Khalti Transaction Amount. <br>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover {{--dataTables-example--}}"
                                       title="Wallet user's list">
                                    <tbody>
                                    <tr class="gradeX">
                                        <td style="font-size: 16px">&nbsp;&nbsp;&nbsp;&nbsp;<strong> NRB Reconciliation
                                                Report</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr class="gradeX">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <strong> Total Credit Amount: </strong>
                                        </td>
                                        <td>Rs. {{$totalLoadAmount}}</td>
                                    </tr>
                                    <tr class="gradeX">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <strong> Total Debit Amount: </strong>
                                        </td>
                                        <td>Rs. {{$totalPaymentAmount}}</td>
                                    </tr>


                                    <tr class="gradeX">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <strong> Total Balance (Credit - Debit): </strong>
                                        </td>
                                        <td>Rs. {{$totalLoadAmount - $totalPaymentAmount}}</td>
                                    </tr>
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





