<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Fund Transfer</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Fund Transfer</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Fund Transfer</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" <?php if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ): ?> style="display: none"  <?php endif; ?>>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="from_user" placeholder="From User Name or Email" class="form-control" value="<?php echo e(!empty($_GET['from_user']) ? $_GET['from_user'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="to_user" placeholder="To User Name or Email" class="form-control" value="<?php echo e(!empty($_GET['to_user']) ? $_GET['to_user'] : ''); ?>">
                                            </div>
                                        </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                        <option value="" selected disabled>Sort By...</option>
                                                        <?php if(!empty($_GET['sort'])): ?>
                                                            <option value="date" <?php if($_GET['sort'] == 'date'): ?> selected <?php endif; ?>>Latest Date</option>
                                                            <option value="amount" <?php if($_GET['sort'] == 'amount'): ?> selected <?php endif; ?>>Highest amount</option>
                                                        <?php else: ?>
                                                            <option value="date">Date</option>
                                                            <option value="amount">Amount</option>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                            <label for="ionrange_balance">Fund</label>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control" placeholder="From Fund" name="from_fund" autocomplete="off" value="<?php echo e(!empty($_GET['from_fund']) ? $_GET['from_fund'] : ''); ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control" placeholder="To Fund" name="to_fund" autocomplete="off" value="<?php echo e(!empty($_GET['to_fund']) ? $_GET['to_fund'] : ''); ?>">
                                                    </div>
                                                </div>
                                            </div>
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
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('transaction.userToUserFundTransfer')); ?>"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="<?php echo e(route('fundTransfer.excel')); ?>"><strong>Excel</strong></button>
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
                        <h5>List of fund transfer transaction</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="User to user fund transfer list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Fund</th>
                                    <th>Commission</th>
                                    <th>Transfer Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php $__currentLoopData = $fundTransfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fundTransfer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeC">
                                    <td><?php echo e($loop->index + ($fundTransfers->perPage() * ($fundTransfers->currentPage() - 1)) + 1); ?></td>
                                    <td>
                                        <a  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $fundTransfer->from_user)); ?>" <?php endif; ?>> <?php echo e($fundTransfer->fromUser['mobile_no'] ?? ''); ?> </a>
                                    </td>
                                    <td>
                                        <a  <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User profile')): ?> href="<?php echo e(route('user.profile', $fundTransfer->to_user)); ?>" <?php endif; ?>> <?php echo e($fundTransfer->toUser['mobile_no']); ?> </a>
                                    </td>
                                    <td class="center">Rs.<?php echo e($fundTransfer->amount); ?></td>

                                    <td>Rs. <?php echo e(optional($fundTransfer->commission)['before_amount'] - optional($fundTransfer->commission)['after_amount']); ?></td>

                                    <td class="center">
                                        <?php echo e($fundTransfer->created_at); ?>

                                    </td>

                                     <td>
                                        <?php echo $__env->make('admin.transaction.fundTransfer.detail', ['transaction' => $fundTransfer], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Fund transfer detail')): ?>
                                            <a href="<?php echo e(route('userToUserFundTransfer.detail', $fundTransfer->id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
                                        <?php endif; ?>
                                     </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                            <?php echo e($fundTransfers->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($fundTransfers->firstItem()); ?> to <?php echo e($fundTransfers->lastItem()); ?> of <?php echo e($fundTransfers->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
    </script>
    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = <?php if(!empty($_GET['fund'])): ?> `<?php echo e($_GET['fund']); ?>`; <?php else: ?> '0;100000'; <?php endif; ?>
        let split = amount.split(';');
        $(".ionrange_fund").ionRangeSlider({
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

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/transaction/userToUserFundTransfer.blade.php ENDPATH**/ ?>