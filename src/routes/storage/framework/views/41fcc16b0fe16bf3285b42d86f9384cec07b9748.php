<?php $__env->startSection('content'); ?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Permission Transaction</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Wallet Permission Transaction</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">


        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        


        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        

        
        
        
        
        

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>List of wallet permission transaction type users</h5>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add wallet permission transaction type')): ?>
                            <div class="ibox-tools" style="top: 8px;">
                                <a href="<?php echo e(route('wallet.permission.transaction.type.create')); ?>">
                                    <button class="btn btn-primary" type="button"><i class="fa fa-plus"></i> Add
                                        Wallet Permission Transaction
                                    </button>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Wallet user's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User type id</th>
                                    <th>User type</th>
                                    <th>Wallet tranasction type id</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $walletPermissionTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$walletPermissionTransaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>

                                        <?php if($walletPermissionTransaction->user_type == 'App\Models\UserType'): ?>
                                            <?php $__currentLoopData = $userTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$userType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($userType->id == $walletPermissionTransaction->user_type_id): ?>
                                                    <td><span class="badge badge-inverse"><?php echo e($userType->name); ?></span>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php elseif($walletPermissionTransaction->user_type == 'App\Models\Merchant\MerchantType'): ?>
                                            <?php $__currentLoopData = $merchantTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$merchantType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($merchantType->id == $walletPermissionTransaction->user_type_id): ?>
                                                    <td><span class="badge badge-success"><?php echo e($merchantType->name); ?></span>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php elseif($walletPermissionTransaction->user_type == 'App\Models\AgentType'): ?>
                                            <?php $__currentLoopData = $agentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$agentType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($agentType->id == $walletPermissionTransaction->user_type_id): ?>
                                                    <td><span class="badge badge-primary"><?php echo e($agentType->name); ?></span>
                                                    </td>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>

                                        <?php if($walletPermissionTransaction->user_type == 'App\Models\AgentType'): ?>
                                            <td><span class="badge badge-primary">Agent Type</span></td>
                                        <?php elseif($walletPermissionTransaction->user_type == 'App\Models\Merchant\MerchantType'): ?>
                                            <td><span class="badge badge-success">Merchant Type</span></td>
                                        <?php elseif($walletPermissionTransaction->user_type == 'App\Models\UserType'): ?>
                                            <td><span class="badge badge-inverse">User Type</span></td>
                                        <?php endif; ?>

                                        <?php $__currentLoopData = $transactionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$transactionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($walletPermissionTransaction->wallet_transaction_type_id == $transactionType->id): ?>
                                                <td><span
                                                        class="badge badge-pill">TransactionType : <?php echo e($transactionType->transaction_type); ?></span>
                                                    <span
                                                        class="badge badge-pill">Service : <?php echo e($transactionType->service == null ? 'Null' : $transactionType->service); ?></span>
                                                    <span
                                                        class="badge badge-pill">Service Type : <?php echo e($transactionType->service_type); ?></span>
                                                    <span
                                                        class="badge badge-pill">Micro service : <?php echo e($transactionType->microservice); ?></span>
                                                </td>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <td>
                                            <form
                                                action="<?php echo e(route('wallet.permission.transaction.type.delete',$walletPermissionTransaction->id)); ?>"
                                                method="post">
                                                <?php echo csrf_field(); ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete wallet permission transaction type')): ?>
                                                    <button
                                                        href="<?php echo e(route('wallet.permission.transaction.type.delete',$walletPermissionTransaction->id)); ?>"
                                                        class="reset btn btn-sm btn-danger m-t-n-xs"
                                                        rel="<?php echo e($walletPermissionTransaction->id); ?>"><i
                                                            class="fa fa-trash"></i>
                                                    </button>

                                                    <button id="resetBtn-<?php echo e($walletPermissionTransaction->id); ?>"
                                                            style="display: none" type="submit"
                                                            href="<?php echo e(route('wallet.permission.transaction.type.delete',$walletPermissionTransaction->id)); ?>"
                                                            class="resetBtn btn btn-sm btn-danger m-t-n-xs">
                                                        <i class="fa fa-trash"></i></button>
                                                <?php endif; ?>
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
                text: "Wallet permission transaction will be deleted",
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

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Architecture/resources/views/WalletPermissionTransaction/viewWalletPermissionTransaction.blade.php ENDPATH**/ ?>