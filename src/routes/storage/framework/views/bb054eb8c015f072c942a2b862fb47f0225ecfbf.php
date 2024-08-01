<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Fund Transfer Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    Fund Transfer
                </li>
                <li class="breadcrumb-item active">
                    <strong>Detail</strong>
                </li>
            </ol>
        </div>
        
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>From:</h5>
                            <address>
                                <strong><?php echo e($transaction->fromUser['name']); ?></strong><br>
                                Email: <?php echo e($transaction->fromUser['email']); ?><br>
                                Number: <?php echo e($transaction->fromUser['mobile_no']); ?><br>
                            </address>


                            <span>To:</span>
                            <address>
                                <strong><?php echo e($transaction->toUser['name']); ?></strong><br>
                                Email: <?php echo e($transaction->toUser['email']); ?><br>
                                Number: <?php echo e($transaction->toUser['mobile_no']); ?><br>
                            </address>

                            <address>
                                <strong>Amount: Rs. <?php echo e($transaction->amount); ?><br></strong>
                                <strong>Commission: Rs. <?php echo e(optional($transaction->commission)['before_amount'] - optional($transaction->commission)['after_amount']); ?><br></strong>
                            </address>

                        </div>

                        <div class="col-sm-6 text-right">
                            <h4>Transaction ID.</h4>
                            <h4 class="text-navy">#<?php echo e($transaction->id); ?></h4>

                            <p style="margin-top: 20px;">
                                <?php
                                $date = explode(' ', $transaction->created_at);
                                ?>
                                <span><strong>Transaction Date:</strong> <?php echo e(date('d M, Y', strtotime($date[0]))); ?></span><br/>
                                <span><strong>Time:</strong> <?php echo e(date('h:i a', strtotime($date[1]))); ?></span><br><br>

                            </p>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/transaction/detail/userToUserFundTransferDetail.blade.php ENDPATH**/ ?>