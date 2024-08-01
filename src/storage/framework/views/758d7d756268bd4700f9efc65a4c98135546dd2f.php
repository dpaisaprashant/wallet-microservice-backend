<?php $__env->startSection('content'); ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row m-b-lg m-t-lg">
            <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="col-md-4" style="margin-top: 20px;">
                <div class="profile-image">
                    <?php if(isset($user->userType)): ?>
                        <?php if(isset($user->kyc['p_photo'])): ?>
                            <img src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['p_photo']); ?>"
                                 class="rounded-circle circle-border m-b-md" alt="profile">
                        <?php else: ?>
                            <img src="<?php echo e(asset('admin/img/a4.jpg')); ?>" class="rounded-circle circle-border m-b-md"
                                 alt="profile">
                        <?php endif; ?>
                        <?php elseif(isset($user->merchant)): ?>
                        <?php if(isset($user->kyc['company_logo'])): ?>
                            <img src="<?php echo e(config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_logo']); ?>"
                                 class="rounded-circle circle-border m-b-md" alt="profile">
                        <?php else: ?>
                            <img src="<?php echo e(asset('admin/img/a4.jpg')); ?>" class="rounded-circle circle-border m-b-md"
                                 alt="profile">
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                <?php echo e($user->name); ?>

                            </h2>
                            <h4>Joined: <?php echo e(date('M d, Y', strtotime($user->created_at))); ?></h4>
                            <h4>Number: <?php echo e($user->mobile_no); ?></h4>
                            <h4>Email: <?php echo e($user->email ?? ""); ?></h4>

                            <?php if(!empty($user->kyc)): ?>
                                <h4>Address: <?php echo e($user->kyc->district); ?>, Province <?php echo e($user->kyc->province); ?></h4>
                            <?php endif; ?>

                            <h4>User Type&nbsp;&nbsp;:&nbsp;&nbsp;<span class="badge badge-primary">
                                <?php if(isset($user->userType)): ?>
                                        User
                                    <?php elseif(isset($user->merchant)): ?>
                                        Merchant
                                    <?php endif; ?>
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
                                        class="btn btn-primary m-r-sm"><?php echo e(count($user->userTransactionEvents)); ?></button>
                            </strong> Total Transactions
                        </td>
                        <td>
                            <strong>
                                <button type="button" class="btn btn-primary m-r-sm">
                                    Rs. <?php echo e($user->wallet->bonus_balance); ?></button>
                            </strong> Total Bonus Balance
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>
                                <button type="button" class="btn btn-warning m-r-sm"><?php echo e($userBonus); ?></button>
                            </strong> Bonus Points
                        </td>
                        <td>
                            <?php if(empty($user->kyc)): ?>
                                <strong>
                                    <button type="button" class="btn btn-danger m-r-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </strong> KYC not filled
                            <?php elseif($user->kyc->accept === null): ?>
                                <strong>
                                    <button type="button" class="btn btn-danger m-r-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </strong> KYC not verified
                            <?php elseif($user->kyc->accept === 0): ?>
                                <strong>
                                    <button type="button" class="btn btn-danger m-r-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </strong> KYC rejected
                            <?php elseif($user->kyc->accept == 1): ?>
                                <strong>
                                    <button type="button" class="btn btn-primary m-r-sm">
                                        <i class="fa fa-check"></i>
                                    </button>
                                </strong> KYC verified
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <?php if(!empty($user->kyc)): ?>
                        <td>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit user kyc')): ?>
                                <a style="margin-top: 5px; width: 100px"
                                   href="<?php echo e(route('user.editKyc',$user->id)); ?>"
                                   class="btn btn-primary m-t-n-xs"
                                   title="user profile">
                                    Edit
                                </a>
                            <?php endif; ?>
                            <?php if($user->should_change_password == 0): ?>

                                <a data-toggle="modal" href="#modal-should-change-password">
                                    <button style="margin-top: 5px;" class="btn btn-danger m-t-n-xs"
                                            rel="<?php echo e(route('user.forcePasswordChange')); ?>"><strong>Force Password
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
                                                        <form action="<?php echo e(route('user.forcePasswordChange')); ?>"
                                                              method="post" id="forcePasswordChangeForm">
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                                            <div class="form-group  row">
                                                                <textarea class="form-control" name="reason" id="reason"
                                                                          placeholder="Reason of rejection"
                                                                          style="width: 100%">Please change your password for security reasons</textarea>
                                                            </div>

                                                            <div class="hr-line-dashed"></div>
                                                            <button id="forcePasswordChange" style="margin-top: 5px;"
                                                                    class="btn btn-danger m-t-n-xs deactivate"
                                                                    rel="<?php echo e(route('user.forcePasswordChange')); ?>">
                                                                <strong>Force Password Change</strong></button>
                                                            <button id="forcePasswordChangeBtn" type="submit"
                                                                    style=" display:none;"
                                                                    class="btn btn-danger m-t-n-xs deactivate"
                                                                    rel="<?php echo e(route('user.forcePasswordChange')); ?>">
                                                                <strong>Force Password Change</strong></button>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            <?php else: ?>
                                <button style="margin-top: 5px;" class="btn btn-success m-t-n-xs " disabled><strong>Password
                                        Change Forced</strong></button>
                            <?php endif; ?>
                        </td>
                        <?php endif; ?>

                        <td>
                            <?php if($user->status == 1 || $user->status === null): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User deactivate')): ?>
                                    <form action="<?php echo e(route('user.deactivate')); ?>" method="post" id="deactivateForm">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                        <button id="deactivate" style="margin-top: 5px;"
                                                class="btn btn-danger m-t-n-xs deactivate"
                                                rel="<?php echo e(route('user.deactivate')); ?>"><strong>Deactivate User</strong>
                                        </button>
                                        <button id="deactivateBtn" type="submit" style=" display:none;"
                                                class="btn btn-danger m-t-n-xs deactivate"
                                                rel="<?php echo e(route('user.deactivate')); ?>"><strong>Deactivate User</strong>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User activate')): ?>
                                    <form action="<?php echo e(route('user.activate')); ?>" method="post" id="activateForm">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                        <button id="activate" style="margin-top: 5px;"
                                                class="btn btn-primary m-t-n-xs activate"
                                                rel="<?php echo e(route('user.activate')); ?>"><strong>Activate User</strong>
                                        </button>
                                        <button id="activateBtn" type="submit" style=" display:none;"
                                                class="btn btn-primary m-t-n-xs activate"
                                                rel="<?php echo e(route('user.activate')); ?>"><strong>Activate User</strong>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>

                    </tr>
                    <tr>
                        

                        <td>

                        </td>

                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <div class="widget lazur-bg no-padding">
                    <div class="p-m">
                        <h1 class="m-xs">Rs. <?php echo e($user->wallet->balance); ?></h1>

                        <h3 class="font-bold no-margins">
                            Total balance in wallet
                        </h3>
                        <small>Money saved in d-paisa wallet</small>
                    </div>

                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs" role="tablist">
                        <li><a class="nav-link <?php if($activeTab == 'kyc'): ?> active <?php endif; ?>" data-toggle="tab" href="#kyc">
                                KYC</a></li>

                        <?php if($user->agent): ?>
                            <li><a class="nav-link <?php if($activeTab == 'agent'): ?> active <?php endif; ?>" data-toggle="tab"
                                   href="#agent"> Agent</a></li>
                        <?php endif; ?>

                        <?php if(isset($user->merchant)): ?>
                            <li><a class="nav-link <?php if($activeTab == 'companyInfo'): ?> active <?php endif; ?>" data-toggle="tab"
                                   href="#companyInfo"> Company Info</a></li>
                            <li><a class="nav-link <?php if($activeTab == 'bankDetails'): ?> active <?php endif; ?>" data-toggle="tab"
                                   href="#bankDetails">Bank Details</a></li>

                            <li><a class="nav-link <?php if($activeTab == 'commission'): ?> active <?php endif; ?>" data-toggle="tab"
                                   href="#commission">Commission | Cashback</a></li>

                        <?php endif; ?>

                        <li><a class="nav-link <?php if($activeTab == 'allAuditTrial'): ?> active <?php endif; ?>" data-toggle="tab"
                               href="#allAuditTrial">All Audit Trials</a></li>
                        <li><a class="nav-link <?php if($activeTab == 'userLoginHistoryAudit'): ?> active <?php endif; ?>"
                               data-toggle="tab" href="#userLoginHistoryAudit">User Login History Audit</a></li>
                        
                        <?php if((isset($user->userType) == true) && (isset($user->merchant) == false)): ?>
                            <li><a class="nav-link <?php if($activeTab == 'cardLoadCommission'): ?> active <?php endif; ?>"
                                   data-toggle="tab"
                                   href="#cardLoadCommission">Commission</a></li>
                            <li><a class="nav-link <?php if($activeTab == 'referralCode'): ?> active <?php endif; ?>" data-toggle="tab"
                                   href="#referralCode">Referral Code</a></li>
                            <li><a class="nav-link <?php if($activeTab == 'referralBonus'): ?> active <?php endif; ?>" data-toggle="tab"
                                   href="#referralBonus">Referral Bonus</a></li>
                            <li><a class="nav-link" data-toggle="tab" href="#limit">Limits</a></li>
                        <?php endif; ?>
                        <li><a class="nav-link" data-toggle="tab" href="#wallet">Wallet</a></li>
                        
                        <li><a id="vendorGraphTabButton" class="nav-link" data-toggle="tab" href="#vendorGraph">Vendor
                                Graph</a></li>
                        <li><a id="transactionGraphTabButton" class="nav-link" data-toggle="tab"
                               href="#transactionGraph">Transaction Graph</a></li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Send notification to user')): ?>
                            <li><a class="nav-link" data-toggle="tab" href="#notification">Notification</a></li>
                        <?php endif; ?>
                    </ul>
                    <div class="tab-content">
                        <?php echo $__env->make('admin.user.profile.tabs.kyc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php if($user->agent): ?>
                            <?php echo $__env->make('admin.user.profile.tabs.agent', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <?php if(isset($user->merchant)): ?>
                            <?php echo $__env->make('admin.merchant.profile.tabs.companyInfo', ['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('admin.merchant.profile.tabs.bankDetails', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php echo $__env->make('admin.merchant.profile.tabs.commission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.allAuditTrial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.userLoginHistoryAuditTrial', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                        <?php echo $__env->make('admin.user.profile.tabs.cardLoadCommission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.user.profile.tabs.referralCode', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.user.profile.tabs.referralBonus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.user.profile.tabs.limit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.user.profile.tabs.wallet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                        <?php echo $__env->make('admin.user.profile.tabs.vendorGraph', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.user.profile.tabs.transactionGraph', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Send notification to user')): ?>
                            <?php echo $__env->make('admin.user.profile.tabs.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>


    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link href="<?php echo e(asset('admin/css/plugins/iCheck/custom.css')); ?>" rel="stylesheet">
    <style>
        .kyc-btn {
            padding: 2px;
        }
    </style>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

    <!-- Sweet Alert -->
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>

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

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- iCheck -->
    <script src="<?php echo e(asset('admin/js/plugins/iCheck/icheck.min.js')); ?>"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

        let balance = <?php if(!empty($_GET['amount'])): ?> `<?php echo e($_GET['amount']); ?>`;
        <?php else: ?> '0;100000'; <?php endif; ?>
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


        let credit = <?php if(!empty($_GET['debit_range'])): ?> `<?php echo e($_GET['debit_range']); ?>`;
        <?php else: ?> '0;100000';
        <?php endif; ?>
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

        let amount = <?php if(!empty($_GET['amount'])): ?> `<?php echo e($_GET['amount']); ?>`;
        <?php else: ?> '0;100000';
        <?php endif; ?>
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

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-- ChartJS-->
    <script src="<?php echo e(asset('admin/js/plugins/chartJs/Chart.min.js')); ?>"></script>

    
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

<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('pageScripts'); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/user/profile.blade.php ENDPATH**/ ?>