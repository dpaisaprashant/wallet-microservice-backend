@extends('admin.layouts.admin_design')
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">


        <div class="row m-b-lg m-t-lg">
            <div class="col-md-4" style="margin-top: 20px;">

                <div class="profile-image">
                    <img src="{{ asset('admin/img/a4.jpg') }}" class="rounded-circle circle-border m-b-md" alt="profile">
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                Test Bank
                            </h2>
                            <h4>Joined: 3rd September, 2019</h4>
                            <h4>Number: 9860000000</h4>
                            <h4>Address: Basantapur, Kathmandu</h4>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5" style="margin-top: 20px;">



                <table class="table m-b-xs">
                    <tbody>
                    <tr>
                        <td>
                            <strong>
                                <button type="button" class="btn btn-primary m-r-sm">12</button>
                            </strong> Total Transactions
                        </td>


                    </tr>

                    <tr>
                        <td>

                        </td>

                        <td>

                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <div class="widget lazur-bg no-padding">
                    <div class="p-m">
                        <h1 class="m-xs">Rs. 2,10,660</h1>

                        <h3 class="font-bold no-margins">
                           Total transaction amount
                        </h3>
                        <small>Money transacted from this bank</small>
                    </div>

                </div>
            </div>


        </div>
        <hr>


        <div class="row">

            <div class="col-lg-12">

                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="nav-link active" data-toggle="tab" href="#transaction">Transactions</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" id="transaction" class="tab-pane active">


                            <div class="row" style="margin-top: 10px;">
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

                                                            <div class="col-md-3">

                                                                <div class="form-group">
                                                                    <input type="text" name="user" placeholder="Enter User" class="form-control">
                                                                </div>
                                                            </div>


                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                                        <option value="" selected disabled>Select Status...</option>
                                                                        <option value="Complete">Complete</option>
                                                                        <option value="Incomplete">Incomplete</option>
                                                                        <option value="Pending">Pending</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                <label for="ionrange_debit">Debit</label>
                                                                <input type="text" name="Debit" class="ionrange_debit">
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="ionrange_credit">Credit</label>
                                                                <input type="text" name="credit" class="ionrange_credit">
                                                            </div>
                                                        </div>



                                                        <div class="row">
                                                            <div class="col-md-3" style="margin-top: 37px;">

                                                                <div class="form-group">
                                                                    <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                                        <option value="" selected disabled>Sort By...</option>
                                                                        <option value="Complete">Highest Debit</option>
                                                                        <option value="Incomplete">Lowest Debit</option>
                                                                        <option value="Pending">Highest Credit</option>
                                                                        <option value="Pending">Lowest Credit</option>
                                                                        <option value="Pending">Highest Balance</option>
                                                                        <option value="Pending">Lowest Balance</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button class="btn btn-primary float-right m-t-n-xs" type="submit"><strong>Filter</strong></button>
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
                                            <th>Debit</th>
                                            <th>Credit</th>
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
                                            <td>100</td>
                                            <td></td>
                                            <td>
                                                <span class="badge badge-primary">Complete</span>
                                            </td>
                                            <td>
                                                <a href="{{route('transactionDetail')}}" class="btn btn-primary m-t-n-xs"><strong>View Details</strong></a>
                                            </td>
                                        </tr>

                                        <tr class="gradeC">
                                            <td>2</td>
                                            <td>2019/09/05</td>
                                            <td>Load Fund</td>
                                            <td>Avaya Baniya</td>
                                            <td></td>
                                            <td>600</td>
                                            <td>
                                                <span class="badge badge-primary">Complete</span>
                                            </td>
                                            <td>
                                                <a href="{{route('transactionDetail')}}" class="btn btn-primary m-t-n-xs"><strong>View Details</strong></a>
                                            </td>
                                        </tr>

                                        <tr class="gradeC">
                                            <td>3</td>
                                            <td>2019/09/03</td>
                                            <td>Load Fund</td>
                                            <td>Rubek Joshi</td>
                                            <td></td>
                                            <td>400</td>
                                            <td>
                                                <span class="badge badge-primary">Complete</span>
                                            </td>
                                            <td>
                                                <a href="{{route('transactionDetail')}}" class="btn btn-primary m-t-n-xs"><strong>View Details</strong></a>
                                            </td>
                                        </tr>

                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>User</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>status</th>
                                            <th>Actions</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
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
                            <h5>Bank Transaction Amount for the year
                            </h5>

                            <div class="input-group date" style="float: right; width: 31%; margin-top: -9px; border-color: #3366ff">

                                <input id="date_graph_year" type="text" class="form-control" placeholder="Select Year" name="year" value="{{ date('Y') }}" autocomplete="off">
                                <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>

                            </div>

                        </div>



                    </div>
                    <div class="ibox-content">
                        <div>
                            <canvas id="lineChart" height="80"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>





@endsection

@section('styles')
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

    {{--<link href="{{ asset('admin/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">

@endsection

@section('scripts')

    <!-- Chosen -->
    <script src="{{ asset('admin/js/plugins/chosen/chosen.jquery.js') }}"></script>

    <script>
        $('.chosen-select').chosen({width: "100%"});
    </script>

    <!-- Data picker -->
   {{-- <script src="{{ asset('admin/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>--}}
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


    <script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                title: 'Bank Transactions List',
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

    <!-- ChartJS-->
    <script src="{{ asset('admin/js/plugins/chartJs/Chart.min.js') }}"></script>



    <script>
        var lineData = {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [

                {
                    label: "Transaction Amount",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [28, 48, 40, 19, 86, 27, 90, 90, 90, 160, 200, 30]
                },/*{
                    label: "Data 2",
                    backgroundColor: 'rgba(220, 220, 220, 0.5)',
                    pointBorderColor: "#fff",
                    data: [65, 59, 80, 81, 56, 55, 40]
                }*/
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


        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

    </script>


@endsection


