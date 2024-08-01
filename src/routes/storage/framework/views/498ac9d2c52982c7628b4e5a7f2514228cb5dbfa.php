<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Notification Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a >Settings</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Notification Settings</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <form method="post" enctype="multipart/form-data" id="notificationForm">
            <?php echo csrf_field(); ?>
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

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Notification Service</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="notification_service">
                                        <option disabled selected> -- Select Notification Service --</option>
                                        <?php if(!empty($settings['notification_service'])): ?>
                                            <option value='FIREBASE' <?php if($settings['notification_service'] == 'FIREBASE'): ?> selected <?php endif; ?>>FIREBASE</option>
                                            <option value='ONE SIGNAL' <?php if($settings['notification_service'] == 'ONE SIGNAL'): ?> selected <?php endif; ?>>ONE SIGNAL</option>
                                        <?php else: ?>
                                            <option value='FIREBASE'>FIREBASE</option>
                                            <option value='ONE SIGNAL'>ONE SIGNAL</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                    </div>

                    <div class="ibox-content">

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">SMS Service Service</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="sms_service">
                                    <option disabled selected> -- Select SMS Service --</option>
                                    <?php if(!empty($settings['sms_service'])): ?>
                                        <option value='SPARROW SMS' <?php if($settings['sms_service'] == 'SPARROW SMS'): ?> selected <?php endif; ?>>Sparrow SMS</option>
                                        <option value='MIRACLE SMS' <?php if($settings['sms_service'] == 'MIRACLE SMS'): ?> selected <?php endif; ?>>Miracle SMS</option>
                                        <option value='AAKASH SMS' <?php if($settings['sms_service'] == 'AAKASH SMS'): ?> selected <?php endif; ?>>Aakash SMS</option>
                                    <?php else: ?>
                                        <option value='SPARROW SMS'>SPARROW SMS</option>
                                        <option value='MIRACLE SMS'>MIRACLE SMS</option>
                                        <option value='AAKASH SMS'>AAKASH SMS</option>
                                    <?php endif; ?>
                                </select>
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
            </div>
        </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/setting/notificationSetting.blade.php ENDPATH**/ ?>