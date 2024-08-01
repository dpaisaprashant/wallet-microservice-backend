<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NEPALQR PAYMENT</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Nepalqr Payment</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Nepalqr Payment</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['transaction_id']) ? $_GET['transaction_id'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or Number"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['user']) ? $_GET['user'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <select data-placeholder="Sort By..." class="chosen-select"
                                                            tabindex="2" name="sort">
                                                        <option value="" selected disabled>Sort By...</option>
                                                        <?php if(!empty($_GET['sort'])): ?>
                                                            <option value="date"
                                                                    <?php if($_GET['sort'] == 'date'): ?> selected <?php endif; ?>>Latest
                                                                Date
                                                            </option>
                                                            <option value="amount"
                                                                    <?php if($_GET['sort'] == 'amount'): ?> selected <?php endif; ?>>
                                                                Highest amount
                                                            </option>
                                                        <?php else: ?>
                                                            <option value="date">Latest Date</option>
                                                            <option value="amount">Highest Amount</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction debit status..."
                                                        class="chosen-select" tabindex="2" name="debit_status">
                                                    <option value="" selected disabled>Select Debit Status...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['debit_status'])): ?>
                                                        <option value="SUCCESS"
                                                                <?php if($_GET['debit_status']  == 'SUCCESS'): ?> selected <?php endif; ?>>
                                                            SUCCESS
                                                        </option>
                                                        <option value="ERROR"
                                                                <?php if($_GET['debit_status']  == 'ERROR'): ?> selected <?php endif; ?>>
                                                            ERROR
                                                        </option>
                                                        <option value="NOT_COMPLETED"
                                                                <?php if($_GET['debit_status']  == 'NOT_COMPLETED'): ?> selected <?php endif; ?>>
                                                            NOT COMPLETED
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="SUCCESS">SUCCESS</option>
                                                        <option value="ERROR">ERROR</option>
                                                        <option value="NOT_COMPLETED">NOT COMPLETED</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                           
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-dollar"></i>
                                                        </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="From Amount" name="from_amount"
                                                               autocomplete="off"
                                                               value="<?php echo e(!empty($_GET['from_amount']) ? $_GET['from_amount'] : ''); ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="To Amount" name="to_amount"
                                                               autocomplete="off"
                                                               value="<?php echo e(!empty($_GET['to_amount']) ? $_GET['to_amount'] : ''); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-3">
                                          
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                        <input type="number" class="form-control"
                                                               placeholder="Pre Transaction Id"
                                                               name="pre_transaction_id" autocomplete="off"
                                                               value="<?php echo e(!empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : ''); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="<?php echo e(route('nqr.nepalQrPayment')); ?>"><strong>Filter</strong>
                                        </button>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs"
                                                style="margin-right: 8px;" type="submit"
                                                formaction="<?php echo e(route('nchlBankTransferApi.compare')); ?>"><strong>Compare
                                                with API</strong>
                                        </button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="<?php echo e(route('nchlBankTransfer.excel')); ?>"><strong>Excel</strong></button>
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
                            <h5>List of NEPAlQR Payments</P></h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> <?php echo e($totalTransactionCount); ?></h5>
                            <h5><b>Total Amount Sum:</b> Rs. <?php echo e($totalTransactionSum); ?></h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="NPay transactions list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>UID</th>
                                        <th>PreTransaction ID</th>
                                        <th>Transaction ID</th>
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th style="width: 1%">Commission</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th style="width: 1%">Request</th>
                                        <th style="width: 1%">Response</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="gradeC">
                                            <td><?php echo e($loop->index + ($transactions->perPage() * ($transactions->currentPage() - 1)) + 1); ?></td>
                                            <td><?php echo e($transaction->transactionEvents->uid); ?></td>
                                            <td><?php echo e($transaction->pre_transaction_id); ?></td>
                                            <td><?php echo e($transaction->transaction_id); ?></td>
                                            <td>
                                                <?php if(!empty($transaction->user)): ?>
                                                    <a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $transaction->user_id)); ?>" <?php endif; ?>><?php echo e($transaction->user['mobile_no']); ?></a>
                                                <?php endif; ?>
                                            </td>

                                            <td> Rs. <?php echo e($transaction->amount ?? 0); ?></td>
                                            <td>Rs. <?php echo e($transaction->getCommission()); ?></td>
                                            <td><?php echo e($transaction->status); ?></td>
                                            <td><?php echo e($transaction->transactionEvents->created_at); ?></td>
                                            <td>
                                                <?php echo $__env->make('admin.transaction.nepalqr.request', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </td>
                                            <td>
                                                <?php echo $__env->make('admin.transaction.nepalqr.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </td>
                                            <td>
                                                <form
                                                    action="<?php echo e(route('nchlBankTransferApi.report', $transaction->transaction_id)); ?>"
                                                    method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <a href="<?php echo e(route('nchl.bankTransfer.detail', $transaction->id)); ?>"
                                                       title="Transaction Detail">
                                                        <button class="btn btn-primary btn-icon" type="button"><i
                                                                class="fa fa-eye"></i></button>
                                                        <button class="btn btn-primary btn-icon" type="submit"
                                                                title="API Details">
                                                            <i class="fa fa-database"></i></button>
                                                    </a>
                                                </form>
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
    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/transaction/nepalqr.blade.php ENDPATH**/ ?>