<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Paypoint</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Paypoint</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Paypoint Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="<?php echo e(route('paypoint')); ?>">
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
                                                <input type="text" name="refStan" placeholder="ref Stan"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['refStan']) ? $_GET['refStan'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or Number"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['user']) ? $_GET['user'] : ''); ?>">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
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

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose paypoint vendor..."
                                                        class="chosen-select" tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select paypoint vendor...
                                                    </option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['vendor'])): ?>
                                                        <?php $__currentLoopData = $paypointVendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($vendor); ?>"
                                                                    <?php if($_GET['vendor'] == $vendor): ?> selected <?php endif; ?>><?php echo e($vendor); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $paypointVendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($vendor); ?>"> <?php echo e($vendor); ?> </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['status'])): ?>
                                                        <option value="completed"
                                                                <?php if($_GET['status']  == 'completed'): ?> selected <?php endif; ?>>
                                                            Completed
                                                        </option>
                                                        <option value="failed"
                                                                <?php if($_GET['status']  == 'failed'): ?> selected <?php endif; ?>>Failed
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="completed">Completed</option>
                                                        <option value="failed">Failed</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                            <label for="ionrange_balance">Amount</label>
                                            
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
                                        <div class="col-md-3" style="margin-top: 40px;">
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
                                        <div class="col-md-3" style="margin-top: 40px;">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <input type="number" class="form-control"
                                                           placeholder="Pre Transaction Id" name="pre_transaction_id"
                                                           autocomplete="off"
                                                           value="<?php echo e(!empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : ''); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit">
                                            <strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="compareBtn" class="btn btn-sm btn-primary float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="<?php echo e(route('paypointTransferApi.compare')); ?>">
                                            <strong>Compare with API</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="<?php echo e(route('paypoint.excel')); ?>"><strong>Excel</strong>
                                        </button>
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
                            <h5>List of Paypoint (Utility) transactions</h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> <?php echo e($totalPayPointTransactionCount); ?></h5>
                            <h5><b>Total Amount Sum:</b> Rs. <?php echo e($totalPayPointTransactionSum); ?></h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="PayPoint transaction list">
                                    <thead>
                                    <tr>
                                        <th>s.No.</th>
                                        <th>UID</th>
                                        <th>PreTransaction ID</th>
                                        <th>Transaction ID</th>
                                        <th>Vendor</th>
                                        <th>RefStan</th>
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th>CashBacck</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Request</th>
                                        <th>Response</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <tr class="gradeC">
                                            <td><?php echo e($loop->index + ($transactions->perPage() * ($transactions->currentPage() - 1)) + 1); ?></td>
                                            <td>
                                                <?php echo e($transaction->userTransaction->transactions->uid ?? '---'); ?>

                                            </td>
                                            <td><?php echo e($transaction->pre_transaction_id); ?></td>
                                            <td>
                                                <?php echo e($transaction->transaction_id); ?>

                                            </td>
                                            <td>
                                                <?php echo e($transaction->userTransaction['vendor'] ?? ''); ?>

                                            </td>
                                            <td>
                                                <?php echo e($transaction->refStan); ?>

                                            </td>
                                            <td>
                                                <?php if(!empty($transaction->user)): ?>
                                                    <a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $transaction->user['id'])); ?>" <?php endif; ?>><?php echo e($transaction->user['mobile_no']); ?></a>
                                                <?php elseif(!empty($transaction->requestInfo->user)): ?>
                                                    <a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $transaction->requestInfo->user->id)); ?>" <?php endif; ?>><?php echo e($transaction->requestInfo->user->mobile_no); ?></a>
                                                <?php elseif(!empty($transaction->preTransaction->user)): ?>
                                                    <a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $transaction->preTransaction->user->id)); ?>" <?php endif; ?>><?php echo e($transaction->preTransaction->user->mobile_no); ?></a>
                                                <?php elseif(!empty($transaction->userTransaction->preTransaction->user)): ?>
                                                    <a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $transaction->userTransaction->preTransaction->user->id)); ?>" <?php endif; ?>><?php echo e($transaction->userTransaction->preTransaction->user->mobile_no); ?></a>
                                                <?php elseif(!empty($transaction->userExecutePayment[0]->preTransaction->user)): ?>
                                                    <a <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $transaction->userExecutePayment[0]->preTransaction->user->id)); ?>" <?php endif; ?>><?php echo e($transaction->userExecutePayment[0]->preTransaction->user->mobile_no); ?></a>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php if($transaction->userTransaction): ?>
                                                    <?php echo e($transaction->userTransaction['amount'] ? 'Rs. '.$transaction->userTransaction['amount'] : ''); ?>

                                                <?php endif; ?>
                                            </td>

                                            <td>

                                                <?php if($transaction->userTransaction != null && $transaction->userTransaction->commission !=null): ?>
                                                    Rs. <?php echo e(round($transaction->userTransaction->commission['after_amount'] - $transaction->userTransaction->commission['before_amount'], 2)); ?>

                                                <?php else: ?>
                                                    Rs. 0
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php echo $__env->make('admin.transaction.paypoint.status', ['transaction' => $transaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </td>
                                            <td class="center"><?php echo e($transaction->updated_at); ?></td>

                                            
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Paypoint request view')): ?>
                                                    <?php echo $__env->make('admin.transaction.paypoint.request', ['transaction' => $transaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>

                                            
                                            <td>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Paypoint response view')): ?>
                                                    <?php echo $__env->make('admin.transaction.paypoint.response', ['transaction' => $transaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php if(isset($transaction->refStan)): ?>
                                                <form
                                                    action="<?php echo e(route('paypointTransferApi.report', $transaction->refStan)); ?>"
                                                    method="post">
                                                    <?php endif; ?>
                                                    <?php echo csrf_field(); ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Paypoint detail')): ?>
                                                        <a href="<?php echo e(route('paypoint.detail', $transaction->id)); ?>">
                                                            <button class="btn btn-primary btn-icon" type="button"><i
                                                                    class="fa fa-eye"></i></button>
                                                            <?php if(isset($transaction->refStan)): ?>
                                                            <button class="btn btn-primary btn-icon" type="submit"
                                                                    title="API Details">
                                                                <i class="fa fa-database"></i></button>
                                                            <?php endif; ?>
                                                        </a>
                                                    <?php endif; ?>
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

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/transaction/paypoint.blade.php ENDPATH**/ ?>