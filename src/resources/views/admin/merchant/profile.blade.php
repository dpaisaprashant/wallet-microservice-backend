@extends('admin.layouts.admin_design')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row m-b-lg m-t-lg">
            @include('admin.asset.notification.notify')
            <div class="col-md-4" style="margin-top: 20px;">
                <div class="profile-image">
                    @isset($merchant->kyc['p_photo'])
                        <img src="{{ config('dpaisa-api-url.merchant_kyc_documentation_url') . $merchant->kyc['company_logo'] }}" class="rounded-circle circle-border m-b-md" alt="profile">
                    @else
                        <img src="{{ asset('admin/img/a4.jpg') }}" class="rounded-circle circle-border m-b-md" alt="profile">
                    @endisset
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                {{ $merchant->name }}
                            </h2>
                            <h4>Joined: {{ date('M d, Y', strtotime($merchant->created_at)) }}</h4>
                            <h4>Number: {{ $merchant->mobile_no }}</h4>

                            @if(!empty($merchant->kyc))
                                <h4>Address: {{ $merchant->kyc->district }}, Province {{ $merchant->kyc->province }}</h4>
                            @endif
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
                                <button type="button" class="btn btn-primary m-r-sm">{{ count($merchant->transactionEvents) }}</button>
                            </strong> Total Transactions
                        </td>
                        <td>
                            <strong>
                                <button type="button" class="btn btn-primary m-r-sm">Rs. {{ $loadFundSum }}</button>
                            </strong> Total Loaded Funds
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <button type="button" class="btn btn-warning m-r-sm">12</button>
                            </strong> icash Points
                        </td>
                        <td>
                            @if(empty($merchant->kyc))
                                <strong>
                                    <button type="button" class="btn btn-danger m-r-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </strong> KYC not filled
                            @elseif($merchant->kyc->accept === null)
                                <strong>
                                    <button type="button" class="btn btn-danger m-r-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </strong> KYC not verified
                            @elseif($merchant->kyc->accept === 0)
                                <strong>
                                    <button type="button" class="btn btn-danger m-r-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </strong> KYC rejected
                            @elseif($merchant->kyc->accept == 1)
                                <strong>
                                    <button type="button" class="btn btn-primary m-r-sm">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </strong> KYC verified
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <button type="button" class="btn btn-info m-r-sm">12</button>
                            </strong> Bonus Amount
                        </td>

                        <td>
                            @if($merchant->status == 1)
                            {{--@can('User deactivate')--}}
                                <form action="{{ route('user.deactivate') }}" method="post" id="deactivateForm">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $merchant->id }}">
                                    <button id="deactivate" style="margin-top: 5px;" class="btn btn-danger m-t-n-xs deactivate" rel="{{ route('user.deactivate') }}"><strong>Deactivate User</strong></button>
                                    <button id="deactivateBtn" type="submit" style=" display:none;" class="btn btn-danger m-t-n-xs deactivate" rel="{{ route('user.deactivate') }}"><strong>Deactivate User</strong></button>
                                </form>
                            {{--@endcan--}}
                            @else
                            {{--@can('User activate')--}}
                                <form action="{{ route('user.activate') }}" method="post" id="activateForm">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $merchant->id }}">
                                    <button id="activate" style="margin-top: 5px;" class="btn btn-primary m-t-n-xs activate" rel="{{ route('user.activate') }}"><strong>Activate User</strong></button>
                                    <button id="activateBtn" type="submit" style=" display:none;" class="btn btn-primary m-t-n-xs activate" rel="{{ route('user.activate') }}"><strong>Activate User</strong></button>
                                </form>
                            {{--@endcan--}}
                            @endif
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

                        <h1 class="m-xs">Rs. {{ $merchant->wallet->balance }}</h1>

                        <h3 class="font-bold no-margins">
                           Total balance in wallet
                        </h3>
                        <small>Money saved in icash wallet</small>
                    </div>

                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="nav-link @if($activeTab == 'kyc') active @endif" data-toggle="tab" href="#kyc"> KYC</a></li>

                        <li><a class="nav-link @if($activeTab == 'companyInfo') active @endif" data-toggle="tab" href="#companyInfo"> Company Info</a></li>
                        <li><a class="nav-link @if($activeTab == 'allAuditTrial') active @endif" data-toggle="tab" href="#allAuditTrial">All Audit Trials</a></li>

                        <li><a class="nav-link @if($activeTab == 'bankDetails') active @endif" data-toggle="tab" href="#bankDetails">Bank Details</a></li>

                        <li><a class="nav-link @if($activeTab == 'commission') active @endif" data-toggle="tab" href="#commission">Commission | Cashback</a></li>

                        <li><a class="nav-link @if($activeTab == 'minBankTransferBalance') active @endif" data-toggle="tab" href="#minBankTransferBalance">BankTransferBalance Limit</a></li>
                        <li><a class="nav-link" data-toggle="tab" href="#wallet">Wallet</a></li>
                        {{--<li><a class="nav-link @if($activeTab == 'loadFund') active @endif" data-toggle="tab" href="#loadFund">Load Funds</a></li>--}}
                        <li><a id="transactionGraphTabButton" class="nav-link" data-toggle="tab" href="#transactionGraph">Transaction Graph</a></li>
                        @can('Send notification to user')
                            <li><a class="nav-link" data-toggle="tab" href="#notification">Notification(SMS)</a></li>
                        @endcan
                    </ul>
                    <div class="tab-content">
                        @include('admin.merchant.profile.tabs.kyc')
                        @include('admin.merchant.profile.tabs.companyInfo')
                        @include('admin.merchant.profile.tabs.wallet')
                        @include('admin.merchant.profile.tabs.bankDetails')
                        @include('admin.merchant.profile.tabs.commission')
                        @include('admin.merchant.profile.tabs.minBankTransferBalance')
                        @include('admin.merchant.profile.tabs.auditTrial.allAuditTrial')
                        @include('admin.merchant.profile.tabs.notification')
                       {{--
                        @include('admin.user.profile.tabs.allSuccessfulTransactions')

                        @include('admin.user.profile.tabs.transactionGraph')


                            --}}
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('styles')


    @include('admin.asset.css.datatable')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')

    <link href="{{ asset('admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <style>
        .kyc-btn {
            padding: 2px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

    <!-- Sweet Alert -->
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <style>
        .profile-image img {
            width: 125px;
            height: 125px;
        }

        .profile-image {
            width: 145px;
        }
    </style>
@endsection

@section('scripts')

    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $('#deactivate').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "This user will be deactivated",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ed5565",
                confirmButtonText: "Yes, deactivate user!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#deactivateBtn').trigger('click');
                swal.close();

            })
        });


        $('#activate').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "This user will be activated",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1ab394",
                confirmButtonText: "Yes, activate user!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#activateBtn').trigger('click');
                swal.close();

            })
        });
    </script>

   @include('admin.asset.js.chosen')

    <!-- iCheck -->
    <script src="{{ asset('admin/js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    @include('admin.asset.js.datepicker')
    <script>
        $(".date_year").datepicker({
            format: "yyyy",
            viewMode: "years",
            minViewMode: "years",
            autoclose: true,
        });
    </script>
    <!-- Data picker close -->

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>

        let balance = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`; @else '0;100000'; @endif
        let split = balance.split(';');

        $(".ionrange_balance_transaction_statement").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });


        let credit = @if(!empty($_GET['debit_range'])) `{{ $_GET['debit_range'] }}`; @else '0;100000'; @endif
            split = credit.split(';');

        $(".ionrange_debit").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        $(".ionrange_balance").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: 100,
            to: 900,
            prefix: "Rs."
        });

        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`; @else '0;100000'; @endif
         split = amount.split(';');

        $(".ionrange_load_fund_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        $(".ionrange_amount_transaction").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

    </script>

    @include('admin.asset.js.datatable')

    {{--<script>
        $(document).ready(function (e) {
            let a = "Showing {{ $merchantLoadTransactions->firstItem() }} to {{ $merchantLoadTransactions->lastItem() }} of {{ $merchantLoadTransactions->total() }} entries";
            $('#userLoadFundTable').find('.dataTables_info').text(a);

            let b = "Showing {{ $merchantTransactionEvents->firstItem() }} to {{ $merchantTransactionEvents->lastItem() }} of {{ $merchantTransactionEvents->total() }} entries";
            $('#userTransactionEventTable').find('.dataTables_info').text(b);

            let c = "Showing {{ $merchantTransactionStatements->firstItem() }} to {{ $merchantTransactionStatements->lastItem() }} of {{ $merchantTransactionStatements->total() }} entries";
            $('#userTransactionStatementTable').find('.dataTables_info').text(c);

            let d = "Showing {{ $allAudits->firstItem() }} to {{ $allAudits->lastItem() }} of {{ $allAudits->total() }} entries";
            $('#AllAuditTable').find('.dataTables_info').text(d);

            let f = "Showing {{ $loginHistoryAudits->firstItem() }} to {{ $loginHistoryAudits->lastItem() }} of {{ $loginHistoryAudits->total() }} entries";
            $('#LoginHistoryAuditTable').find('.dataTables_info').text(f);
        });
    </script>--}}

    <!-- ChartJS-->
    <script src="{{ asset('admin/js/plugins/chartJs/Chart.min.js') }}"></script>

    {{--Yearly Paypoint Graph--}}
    <script>

        let lineChart;
        let barChart;

        $('#transactionGraphTabButton').one('click', function (e) {
            $("#userGraphForm").submit();
        });

        $('#userGraphForm').submit(function (e) {
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

                    loadLineGraph(resp.graph);

                    //set value to stats
                    $("#successfulTransactionCount").text(resp.transactionCount);
                    $("#totalTransactionAmount").text(resp.transactionAmount);
                    $("#usersInvolved").text(resp.usersInvolved);

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');
                }
            });
        });

        function loadLineGraph(respData) {
            let monthLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            let data = respData;
            let countObj = {};
            let amountObj = {};

            $.each(monthLabels, function( index, value ) {
                data[value] !== undefined
                    ? countObj[value] = data[value].count
                    : countObj[value] = 0;

                data[value] !== undefined
                    ? amountObj[value] = data[value].amount
                    : amountObj[value] = 0;
            });

            let monthCountData = Object.values(countObj);
            let monthAmountData = Object.values(amountObj);

            var lineData = {
                labels: monthLabels,
                datasets: [
                    {
                        label: "Transaction Number",
                        lineTension: 0.12,
                        backgroundColor: 'rgba(26,179,148,0.5)',
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
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
            var ctx = document.getElementById("lineChart2").getContext("2d");
            lineChart = new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
        }
    </script>

    {{--User Paypoint Graph--}}
    <script>

        $('#vendorGraphTabButton').one('click', function (e) {
            $("#yearlyVendorGraphForm").submit();
        });

        $('#yearlyVendorGraphForm').submit(function (e) {
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
                        backgroundColor: 'rgba(26,179,148,0.5)',
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
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

@yield('pageScripts')


