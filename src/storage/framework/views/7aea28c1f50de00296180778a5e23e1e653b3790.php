<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Refund Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Refund Transaction</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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

                    <div class="ibox-content" <?php if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ): ?> style="display: none"  <?php endif; ?>>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="<?php echo e(route('transaction.complete')); ?>" id="filter">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="uid" placeholder="User Transaction ID" class="form-control" value="<?php echo e(!empty($_GET['uid']) ? $_GET['uid'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="<?php echo e(!empty($_GET['transaction_id']) ? $_GET['transaction_id'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or number" class="form-control" value="<?php echo e(!empty($_GET['user']) ? $_GET['user'] : ''); ?>">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="ionrange_amount">Amount</label>
                                            <input type="text" name="amount" class="ionrange_amount">
                                        </div>

                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 40px;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    <?php if(!empty($_GET['sort'])): ?>
                                                        <option value="date" <?php if($_GET['sort'] == 'date'): ?> selected <?php endif; ?>>Latest Date</option>
                                                        <option value="amount" <?php if($_GET['sort'] == 'amount'): ?> selected <?php endif; ?>>Highest amount</option>
                                                    <?php else: ?>
                                                        <option value="date">Latest Date</option>
                                                        <option value="amount">Amount</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Vendor...." class="chosen-select"  tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['vendor'])): ?>
                                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($vendor); ?>"
                                                                    <?php if($_GET['vendor']  == $vendor): ?> selected <?php endif; ?> ><?php echo e($vendor); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($vendor); ?>"><?php echo e($vendor); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2" name="service">
                                                    <option value="" selected disabled>Select Service Type...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['service'])): ?>
                                                        <?php $__currentLoopData = $serviceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($serviceType); ?>" <?php if($_GET['service'] == $serviceType): ?> selected <?php endif; ?>><?php echo e($serviceType); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $serviceTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serviceType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($serviceType); ?>"> <?php echo e($serviceType); ?> </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('loadTestFund.index')); ?>"><strong>Filter</strong></button>
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
                        <h5>List of all load funds</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Complete transactions list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Admin</th>
                                    <th>UID</th>
                                    <th>Pre Transaction Id</th>
                                    <th>User</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Bonus Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeC">
                                        <td><?php echo e($loop->index + ($transactions->perPage() * ($transactions->currentPage() - 1)) + 1); ?></td>
                                        <td><?php echo e($transaction->admin_id); ?></td>
                                        <td><?php echo e($transaction->uid ?? '---'); ?></td>
                                        <td><?php echo e($transaction->pre_transaction_id ?? '---'); ?></td>
                                        <td>
                                            <a  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $transaction->user_id)); ?>" <?php endif; ?>> <?php echo e($transaction->user['mobile_no']); ?> </a>
                                        </td>
                                        <td>
                                            <?php echo e($transaction->description); ?>

                                        </td>
                                        <td class="center">Rs. <?php echo e($transaction->amount); ?></td>
                                        <td class="center">Rs. <?php echo e($transaction->bonus_amount); ?></td>
                                        <td class="center"><?php echo e($transaction->created_at); ?></td>
                                        <td>

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
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    <?php echo $__env->make('admin.asset.css.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($transactions->firstItem()); ?> to <?php echo e($transactions->lastItem()); ?> of <?php echo e($transactions->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = <?php if(!empty($_GET['amount'])): ?> `<?php echo e($_GET['amount']); ?>`; <?php else: ?> '0;100000'; <?php endif; ?>
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



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/refund/index.blade.php ENDPATH**/ ?>