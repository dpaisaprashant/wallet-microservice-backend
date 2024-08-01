<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>PayPoint Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>PayPoint Settings</strong>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="<?php echo e(route('settings.paypoint')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Settings</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">PayPoint Service enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="paypoint_service_enable">
                                        <?php if(!empty($settings['paypoint_service_enable'])): ?>
                                            <option value=0 <?php if($settings['paypoint_service_enable'] == 0): ?> selected <?php endif; ?>>FALSE</option>
                                            <option value=1 <?php if($settings['paypoint_service_enable'] == 1): ?> selected <?php endif; ?>>TRUE</option>
                                        <?php else: ?>
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">PayPoint Base URL</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['pp_base_url'] ?? ''); ?>" name="pp_base_url" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">PayPoint User ID</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['pp_userId'] ?? ''); ?>" name="pp_userId" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">PayPoint User Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="pp_userPassword" value="<?php echo e($settings['pp_userPassword'] ?? ''); ?>" name="pp_userPassword" type="text" class="form-control">
                                        <span class="input-group-append">
                                        <button type="button" rel="pp_userPassword" class="btn btn-white toggle-password"><i class="fa fa-eye passwordIcon"></i></button>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">SalePoint Type</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['pp_salePointType'] ?? ''); ?>" name="pp_salePointType" type="text" class="form-control">
                                </div>
                            </div>

                                <div class="hr-line-dashed"></div>

                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Paypoint setting update')): ?>
                                            <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
   <?php echo $__env->make('admin.asset.css.summernote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style>
        select {
            height: 35.6px !important;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.summernote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.passwordToggle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/paypointSetting.blade.php ENDPATH**/ ?>