<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>BFI Merchant View</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>BFI Merchant</strong>
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
                        <h5>List of BFI Merchants</h5>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add BFI Merchant')): ?>
                            <a href="<?php echo e(route('bfi.create')); ?>" class="btn btn-sm btn-primary btn-xs"
                               style="float: right;margin-top: -5px;">Add BFI Merchant</a>
                        <?php endif; ?>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Merchant Name</th>
                                    <th>BFI Name</th>
                                    <th>Merchant type</th>
                                    <th>Merchant Mobile Number</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $merchantBFIs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$merchantBFI): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> <?php echo e($key+1); ?></td>
                                        <td> <?php echo e($merchantBFI->merchant->name); ?></td>
                                        <td> <?php echo e($merchantBFI->bfiUser->bfi_name); ?></td>
                                        <td><span
                                                class="badge badge-success"> <?php echo e($merchantBFI->merchant->merchantType->name); ?> </span>
                                        </td>
                                        <td> <?php echo e($merchantBFI->merchant->mobile_no); ?></td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete BFI Merchant')): ?>
                                            <form
                                                action=" <?php echo e(route('bfi.delete',$merchantBFI->id)); ?>"
                                                method="post">
                                                <?php echo csrf_field(); ?>
                                                <button
                                                    href="<?php echo e(route('bfi.delete',$merchantBFI->id)); ?>"
                                                    class="reset btn btn-sm btn-danger m-t-n-xs"
                                                    rel="<?php echo e($merchantBFI->id); ?>"><i
                                                        class="fa fa-trash"></i>
                                                </button>

                                                <button id="resetBtn-<?php echo e($merchantBFI->id); ?>"
                                                        style="display: none" type="submit"
                                                        href="{ route('bfi.delete',$merchantBFI->id) }}"
                                                        class="resetBtn btn btn-sm btn-danger m-t-n-xs">
                                                    <i class="fa fa-trash"></i></button>
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
    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Page-Level Scripts -->
    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "BFI Merchant will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>

    
    

    

    
    
    
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/BFIMerchant/resources/views/viewBfiMerchant.blade.php ENDPATH**/ ?>