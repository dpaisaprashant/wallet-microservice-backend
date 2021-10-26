@extends('admin.layouts.admin_design')
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row m-b-lg m-t-lg">
            @include('admin.asset.notification.notify')
            <div class="col-md-4" style="margin-top: 20px;">
                <div class="profile-image">
                    @if(isset($user->userType))
                        @isset($user->kyc['p_photo'])
                            <img src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['p_photo'] }}"
                                 class="rounded-circle circle-border m-b-md" alt="profile">
                        @else
                            <img src="{{ asset('admin/img/a4.jpg') }}" class="rounded-circle circle-border m-b-md"
                                 alt="profile">
                        @endisset
                        @elseif(isset($user->merchant))
                        @isset($user->kyc['company_logo'])
                            <img src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_logo'] }}"
                                 class="rounded-circle circle-border m-b-md" alt="profile">
                        @else
                            <img src="{{ asset('admin/img/a4.jpg') }}" class="rounded-circle circle-border m-b-md"
                                 alt="profile">
                        @endisset
                    @endif
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                {{ $user->name }}
                            </h2>
                            <h4>Joined: {{ date('M d, Y', strtotime($user->created_at)) }}</h4>
                            <h4>Number: {{ $user->mobile_no }}</h4>
                            <h4>Email: {{ $user->email ?? "" }}</h4>

                            @if(!empty($user->kyc))
                                <h4>Address: {{ $user->kyc->district }}, Province {{ $user->kyc->province }}</h4>
                            @endif

                            <h4>User Type&nbsp;&nbsp;:&nbsp;&nbsp;<span class="badge badge-primary">
                                @if(isset($user->userType))
                                        User
                                    @elseif(isset($user->merchant))
                                        Merchant
                                    @endif
                            </span>
                            </h4>
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
                                <button type="button"
                                        class="btn btn-primary m-r-sm">{{ count($user->userTransactionEvents) }}</button>
                            </strong> Total Transactions
                        </td>
                        <td>
                            <strong>
                                <button type="button" class="btn btn-primary m-r-sm">
                                    Rs. {{ $user->wallet->bonus_balance }}</button>
                            </strong> Total Bonus Balance
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <button type="button" class="btn btn-warning m-r-sm">{{ $userBonus }}</button>
                            </strong> Bonus Points
                        </td>
                        <td>
                            @if(empty($user->kyc))
                                <strong>
                                    <button type="button" class="btn btn-danger m-r-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </strong> KYC not filled
                            @elseif($user->kyc->accept === null)
                                <strong>
                                    <button type="button" class="btn btn-danger m-r-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </strong> KYC not verified
                            @elseif($user->kyc->accept === 0)
                                <strong>
                                    <button type="button" class="btn btn-danger m-r-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </strong> KYC rejected
                            @elseif($user->kyc->accept == 1)
                                <strong>
                                    <button type="button" class="btn btn-primary m-r-sm">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </strong> KYC verified
                            @endif
                        </td>
                    </tr>
                    <tr>
                        @if(!empty($user->kyc))
                        <td>
                            @can('Edit user kyc')
                                <a style="margin-top: 5px; width: 100px"
                                   href="{{route('user.editKyc',$user->id)}}"
                                   class="btn btn-primary m-t-n-xs"
                                   title="user profile">
                                    Edit
                                </a>
                            @endcan
                            @if($user->should_change_password == 0)

                                <a data-toggle="modal" href="#modal-should-change-password">
                                    <button style="margin-top: 5px;" class="btn btn-danger m-t-n-xs"
                                            rel="{{ route('user.forcePasswordChange') }}"><strong>Force Password
                                            Change</strong></button>
                                </a>
                                <div id="modal-should-change-password" class="modal fade" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h3 class="m-t-none m-b">Reason of forcing password change</h3>
                                                        <hr>
                                                        <form action="{{ route('user.forcePasswordChange') }}"
                                                              method="post" id="forcePasswordChangeForm">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                            <div class="form-group  row">
                                                                <textarea class="form-control" name="reason" id="reason"
                                                                          placeholder="Reason of rejection"
                                                                          style="width: 100%">Please change your password for security reasons</textarea>
                                                            </div>

                                                            <div class="hr-line-dashed"></div>
                                                            <button id="forcePasswordChange" style="margin-top: 5px;"
                                                                    class="btn btn-danger m-t-n-xs deactivate"
                                                                    rel="{{ route('user.forcePasswordChange') }}">
                                                                <strong>Force Password Change</strong></button>
                                                            <button id="forcePasswordChangeBtn" type="submit"
                                                                    style=" display:none;"
                                                                    class="btn btn-danger m-t-n-xs deactivate"
                                                                    rel="{{ route('user.forcePasswordChange') }}">
                                                                <strong>Force Password Change</strong></button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            @else
                                <button style="margin-top: 5px;" class="btn btn-success m-t-n-xs " disabled><strong>Password
                                        Change Forced</strong></button>
                            @endif
                        </td>
                        @endif

                        <td>
                            @if($user->status == 1 || $user->status === null)
                                @can('User deactivate')
                                    <form action="{{ route('user.deactivate') }}" method="post" id="deactivateForm">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button id="deactivate" style="margin-top: 5px;"
                                                class="btn btn-danger m-t-n-xs deactivate"
                                                rel="{{ route('user.deactivate') }}"><strong>Deactivate User</strong>
                                        </button>
                                        <button id="deactivateBtn" type="submit" style=" display:none;"
                                                class="btn btn-danger m-t-n-xs deactivate"
                                                rel="{{ route('user.deactivate') }}"><strong>Deactivate User</strong>
                                        </button>
                                    </form>
                                @endcan
                            @else
                                @can('User activate')
                                    <form action="{{ route('user.activate') }}" method="post" id="activateForm">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button id="activate" style="margin-top: 5px;"
                                                class="btn btn-primary m-t-n-xs activate"
                                                rel="{{ route('user.activate') }}"><strong>Activate User</strong>
                                        </button>
                                        <button id="activateBtn" type="submit" style=" display:none;"
                                                class="btn btn-primary m-t-n-xs activate"
                                                rel="{{ route('user.activate') }}"><strong>Activate User</strong>
                                        </button>
                                    </form>
                                @endcan
                            @endif
                        </td>

                    </tr>
                    <tr>
                        {{--@can('Transfer bonus balance to main balance')
                            <td>
                                @include('admin.user.bonusToMainBalanceTransfer')
                            </td>
                        @endcan--}}

                        <td>

                        </td>

                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <div class="widget lazur-bg no-padding">
                    <div class="p-m">
                        <h1 class="m-xs">Rs. {{ $user->wallet->balance }}</h1>

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
                        <li><a class="nav-link @if($activeTab == 'kyc') active @endif" data-toggle="tab" href="#kyc">
                                KYC</a></li>

                        @if($user->agent)
                            <li><a class="nav-link @if($activeTab == 'agent') active @endif" data-toggle="tab"
                                   href="#agent"> Agent</a></li>
                        @endif

                        @if(isset($user->merchant))
                            <li><a class="nav-link @if($activeTab == 'companyInfo') active @endif" data-toggle="tab"
                                   href="#companyInfo"> Company Info</a></li>
                            <li><a class="nav-link @if($activeTab == 'bankDetails') active @endif" data-toggle="tab"
                                   href="#bankDetails">Bank Details</a></li>

                            <li><a class="nav-link @if($activeTab == 'commission') active @endif" data-toggle="tab"
                                   href="#commission">Commission | Cashback</a></li>

                        @endif

                        <li><a class="nav-link @if($activeTab == 'allAuditTrial') active @endif" data-toggle="tab"
                               href="#allAuditTrial">All Audit Trials</a></li>
                        <li><a class="nav-link @if($activeTab == 'userLoginHistoryAudit') active @endif"
                               data-toggle="tab" href="#userLoginHistoryAudit">User Login History Audit</a></li>
                        {{--<li><a class="nav-link @if($activeTab == 'transaction') active @endif" data-toggle="tab" href="#transaction">Transaction</a></li>--}}
                        @if((isset($user->userType) == true) && (isset($user->merchant) == false))
                            <li><a class="nav-link @if($activeTab == 'cardLoadCommission') active @endif"
                                   data-toggle="tab"
                                   href="#cardLoadCommission">Commission</a></li>
                            <li><a class="nav-link @if($activeTab == 'referralCode') active @endif" data-toggle="tab"
                                   href="#referralCode">Referral Code</a></li>
                            <li><a class="nav-link @if($activeTab == 'referralBonus') active @endif" data-toggle="tab"
                                   href="#referralBonus">Referral Bonus</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#limit">Limits</a></li>
                        @endif
                        <li><a class="nav-link" data-toggle="tab" href="#wallet">Wallet</a></li>
                        {{--<li><a class="nav-link @if($activeTab == 'loadFund') active @endif" data-toggle="tab" href="#loadFund">Load Funds</a></li>--}}
                        <li><a id="vendorGraphTabButton" class="nav-link" data-toggle="tab" href="#vendorGraph">Vendor
                                Graph</a></li>
                        <li><a id="transactionGraphTabButton" class="nav-link" data-toggle="tab"
                               href="#transactionGraph">Transaction Graph</a></li>
                        @can('Send notification to user')
                            <li><a class="nav-link" data-toggle="tab" href="#notification">Notification</a></li>
                        @endcan
                    </ul>
                    <div class="tab-content">
                        @include('admin.user.profile.tabs.kyc')
                        @if($user->agent)
                            @include('admin.user.profile.tabs.agent')
                        @endif
                        @if(isset($user->merchant))
                            @include('admin.merchant.profile.tabs.companyInfo', ['user' => $user])
                            @include('admin.merchant.profile.tabs.bankDetails')
                            @include('admin.merchant.profile.tabs.commission')
                        @endif
                        @include('admin.user.profile.tabs.auditTrial.allAuditTrial')
                        @include('admin.user.profile.tabs.auditTrial.userLoginHistoryAuditTrial')
                        {{--@include('admin.user.profile.tabs.allSuccessfulTransactions')--}}
                        @include('admin.user.profile.tabs.cardLoadCommission')
                        @include('admin.user.profile.tabs.referralCode')
                        @include('admin.user.profile.tabs.referralBonus')
                        @include('admin.user.profile.tabs.limit')
                        @include('admin.user.profile.tabs.wallet')
                        {{--@include('admin.user.profile.tabs.loadFundTransactions')--}}
                        @include('admin.user.profile.tabs.vendorGraph')
                        @include('admin.user.profile.tabs.transactionGraph')
                        @can('Send notification to user')
                            @include('admin.user.profile.tabs.notification')
                        @endcan
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

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

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

    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
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
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, activate user!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#activateBtn').trigger('click');
                swal.close();

            })
        });
    </script>

    {{--force password change--}}
    <script>
        $('#forcePasswordChange').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "This user will be forced to change password",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ed5565",
                confirmButtonText: "Yes, force password change!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#forcePasswordChangeBtn').trigger('click');
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

        let balance = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`;
        @else '0;100000'; @endif
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


        let credit = @if(!empty($_GET['debit_range'])) `{{ $_GET['debit_range'] }}`;
        @else '0;100000';
        @endif
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

        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`;
        @else '0;100000';
        @endif
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
                url: url,
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {


                    if (lineChart) {
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

            $.each(monthLabels, function (index, value) {
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
                            callback: function (value, index, values) {
                                return value;
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
                        label: function (tooltipItem) {
                            return "Count: " + Number(tooltipItem.yLabel) + "\n\n Amount: Rs." + amountObj[tooltipItem.xLabel];
                            //return "Total transaction amount Rs. ";
                        }
                    }
                }
            };
            var ctx = document.getElementById("lineChart2").getContext("2d");
            lineChart = new Chart(ctx, {type: 'line', data: lineData, options: lineOptions});
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
                url: url,
                method: "POST",
                data: new FormData(this),
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {

                    if (barChart) {
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

            Chart.scaleService.updateScaleDefaults('linear', {
                ticks: {
                    min: 0,
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
                            callback: function (value, index, values) {
                                return value;
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
                        label: function (tooltipItem) {
                            return "Count: " + Number(tooltipItem.yLabel) + "\n\n Amount: Rs." + amountObj[tooltipItem.xLabel];
                            //return "Total transaction amount Rs. ";
                        }
                    }
                }
            };

            var ctx2 = document.getElementById("barChart").getContext("2d");
            barChart = new Chart(ctx2, {type: 'bar', data: barData, options: barOptions});

        }
    </script>

    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("BonusToMain");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function(){
            modal.style.display = "block";
        }

        span.onclick = function (){
            modal.style.display = "none";
        }

        window.onclick = function(event){
            if (event.target === modal){
                modal.style.display = "none";
            }
        }
    </script>

@endsection

@yield('pageScripts')


