<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NCHL Load Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>NCHL Load Settings</strong>
                </li>

            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form method="post" enctype="multipart/form-data" action="<?php echo e(route('settings.nchl.load')); ?>">
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
                                <label class="col-sm-2 col-form-label">NCHL Load Base URL</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['nchl_load_base_url'] ?? ''); ?>" name="nchl_load_base_url" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NCHL Load Merchant ID</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['nchl_load_merchant_id'] ?? ''); ?>" name="nchl_load_merchant_id" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NCHL App ID</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['nchl_load_app_id'] ?? ''); ?>" name="nchl_load_app_id" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">NCHL App Name</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['nchl_load_app_name'] ?? ''); ?>" name="nchl_load_app_name" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Client Password</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input id="pp_userPassword" value="<?php echo e($settings['nchl_load_client_password'] ?? ''); ?>" name="nchl_load_client_password" type="text" class="form-control">
                                        <span class="input-group-append">
                                        <button type="button" rel="pp_userPassword" class="btn btn-white toggle-password"><i class="fa fa-eye passwordIcon"></i></button>
                                    </span>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>


                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
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
    <?php echo $__env->make('admin.asset.js.passwordToggle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/nchl/loadTransactionSetting.blade.php ENDPATH**/ ?>