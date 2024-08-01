<div class="col-lg-3">
    <div class="ibox ">
        <div class="ibox-title" style="padding-right: 15px;">
            <span class="label label-primary float-right">Total</span>
            <h5>KYC Filled Users</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins"><?php echo e($kycFilledUserCount); ?></h1>
            <?php if(($kycFilledUserCount + $kycNotFilledUserCount) != 0): ?>
                <div class="stat-percent font-bold text-navy"><?php echo e(round(($kycFilledUserCount / ($kycFilledUserCount + $kycNotFilledUserCount) ) * 100, 2)); ?>% <i class="fa fa-bolt"></i></div>
            <?php endif; ?>
            <small>Users who have filled KYC form</small>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/admin/dashboard/widgets/totalKYCFilledUsers.blade.php ENDPATH**/ ?>