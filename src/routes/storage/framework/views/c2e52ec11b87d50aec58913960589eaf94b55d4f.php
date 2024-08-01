<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Load For Paypoint</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Load for Paypoint</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Load for Paypoint</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Select User</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo e(route('loadTestFund.create')); ?>" enctype="multipart/form-data" id="loadForPayppointForm">
                            <?php echo csrf_field(); ?>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">User</label>
                                <div class="col-sm-10">
                                    <input name="user" value="<?php echo e($user->name . " ({$user->mobile_no})"); ?>" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Amount in Rs.</label>
                                <div class="col-sm-10">
                                    <input name="amount" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <button id="handleBtn" class="btn btn-sm btn-primary m-t-n-xs" type="submit" formaction="<?php echo e(route('paypoint.loadTestFund.create')); ?>"><strong>Create</strong></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Sweet Alert -->
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>

    <script>
        /*$('form').on('submit', function (e) {

            e.preventDefault();
            let formObj = $(this);

            swal({
                title: "Are you sure?",
                text: "Amount will be loaded to this user's wallet",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, approve",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                console.log(formObj)
                formObj.submit()
            })
        });*/
    </script>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/loadTestTransaction/paypoint/create.blade.php ENDPATH**/ ?>