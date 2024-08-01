<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend Banner Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Frontend</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Banner Settings</strong>
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
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo e(route('frontend.banner.create')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="title" type="text"
                                           class="form-control" required>
                                </div>
                            </div>

                            <input type="text" name="belongs_to" value="<?php echo e(strtolower(config('app.'.'name'))); ?>" hidden>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="image" id="logo1" type="file" class="custom-file-input" required>
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                    <?php if(!empty($banner->image)): ?>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="<?php echo e(asset('storage/uploads/frontend/' . $banner->image)); ?>"
                                                     alt="First slide">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Mobile Image</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="mobile_image" id="logo1" type="file" class="custom-file-input" required>
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                    <?php if(!empty($banner->mobile_image)): ?>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="<?php echo e(asset('storage/uploads/frontend/' . $banner->mobile_image)); ?>"
                                                     alt="First slide">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <hr class="hr-line-dashed">

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script>
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/frontend/banner/create.blade.php ENDPATH**/ ?>