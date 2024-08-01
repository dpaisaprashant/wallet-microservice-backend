<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Transaction Types</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Edit Wallet Transaction Types</strong>
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
                        <h5>Create Wallet Transaction Type</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">

                                <form method="post" action="<?php echo e(route('wallet.transaction.type.update',$singleWalletTransaction->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Transaction Type</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Choose transaction status..."
                                                    class="chosen-select" tabindex="2" name="transaction_type">
                                                <option value="" selected disabled>Transaction Type</option>
                                                <?php $__currentLoopData = $transactionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$transactionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>" <?php echo e($singleWalletTransaction->transaction_type == $key ? "selected" : ""); ?>><?php echo e($transactionType); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">User type</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="User type..."
                                                    class="chosen-select" tabindex="2" name="user_type">
                                                <option value="" selected disabled>User Type</option>
                                                <?php $__currentLoopData = $userTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$userType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>" <?php echo e($singleWalletTransaction->user_type == $key ? "selected" : ""); ?>><?php echo e($userType); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Vendor</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="vendor"
                                                   placeholder="Vendor" value="<?php echo e($singleWalletTransaction->vendor); ?>">
                                        </div>
                                    </div>


                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Transaction Category</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Choose transaction category..."
                                                    class="chosen-select" tabindex="2" name="transaction_category">
                                                <option value="" selected disabled>Transaction Category</option>
                                                    <option value="PAYMENT" <?php echo e($singleWalletTransaction->transaction_category == "PAYMENT" ? "selected" : ""); ?>>Payment</option>
                                                    <option value="LOAD" <?php echo e($singleWalletTransaction->transaction_category == "LOAD" ? "selected" : ""); ?>>Load</option>
                                                    <option value="BANK_TRANSFER" <?php echo e($singleWalletTransaction->transaction_category == "BANK_TRANSFER" ? "selected" : ""); ?>>Bank Transfer</option>
                                                    <option value="FUND_TRANSFER" <?php echo e($singleWalletTransaction->transaction_category == "FUND_TRANSFER" ? "selected" : ""); ?>>Fund Transfer</option>
                                                    <option value="FUND_REQUEST" <?php echo e($singleWalletTransaction->transaction_category == "FUND_REQUEST" ? "selected" : ""); ?>>Fund Request</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Service
                                            type</label>
                                        <div class="col-lg-10 col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="service_type"
                                                   placeholder="Service type" value="<?php echo e($singleWalletTransaction->service_type); ?>">
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Service</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="service"
                                                   placeholder="Service" value="<?php echo e($singleWalletTransaction->service); ?>">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Service
                                            Enabled</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Service Enabled"
                                                    class="chosen-select" tabindex="2" name="service_enabled">

                                                <option value="" selected disabled>Service Enabled</option>
                                                    <option value="Enabled" <?php echo e($singleWalletTransaction->service_enabled == 1 ? "selected" : ""); ?>>Enabled</option>
                                                    <option value="Disabled" <?php echo e($singleWalletTransaction->service_enabled == 0 ? "selected" : ""); ?>>Disabled</option>
                                            </select></div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Validate
                                            balance</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Validate balance"
                                                    class="chosen-select" tabindex="2" name="validate_balance">
                                                <option value="" selected disabled>Validate balance</option>

                                                    <option value="True" <?php echo e($singleWalletTransaction->validate_balance == 1 ? "selected" : ""); ?>>True</option>
                                                    <option value="False" <?php echo e($singleWalletTransaction->validate_balance == 0 ? "selected" : ""); ?>>False</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Validate
                                            Kyc </label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Validate kyc"
                                                    class="chosen-select" tabindex="2" name="validate_kyc">
                                                <option value="" selected disabled>Validate Kyc</option>
                                                    <option value="True" <?php echo e($singleWalletTransaction->validate_kyc == 1 ? "selected" : ""); ?>>True</option>
                                                    <option value="False" <?php echo e($singleWalletTransaction->validate_kyc == 0 ? "selected" : ""); ?>>False</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Validate
                                            limit</label>

                                        <div class="col-sm-10">
                                            <select data-placeholder="Validate limit"
                                                    class="chosen-select" tabindex="2" name="validate_limit">
                                                <option value="" selected disabled>Validate limit</option>
                                                    <option value="True" <?php echo e($singleWalletTransaction->validate_limit == 1 ? "selected" : ""); ?>>True</option>
                                                    <option value="False" <?php echo e($singleWalletTransaction->validate_limit == 0 ? "selected" : ""); ?>>False</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Limit
                                            type</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Limit type"
                                                    class="chosen-select" tabindex="2" name="limit_type">
                                                <option value="" selected disabled>Limit Type</option>
                                                    <option value="PAYMENT" <?php echo e($singleWalletTransaction->limit_type == "PAYMENT" ? "selected" : ""); ?>>Payment</option>
                                                    <option value="LOAD" <?php echo e($singleWalletTransaction->limit_type == "LOAD" ? "selected" : ""); ?>>Load</option>
                                                    <option value="BANK_TRANSFER" <?php echo e($singleWalletTransaction->limit_type == "BANK_TRANSFER" ? "selected" : ""); ?>>Bank Transfer</option>
                                                    <option value="TRANSFER" <?php echo e($singleWalletTransaction->limit_type == "TRANSFER" ? "selected" : ""); ?>>Transfer</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Micro
                                            service</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm"
                                                   placeholder="MicroService" name="microservice" value="<?php echo e($singleWalletTransaction->microservice); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Payment
                                            type</label>

                                        <div class="col-sm-10">
                                            <select data-placeholder="Payment Type"
                                                    class="chosen-select" tabindex="2" name="payment_type">
                                                <option value="" selected disabled>Payment type</option>
                                                    <option value="debit" <?php echo e($singleWalletTransaction->payment_type == "debit" ? "selected" : ""); ?>>Debit</option>
                                                    <option value="credit" <?php echo e($singleWalletTransaction->payment_type == "credit" ? "selected" : ""); ?>>Credit</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>


                                    <div class="form-group row">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary btn-sm" type="submit">Update</button>
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

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Architecture/resources/views/TransactionType/editTransactionType.blade.php ENDPATH**/ ?>