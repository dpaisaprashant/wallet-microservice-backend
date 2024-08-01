<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Transaction Types</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong><?php echo e($vendorName); ?> Vendor Transaction Types</strong>
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
                        <h5>Filter Transaction Type</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content"
                         <?php if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ): ?> style="display: none" <?php endif; ?>>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Enter User Name"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['name']) ? $_GET['name'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="number" placeholder="Enter Contact Number"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['number']) ? $_GET['number'] : ''); ?>">
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <input type="email" name="email" placeholder="Enter Email"
                                                   class="form-control"
                                                   value="<?php echo e(!empty($_GET['email']) ? $_GET['email'] : ''); ?>">
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="sort">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    <?php if(!empty($_GET['sort'])): ?>
                                                        <option value="wallet_balance"
                                                                <?php if($_GET['sort']  == 'wallet_balance'): ?> selected <?php endif; ?> >
                                                            Wallet Balance
                                                        </option>
                                                        <option value="transaction_number"
                                                                <?php if($_GET['sort'] == 'transaction_number'): ?> selected <?php endif; ?>>
                                                            Transaction Number
                                                        </option>
                                                        <option value="transaction_payment"
                                                                <?php if($_GET['sort'] == 'transaction_payment'): ?> selected <?php endif; ?>>
                                                            Transaction Payment
                                                        </option>
                                                        <option value="transaction_loaded"
                                                                <?php if($_GET['sort'] == 'transaction_loaded'): ?> selected <?php endif; ?>>
                                                            Transaction Loaded
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="wallet_balance">Wallet Balance</option>
                                                        <option value="transaction_number">Transaction Number</option>
                                                        <option value="transaction_payment">Transaction Payment</option>
                                                        <option value="transaction_loaded">Transaction Loaded</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="<?php echo e(route('architecture.vendor.transaction', $vendorName)); ?>">
                                            <strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="<?php echo e(route('architecture.excel.vendor.transaction',$vendorName)); ?>"><strong>Excel</strong></button>
                                    </div>

                                    <div>
                                    </div>
                                    <?php echo $__env->make('admin.asset.components.clearFilterButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of registered users</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Wallet user's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User Type</th>
                                    <th>Vendor</th>
                                    <?php if($vendorName == "BFI"): ?>
                                        <th>BFI Name</th>
                                    <?php endif; ?>
                                    <th>Transaction Category</th>
                                    <th>Service Type</th>
                                    <th>Service</th>
                                    <th>Service Enabled</th>
                                    <th>Payment Type</th>
                                    <th>Specials</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $walletTransactionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transactionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index + 1); ?></td>
                                        <td>
                                            <?php if($transactionType->user_type == \App\Models\User::class): ?>
                                                User
                                            <?php elseif($transactionType->user_type == \App\Models\Merchant\Merchant::class): ?>
                                                Merchant
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo e($transactionType->vendor); ?>

                                            <?php if($vendorName == "BFI"): ?>
                                                <?php if($transactionType->special1 == null): ?>
                                                    <span class="badge badge-danger"></span>
                                                <?php else: ?>
                                                    <span class="badge badge-success"> <?php echo e($transactionType->special1); ?></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <?php if($vendorName == "BFI"): ?>
                                            <?php if($transactionType->special2 == null): ?>
                                            <td>  </td>
                                            <?php else: ?>
                                                <td> <span class="badge badge-success"><?php echo e($transactionType->special2); ?></span></td>
                                                <?php endif; ?>
                                        <?php endif; ?>
                                        <td>
                                            <?php echo e($transactionType->transaction_category); ?>

                                        </td>
                                        <td>
                                            <?php echo e($transactionType->service_type); ?>

                                        </td>
                                        <td>
                                            <?php echo e($transactionType->service); ?>

                                        </td>
                                        <td>
                                            <?php if($transactionType->service_enabled == 1): ?>
                                                <span class="badge badge-success">Enabled</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger">Disabled</span>
                                            <?php endif; ?>
                                        </td>

                                        <td><?php echo e($transactionType->payment_type); ?></td>
                                        <td><?php echo e($transactionType->special1); ?> <?php if($transactionType->special1): ?> | <?php echo e($transactionType->special2); ?> <?php endif; ?></td>
                                        <td class="center">
                                            <a style="margin-top: 5px;"
                                               href="<?php echo e(route('architecture.transaction.cashback', $transactionType->id)); ?>"
                                               class="btn btn-sm btn-success m-t-n-xs" title="Transaction Cashbacks"><i
                                                    class="fa fa-refresh"></i> Transaction Cashback</a>
                                            <a style="margin-top: 5px;"
                                               href="<?php echo e(route('architecture.transaction.commission', $transactionType->id)); ?>"
                                               class="btn btn-sm btn-info m-t-n-xs" title="Transaction Commissions"><i
                                                    class="fa fa-dollar"></i> Transaction Commission</a>
                                            <br>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add cashback to single user')): ?>
                                                <a style="margin-top: 5px;"
                                                   href="<?php echo e(route('architecture.user.cashback', $transactionType->id)); ?>"
                                                   class="btn btn-sm btn-success m-t-n-xs" title="User Cashbacks"><i
                                                        class="fa fa-refresh"></i> User Cashback</a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add commission to single user')): ?>
                                                <a style="margin-top: 5px;"
                                                   href="<?php echo e(route('architecture.user.commission', $transactionType->id)); ?>"
                                                   class="btn btn-sm btn-info m-t-n-xs" title="User Commissions"><i
                                                        class="fa fa-dollar"></i> User Commission</a>
                                            <?php endif; ?>
                                            <a style="margin-top: 5px;"
                                               href="<?php echo e(route('walletBonus.index', $transactionType->id)); ?>"
                                               class="btn btn-sm btn-warning m-t-n-xs" title="User Commissions"><i
                                                    class="fa fa-dollar"></i>&nbsp;Bonus</a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Add merchant revenue')): ?>
                                                <a style="margin-top: 5px;"
                                                   href="<?php echo e(route('architecture.wallet.merchantRevenue', $transactionType->id)); ?>"
                                                   class="btn btn-sm btn-info m-t-n-xs" title="User Commissions"><i
                                                        class="fa fa-dollar"></i> Merchant Revenue</a>
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






<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Architecture/resources/views/walletTransactionTypes.blade.php ENDPATH**/ ?>