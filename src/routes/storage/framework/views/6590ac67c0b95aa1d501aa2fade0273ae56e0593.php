<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Transaction Types</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Wallet Transaction Types</strong>
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
                    <h5>List of registered users</h5>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add wallet transaction type')): ?>
                        <a href="<?php echo e(route('wallet.transaction.type.create')); ?>"
                           class="btn btn-primary btn-sm float-right">Add
                            Wallet Transaction</a>
                    <?php endif; ?>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example"
                               title="Wallet user's list">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Transaction type</th>
                                <th>User type</th>
                                <th>Vendor</th>
                                <th>Transaction category</th>
                                <th>Service type</th>
                                <th>Service</th>
                                <th>Service enabled</th>
                                <th>Validate balance</th>
                                <th>Validate kyc</th>
                                <th>Validate limit</th>
                                <th>Limit type</th>
                                <th>Micro service</th>
                                <th>Payment type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $walletTransactionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$walletTransactionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key+1); ?></td>
                                    <td><?php echo e($walletTransactionType->transaction_type); ?></td>
                                    <td><?php echo e($walletTransactionType->user_type); ?></td>
                                    <td><?php echo e($walletTransactionType->vendor); ?></td>
                                    <td><?php echo e($walletTransactionType->transaction_category); ?></td>
                                    <td>
                                        <?php if(!empty($walletTransactionType->service_type)): ?>
                                            <?php echo e($walletTransactionType->service_type); ?>

                                        <?php else: ?>
                                            <span class="badge badge-danger">Null</span>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <?php if(!empty($walletTransactionType->service)): ?>
                                            <?php echo e($walletTransactionType->service); ?>

                                        <?php else: ?>
                                            <span class="badge badge-danger">Null</span>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <?php if($walletTransactionType->service_enabled == 1): ?>
                                            <span class="badge badge-primary">True</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">False</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($walletTransactionType->validate_balance == 1): ?>
                                            <span class="badge badge-primary">True</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">False</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($walletTransactionType->validate_kyc == 1): ?>
                                            <span class="badge badge-primary">True</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">False</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($walletTransactionType->validate_limit == 1): ?>
                                            <span class="badge badge-primary">True</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">False</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(!empty($walletTransactionType->limit_type)): ?>
                                            <?php echo e($walletTransactionType->limit_type); ?>

                                        <?php else: ?>
                                            <span class="badge badge-danger">Null</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo e($walletTransactionType->microservice); ?>

                                    </td>
                                    <td>
                                        <?php if($walletTransactionType->payment_type == 'debit'): ?>
                                            <span class="badge badge-primary">Debit</span>
                                        <?php else: ?>
                                            <span class="badge badge-danger">Credit</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit wallet transaction type')): ?>
                                        <a href="<?php echo e(route('wallet.transaction.type.edit',$walletTransactionType->id)); ?>"
                                           class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                        <?php endif; ?>
                                            <form action=" <?php echo e(route('wallet.transaction.type.delete',$walletTransactionType->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                        <button
                                           class="btn btn-sm btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('styles'); ?>


    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Architecture/resources/views/TransactionType/viewTransactionType.blade.php ENDPATH**/ ?>