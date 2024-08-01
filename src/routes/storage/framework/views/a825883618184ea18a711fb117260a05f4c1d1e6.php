<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Transaction Types</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Wallet Transaction Types</strong>
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

                                <form method="post" action="<?php echo e(route('wallet.transaction.type.store')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Transaction Type</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Choose transaction status..."
                                                    class="chosen-select" tabindex="2" name="transaction_type">
                                                <option value="" selected disabled>Transaction Type</option>
                                                <?php $__currentLoopData = $transactionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$transactionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>"><?php echo e($transactionType); ?></option>
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
                                                    <option value="<?php echo e($key); ?>"><?php echo e($userType); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Vendor</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="vendor"
                                                   placeholder="Vendor">
                                        </div>
                                    </div>


                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Transaction Category</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Choose transaction category..."
                                                    class="chosen-select" tabindex="2" name="transaction_category">
                                                <option value="" selected disabled>Transaction Category</option>
                                                <?php if(!empty($_GET['transaction_category'])): ?>
                                                    <option value="PAYMENT"
                                                            <?php if($_GET['transaction_category']  == 'PAYMENT'): ?> selected <?php endif; ?> >
                                                        Payment
                                                    </option>
                                                    <option value="LOAD"
                                                            <?php if($_GET['transaction_category']  == 'LOAD'): ?> selected <?php endif; ?> >
                                                        Load
                                                    </option>
                                                    <option value="BANK_TRANSFER"
                                                            <?php if($_GET['transaction_category']  == 'BANK_TRANSFER'): ?> selected <?php endif; ?> >
                                                        Bank Transfer
                                                    </option>
                                                    <option value="FUND_TRANSFER"
                                                            <?php if($_GET['transaction_category']  == 'FUND_TRANSFER'): ?> selected <?php endif; ?> >
                                                        Fund Transfer
                                                    </option>
                                                    <option value="FUND_REQUEST"
                                                            <?php if($_GET['transaction_category']  == 'FUND_REQUEST'): ?> selected <?php endif; ?> >
                                                        Fund Request
                                                    </option>

                                                <?php else: ?>
                                                    <option value="PAYMENT">Payment</option>
                                                    <option value="LOAD">Load</option>
                                                    <option value="BANK_TRANSFER">Bank Transfer</option>
                                                    <option value="FUND_TRANSFER">Fund Transfer</option>
                                                    <option value="FUND_REQUEST">Fund Request</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Service
                                            type</label>
                                        <div class="col-lg-10 col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="service_type"
                                                   placeholder="Service type">
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Service</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="service"
                                                   placeholder="Service">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Service
                                            Enabled</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Service Enabled"
                                                    class="chosen-select" tabindex="2" name="service_enabled">
                                                <option value="" selected disabled>Service Enabled</option>
                                                <?php if(!empty($_GET['service_enabled'])): ?>
                                                    <option value="wallet_balance"
                                                            <?php if($_GET['service_enabled']  == 'Enabled'): ?> selected <?php endif; ?> >
                                                        Enabled
                                                    </option>
                                                    <option value="transaction_number"
                                                            <?php if($_GET['service_enabled'] == 'Disabled'): ?> selected <?php endif; ?>>
                                                        Disabled
                                                    </option>
                                                <?php else: ?>
                                                    <option value="Enabled">Enabled</option>
                                                    <option value="Disabled">Disabled</option>
                                                <?php endif; ?>
                                            </select></div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Validate
                                            balance</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Validate balance"
                                                    class="chosen-select" tabindex="2" name="validate_balance">
                                                <option value="" selected disabled>Validate balance</option>
                                                <?php if(!empty($_GET['validate_balance'])): ?>
                                                    <option value="True"
                                                            <?php if($_GET['validate_balance']  == 'True'): ?> selected <?php endif; ?> >
                                                        True
                                                    </option>
                                                    <option value="False"
                                                            <?php if($_GET['validate_balance'] == 'False'): ?> selected <?php endif; ?>>
                                                        False
                                                    </option>
                                                <?php else: ?>
                                                    <option value="True">True</option>
                                                    <option value="False">False</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Validate
                                            Kyc </label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Validate kyc"
                                                    class="chosen-select" tabindex="2" name="validate_kyc">
                                                <option value="" selected disabled>Validate Kyc</option>
                                                <?php if(!empty($_GET['validate_kyc'])): ?>
                                                    <option value="True"
                                                            <?php if($_GET['validate_kyc']  == 'True'): ?> selected <?php endif; ?> >
                                                        True
                                                    </option>
                                                    <option value="False"
                                                            <?php if($_GET['validate_kyc'] == 'False'): ?> selected <?php endif; ?>>
                                                        False
                                                    </option>
                                                <?php else: ?>
                                                    <option value="True">True</option>
                                                    <option value="False">False</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Validate
                                            limit</label>

                                        <div class="col-sm-10">
                                            <select data-placeholder="Validate limit"
                                                    class="chosen-select" tabindex="2" name="validate_limit">
                                                <option value="" selected disabled>Validate limit</option>
                                                <?php if(!empty($_GET['validate_limit'])): ?>
                                                    <option value="True"
                                                            <?php if($_GET['validate_limit']  == 'True'): ?> selected <?php endif; ?> >
                                                        True
                                                    </option>
                                                    <option value="False"
                                                            <?php if($_GET['validate_limit'] == 'False'): ?> selected <?php endif; ?>>
                                                        False
                                                    </option>
                                                <?php else: ?>
                                                    <option value="True">True</option>
                                                    <option value="False">False</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Limit
                                            type</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Limit type"
                                                    class="chosen-select" tabindex="2" name="limit_type">
                                                <option value="" selected disabled>Limit Type</option>
                                                <?php if(!empty($_GET['limit_type'])): ?>
                                                    <option value="PAYMENT"
                                                            <?php if($_GET['limit_type']  == 'PAYMENT'): ?> selected <?php endif; ?> >
                                                        Payment
                                                    </option>
                                                    <option value="LOAD"
                                                            <?php if($_GET['limit_type']  == 'LOAD'): ?> selected <?php endif; ?> >
                                                        Load
                                                    </option>
                                                    <option value="BANK_TRANSFER"
                                                            <?php if($_GET['limit_type']  == 'BANK_TRANSFER'): ?> selected <?php endif; ?> >
                                                        Bank Transfer
                                                    </option>
                                                    <option value="TRANSFER"
                                                            <?php if($_GET['limit_type']  == 'TRANSFER'): ?> selected <?php endif; ?> >
                                                        Transfer
                                                    </option>

                                                <?php else: ?>
                                                    <option value="PAYMENT">Payment</option>
                                                    <option value="LOAD">Load</option>
                                                    <option value="BANK_TRANSFER">Bank Transfer</option>
                                                    <option value="TRANSFER">Transfer</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Micro
                                            service</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm"
                                                   placeholder="MicroService" name="microservice">
                                        </div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Payment
                                            type</label>

                                        <div class="col-sm-10">
                                            <select data-placeholder="Payment Type"
                                                    class="chosen-select" tabindex="2" name="payment_type">
                                                <option value="" selected disabled>Payment type</option>
                                                <?php if(!empty($_GET['payment_type'])): ?>
                                                    <option value="debit"
                                                            <?php if($_GET['payment_type']  == 'debit'): ?> selected <?php endif; ?> >
                                                        Debit
                                                    </option>
                                                    <option value="credit"
                                                            <?php if($_GET['payment_type'] == 'credit'): ?> selected <?php endif; ?>>
                                                        Credit
                                                    </option>
                                                <?php else: ?>
                                                    <option value="debit">Debit</option>
                                                    <option value="credit">Credit</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Special1</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm"
                                                   placeholder="special1" name="special1">
                                        </div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Special2</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm"
                                                   placeholder="special2" name="special2">
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

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Architecture/resources/views/TransactionType/createTransactionType.blade.php ENDPATH**/ ?>