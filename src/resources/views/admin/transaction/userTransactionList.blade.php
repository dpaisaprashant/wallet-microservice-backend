@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>All</strong>
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

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('transaction.complete') }}" id="filter">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="user_name" placeholder="User Name"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user_name']) ? $_GET['user_name'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="mobile_no" placeholder="User Phone Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['mobile_no']) ? $_GET['mobile_no'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 20px">

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from_transaction_date" autocomplete="off"
                                                       value="{{ !empty($_GET['from_transaction_date']) ? $_GET['from_transaction_date'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to_transaction_date" autocomplete="off"
                                                       value="{{ !empty($_GET['to_transaction_date']) ? $_GET['to_transaction_date'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('transaction.complete.user') }}">
                                            <strong>Filter</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('transaction.complete.excel') }}">
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

        {{--        @if(!empty($_GET))--}}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of all transactions</h5>

                    </div>
                    <div class="ibox-content">
                        {{--                            <h5><b>Total Count:</b> {{ $totalTransactionCount }}</h5>--}}
                        {{--                            <h5><b>Total Amount Sum:</b> Rs. {{ $totalTransactionAmountSum }}</h5>--}}
                        {{--                            <h5><b>Total Fee Sum:</b> Rs. {{ $totalTransactionFeeSum }}</h5>--}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Complete transactions list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User Name</th>
                                    <th>User Phone Number</th>
                                    <th>Total Credit Amount</th>
                                    <th>Credited Transaction Count</th>
                                    <th>Total Debit Amount</th>
                                    <th>Debit Transactions Count</th>
                                    <th>Total Cashback Amount</th>
                                    <th>Count of Cashback Transactions</th>
                                    <th>Total Commission</th>
                                    <th>Count of Commission Transactions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach($users as $user)
                                    <tr class="gradeC">
                                        <td>{{ $i++}}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->mobile_no }}</td>
                                        <td>{{ $user->credit_sum }}</td>
                                        <td>{{ $user->credit_count }}</td>
                                        <td>{{ $user->debit_sum }}</td>
                                        <td>{{ $user->debit_count }}</td>
                                        <td>{{ $user->cashback_sum }}</td>
                                        <td>{{ $user->cashback_count }}</td>
                                        <td>{{ $user->commission_sum }}</td>
                                        <td>{{ $user->commission_count }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                                {{ $users->appends(request()->query())->links() }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        @endif--}}
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
    @include('admin.asset.js.datatableWithPaging')
{{--    <script>--}}
{{--        @if(!empty($_GET))--}}
{{--        $(document).ready(function (e) {--}}
{{--            let a = "Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries";--}}
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


