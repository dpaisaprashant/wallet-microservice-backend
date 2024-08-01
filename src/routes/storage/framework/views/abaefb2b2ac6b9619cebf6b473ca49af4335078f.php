<h2 style="margin-top: -5px; margin-left: 5px;">Admin Dashboard</h2>
<div class="row">








    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Dashboard total KYC not filled users')): ?>
        <?php echo $__env->make('admin.dashboard.widgets.totalKYCNotFilledUsers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Dashboard total KYC filled users')): ?>
        <?php echo $__env->make('admin.dashboard.widgets.totalKYCFilledUsers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Dashboard total KYC accepted by backend user count')): ?>
        <?php echo $__env->make('admin.dashboard.widgets.acceptedKYCByBackendUserCount', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Dashboard total KYC rejected by backend user count')): ?>
        <?php echo $__env->make('admin.dashboard.widgets.rejectedKYCByBackendUserCount', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>








</div>





































<?php /**PATH /var/www/html/resources/views/admin/dashboard/adminDashboard.blade.php ENDPATH**/ ?>