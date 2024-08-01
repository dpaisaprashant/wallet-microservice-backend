'
<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Service</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Wallet Service</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">


        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        


        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        

        
        
        
        
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="ibox-title">
                    <h5>List of wallet service</h5>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add wallet service')): ?>
                            <div class="ibox-tools" style="top: 8px;">
                                <a href="<?php echo e(route('wallet.service.create')); ?>">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add
                                        Wallet Service
                                    </button>
                                </a>
                            </div>
                    <?php endif; ?>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example"
                               title="Wallet Service List">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Service</th>
                                <th>Micro Service URL</th>
                                <th>Micro Service Process</th>
                                <th>Wallet Transaction Type </th>
                                <th>Payment Validated</th>
                                <th>Payment Handeled</th>
                                <th>Actions</th>

                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="gradeX">
                                    <td><?php echo e($loop->index + ($services->perPage() * ($services->currentPage() - 1)) + 1); ?></td>
                                    <td>
                                        &nbsp;<?php echo e($service->service); ?>

                                    </td>
                                    <td><?php echo e($service->core_to_microservice_url); ?></td>
                                    <td><?php echo e($service->microservice_process ?? '-'); ?></td>
                                    <td><?php echo e(optional($service->walletTransactionType)->transaction_type); ?></td>
                                    <td>
                                        <?php if($service->validate_payment == 1): ?>
                                            <span class="badge badge-primary">Valid</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Invalid</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($service->handle_payment == 1): ?>
                                            <span class="badge badge-primary">Handeled</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Unhandeled</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="-align-center">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit wallet service')): ?>
                                            <a style="margin-right: 5px; display: inline; height: 3px;width: 3px"
                                               href="<?php echo e(route('wallet.service.edit', $service->id)); ?>"
                                                   class="btn btn-sm btn-primary m-t-n-xs"
                                                   title="user profile">
                                                <i class="fa fa-pencil"></i>
                                            </a>


                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete wallet service')): ?>
                                                <form action="<?php echo e(route('wallet.service.delete',$service->id)); ?>" method="post" style="display: inline">
                                                    <?php echo csrf_field(); ?>
                                                    <input id="resetValue" type="hidden" name="admin_id" value="<?php echo e($service->id); ?>">
                                                    <button href="<?php echo e(route('backendUser.role', $service->id)); ?>" class="reset btn btn-sm btn-danger m-t-n-xs" rel="<?php echo e($service->id); ?>"><i class="fa fa-trash"></i></button>
                                                    <button id="resetBtn-<?php echo e($service->id); ?>" style="display: none" type="submit" href="<?php echo e(route('backendUser.role', $service->id)); ?>"  class="resetBtn btn btn-sm btn-danger m-t-n-xs"><i class="fa fa-trash"></i></button>
                                                </form>
                                            <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                        <?php echo e($services->appends(request()->query())->links()); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>


    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

    <?php echo $__env->make('admin.asset.css.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "Wallet service will be deleted'",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete service",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($services->firstItem()); ?> to <?php echo e($services->lastItem()); ?> of <?php echo e($services->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Architecture/resources/views/WalletService/viewWalletService.blade.php ENDPATH**/ ?>