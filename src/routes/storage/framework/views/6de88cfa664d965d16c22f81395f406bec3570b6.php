<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NPay Web/Mobile Banking</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>NPay Web/Mobile Banking</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter NPay Transactions</h5>
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
                                                <input type="text" name="user" placeholder="Email or Number"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['user']) ? $_GET['user'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="bank" placeholder="Bank" class="form-control"
                                                       value="<?php echo e(!empty($_GET['bank']) ? $_GET['bank'] : ''); ?>">
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
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['status'])): ?>
                                                        <option value="completed"
                                                                <?php if($_GET['status']  == 'completed'): ?> selected <?php endif; ?>>
                                                            Completed
                                                        </option>
                                                        <option value="validated"
                                                                <?php if($_GET['status']  == 'validated'): ?> selected <?php endif; ?>>
                                                            Validated
                                                        </option>
                                                        <option value="error"
                                                                <?php if($_GET['status']  == 'error'): ?> selected <?php endif; ?>>Error
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="completed">Completed</option>
                                                        <option value="validated">Validated</option>
                                                        <option value="error">Error</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
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

                                        <div class="col-md-6 mt-3">
                                            <label for="ionrange_balance">Pre Transaction Id</label>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control"
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
                                                formaction="<?php echo e(route('eBanking')); ?>"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="<?php echo e(route('npay.excel')); ?>"><strong>Excel</strong></button>
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
                            <h5>List of NPay (Load Fund) transactions</h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> <?php echo e($totalCountEbanking); ?></h5>
                            <h5><b>Total Amount Sum:</b> Rs. <?php echo e($totalSumEbanking); ?></h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="NPay transactions list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>UID</th>
                                        <th>Pre Transaction ID</th>
                                        <th>Transaction ID</th>
                                        <th>User</th>
                                        <th>Bank</th>
                                        <th>Description</th>
                                        <th>Gateway Ref no.</th>
                                        <th>Amount</th>
                                        <th style="width: 1%">Commission</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th style="width: 1%">Response</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $__currentLoopData = $userLoadTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="gradeC">
                                            <td><?php echo e($loop->index + ($userLoadTransactions->perPage() * ($userLoadTransactions->currentPage() - 1)) + 1); ?></td>
                                            <td><?php echo e($transaction->transactions->uid ?? '---'); ?></td>
                                            <td><?php echo e($transaction->pre_transaction_id); ?></td>
                                            <td>
                                                <?php echo e($transaction->transaction_id); ?>

                                            </td>
                                            <td>
                                                <?php echo e($transaction->user['mobile_no'] ?? ""); ?>

                                            </td>
                                            <td>
                                                <?php echo e($transaction->payment_mode); ?>

                                            </td>
                                            <td>
                                                <?php echo e($transaction->description); ?>

                                            </td>
                                            <td><?php echo e($transaction->gateway_ref_no); ?></td>
                                            <td class="center">Rs.<?php echo e($transaction->amount); ?></td>

                                            <td>
                                                Rs. <?php echo e($transaction->transaction_fee  ?? 0); ?>

                                            </td>

                                            <td>
                                                <?php echo $__env->make('admin.transaction.npay.status', ['transaction' => $transaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </td>
                                            <td class="center"><?php echo e($transaction->updated_at); ?></td>
                                            <td>
                                                <?php if(isset($transaction->loadTransactionResponse)): ?>
                                                    <?php echo $__env->make('admin.transaction.npay.response', ['transaction' => $transaction->loadTransactionResponse], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php echo $__env->make('admin.transaction.npay.detail', ['transaction' => $transaction], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Fund transfer detail')): ?>
                                                    <a href="<?php echo e(route('eBanking.detail', $transaction->id)); ?>">
                                                        <button class="btn btn-primary btn-icon" type="button"><i
                                                                class="fa fa-eye"></i></button>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>

                                </table>
                                <?php echo e($userLoadTransactions->appends(request()->query())->links()); ?>

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
            let a = "Showing <?php echo e($userLoadTransactions->firstItem()); ?> to <?php echo e($userLoadTransactions->lastItem()); ?> of <?php echo e($userLoadTransactions->total()); ?> entries";
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

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/transaction/eBanking.blade.php ENDPATH**/ ?>