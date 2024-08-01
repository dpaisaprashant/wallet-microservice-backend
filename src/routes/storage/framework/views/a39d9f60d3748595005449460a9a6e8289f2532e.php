<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend Service Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Frontend</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Update Service - <?php echo e($service->title); ?></strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Update Service - <?php echo e($service->title); ?></h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo e(route('frontend.service.update', $service->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="title" type="text"
                                           value="<?php echo e($service->title); ?>" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Icon</label>
                                <div class="col-sm-10">
                                    <input name="icon" type="text"
                                           value="<?php echo e($service->icon); ?>" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Placement</label>
                                <div class="col-sm-10">
                                    <select name="placement" class="form-control" required>
                                        <option value="" disabled selected>Select Placement</option>
                                        <?php if($service->placement == "top"): ?>
                                            <option value="top" selected>Top</option>
                                            <option value="bottom">Bottom</option>
                                        <?php else: ?>
                                            <option value="top">Top</option>
                                            <option value="bottom" selected>Bottom</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <hr class="hr-line-dashed">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input value="<?php echo e($service->image); ?>" name="image" id="logo1" type="file" class="custom-file-input">
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                    <?php if(!empty($service->image)): ?>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="<?php echo e(config('dpaisa-api-url.public_document_url') . $service->image); ?>"
                                                     alt="First slide">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <hr class="hr-line-dashed">


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control">
                                        <?php echo $service->description; ?>

                                    </textarea>
                                </div>
                            </div>

                            <hr class="hr-line-dashed">

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Update changes</button>
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
    <?php echo $__env->make('admin.asset.css.icheck', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.icheck', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/frontend/service/update.blade.php ENDPATH**/ ?>