<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend FAQ Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Frontend</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Frequently Asked Questions</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of all FAQs</h5>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend faq create')): ?>
                            <div class="ibox-tools" style="top: 8px;">
                                <a class="btn btn-primary" href="<?php echo e(route('frontend.faq.create')); ?>"> <i class="fa fa-plus-circle"></i> Add New FAQ</a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <?php if(strtolower(config('app.'.'name')) == "icash" || strtolower(config('app.'.'name')) == "master"): ?>
                                        <th>Question Type</th>
                                        <th>Icon</th>
                                    <?php endif; ?>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeC">
                                        <td><?php echo e($loop->index + 1); ?></td>
                                        <td><?php echo e($faq->question); ?></td>
                                        <td><?php echo e($faq->answer); ?></td>
                                        <?php if(strtolower(config('app.'.'name')) == "icash" || strtolower(config('app.'.'name')) == "master"): ?>
                                            <td><?php echo e($faq->question_type); ?></td>
                                            <td><?php echo e($faq->icon); ?></td>
                                        <?php endif; ?>
                                        <td><?php echo e($faq->created_at); ?></td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend faq update')): ?>
                                                <a href="<?php echo e(route('frontend.faq.update',$faq->id)); ?>"><button class="btn btn-info btn-icon" type="button"><i class="fa fa-edit"></i></button></a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend faq delete')): ?>
                                                    <form action="<?php echo e(route('frontend.faq.delete')); ?>" method="post" id="deactivateForm" style="display: inline">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?php echo e($faq->id); ?>">
                                                        <button id="deactivate" class="btn btn-danger btn-icon deactivate" rel="<?php echo e($faq->id); ?>"><i class="fa fa-trash"></i></button>
                                                        <button id="deactivateBtn-<?php echo e($faq->id); ?>" type="submit" style=" display:none;" rel="<?php echo e(route('frontend.faq.delete')); ?>"></button>
                                                    </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Sweet Alert -->
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>

    <script>
        $('.deactivate').on('click', function (e) {

            e.preventDefault();
            let id = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "This data will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ed5565",
                confirmButtonText: "Yes, delete!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                let deactivateButton = '#deactivateBtn-' + id;
                $(deactivateButton).trigger('click');
                swal.close();
            })
        });
    </script>


<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/frontend/faq/index.blade.php ENDPATH**/ ?>