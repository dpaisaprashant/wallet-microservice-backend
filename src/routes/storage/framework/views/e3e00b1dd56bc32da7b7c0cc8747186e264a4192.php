<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Service</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Wallet Service</strong>
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
                    <div class="ibox-title collapse-link">
                        <h5>Create Wallet Service</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">

                                <form method="post" action="<?php echo e(route('wallet.service.store')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Wallet Service</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="service"
                                                   placeholder="Wallet Service" required>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Micro Service URL</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="microservice_url"
                                                   placeholder="Micro Service URL" required>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Micro Service Process</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm" name="microservice_process"
                                                   placeholder="Micro Service Process">
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Wallet Transaction Type ID</label>
                                        <div class="col-sm-10">
                                            <select class="chosen-select" tabindex="2" name="wallet_transaction_type_id" required>
                                            <option value="" selected disabled>Select Wallet Transaction Type</option>
                                                <?php $__currentLoopData = $all_wallet_transaction_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$walletTransactionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($walletTransactionType->id); ?>"><p style="font-weight: bolder">Transaction Type&nbsp;&nbsp;:&nbsp;&nbsp;</p><?php echo e($walletTransactionType['transaction_type']); ?>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;User Type&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo e($walletTransactionType['user_type']); ?>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;MicroService&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo e($walletTransactionType['microservice']); ?>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Service&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo e($walletTransactionType['service'] == null ?'Null':$walletTransactionType['service']); ?>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Service Type&nbsp;&nbsp;:&nbsp;&nbsp;<?php echo e($walletTransactionType['service_type'] == null ? 'Null' : $walletTransactionType['service_type']); ?>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp; Special 1 : <?php echo e($walletTransactionType['special1'] == null ? 'Null' : $walletTransactionType['special1']); ?>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp; Special 2 : <?php echo e($walletTransactionType['special2'] == null ? 'Null' : $walletTransactionType['special2']); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Validate Payment</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Choose transaction status..."
                                                    class="chosen-select" tabindex="2" name="validate_payment" required>
                                                <option value="" selected disabled>Validate Payment</option>
                                                    <option value=1>Valid</option>
                                                    <option value=0>Invalid</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Handle Payment</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Choose transaction status..."
                                                    class="chosen-select" tabindex="2" name="handle_payment" required>
                                                <option value="" selected disabled>Handle Payment</option>
                                                    <option value=1>Handle</option>
                                                    <option value=0>Unhandle</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="hr-line-dashed"></div>


                                    <div class="form-group row">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Architecture/resources/views/WalletService/createWalletService.blade.php ENDPATH**/ ?>