<?php $__env->startSection('content'); ?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Merchants</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-success float-right">Valid</span>
                        <h5>Valid KYC Merchant Count</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo e($stats['validMerchantCount']); ?></h1>
                        <small>Number of merchant with valid KYC</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-danger float-right">Invalid</span>
                        <h5>Invalid KYC Merchant Count</h5>
                    </div>
                    <div class="ibox-content">
                        
                        <small>Number of merchant with invalid KYC</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-info float-right">Count</span>
                        <h5>Number of merchant transaction</h5>
                    </div>
                    <div class="ibox-content">
                        
                        <small>Number of successful merchant transaction</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-primary float-right">Sum</span>
                        <h5>Sum of merchant transaction</h5>
                    </div>
                    <div class="ibox-content">
                        
                        <small>Sum of merchant transaction amount</small>
                    </div>
                </div>
            </div>

        </div>




































































































































































































































































































































































        <?php echo $__env->make('admin.userFilter.user-filter',['title' => "Merchant",'excelRoute'=>"merchant.excel"], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of registered merchants</h5>
                        <a href="<?php echo e(route('merchant.update.view')); ?>" class="btn btn-sm btn-primary btn-xs"
                           style="float: right;margin-top: -5px;">Update Merchant Type</a>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Merchant's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Merchant</th>
                                    <th>Contact Number</th>
                                    
                                    <th>KYC status</th>
                                    <th>Wallet Balance</th>
                                    <th>Merchant Type</th>
                                    
                                    
                                    
                                    
                                    
                                    
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index + ($merchants->perPage() * ($merchants->currentPage() - 1)) + 1); ?></td>
                                        <td>

                                            <a href="<?php echo e(route('user.profile', $merchant->id)); ?>"><?php echo e($merchant->name); ?></a>
                                        </td>
                                        <td>

                                            <?php if(!empty($merchant->phone_verified_at)): ?>
                                                <i class="fa fa-check-circle" style="color: green;"></i>
                                                &nbsp;<?php echo e($merchant->mobile_no); ?>

                                            <?php else: ?>
                                                <i class="fa fa-times-circle" style="color: red;"></i>
                                                &nbsp;<?php echo e($merchant->mobile_no); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php echo $__env->make('admin.merchant.kyc.status', ['kyc' => $merchant->kyc], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        </td>
                                        <td>Rs. <?php echo e($merchant->wallet->balance); ?></td>
                                        
                                        

                                        

                                        


                                        

                                        
                                        <td><?php echo $__env->make('admin.user.userType.displayUserTypes',['user'=>$merchant], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></td>

                                        <td class="center">

                                            <?php if(optional(optional($merchant->merchant)->merchantType)->name == "reseller"): ?>
                                                <?php echo $__env->make('admin.merchant.viewMerchantResellerCredentials',['id'=>optional($merchant->merchant)->id,'merchant' => $merchant], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endif; ?>
                                    
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User KYC view')): ?>
                                                <a style="margin-top: 5px;" href="<?php echo e(route('user.kyc', $merchant->id)); ?>"
                                                   class="btn btn-sm btn-icon btn-primary m-t-n-xs" title="Verify Merchant KYC"><i class="fa fa-file"></i></a>
                                            <?php endif; ?>

                                            <a style="margin-top: 5px" href="<?php echo e(route('user.profile', $merchant->id)); ?>"
                                               class="btn btn-sm btn-icon btn-warning m-t-n-xs"
                                               title="Merchant Profile"><i class="fa fa-user"></i></a>
                                            <?php if(optional(optional($merchant->merchant)->merchantType)->name == "reseller"): ?>
                                                <?php echo $__env->make('admin.merchant.viewMerchantResellerCredentials',['id'=>optional($merchant->merchant)->id,'merchant' => $merchant], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            <?php endif; ?>

                                            
                                            
                                            
                                            
                                            
                                            
                                            

                                            
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create user kyc')): ?>

                                                <?php if(empty($merchant->kyc)): ?>
                                                    <a style="margin-top: 5px;"
                                                       href="<?php echo e(route('user.createUserKyc',$merchant->id)); ?>"
                                                       class="btn btn-sm btn-icon btn-primary m-t-n-xs"
                                                       title="user profile"><i class="fa fa-plus"></i></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                                <a style="margin-top: 5px;" target="_blank"
                                                   href="<?php echo e(route('merchant.download.qr',$merchant->id)); ?>"
                                                   class="btn btn-sm btn-icon btn-secondary m-t-n-xs"
                                                   title="download qr"><i class="fa fa-qrcode"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($merchants->appends(request()->query())->links()); ?>

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

            let a = "Showing <?php echo e($merchants->firstItem()); ?> to <?php echo e($merchants->lastItem()); ?> of <?php echo e($merchants->total()); ?> entries";

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






<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/merchant/view.blade.php ENDPATH**/ ?>