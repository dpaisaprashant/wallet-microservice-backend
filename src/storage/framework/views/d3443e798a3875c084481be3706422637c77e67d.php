<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content">
        
        <?php echo $__env->make('admin.dashboard.adminDashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <hr>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <!-- FooTable -->
    <link href="<?php echo e(asset('admin/css/plugins/footable/footable.core.css')); ?>" rel="stylesheet">
    <style>
        .apexcharts-menu-icon {
            display: none;
        }
    </style>

    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo e(asset('admin/js/inspinia.js')); ?> " ></script>
    <script src="<?php echo e(asset('admin/js/plugins/pace/pace.min.js')); ?> " ></script>

    <!-- jQuery UI -->
    <script src="<?php echo e(asset('admin/js/plugins/jquery-ui/jquery-ui.min.js')); ?> " ></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>








    <!-- FooTable -->
    <script src="<?php echo e(asset('admin/js/plugins/footable/footable.all.min.js')); ?>"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function() {

            $('.footable').footable();
            $('.footable2').footable();

        });
    </script>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>