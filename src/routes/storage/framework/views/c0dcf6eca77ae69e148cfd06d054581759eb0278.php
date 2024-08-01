<div class="col-lg-3">
    <a href="<?php echo e(route('user.kycNotFilled.view')); ?>">
    <div class="ibox ">
        <div class="ibox-title" style="padding-right: 15px";>
            <span class="label label-danger float-right">Total</span>
            <h5>KYC Not Filled Users</h5>
        </div>
        <div class="ibox-content">
            <h1 class="no-margins"><?php echo e($kycNotFilledUserCount); ?></h1>
            <?php if(($kycFilledUserCount + $kycNotFilledUserCount != 0)): ?>
                <div class="stat-percent font-bold text-danger">
                    <?php echo e(round(($kycNotFilledUserCount / ($kycFilledUserCount + $kycNotFilledUserCount) ) * 100, 2)); ?>%
                    <i class="fa fa-bolt"></i>
                </div>
            <?php endif; ?>
            <small>Users who have not filled KYC form </small>
        </div>
    </div>
    </a>
</div>
<?php /**PATH /var/www/html/resources/views/admin/dashboard/widgets/totalKYCNotFilledUsers.blade.php ENDPATH**/ ?>