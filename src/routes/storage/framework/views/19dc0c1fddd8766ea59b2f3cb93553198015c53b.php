<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Notification</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Notifications</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Create new notification</h5>
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
                        <form method="post" enctype="multipart/form-data" action="<?php echo e(route('notification.create')); ?>" >
                            <?php echo csrf_field(); ?>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Title</label>

                                <div class="col-sm-10">
                                    <input name="title" type="text" class="form-control" required></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row"><label class="col-sm-2 col-form-label"> Topics (Groups)<br/></label>

                                <div class="col-sm-10">
                                    <?php $__currentLoopData = $allTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" value="<?php echo e($topic); ?>" name="topics[]">
                                                <i></i> <?php echo e(ucfirst(str_replace('_', ' ', $topic))); ?>

                                            </label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                                    <div class="form-group row"> <label class="col-sm-2 col-form-label">Select Districts</label>
                                        <div class="col-lg-10 col-sm-10">
                                        <select class="select2_demo_2 form-control" multiple="multiple" name="district_topics[]">
                                            <?php $__currentLoopData = $allDistrictTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $districtTopic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($districtTopic); ?>"><?php echo e($districtTopic); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        </div>
                                    </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Message</label>
                                <div class="col-lg-10 col-sm-10">
                                    <div class="ibox ">

                                        <div class="ibox-content no-padding">

                                            <textarea name="message" required style="width: 100%">


                                            </textarea>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Image</label>

                                <div class="col-sm-10">

                                    <div class="custom-file">
                                        <input name="image" id="logo1" type="file" class="custom-file-input">
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>













                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Send Notification</button>
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
    <?php echo $__env->make('admin.asset.css.select2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link href="<?php echo e(asset('admin/css/plugins/iCheck/custom.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
   <?php echo $__env->make('admin.asset.js.summernote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <?php echo $__env->make('admin.asset.js.select2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <script src="<?php echo e(asset('admin/js/plugins/iCheck/icheck.min.js')); ?>"></script>
   <script>
       $(document).ready(function () {
           $('.i-checks').iCheck({
               checkboxClass: 'icheckbox_square-green',
               radioClass: 'iradio_square-green',
           });
       });
   </script>


    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/notification/create.blade.php ENDPATH**/ ?>