<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>User Wallet Transaction Types Cashbacks</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('architecture.vendor.transaction', $walletTransactionType->vendor)); ?>">Wallet Transaction Type</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Cashback</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Wallet Transaction Type</h5>
                    </div>
                    <div class="ibox-content">
                        <h3>
                            <span class="font-bold">User Type:
                            </span> <?php if($walletTransactionType->user_type == \App\Models\User::class): ?>
                                User
                            <?php elseif($walletTransactionType->user_type == \App\Models\Merchant\Merchant::class): ?>
                                Merchant
                            <?php endif; ?>

                        | <span class="font-bold">Vendor: </span> <?php echo e($walletTransactionType->vendor); ?>

                        | <span class="font-bold">Transaction Category: </span> <?php echo e($walletTransactionType->transaction_category); ?>

                        | <span class="font-bold">Service Type: </span> <?php echo e($walletTransactionType->service_type); ?>

                        <?php if(isset($walletTransactionType->service)): ?>
                        | <span class="font-bold">Service: </span> <?php echo e($walletTransactionType->service); ?></h3>
                        <?php endif; ?>
                        | <span class="font-bold">Special 1: </span><?php echo e($walletTransactionType->special1 != null ? $walletTransactionType->special1 : ''); ?>

                        |
                        <span class="font-bold">Special 2: </span><?php echo e($walletTransactionType->special2 != null ? $walletTransactionType->special2 : ''); ?>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Cashbacks</h5>
                        <div class="ibox-tools" style="top: 8px;">
                            <a href="<?php echo e(route('architecture.user.cashback.create', $walletTransactionType->id)); ?>"><button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Create New Cashback</button></a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>User Type</th>
                                    <th>User</th>
                                    <th>Slab From</th>
                                    <th>Slab To</th>
                                    <th>Cashback Service</th>
                                    <th>Cashback Type</th>
                                    <th>Cashback Value</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $walletTransactionType->singleUserCashbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cashback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index + 1); ?></td>
                                        <td>
                                            <?php echo e($cashback->title); ?>

                                        </td>
                                        <td>
                                            <?php echo e($cashback->user_type); ?>

                                        </td>
                                        <td>
                                            <?php echo e($cashback->userCashbackable->name . "(" . $cashback->userCashbackable->mobile_no .")"); ?>

                                        </td>
                                        <td>
                                            <?php if(isset($cashback->slab_from)): ?>
                                                Rs. <?php echo e($cashback->slab_from / 100); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(isset($cashback->slab_to)): ?>
                                                Rs. <?php echo e($cashback->slab_to / 100); ?>

                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($cashback->description ?? "Normal Cashback"); ?>

                                        </td>

                                        <td><?php echo e($cashback->cashback_type); ?></td>

                                        <td>
                                            <?php if($cashback->cashback_type == 'FLAT'): ?>
                                                Rs. <?php echo e($cashback->cashback_value / 100); ?>

                                            <?php else: ?>
                                                <?php echo e($cashback->cashback_value); ?>

                                            <?php endif; ?>
                                        </td>

                                        <td class="center">
                                            
                                            <form action="<?php echo e(route('architecture.user.cashback.delete')); ?>" method="post" id="deactivateForm" style="display: inline">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="id" value="<?php echo e($cashback->id); ?>">
                                                <button class="btn btn-danger btn-icon deactivate" rel="<?php echo e($cashback->id); ?>"><i class="fa fa-trash"></i></button>
                                                <button id="deactivateBtn-<?php echo e($cashback->id); ?>" type="submit" style=" display:none;"  rel="<?php echo e(route('architecture.user.cashback.delete')); ?>"></button>
                                            </form>
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

    <style>
        h3 {
            font-weight: normal;
        }
    </style>

    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>


    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $('.deactivate').on('click', function (e) {

            e.preventDefault();
            let id = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "This cashback will be deleted",
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






<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Architecture/resources/views/cashback/user/index.blade.php ENDPATH**/ ?>