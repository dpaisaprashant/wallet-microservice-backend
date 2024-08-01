<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Register Using Referral User Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong> Register Using Referral User Report</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title collapse-link">
                        <h5>Select Date</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-left: 10px;" formaction="<?php echo e(route('register-using-referral.excel')); ?>"><strong>Excel</strong></button>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('referral.registerUsingReferralUserReport')); ?>"><strong>Generate Report</strong></button>
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

                <?php if(!empty($_GET['referred_from']) || (!empty($_GET['from']) && !empty($_GET['to']))): ?>

                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Registered Using Referral report from <?php echo e($_GET['from'] . ' to ' . $_GET['to']); ?></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" title="<?php echo e("registered_using_referral_report_" . $_GET['from'] . '_to_' . $_GET['to']); ?>">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Referred From</th>
                                        <th>Referred From Earnings</th>
                                        <th>User Name</th>
                                        <th>Mobile No.</th>
                                        <th>KYC Status</th>
                                        <th>Transaction Count</th>
                                        <th>Total Balance</th>
                                        <th>Total Referral Amount</th>
                                        <th>Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $totalTransaction = 0; $totalAmount = 0; $totalReferralAmount = 0;?>
                                    <?php $__currentLoopData = $registerUsingReferralUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="gradeX">
                                            <td><?php echo e($loop->index + ($registerUsingReferralUsers->perPage() * ($registerUsingReferralUsers->currentPage() - 1)) + 1); ?></td>
                                            <td><?php echo e(optional($user->referredByUser())->name); ?></td>
                                            <td>
                                                <?php if(optional($user->registerReferral())->status == 'COMPLETE'): ?>
                                                    Rs. <?php echo e(optional($user->registerReferral())->referred_from_amount); ?>

                                                <?php else: ?>
                                                    Rs. 0
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo e($user->name); ?>

                                            </td>
                                            <td>
                                                <?php if(!empty($user->phone_verified_at)): ?>
                                                    <i class="fa fa-check-circle" style="color: green;"></i> &nbsp;<?php echo e($user->mobile_no); ?>

                                                <?php else: ?>
                                                    <i class="fa fa-times-circle" style="color: red;"></i>&nbsp;<?php echo e($user->mobile_no); ?>

                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php echo $__env->make('admin.user.kyc.status', ['kyc' => $user->kyc], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </td>

                                            <td>
                                                <?php echo e($user->totalTransactionCount()); ?>

                                            </td>
                                            <td>
                                                Rs. <?php echo e($user->wallet->balance / 100); ?>

                                            </td>
                                            <td>
                                                Rs. <?php echo e($user->totalReferralAmount()); ?>

                                            </td>
                                            <td>
                                                <?php echo e($user->created_at); ?>

                                            </td>
                                            <?php
                                            $totalTransaction = $totalTransaction + $user->totalTransactionCount();
                                            $totalAmount = $totalAmount +  $user->wallet->balance;
                                            $totalReferralAmount = $totalReferralAmount + $user->totalReferralAmount();
                                            ?>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total Transaction Count</b></td>
                                        <td><?php echo e($totalTransaction); ?></td>
                                        <td>Rs. <?php echo e($totalAmount / 100); ?></td>
                                        <td>Rs. <?php echo e($totalReferralAmount); ?></td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <?php echo e($registerUsingReferralUsers->appends(request()->query())->links()); ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>


    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>






<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Referral/resources/views/report/registerUsingReferralUserReport.blade.php ENDPATH**/ ?>