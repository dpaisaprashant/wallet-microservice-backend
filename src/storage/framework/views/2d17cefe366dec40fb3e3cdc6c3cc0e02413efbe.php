       
<?php $__env->startSection('content'); ?>

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>All</strong>
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
                    <div class="ibox-title collapse-link">
                        <h5>Filter Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="<?php echo e(route('transaction.complete')); ?>" id="filter">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="uid" placeholder="User Transaction ID"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['uid']) ? $_GET['uid'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['transaction_id']) ? $_GET['transaction_id'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or number"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['user']) ? $_GET['user'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="pre_transaction_id"
                                                       placeholder="Pre Transaction Id" class="form-control"
                                                       value="<?php echo e(!empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : ''); ?>">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row" style="margin-top: 20px">
                                        

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="From Amount"
                                                       name="from_amount" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from_amount']) ? $_GET['from_amount'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="To Amount"
                                                       name="to_amount" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to_amount']) ? $_GET['to_amount'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 40px;">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="User Type..." class="chosen-select"
                                                        tabindex="2"
                                                        name="user_type">
                                                    <option value="" selected disabled>User Type...</option>
                                                    <?php if(!empty($_GET['user_type'])): ?>
                                                        <option value="all"
                                                                <?php if($_GET['user_type'] == 'all'): ?> selected <?php endif; ?>>All
                                                        </option>
                                                        <option value="user"
                                                                <?php if($_GET['user_type'] == 'user'): ?> selected <?php endif; ?>>User
                                                        </option>
                                                        <option value="merchant"
                                                                <?php if($_GET['user_type'] == 'merchant'): ?> selected <?php endif; ?>>
                                                            Merchant
                                                        </option>
                                                        <option value="agent"
                                                                <?php if($_GET['user_type'] == 'agent'): ?> selected <?php endif; ?>>Agent
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="all">All</option>
                                                        <option value="user">User</option>
                                                        <option value="merchant">Merchant</option>
                                                        <option value="agent">Agent</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Vendor...." class="chosen-select"
                                                        tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['vendor'])): ?>

                                                        <?php $__currentLoopData = $getAllUniqueVendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getAllUniqueVendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($getAllUniqueVendor); ?>"
                                                                    <?php if($_GET['vendor']  == $getAllUniqueVendor): ?> selected <?php endif; ?> ><?php echo e($getAllUniqueVendor); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $getAllUniqueVendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getAllUniqueVendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($getAllUniqueVendor); ?>"><?php echo e($getAllUniqueVendor); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="service">
                                                    <option value="" selected disabled>Select Service Type...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['service'])): ?>
                                                        <?php $__currentLoopData = $walletServiceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($serviceType); ?>"
                                                                    <?php if($_GET['service'] == $serviceType): ?> selected <?php endif; ?>><?php echo e($serviceType); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $walletServiceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($serviceType); ?>"> <?php echo e($serviceType); ?> </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction type..."
                                                        class="chosen-select" tabindex="2" name="transaction_type">
                                                    <option value="" selected disabled>Select Transaction Type...
                                                    </option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['transaction_type'])): ?>
                                                        <?php $__currentLoopData = $transactionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transactionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($key); ?>"
                                                                    <?php if($_GET['transaction_type'] == $key): ?> selected <?php endif; ?>><?php echo e($transactionType); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $transactionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transactionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($key); ?>"> <?php echo e($transactionType); ?> </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="<?php echo e(route('transaction.complete')); ?>"><strong>Filter</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="<?php echo e(route('transaction.complete.excel')); ?>">
                                            <strong>Excel</strong></button>
                                    </div>
                                    <?php echo $__env->make('admin.asset.components.clearFilterButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(!empty($_GET)): ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all transactions</h5>

                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> <?php echo e($totalTransactionCount); ?></h5>
                            <h5><b>Total Amount Sum:</b> Rs. <?php echo e($totalTransactionAmountSum); ?></h5>
                            <h5><b>Total Fee Sum:</b> Rs. <?php echo e($totalTransactionFeeSum); ?></h5>
                            <h5><b>Total Cashback Sum:</b> Rs. <?php echo e($totalTransactionCashbackSum); ?></h5>
                            <h5><b>Total Commission Sum:</b> Rs. <?php echo e($totalTransactionCommissionSum); ?></h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Complete transactions list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction ID</th>
                                        <th>UID</th>
                                        <th>Transaction ID</th>
                                        <th>User</th>
                                        <th>Vendor</th>
                                        <th>Service Type</th>
                                        <th>Amount</th>
                                        <th>Fee</th>
                                        <th>Cashback</th>
                                        <th>Commission</th>
                                        <th>Status</th>
                                        
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="gradeC">
                                            <td><?php echo e($loop->index + ($transactions->perPage() * ($transactions->currentPage() - 1)) + 1); ?></td>
                                            <td><?php echo e($transaction->pre_transaction_id); ?></td>
                                            <td><?php echo e($transaction->uid ?? '---'); ?></td>
                                            <td>
                                                <?php if(!empty($transaction->transactionable->transaction_id)): ?>
                                                    <?php echo e($transaction->transactionable->transaction_id); ?>

                                                <?php elseif(!empty($transaction->transactionable->refStan)): ?>
                                                    <?php echo e($transaction->transactionable->refStan); ?>

                                                <?php else: ?>
                                                    <?php echo e($transaction->id); ?>

                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $transaction->user_id)); ?>" <?php endif; ?>> <?php echo e($transaction->user['mobile_no'] ?? '--'); ?> <br>
                                                </a>
                                            </td>
                                            <td>
                                                <?php echo e($transaction->vendor); ?>

                                            </td>
                                            <td>
                                                <?php echo e($transaction->service_type); ?>

                                            </td>
                                            <td class="center">Rs. <?php echo e($transaction->amount); ?></td>
                                            <td class="center">
                                                Rs. <?php echo e($transaction->fee); ?>

                                            </td>
                                            <td>
                                                Rs. <?php echo e($transaction->cashback_amount); ?>

                                            </td>
                                            <td>Rs. <?php echo e($transaction->commission_amount ?? 0); ?></td>
                                            <td>
                                                <span class="badge badge-primary">Complete</span>
                                            </td>
                                            
                                            <td class="center"><?php echo e($transaction->created_at); ?></td>
                                            <td>
                                                <?php echo $__env->make('admin.transaction.transactionActionButtons', ['transaction' => $transaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php echo e($transactions->appends(request()->query())->links()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        <?php if(!empty($_GET)): ?>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($transactions->firstItem()); ?> to <?php echo e($transactions->lastItem()); ?> of <?php echo e($transactions->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
        <?php endif; ?>
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = <?php if(!empty($_GET['amount'])): ?> `<?php echo e($_GET['amount']); ?>`;
        <?php else: ?> '0;100000'; <?php endif; ?>
        let split = amount.split(';');
        $(".ionrange_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });
    </script>

    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/transaction/complete.blade.php ENDPATH**/ ?>