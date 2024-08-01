<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>KYC Not Filled Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Users</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>KYC Not Filled Users</strong>
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
                        <h5>Filter Users</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" <?php if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ): ?> style="display: none"  <?php endif; ?>>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Enter User Name" class="form-control" value="<?php echo e(!empty($_GET['name']) ? $_GET['name'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <input type="text" name="number" placeholder="Enter Contact Number" class="form-control" value="<?php echo e(!empty($_GET['number']) ? $_GET['number'] : ''); ?>">
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <input type="email" name="email" placeholder="Enter Email" class="form-control" value="<?php echo e(!empty($_GET['email']) ? $_GET['email'] : ''); ?>">
                                        </div>

                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2" name="sort_by">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    <option value="latest_transaction">Latest Transaction</option>
                                                    <option value="transaction_number">Transaction Number</option>
                                                    <option value="transaction_payment">Transaction Payment</option>
                                                    <option value="transaction_loaded">Transaction Loaded</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-bottom: 15px;">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-bottom: 15px;">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Choose User Type..." class="chosen-select"  tabindex="2" name="user_type">
                                                    <option value=""  disabled>Sort By User Type</option>
                                                    <option value="" selected>All</option>
                                                    <?php if(!empty($_GET['user_type'])): ?>
                                                        <?php if($_GET['user_type'] == "normal_user"): ?>
                                                            <option value="normal_user" selected>Normal user</option>
                                                            <option value="agent">Agent</option>
                                                            <option value="merchant">Merchant</option>
                                                        <?php elseif($_GET['user_type'] == "agent"): ?>
                                                            <option value="normal_user">Normal user</option>
                                                            <option value="agent" selected>Agent</option>
                                                            <option value="merchant">Merchant</option>
                                                        <?php elseif($_GET['user_type'] == 'merchant'): ?>
                                                            <option value="normal_user">Normal user</option>
                                                            <option value="agent">Agent</option>
                                                            <option value="merchant" selected>Merchant</option>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <option value="normal_user">Normal user</option>
                                                        <option value="agent">Agent</option>
                                                        <option value="merchant">Merchant</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="transaction_number">Transaction Number</label>
                                            <input type="text" name="transaction_number" class="ionrange_number">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="wallet_balance">Wallet Balance</label>
                                            <input type="text" name="wallet_balance" class="ionrange_wallet_amount">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="transaction_amount">Transaction Payment</label>
                                            <input type="text" name="transaction_payment" class="ionrange_payment_amount">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="transaction_amount">Transaction Loaded</label>
                                            <input type="text" name="transaction_loaded" class="ionrange_loaded_amount">
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('user.kycNotFilled.view')); ?>"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="<?php echo e(route('kyc.notfilled.user.excel')); ?>"><strong>Excel</strong></button>
                                    </div>
                                    <?php echo $__env->make('admin.asset.components.clearFilterButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of KYC not filled users</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>s.No.</th>
                                    <th>User</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Wallet Balance</th>
                                    <th>No. of <br>Transactions</th>
                                    <th>Utility <br>Payment Sum</th>
                                    <th>Transaction <br>Loaded Sum</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index + ($users->perPage() * ($users->currentPage() - 1)) + 1); ?></td>
                                        <td>
                                            
                                            <a  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $user->id)); ?>" <?php endif; ?>><?php echo e($user->name); ?></a>
                                        </td>
                                        <td>
                                            <?php if(!empty($user->phone_verified_at)): ?>
                                                <i class="fa fa-check-circle" style="color: green;"></i> &nbsp;<?php echo e($user->mobile_no); ?>

                                            <?php else: ?>
                                                <i class="fa fa-times-circle" style="color: red;"></i>&nbsp;<?php echo e($user->mobile_no); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td class="center">
                                            <?php if(!empty($user->email_verified_at)): ?>
                                                <i class="fa fa-check-circle" style="color: green;"></i> &nbsp;<?php echo e($user->email); ?>

                                            <?php else: ?>
                                                <i class="fa fa-times-circle" style="color: red;"></i>&nbsp;<?php echo e($user->email); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $__env->make('admin.user.userType.displayUserTypes',['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>
                                        <td>Rs. <?php echo e($user->wallet->balance); ?></td>
                                        <td><?php echo e(count($user->userTransactionEvents)); ?></td>
                                        <td>Rs. <?php echo e($user->userTransactionEvents()->where('transaction_type', 'App\Models\UserTransaction')->sum('amount') / 100); ?></td>
                                        <td>Rs. <?php echo e($user->userTransactionEvents()->whereIn('transaction_type', [\App\Models\UserLoadTransaction::class, \App\Models\NchlLoadTransaction::class, \App\Models\NICAsiaCyberSourceLoadTransaction::class])->sum('amount') / 100); ?></td>

                                        <td class="center">

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?>
                                                <a style="margin-top: 5px;" href="<?php echo e(route('user.profile', $user->id)); ?>" class="btn btn-sm btn-icon btn-primary m-t-n-xs" title="user profile"><i class="fa fa-eye"></i></a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User transactions')): ?>
                                                <a style="margin-top: 5px;" href="<?php echo e(route('user.transaction', $user->id)); ?>" class="btn btn-sm btn-icon btn-info m-t-n-xs" title="user transactions"><i class="fa fa-credit-card"></i></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($users->appends(request()->query())->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(asset('admin/css/plugins/dataTables/datatables.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('admin/css/plugins/chosen/bootstrap-chosen.css')); ?>" rel="stylesheet">

    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style>
        .chosen-container-single .chosen-single{
            height: 35px !important;
            border-radius: 0px;
        }

        .chosen-container-single .chosen-single span{
            margin-top: 5px;
            margin-left: 5px;
        }

        .pagination{
            padding-top: -20px;
            padding-left: 15px;
            padding-bottom: 200px;
        }

        .dataTables_wrapper{
            padding-bottom: 5px;
        }
    </style>

    <!-- Sweet Alert -->
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>


    <!-- Chosen -->
    <script src="<?php echo e(asset('admin/js/plugins/chosen/chosen.jquery.js')); ?>"></script>

    <script>
        $('.chosen-select').chosen({width: "100%"});
    </script>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>

    <script>
        $('.deactivate').click(function () {

            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "This user's profile will be deactivated",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, deactivate user!",
                closeOnConfirm: false
            }, function () {
                //window.location.href="";
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'post',
                    url: url,
                    data:{
                        user: 1
                    },
                    success:function (resp) {
                        console.log(resp);
                        location.reload()
                    }, error:function (resp) {
                        console.log(resp);
                    }
                });

            })
        });
    </script>


    <script src="<?php echo e(asset('admin/js/plugins/dataTables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')); ?>"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                paging: false,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'KYC not filled users list'},
                    {extend: 'pdf', title: 'KYC not filled users list'},

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

    <script>
        $(document).ready(function (e) {

            let a = "Showing <?php echo e($users->firstItem()); ?> to <?php echo e($users->lastItem()); ?> of <?php echo e($users->total()); ?> entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

   <script>

        let walletAmount = <?php if(!empty($_GET['wallet_balance'])): ?> `<?php echo e($_GET['wallet_balance']); ?>`; <?php else: ?> '0;100000'; <?php endif; ?>
        let split = walletAmount.split(';');


        $(".ionrange_wallet_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = <?php if(!empty($_GET['transaction_payment'])): ?> `<?php echo e($_GET['transaction_payment']); ?>`; <?php else: ?> '0;100000'; <?php endif; ?>
            split = walletAmount.split(';');

        $(".ionrange_payment_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = <?php if(!empty($_GET['transaction_loaded'])): ?> `<?php echo e($_GET['transaction_loaded']); ?>`; <?php else: ?> '0;100000'; <?php endif; ?>
            split = walletAmount.split(';');

        $(".ionrange_loaded_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });


        walletAmount = <?php if(!empty($_GET['transaction_number'])): ?> `<?php echo e($_GET['transaction_number']); ?>`; <?php else: ?> '0;1000'; <?php endif; ?>
            split = walletAmount.split(';');

        $(".ionrange_number").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: split[0],
            to: split[1],
        });



    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/user/kycNotFilledView.blade.php ENDPATH**/ ?>