<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Merchant Ledgers</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant Ledger</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant Ledger</strong>
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
                        <h5>Filter Merchant Ledgers</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" <?php if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ): ?> style="display: none" <?php endif; ?>>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off"  value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off"  value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class = "col-6" style="padding-top: 10px">
                                            <select name="merchant" class="form-control form-control-sm" required>
                                                <option value="" selected disabled>-- Select Merchant --</option>
                                                <?php $__currentLoopData = $merchants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $merchant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(!empty($_GET['merchant'])): ?>
                                                        <?php if($merchant->id == $_GET['merchant']): ?>
                                                            <option value="<?php echo e($merchant->id); ?>" selected><?php echo e($merchant->mobile_no . "-" .$merchant->name); ?></option>
                                                        <?php else: ?>
                                                            <option value="<?php echo e($merchant->id); ?>"><?php echo e($merchant->moble_no . "-" .$merchant->name); ?></option>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <option value="<?php echo e($merchant->id); ?>"><?php echo e($merchant->moble_no . "-" .$merchant->name); ?></option>
                                                    <?php endif; ?>

                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="form-group" style="padding-top: 10px">
                                                <select data-placeholder="Select Pre-Transaction status..."
                                                        class="chosen-select" tabindex="2" name="transaction_type">
                                                    <option value="" selected disabled>-- Select Transaction Type -- </option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['transaction_type'])): ?>
                                                        <option value="<?php echo e(\App\Models\MagnusWithdraw::class); ?>"
                                                                <?php if($_GET['transaction_type']  == \App\Models\MagnusWithdraw::class): ?> selected <?php endif; ?> >
                                                            Magnus Withdraw
                                                        </option>
                                                        <option value="<?php echo e(\App\Models\MagnusDeposit::class); ?>"
                                                                <?php if($_GET['transaction_type'] == \App\Models\MagnusDeposit::class): ?> selected <?php endif; ?>>
                                                            Magnus Deposit
                                                        </option>
                                                    <?php else: ?>
                                                        <option value="<?php echo e(\App\Models\MagnusWithdraw::class); ?>">Magnus Withdraw</option>
                                                        <option value="<?php echo e(\App\Models\MagnusDeposit::class); ?>">Magnus Deposit</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pre_transaction_id">Enter Pre Transaction ID</label>
                                                <input type="text" name="pre_transaction_id" placeholder="Enter Pre Transaction ID"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : ''); ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('admin.merchant.ledger.index')); ?>"><strong>Filter</strong></button>
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
                        <div class="row">
                            <div class = "col-3">
                                <h5>List of Merchant Ledgers</h5>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="User Login Sessions">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Pre Transaction ID</th>
                                    <th>Date</th>
                                    <th>Transaction Code</th>
                                    <th>Merchant Name</th>
                                    <th>Account Name</th>
                                    <th>SFACL Transaction ID</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Amount</th>
                                    <th>Description(Kaifhiyat)</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <?php if(isset($ledgers)): ?>
                                    <?php ($amount = 0); ?>
                                    <?php $__currentLoopData = $ledgers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ledger): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tbody>
                                            <td><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($ledger->pre_transaction_id); ?></td>
                                            <td><?php echo e($ledger->created_at); ?></td>
                                            <td><?php echo e($ledger->uid); ?></td>
                                            <td><?php echo e($ledger->user->name); ?></td>
                                            <td><?php echo e($ledger->account_mobile_no); ?></td>
                                            <td><?php echo e($ledger->tx_id); ?></td>
                                            <?php if($ledger->uniquePreTransaction->transaction_type == \App\Models\Microservice\PreTransaction::TRANSACTION_TYPE_DEBIT): ?>
                                                <td style="color: red"><?php echo e($ledger->amount); ?></td>
                                                <td>--</td>




                                            <?php else: ?>
                                                <td>--</td>
                                                <td style="color: green"><?php echo e($ledger->amount); ?></td>




                                            <?php endif; ?>
                                            <td><?php echo e($ledger->balance); ?></td>
                                            <td><?php echo e($ledger->descripiton); ?></td>
                                            <td>
                                                <a style="margin-top: 5px;"
                                                   href="<?php echo e(route('admin.merchant.ledger.detail',$ledger->id)); ?>"
                                                   class="btn btn-sm btn-icon btn-primary m-t-n-xs"
                                                   title="user profile"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tbody>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </table>
                            <?php if(isset($ledgers)): ?>
                            <?php echo e($ledgers->appends(request()->query())->links()); ?>

                            <?php endif; ?>
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
    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(isset($ledgers)): ?>
        <script>
            $(document).ready(function (e) {
                let a = "Showing <?php echo e($ledgers->firstItem()); ?> to <?php echo e($ledgers->lastItem()); ?> of <?php echo e($ledgers->total()); ?> entries";
                $('.dataTables_info').text(a);
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/merchant-ledger/merchant_ledger_index.blade.php ENDPATH**/ ?>