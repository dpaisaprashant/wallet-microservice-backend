<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NPS Repost</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a >Repost</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>NPS Repost</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <form target="_blank" method="get" enctype="multipart/form-data" action="<?php echo e($url); ?>">
                    <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Delivery Urls</h5>
                    </div>
                    <div class="ibox-content">
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Merchant Transaction Id</label>
                                <div class="col-sm-10">
                                    <input name="MerchantTxnId" type="text" class="form-control">
                                </div>
                            </div>

                        <div class="form-group  row">
                            <label class="col-sm-2 col-form-label">Gateway Ref No.</label>
                            <div class="col-sm-10">
                                <input name="GatewayTxnId" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Repost Transaction</button>
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
    <?php echo $__env->make('admin.asset.js.summernote', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/repost/nps.blade.php ENDPATH**/ ?>