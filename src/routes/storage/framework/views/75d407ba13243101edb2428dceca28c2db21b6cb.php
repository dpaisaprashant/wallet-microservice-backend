<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content">
        
        <h2 style="margin-top: -5px; margin-left: 5px;">SMS Dashboard</h2>
        <div class="row">
                <div class="col-lg-3">
                    <div class="ibox ">
                        <div class="ibox-title" style="padding-right: 15px;">
                            <span class="label label-success float-right">Total</span>
                            <h5>SMS Sent</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo e($smsCount); ?></h1>
                            <small>Number of SMS sent </small>
                        </div>
                    </div>
                </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/sparrow/detail.blade.php ENDPATH**/ ?>