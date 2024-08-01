<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Agent Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>User Activity Bonus Settings</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
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
                        <form method="post" enctype="multipart/form-data" id="agentForm">
                            <?php echo csrf_field(); ?>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On Registration Bonus Enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="user_activity_bonus_register_enabled">
                                        <?php if(!empty($settings['user_activity_bonus_register_enabled'])): ?>
                                            <option value=0 <?php if($settings['user_activity_bonus_register_enabled'] == 0): ?> selected <?php endif; ?>>FALSE</option>
                                            <option value=1 <?php if($settings['user_activity_bonus_register_enabled'] == 1): ?> selected <?php endif; ?>>TRUE</option>
                                        <?php else: ?>
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On registration Bonus Amount</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['user_activity_bonus_register_amount'] ?? ''); ?>" name="user_activity_bonus_register_amount" type="text" class="form-control">
                                    <small>**Amount should be in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On Kyc Accept Bonus Enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="user_activity_bonus_kyc_accept_enabled">
                                        <?php if(!empty($settings['user_activity_bonus_kyc_accept_enabled'])): ?>
                                            <option value=0 <?php if($settings['user_activity_bonus_kyc_accept_enabled'] == 0): ?> selected <?php endif; ?>>FALSE</option>
                                            <option value=1 <?php if($settings['user_activity_bonus_kyc_accept_enabled'] == 1): ?> selected <?php endif; ?>>TRUE</option>
                                        <?php else: ?>
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On Kyc Accept Bonus Amount</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['user_activity_bonus_kyc_accept_amount'] ?? ''); ?>" name="user_activity_bonus_kyc_accept_amount" type="text" class="form-control">
                                    <small>**Amount should be in paisa</small>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On Kyc Accept Start From Date</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['user_activity_bonus_kyc_accept_start_from_date'] ?? ''); ?>" name="user_activity_bonus_kyc_accept_start_from_date" type="text" class="form-control">
                                    <small>**English Date should be in format YYYY-MM-DD</small>
                                    <small>**Only users with phone verified at after this date will be eligible for bonus</small>
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">First Load Transaction Bonus Enabled</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="user_activity_bonus_first_load_transaction_enabled">
                                        <?php if(!empty($settings['user_activity_bonus_first_load_transaction_enabled'])): ?>
                                            <option value=0 <?php if($settings['user_activity_bonus_first_load_transaction_enabled'] == 0): ?> selected <?php endif; ?>>FALSE</option>
                                            <option value=1 <?php if($settings['user_activity_bonus_first_load_transaction_enabled'] == 1): ?> selected <?php endif; ?>>TRUE</option>
                                        <?php else: ?>
                                            <option value=0>FALSE</option>
                                            <option value=1>TRUE</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On First Load Transaction Bonus Amount</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['user_activity_bonus_first_load_transaction_amount'] ?? ''); ?>" name="user_activity_bonus_first_load_transaction_amount" type="text" class="form-control">
                                    <small>**Amount should be in paisa</small>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On First Load Transaction Bonus Min Amount</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['user_activity_bonus_first_load_transaction_min_amount'] ?? ''); ?>" name="user_activity_bonus_first_load_transaction_min_amount" type="text" class="form-control">
                                    <small>**Amount should be in paisa</small>
                                    <small>**The minimum amount the user should load to be eligible to get the bonus.</small>
                                </div>
                            </div>


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">On First Load Transaction Start From Date</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['user_activity_bonus_first_load_transaction_start_from_date'] ?? ''); ?>" name="user_activity_bonus_first_load_transaction_start_from_date" type="text" class="form-control">
                                    <small>**English Date should be in format YYYY-MM-DD</small>
                                    <small>**Only users with phone verified at after this date will be eligible for bonus</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('General setting update')): ?>
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.summernote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
   <?php echo $__env->make('admin.asset.js.summernote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
    <?php echo $__env->make('admin.asset.js.passwordToggle', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/userActivityBonusSetting.blade.php ENDPATH**/ ?>