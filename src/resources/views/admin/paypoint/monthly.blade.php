@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Monthly PayPoint Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>PayPoint</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Monthly PayPoint</strong>
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
                        <li><a class="nav-link" data-toggle="tab" href="#graph">Graph</a></li>


                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="data" class="tab-pane active">
                            <div class="monthly">


                                {{--table--}}
                                <div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ibox ">
                                                <div class="ibox-title">
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
                                                            <form role="form" method="get" action="{{ route('filter.profile.transaction') }}">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-3">

                                                                        <div class="form-group">
                                                                            <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">

                                                                        <div class="form-group">
                                                                            <input type="text" name="user" placeholder="Enter User" class="form-control">
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-3">
                                                                        <div class="input-group date">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                            <input id="date_transaction_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3">
                                                                        <div class="input-group date">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                            <input id="date_transaction_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off">
                                                                        </div>
                                                                    </div>





                                                                    <div class="col-md-6">
                                                                        <label for="ionrange_balance">Amount</label>
                                                                        <input type="text" name="amount" class="ionrange_balance">
                                                                    </div>

                                                                    <div class="col-md-3" style="margin-top: 40px;">
                                                                        <div class="form-group">
                                                                            <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                                                <option value="" selected disabled>Select Status...</option>
                                                                                <option value="Complete">Complete</option>
                                                                                <option value="Incomplete">Incomplete</option>
                                                                                <option value="Pending">Pending</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-3" style="margin-top: 40px;">

                                                                        <div class="form-group">
                                                                            <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                                                <option value="" selected disabled>Sort By...</option>
                                                                                <option value="Pending">Highest Amount</option>
                                                                                <option value="Pending">Lowest Amount</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>


                                                                </div>


                                                                <br>





                                                                <div>
                                                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Filter</strong></button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>User</th>

                                                    <th>Amount</th>
                                                    <th>status</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <tr class="gradeC">
                                                    <td>1</td>
                                                    <td>2019/09/10</td>
                                                    <td>Top UP</td>
                                                    <td>Avaya Baniya</td>

                                                    <td>

                                                        900

                                                    </td>
                                                    <td>
                                                        <span class="badge badge-primary">Complete</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('transactionDetail')}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>View Details</strong></a>
                                                    </td>
                                                </tr>

                                                <tr class="gradeC">
                                                    <td>2</td>
                                                    <td>2019/09/05</td>
                                                    <td>Load Fund</td>
                                                    <td>Avaya Baniya</td>

                                                    <td>

                                                        1000

                                                    </td>
                                                    <td>
                                                        <span class="badge badge-primary">Complete</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('transactionDetail')}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>View Details</strong></a>
                                                    </td>
                                                </tr>

                                                <tr class="gradeC">
                                                    <td>3</td>
                                                    <td>2019/09/03</td>
                                                    <td>Load Fund</td>
                                                    <td>Rubek Joshi</td>

                                                    <td>

                                                        400

                                                    </td>
                                                    <td>
                                                        <span class="badge badge-primary">Complete</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('transactionDetail')}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>View Details</strong></a>
                                                    </td>
                                                </tr>

                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                </div>




                            </div>
                        </div>

                        <div role="tabpanel" id="graph" class="tab-pane">
                            <div class="monthly">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <span class="label label-primary float-right">Yearly</span>
                                                <h5>Successful Transactions</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins">40 886,200</h1>
                                                <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                                                <small>Number of Transactions</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <span class="label label-primary float-right">Yearly</span>
                                                <h5>Failed Transactions</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins">275,800</h1>
                                                <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                                                <small>Number of Transactions</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <span class="label label-primary float-right">Yearly</span>
                                                <h5>Total Amount</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins">106,120</h1>
                                                <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                                                <small>Total Users</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <span class="label label-primary float-right">Yearly</span>
                                                <h5>Users Involved</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <h1 class="no-margins">80</h1>
                                                <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                                                <small>Number of verified users</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-lg-12">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <div style="width: 38%">
                                                    <h5>Paypoint Daily Transaction Number
                                                    </h5>

                                                    <div class="input-group date" style="float: right; width: 31%; margin-top: -9px; border-color: #18a689">

                                                        <input id="date_graph_year" type="text" class="form-control" placeholder="Select Year" name="year" value="{{ date('Y') }}" autocomplete="off">
                                                        <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <div>
                                                    <canvas id="lineChart_monthly" height="60"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-lg-12">
                                        <div class="ibox ">
                                            <div class="ibox-title">
                                                <div style="width: 38%">
                                                    <h5>User Paypoint Transactions
                                                    </h5>
                                                </div>
                                                <div class="ibox-content">
                                                    <div>
                                                        <canvas id="barChart" height="80"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>

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

    <link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">

    <style>
        .chosen-container-single .chosen-single{
            height: 35px !important;
            border-radius: 0px;
        }

        .chosen-container-single .chosen-single span{
            margin-top: 5px;
            margin-left: 5px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
@endsection


@section('scripts')

    <!-- Chosen -->
    <script src="{{ asset('admin/js/plugins/chosen/chosen.jquery.js') }}"></script>

    <script>
        $('.chosen-select').chosen({width: "100%"});
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(".date_from").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });

    </script>

    <script>
        $(".date_from").change(function () {
            var start_date = $(this).val();

            $(".date_to").val('');
            $(".date_to").removeAttr('readonly');
            $(".date_to").datepicker('destroy');
            $(".date_to").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate:new Date(start_date),
                format: 'dd M, yyyy'
            });
        });

        $(".date_to").keyup(function () {
            $(this).val('');
        });
    </script>

    <script>
        $("#date_graph_year").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,
        });
    </script>

    <!-- IonRangeSlider -->
    {{--<script src="{{ asset('admin/js/plugins/ionRangeSlider/ion.rangeSlider.min.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        $(".ionrange_balance").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: 100,
            to: 900,
            prefix: "Rs."
        });

        $(".ionrange_debit").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: 100,
            to: 900,
            prefix: "Rs."
        });

        $(".ionrange_credit").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: 100,
            to: 900,
            prefix: "Rs."
        });


    </script>


    {{--Data Table--}}
    <script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });

    </script>

    <!-- ChartJS-->
    <script src="{{ asset('admin/js/plugins/chartJs/Chart.min.js') }}"></script>

    {{--Monthly Paypoint Graph--}}
    <script>
        var lineData = {
            labels: ["00:00", "01:00", "02:00", "03:00", "04:00", "05:00", "06:00", "07:00", "08:00", "09:00", "10:00", "11:00", "12:00",
                "13:00", "14:00", "15:00", "16:00", "17:00", "18:00", "19:00", "20:00", "21:00", "22:00", "23:00", "24:00"],
            datasets: [

                {
                    label: "Transaction NUmber",
                    backgroundColor: 'rgba(28,132,198,0.5)',
                    borderColor: "rgba(28,132,198,0.7)",
                    pointBackgroundColor: "rgba(28,132,198,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90, 90, 90, 160, 200, 30]
                },
            ]
        };

        var lineOptions = {
            responsive: true,
            scales: {
                xAxes: [{
                    ticks: {
                        // Include a dollar sign in the ticks
                        callback: function(value, index, values) {
                            return  value;
                        },
                        autoSkip: false
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Months'
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Transaction Amount(NRP)'

                    }
                }]
            }
        };


        var ctx = document.getElementById("lineChart_monthly").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});


    </script>

    {{--User Paypoint Graph--}}
    <script>

        Chart.scaleService.updateScaleDefaults('linear',{
            ticks:{
                min:0,
            }
        });

        var barData = {
            labels: <?php echo $labels; ?>,
            datasets: [
                {
                    label: "Number of PayPoint Transactions",
                    backgroundColor: 'rgba(28,132,198,0.5)',
                    borderColor: "rgba(28,132,198,0.7)",
                    pointBackgroundColor: "rgba(28,132,198,1)",
                    pointBorderColor: "#fff",
                    data: [65, 59, 80, 81, 56, 55, 40]
                },

            ]
        };

        var barOptions = {
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
                        //return "$" + Number(tooltipItem.yLabel) + " and so worth it !";

                        let sum = <?php echo $sumAmount ?>;
                        return "Total transaction amount Rs. " + sum[tooltipItem.index];
                    }
                }
            }

        };


        var ctx2 = document.getElementById("barChart").getContext("2d");
        new Chart(ctx2, {type: 'bar', data: barData, options:barOptions});
    </script>


@endsection

