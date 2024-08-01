<?php $__env->startSection('content'); ?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>User</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <?php echo $__env->make('admin.userFilter.user-filter',['title' => "User" ,'excelRoute' => "kyc.rejected.user.excel"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>List of Rejected KYC users</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Rejected Kyc Users">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Contact Number</th>
                                    
                                    <th>KYC status</th>
                                    <th>Wallet Balance</th>
                                    <th>User type</th>
                                    <th>Bonus Balance</th>
                                    
                                    
                                    
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $rejectedKycUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index + ($rejectedKycUsers->perPage() * ($rejectedKycUsers->currentPage() - 1)) + 1); ?></td>
                                        <td>
                                            
                                            <a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $user->id)); ?>" <?php endif; ?>><?php echo e($user->name); ?></a>
                                        </td>
                                        <td>
                                            <?php if(!empty($user->phone_verified_at)): ?>
                                                <i class="fa fa-check-circle" style="color: green;"></i>
                                                &nbsp;<?php echo e($user->mobile_no); ?>

                                            <?php else: ?>
                                                <i class="fa fa-times-circle" style="color: red;"></i>
                                                &nbsp;<?php echo e($user->mobile_no); ?>

                                            <?php endif; ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $__env->make('admin.user.kyc.status', ['kyc' => $user->kyc], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>
                                        <td>Rs. <?php echo e(optional($user->wallet)->balance); ?></td>
                                        <td>
                                            <?php echo $__env->make('admin.user.userType.displayUserTypes',['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>
                                        <td>Rs. <?php echo e(optional($user->wallet)->bonus_balance); ?></td>

                                        

                                        

                                        

                                        <td class="center">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?>
                                                <a style="margin-top: 5px;"
                                                   href="<?php echo e(route('user.profile', $user->id)); ?>"
                                                   class="btn btn-sm btn-icon btn-primary m-t-n-xs"
                                                   title="user profile"><i class="fa fa-eye"></i></a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User transactions')): ?>
                                                <a style="margin-top: 5px;"
                                                   href="<?php echo e(route('user.transaction', $user->id)); ?>"
                                                   class="btn btn-sm btn-icon btn-info m-t-n-xs"
                                                   title="user transactions"><i
                                                        class="fa fa-credit-card"></i></a>
                                            <?php endif; ?>

                                            <a style="margin-top: 5px;"
                                               href="<?php echo e(route('user.bank.accounts', $user->id)); ?>"
                                               class="btn btn-sm btn-icon btn-warning m-t-n-xs"
                                               title="user bank accounts"><i class="fa fa-bank"></i></a>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create user kyc')): ?>
                                                <?php if(empty($user->kyc)): ?>
                                                    <a style="margin-top: 5px;"
                                                       href="<?php echo e(route('user.createUserKyc',$user->id)); ?>"
                                                       class="btn btn-sm btn-icon btn-primary m-t-n-xs"
                                                       title="user profile"><i class="fa fa-plus"></i></a>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($rejectedKycUsers->appends(request()->query())->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>


    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function (e) {

            let a = "Showing <?php echo e($rejectedKycUsers->firstItem()); ?> to <?php echo e($rejectedKycUsers->lastItem()); ?> of <?php echo e($rejectedKycUsers->total()); ?> entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        let walletAmount = <?php if(!empty($_GET['wallet_balance'])): ?> `<?php echo e($_GET['wallet_balance']); ?>`;
        <?php else: ?> '0;100000'; <?php endif; ?>
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

        walletAmount = <?php if(!empty($_GET['transaction_payment'])): ?> `<?php echo e($_GET['transaction_payment']); ?>`;
        <?php else: ?> '0;100000';
        <?php endif; ?>
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

        walletAmount = <?php if(!empty($_GET['transaction_loaded'])): ?> `<?php echo e($_GET['transaction_loaded']); ?>`;
        <?php else: ?> '0;100000';
        <?php endif; ?>
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


        walletAmount = <?php if(!empty($_GET['transaction_number'])): ?> `<?php echo e($_GET['transaction_number']); ?>`;
        <?php else: ?> '0;1000';
        <?php endif; ?>
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






<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/user/rejectedKycUser.blade.php ENDPATH**/ ?>