<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend Contact Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Frontend</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Contact Settings</strong>
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
                        <form method="post" action="<?php echo e(route('frontend.contact')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <input type="text" name="belongs_to" value="<?php echo e(strtolower(config('app.'.'name'))); ?>" hidden>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Logo</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="logo" id="logo1" type="file" class="custom-file-input">
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                    <?php if(!empty($contact->logo)): ?>
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="<?php echo e(config('dpaisa-api-url.public_document_url') . $contact->logo); ?>"
                                                     alt="First slide">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>



                            <hr class="hr-line-dashed">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Contact Number</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($contact->number ?? ''); ?>" name="number" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($contact->email ?? ''); ?>" name="email" type="email"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($contact->address ?? ''); ?>" name="address" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <hr class="hr-line-dashed">
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Facebook</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($contact->facebook ?? ''); ?>" name="facebook" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Linked In</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($contact->linkedin ?? ''); ?>" name="linkedin" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Twitter</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($contact->twitter ?? ''); ?>" name="twitter" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Instagram</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($contact->instagram ?? ''); ?>" name="instagram" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <hr class="hr-line-dashed">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Latitude</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($contact->latitude ?? ''); ?>" name="latitude" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Longitude</label>
                                <div class="col-sm-10">
                                    <input value="<?php echo e($contact->longitude ?? ''); ?>" name="longitude" type="text"
                                           class="form-control">
                                </div>
                            </div>
                            <hr class="hr-line-dashed">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend contact create')): ?>
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


<?php $__env->startSection('scripts'); ?>
    <script>
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/frontend/contact/index.blade.php ENDPATH**/ ?>