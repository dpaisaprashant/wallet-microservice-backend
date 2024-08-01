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

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="user_name" placeholder="User Name"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['user_name']) ? $_GET['user_name'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" name="mobile_no" placeholder="User Phone Number"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['mobile_no']) ? $_GET['mobile_no'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 20px">

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from_transaction_date"
                                                       autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from_transaction_date']) ? $_GET['from_transaction_date'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to_transaction_date" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to_transaction_date']) ? $_GET['to_transaction_date'] : ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Sort By..." class="chosen-select" tabindex="2"
                                                        name="sortTotal">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    <?php if(!empty($_GET['sortTotal'])): ?>
                                                        <option value="total_credit_amount"
                                                                <?php if($_GET['sortTotal'] == 'total_credit_amount'): ?> selected <?php endif; ?>>
                                                            Total Credit Amount
                                                        </option>
                                                        <option value="total_credit_count"
                                                                <?php if($_GET['sortTotal'] == 'total_credit_count'): ?> selected <?php endif; ?>>
                                                            Total Credit Count
                                                        </option>
                                                        <option value="total_debit_amount"
                                                                <?php if($_GET['sortTotal'] == 'total_debit_amount'): ?> selected <?php endif; ?>>
                                                            Total Debit Amount
                                                        </option>
                                                        <option value="total_debit_count"
                                                                <?php if($_GET['sortTotal'] == 'total_debit_count'): ?> selected <?php endif; ?>>
                                                            Total Debit Count
                                                        </option>
                                                        <option value="total_cashback_amount"
                                                                <?php if($_GET['sortTotal'] == 'total_cashback_amount'): ?> selected <?php endif; ?>>
                                                            Total Cashback Amount
                                                        </option>
                                                        <option value="total_cashback_count"
                                                                <?php if($_GET['sortTotal'] == 'total_cashback_count'): ?> selected <?php endif; ?>>
                                                            Total Cashback Count
                                                        </option>
                                                        <option value="total_commission_amount"
                                                                <?php if($_GET['sortTotal'] == 'total_commission_amount'): ?> selected <?php endif; ?>>
                                                            Total Commission Amount
                                                        </option>
                                                        <option value="total_commission_count"
                                                                <?php if($_GET['sortTotal'] == 'total_commission_count'): ?> selected <?php endif; ?>>
                                                            Total Commission Count
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="total_credit_amount">Total Credit Amount</option>
                                                        <option value="total_credit_count">Total Credit Count</option>
                                                        <option value="total_debit_amount">Total Debit Amount</option>
                                                        <option value="total_debit_count">Total Debit Count</option>
                                                        <option value="total_cashback_amount">Total Cashback Amount
                                                        </option>
                                                        <option value="total_cashback_count">Total Cashback Count
                                                        </option>
                                                        <option value="total_commission_amount">Total Commission
                                                            Amount
                                                        </option>
                                                        <option value="total_commission_count">Total Commission Count
                                                        </option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="<?php echo e(route('transaction.complete.user')); ?>">
                                            <strong>Filter</strong>
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
                            <h5>List of all transactions</h5>

                        </div>
                        <div class="ibox-content">
                            
                            
                            
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Complete transactions list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>User Name</th>
                                        <th>User Phone Number</th>
                                        <th>Total Credit Amount</th>
                                        <th>Credited Transaction Count</th>
                                        <th>Total Debit Amount</th>
                                        <th>Debit Transactions Count</th>
                                        <th>Total Cashback Amount</th>
                                        <th>Count of Cashback Transactions</th>
                                        <th>Total Commission</th>
                                        <th>Count of Commission Transactions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="gradeC">
                                            <td><?php echo e($loop->index + ($users->perPage() * ($users->currentPage() - 1)) + 1); ?></td>
                                            <td><?php echo e($user->name); ?></td>
                                            <td><?php echo e($user->mobile_no); ?></td>
                                            <td><?php echo e($user->credit_sum); ?></td>
                                            <td><?php echo e($user->credit_count); ?></td>
                                            <td><?php echo e($user->debit_sum); ?></td>
                                            <td><?php echo e($user->debit_count); ?></td>
                                            <td><?php echo e($user->cashback_sum); ?></td>
                                            <td><?php echo e($user->cashback_count); ?></td>
                                            <td><?php echo e($user->commission_sum); ?></td>
                                            <td><?php echo e($user->commission_count); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php echo e($users->appends(request()->query())->links()); ?>

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
                let a = "Showing <?php echo e($users->firstItem()); ?> to <?php echo e($users->lastItem()); ?> of <?php echo e($users->total()); ?> entries";
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



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/transaction/userTransactionList.blade.php ENDPATH**/ ?>