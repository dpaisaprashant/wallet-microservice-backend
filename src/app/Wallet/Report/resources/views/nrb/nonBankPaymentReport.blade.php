@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Non bank payment</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Non-bank payment</strong>
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
                                <form role="form" method="get" action="{{ route('report.nonBankPaymentReport') }}"
                                      id="filter">

                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <label for="ionrange_amount">Amount</label><br>
                                            {{--                                            <input type="text" name="amount" class="ionrange_amount">--}}
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="From Amount" name="from_amount"
                                                               autocomplete="off"
                                                               value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="To Amount" name="to_amount"
                                                               autocomplete="off"
                                                               value="{{ !empty($_GET['to_amount']) ? $_GET['to_amount'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">


                                        <div class="col-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text"
                                                       class="form-control date_from" placeholder="From"
                                                       name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
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
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="User Type..." class="chosen-select"
                                                        tabindex="2"
                                                        name="user_type">
                                                    <option value="" selected disabled>User Type...</option>
                                                    @if(!empty($_GET['user_type']))
                                                        <option value="all"
                                                                @if($_GET['user_type'] == 'all') selected @endif>All
                                                        </option>
                                                        <option value="user"
                                                                @if($_GET['user_type'] == 'user') selected @endif>User
                                                        </option>
                                                        <option value="merchant"
                                                                @if($_GET['user_type'] == 'merchant') selected @endif>
                                                            Merchant
                                                        </option>
                                                        <option value="agent"
                                                                @if($_GET['user_type'] == 'agent') selected @endif>Agent
                                                        </option>
                                                    @else
                                                        <option value="all">All</option>
                                                        <option value="user">User</option>
                                                        <option value="merchant">Merchant</option>
                                                        <option value="agent">Agent</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>


                                    </div>
                                    <br>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.nonBankPaymentReport') }}">
                                            <strong>Filter</strong>
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
                            <h5>List of all Non bank payment reports</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Non bank payment report">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Transaction channel</th>
                                        <th>Form of transaction</th>
                                        <th>Number (Count)</th>
                                        <th>Value (Amount sum)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($nonBankPayments as $title=>$nonBankPayment)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>Customer initiated</td>
                                            <td>{{$title}}</td>
                                            <td>{{$nonBankPayment['number']}}</td>
                                            <td>Rs. {{$nonBankPayment['value']}}</td>
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


