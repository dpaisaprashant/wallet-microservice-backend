<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Blocked IPs</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Blocked IPs</strong>
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
                        <h5>List of Blocked IPs</h5>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add blocked ip')): ?>
                            <a href="<?php echo e(route('blockedip.create')); ?>" class="btn btn-sm btn-primary btn-xs"
                               style="float: right;margin-top: -5px;">Block an IP</a>
                        <?php endif; ?>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>IP</th>
                                    <th>Description</th>
                                    <th>Blocked At</th>
                                    <th>Blocked Until</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $blockedIPs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$blockedIP): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> <?php echo e($key+1); ?></td>
                                        <td> <?php echo e($blockedIP->ip); ?></td>
                                        <td> <?php echo e($blockedIP->description); ?></td>
                                        <td> <?php echo e($blockedIP->blocked_at); ?></td>
                                        <td> <?php echo e($blockedIP->block_duration); ?></td>
                                        <td> <?php echo e($blockedIP->status); ?></td>                                        
                                        <td class="center">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete blocked ip')): ?>                                           
                                            <form action="<?php echo e(route('blockedip.delete',$blockedIP->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <button                                                    
                                                    class="reset btn btn-sm btn-danger m-t-n-xs"
                                                    rel="<?php echo e($blockedIP->id); ?>"><i
                                                        class="fa fa-trash"></i>
                                                </button>              

                                                <button id="resetBtn-<?php echo e($blockedIP->id); ?>"
                                                    style="display: none" type="submit"
                                                    href="<?php echo e(route('blockedip.delete',$blockedIP->id)); ?>"
                                                    class="resetBtn btn btn-sm btn-danger m-t-n-xs">
                                                <i class="fa fa-trash"></i></button>     
                                                   
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit blocked ip')): ?>                                            
                                                <a href="<?php echo e(route('blockedip.edit',$blockedIP->id)); ?>" class="btn btn-success btn-sm m-t-n-xs"><i class="fa fa-edit"></i></a>                                            
                                                <?php endif; ?>                                                              
                                            </form>                    
                                                              
                                            <?php endif; ?>
                                            
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <?php echo e($blockedIPs->appends(request()->query())->links()); ?>

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
            let blockedIP_Id = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "Blocked IP will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + blockedIP_Id).trigger('click');
                swal.close();

            })
        });
    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/WalletIP/resources/views/viewBlockedIP.blade.php ENDPATH**/ ?>