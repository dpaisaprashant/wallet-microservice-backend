<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>General Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>General Settings</strong>
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
                        <form method="post" action="<?php echo e(route('settings.general')); ?>" enctype="multipart/form-data"
                              id="notificationForm">
                            <?php echo csrf_field(); ?>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Maintenance mode</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="maintenance_mode">
                                        <?php if(!empty($settings['maintenance_mode'])): ?>
                                            <option value="ON"
                                                    <?php if($settings['maintenance_mode'] == 'ON'): ?> selected <?php endif; ?>>ON
                                            </option>
                                            <option value="OFF"
                                                    <?php if($settings['maintenance_mode'] == 'OFF'): ?> selected <?php endif; ?>>OFF
                                            </option>
                                        <?php else: ?>
                                            <option value="ON">ON</option>
                                            <option value="OFF" selected>OFF</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Login attempts to Lock User</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['lock_user_login_attempt'] ?? ''); ?>" name="lock_user_login_attempt" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Deactivate inactive user in</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="deactivate_inactive_user_duration">
                                        <option value="" selected disabled>Not Set</option>
                                        <?php if(!empty($settings['deactivate_inactive_user_duration'])): ?>
                                            <option value="1"
                                                    <?php if($settings['deactivate_inactive_user_duration'] == '1'): ?> selected <?php endif; ?>>1 Months
                                            </option>
                                            <option value="3"
                                                    <?php if($settings['deactivate_inactive_user_duration'] == '3'): ?> selected <?php endif; ?>>3 Months
                                            </option>
                                            <option value="6"
                                                    <?php if($settings['deactivate_inactive_user_duration'] == '6'): ?> selected <?php endif; ?>>6 Months
                                            </option>
                                            <option value="9"
                                                    <?php if($settings['deactivate_inactive_user_duration'] == '9'): ?> selected <?php endif; ?>>9 Months
                                            </option>
                                            <option value="12"
                                                    <?php if($settings['deactivate_inactive_user_duration'] == '12'): ?> selected <?php endif; ?>>12 Months
                                            </option>
                                        <?php else: ?>
                                            <option value="1">1 Months</option>
                                            <option value="3">3 Months</option>
                                            <option value="6">6 Months</option>
                                            <option value="9">9 Months</option>
                                            <option value="12">12 Months</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Site Title</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['site_title'] ?? ''); ?>" name="site_title" type="text"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Site Description</label>
                                <div class="col-lg-10 col-sm-10">
                                    <div class="ibox ">
                                        <div class="ibox-content no-padding">
                                            <textarea name="general_description" class="summernote"
                                                      style="display: none; height: 100px;">
                                                <?php echo $settings['general_description'] ?? ''; ?>

                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Site Logo</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="site_logo" id="logo1" type="file" class="custom-file-input">
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                    <?php if(!empty($settings['site_logo'])): ?>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="<?php echo e(asset('storage/img/settings/' . $settings['site_logo'])); ?>"
                                                     alt="First slide">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Fav Icon</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="favicon" id="favicon" type="file" class="custom-file-input">
                                        <label for="favicon" class="custom-file-label">Choose file...</label>
                                    </div>
                                    <?php if(!empty($settings['favicon'])): ?>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="<?php echo e(asset('storage/img/settings/' . $settings['favicon'])); ?>"
                                                     alt="First slide">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['general_address'] ?? ''); ?>" name="general_address"
                                           type="text" class="form-control"></div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Email Address</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['general_email'] ?? ''); ?>" name="general_email"
                                           type="email" class="form-control"></div>
                            </div>


                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Contact Number</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['general_number'] ?? ''); ?>" name="general_number"
                                           type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Facebook</label>

                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['facebook'] ?? ''); ?>" name="facebook" type="text"
                                           class="form-control">
                                </div>
                            </div>


                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Linkedin</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['linkedin'] ?? ''); ?>" name="linkedin" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Latitude</label>

                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['latitude'] ?? ''); ?>" name="latitude" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Longitude</label>

                                <div class="col-sm-10">
                                    <input value="<?php echo e($settings['longitude'] ?? ''); ?>" name="longitude" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('General setting update')): ?>
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    </div>
                                </div>
                            <?php endif; ?>
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
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/generalSetting.blade.php ENDPATH**/ ?>