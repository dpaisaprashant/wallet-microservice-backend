@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Monthly Transaction Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Monthly Transaction</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">

            <div class="col-lg-12">

                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="nav-link active" data-toggle="tab" href="#data">Data</a></li>
                        <li><a id="transactionGraphTabButton" class="nav-link" data-toggle="tab" href="#transactionGraph">Transaction Graph</a></li>
                        <li><a id="vendorGraphTabButton" class="nav-link" data-toggle="tab" href="#vendorGraph">Vendor Graph</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="data" class="tab-pane active">
                            <div class="daily">

                                {{--table--}}
                                <div>
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
                                                <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <form role="form" method="get">
                                                                <div class="row">

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <input type="text" name="uid" placeholder="User Transaction ID" class="form-control" value="{{ !empty($_GET['uid']) ? $_GET['uid'] : '' }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <input type="text" name="user" placeholder="User" class="form-control" value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <select data-placeholder="Select Vendor...." class="chosen-select"  tabindex="2" name="vendor">
                                                                                <option value="" selected disabled>Select Vendor...</option>
                                                                                <option value="">All</option>
                                                                                @if(!empty($_GET['vendor']))
                                                                                    @foreach($vendors as $vendor)
                                                                                    <option value="{{$vendor}}" @if($_GET['vendor']  == $vendor) selected @endif >{{$vendor}}</option>
                                                                                    @endforeach
                                                                                @else
                                                                                    @foreach($vendors as $vendor)
                                                                                        <option value="{{$vendor}}"  >{{$vendor}}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2" name="service">
                                                                                <option value="" selected disabled>Select Service Type...</option>
                                                                                <option value="">All</option>
                                                                                @if(!empty($_GET['service']))
                                                                                    @foreach($serviceTypes as $serviceType)
                                                                                        <option value="{{ $serviceType }}" @if($_GET['service'] == $serviceType) selected @endif>{{ $serviceType }}</option>
                                                                                    @endforeach
                                                                                @else
                                                                                    @foreach($serviceTypes as $serviceType)
                                                                                        <option value="{{ $serviceType }}"> {{ $serviceType }} </option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <label for="ionrange_amount">Amount</label>
                                                                        <input type="text" name="amount" class="ionrange_amount">
                                                                    </div>

                                                                    <div class="col-md-3" style="padding-top: 40px;">
                                                                        <div class="input-group date">

                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                            <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3" style="padding-top: 40px;">
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
                                                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('report.monthly') }}"><strong>Filter</strong></button>
                                                                </div>

                                                                <div>
                                                                    <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('report.monthly.excel') }}"><strong>Excel</strong></button>
                                                                </div>
                                                                @include('admin.asset.components.clearFilterButton')
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Monthly transaction report">
                                                <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>UID</th>
                                                    <th>Transaction ID</th>
                                                    <th>User</th>
                                                    <th>Vendor</th>
                                                    <th>Service Type</th>
                                                    <th>Amount</th>
                                                    <th>Commission</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($transactions as $transaction)
                                                    <tr class="gradeC">
                                                        <td>{{ $loop->index + ($transactions->perPage() * ($transactions->currentPage() - 1)) + 1 }}</td>
                                                        <td>{{ $transaction->uid }}</td>
                                                        <td>
                                                            @if(!empty($transaction->transactionable->transaction_id))
                                                                {{ $transaction->transactionable->transaction_id}}
                                                            @elseif(!empty($transaction->transactionable->refStan))
                                                                {{ $transaction->transactionable->refStan}}
                                                            @else
                                                                {{ $transaction->id }}
                                                            @endif


                                                        </td>
                                                        <td>
                                                            <a  @can('User profile') href="{{route('user.profile', $transaction->user_id)}}" @endcan> {{ $transaction->user['mobile_no'] }} </a>
                                                        </td>
                                                        <td>
                                                            {{ $transaction->vendor }}
                                                        </td>
                                                        <td>
                                                            {{ $transaction->service_type }}
                                                        </td>
                                                        <td class="center">Rs. {{ $transaction->amount }}</td>
                                                        <td class="center">
                                                            @if($transaction->commission)
                                                                    @if($transaction->commission['module'] != \App\Wallet\Commission\Models\Commission::MODULE_CASHBACK)
                                                                        Rs. {{ $transaction->commission['before_amount'] - round($transaction->commission['after_amount'] , 2) }}
                                                                    @endif
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <span class="badge badge-primary">Complete</span>
                                                        </td>
                                                        <td class="center">{{ $transaction->created_at }}</td>
                                                        <td>

                                                            @if($transaction->transaction_type == 'App\Models\UserToUserFundTransfer')

                                                                @include('admin.transaction.fundTransfer.detail', ['transaction' => $transaction->transactionable])
                                                                <a href="{{ route('userToUserFundTransfer.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                                                            @elseif($transaction->transaction_type == 'App\Models\UserLoadTransaction')

                                                                @include('admin.transaction.npay.detail', ['transaction' => $transaction->transactionable])
                                                                <a href="{{ route('eBanking.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                                                            @elseif($transaction->transaction_type == 'App\Models\UserTransaction')

                                                                @include('admin.transaction.paypoint.detail', ['transaction' => $transaction->transactionable])
                                                                <a href="{{ route('paypoint.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                                                            @elseif($transaction->transaction_type == 'App\Models\FundRequest')

                                                                @include('admin.transaction.fundRequest.detail', ['transaction' => $transaction->transactionable])
                                                                <a href="{{ route('fundRequest.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach



                                                </tbody>

                                            </table>
                                            {{ $transactions->appends(request()->query())->links() }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-body">
                            </div>
                        </div>
                        <div role="tabpanel" id="transactionGraph" class="tab-pane">
                            <div class="daily">
                                {{--Stats--}}
                                <div class="row stats" style="display: none;">
                                    <div class="col-lg-3">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <span class="label label-success float-right">Monthly</span>
                                                <h5>Successful Transactions</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins" id="successfulTransactionCount"></h1>
                                                <small>Number of Transactions</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <span class="label label-success float-right">Monthly</span>
                                                <h5>Total Amount</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins" id="totalTransactionAmount"></h1>
                                                <small>Total Amount of Money Transferred</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <span class="label label-success float-right">Monthly</span>
                                                <h5>New Users</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins" id="NewUsersCount"></h1>
                                                <small>Number of new users registered this month</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <span class="label label-success float-right">Monthly</span>
                                                <h5>Users Involved</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins" id="usersInvolved"></h1>
                                                <small>Number of users Involved</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{--Graph--}}
                                <div class="row" style="margin-bottom: 2px; padding-bottom: 2px;">
                                </div>

                                <div class="row" style="">
                                    <div class="col-lg-12">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                    <h5>Monthly Transaction Graph
                                                    </h5>
                                            </div>
                                            <div class="ibox-content">
                                                {{-- filter graph--}}
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <form id="monthlyGraphForm" role="form" method="post" action="{{ route('report.monthly.graph') }}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <input type="text" name="user" placeholder="Enter User" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <select data-placeholder="Select Vendor...." class="chosen-select"  tabindex="2" name="vendor">
                                                                                <option value="" selected disabled>Select Vendor...</option>
                                                                                <option value="">All</option>
                                                                                @if(!empty($_GET['vendor']))
                                                                                    @foreach($vendors as $vendor)
                                                                                    <option value="{{$vendor}}" @if($_GET['vendor']  == $vendor) selected @endif >{{$vendor}}</option>
                                                                                    @endforeach
                                                                                @else
                                                                                    @foreach($vendors as $vendor)
                                                                                        <option value="{{$vendor}}"  >{{$vendor}}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="input-group date">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                        <input id="date_month" type="text" class="form-control date_month" placeholder="Select Month" name="date_month" value="{{ \Carbon\Carbon::now()->format('Y-m') }}" autocomplete="off">
                                                                    </div>
                                                                </div>
                                                                <div style="margin-top: 7px;">
                                                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Filter</strong></button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                <div>
                                                    <canvas id="lineChart_monthly" height="80"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <div class="panel-body">
                            </div>
                        </div>
                        <div role="tabpanel" id="vendorGraph" class="tab-pane">
                            <div class="daily">
                                {{--Graph--}}
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-lg-12">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <div style="width: 38%">
                                                    <h5>User Vendor Transactions
                                                    </h5>
                                                </div>
                                                <div class="ibox-content">
                                                    {{--filter graph--}}
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <form id="monthlyVendorGraphForm" role="form" method="post" action="{{ route('report.monthly.vendor.graph') }}">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <input type="text" name="user" placeholder="Enter User" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <select data-placeholder="Select Vendor...." class="chosen-select"  tabindex="2" name="vendor">
                                                                                <option value="" selected disabled>Select Vendor...</option>
                                                                                <option value="">All</option>
                                                                                @if(!empty($_GET['vendor']))
                                                                                    @foreach($vendors as $vendor)
                                                                                    <option value="{{$vendor}}" @if($_GET['vendor']  == $vendor) selected @endif >{{$vendor}}</option>
                                                                                    @endforeach
                                                                                @else
                                                                                    @foreach($vendors as $vendor)
                                                                                        <option value="{{$vendor}}"  >{{$vendor}}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="input-group date">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                            <input type="text" class="form-control date_month" placeholder="Select Year" name="date_month" value="{{ \Carbon\Carbon::now()->format('Y-m') }}" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div style="margin-top: 7px;">
                                                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Show Graph</strong></button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <canvas id="barChart" height="80"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .ibox-title{
            padding-right: 50px;
        }
    </style>
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    @include('admin.asset.css.datepicker')
@endsection


@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`; @else '0;300000'; @endif
        let split = amount.split(';');

        $(".ionrange_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 300000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });
    </script>
    @include('admin.asset.js.datatable')
    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>

    <!-- ChartJS-->
    <script src="{{ asset('admin/js/plugins/chartJs/Chart.min.js') }}"></script>

    {{--Monthly Paypoint Graph--}}
    <script>
        let lineChart;
        let barChart;
        $('#transactionGraphTabButton').one('click', function (e) {
            $("#monthlyGraphForm").submit();
        });

        $('#monthlyGraphForm').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:url,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    if(lineChart) {
                        lineChart.destroy();
                    }
                    loadLineGraph(resp.graph, resp.month, resp.year);
                    //set value to stats
                    $("#successfulTransactionCount").text(resp.transactionCount);
                    $("#totalTransactionAmount").text('Rs. ' + resp.transactionAmount);
                    $("#usersInvolved").text(resp.usersInvolved);
                    $("#NewUsersCount").text(resp.newUsersCount);

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');
                }
            });
        });

        function loadLineGraph(graphData, month, year) {
            let data = graphData;
            let monthDates = new Date(parseInt(year), parseInt(month), 0).getDate();
            let countObj = {};
            let amountObj = {};

            for( let i = 1; i <= monthDates; i++){
                const date = `${year}-${month}-${i < 10 ? '0' + i : i}`;

                data[date] !== undefined
                    ? countObj[date] = data[date].count
                    : countObj[date] = 0;

                data[date] !== undefined
                    ? amountObj[date] = data[date].amount
                    : amountObj[date]=0;
            }
            let keys = Object.keys(countObj);
            let monthCountData = Object.values(countObj);
            let monthAmountData = Object.values(amountObj);
            var lineData = {
                labels: keys, //labels
                datasets: [
                    {
                        label: "Transaction Number",
                        lineTension: 0.19,
                        backgroundColor: 'rgba(28,132,198,0.5)',
                        borderColor: "rgba(28,132,198,0.7)",
                        pointBackgroundColor: "rgba(28,132,198,1)",
                        pointBorderColor: "#fff",
                        data: monthCountData
                    },
                ]
            };
            var lineOptions = {
                responsive: true,
                scales: {
                    xAxes: [{
                        ticks: {
                            callback: function(value, index, values) {
                                return  value;
                            },
                            autoSkip: false
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Dates is selected month'
                        }
                    }],
                    yAxes: [{
                        ticks:{
                            //stepSize: 1
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Transaction Count'
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return "Count: " + Number(tooltipItem.yLabel) + "\n\n Amount: Rs." + amountObj[tooltipItem.xLabel]  ;
                            //return "Total transaction amount Rs. ";
                        }
                    }
                }
            };

            var ctx = document.getElementById("lineChart_monthly").getContext("2d");
            lineChart = new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
        }
    </script>

    {{--User Paypoint Graph--}}
    <script>
        $('#vendorGraphTabButton').one('click', function (e) {
            $("#monthlyVendorGraphForm").submit();
        });

        $('#monthlyVendorGraphForm').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:url,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {

                    if(barChart) {
                        barChart.destroy();
                    }

                    loadVendorGraph(resp);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');
                }
            });
        });

        function loadVendorGraph(graphData) {
            Chart.scaleService.updateScaleDefaults('linear',{
                ticks:{
                    min:0,
                }
            });

            let keys = graphData;

            let countObj = {};
            let amountObj = {};

            $.each(keys, function (index, value) {
                countObj[index] = value.count;
                amountObj[index] = value.amount;
            });

            let countData = Object.values(countObj);
            var barData = {
                labels: Object.keys(keys),
                datasets: [
                    {
                        label: "Number of Transactions of a Vendor",
                        backgroundColor: 'rgba(28,132,198,0.5)',
                        borderColor: "rgba(28,132,198,0.7)",
                        pointBackgroundColor: "rgba(28,132,198,1)",
                        pointBorderColor: "#fff",
                        data: countData
                    },
                ]
            };
            var barOptions = {
                responsive: true,
                scales: {
                    xAxes: [{
                        barPercentage: 0.4,
                        ticks: {
                            callback: function(value, index, values) {
                                return  value;
                            },
                            autoSkip: false
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'PayPoints'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Number of Transaction',
                        },
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return "Count: " + Number(tooltipItem.yLabel) + "\n\n Amount: Rs." + amountObj[tooltipItem.xLabel]  ;
                            //return "Total transaction amount Rs. ";
                        }
                    }
                }
            };

            var ctx2 = document.getElementById("barChart").getContext("2d");
            barChart = new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});
        }
    </script>
@endsection
