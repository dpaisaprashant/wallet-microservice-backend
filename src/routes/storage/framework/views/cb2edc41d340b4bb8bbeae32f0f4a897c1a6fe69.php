<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Clearance</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Clearance</strong>
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
                        <h5>Select Date</h5>
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
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Vendor...." class="chosen-select"
                                                        tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['vendor'])): ?>

                                                        <?php $__currentLoopData = $walletVendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getAllUniqueVendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($getAllUniqueVendor); ?>"
                                                                    <?php if($_GET['vendor']  == $getAllUniqueVendor): ?> selected <?php endif; ?> ><?php echo e($getAllUniqueVendor); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $walletVendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $getAllUniqueVendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option
                                                                value="<?php echo e($getAllUniqueVendor); ?>"><?php echo e($getAllUniqueVendor); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction type..."
                                                        class="chosen-select" tabindex="2" name="transaction_event_transaction_type" required>
                                                    <option value="" selected disabled>Select Transaction Type...
                                                    </option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['transaction_event_transaction_type'])): ?>
                                                        <?php $__currentLoopData = $transactionTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $transactionType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($key); ?>"
                                                                    <?php if($_GET['transaction_event_transaction_type'] == $key): ?> selected <?php endif; ?>><?php echo e($transactionType); ?></option>
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

                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="<?php echo e(route('clearance.transactions')); ?>"><strong>Generate
                                                Report</strong></button>
                                    </div>
                                    <?php echo $__env->make('admin.asset.components.clearFilterButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    
                                </form>
                            </div>
                        </div>
                        <?php if(!empty($_GET['from']) && !empty($_GET['to'])): ?>
                            <?php if(!empty($info)): ?>
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-sm-12">
                                        <div class="alert alert-warning" style="width: 100%">
                                            <i class="fa fa-info-circle"></i>&nbsp; <?php echo e($info); ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <?php if(!empty($_GET['from']) && !empty($_GET['to'])): ?>
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Clearance report from <?php echo e($_GET['from'] . ' to ' . $_GET['to']); ?></h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> <?php echo e($totalTransactionCount); ?></h5>
                            <h5><b>Total Amount Sum:</b> Rs. <?php echo e($totalTransactionAmountSum); ?></h5>
                            <h5><b>Total Fee Sum:</b> Rs. <?php echo e($totalTransactionFeeSum); ?></h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="clearance transactions">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Vendor</th>
                                        <th>Amount</th>
                                        <th>Transaction Fee</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($loop->index+1); ?></td>
                                            <td><?php echo e($transaction->pre_transaction_id); ?></td>
                                            <td><?php echo e($transaction->vendor); ?></td>
                                            <td><?php echo e($transaction->amount); ?></td>
                                            <td><?php echo e($transaction->fee ?? 0); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php echo e($transactions->appends(request()->query())->links()); ?>

                                <div class="">
                                    <div class="col-md-4" style="float: right">

                                        <form id="excelClearance" action="<?php echo e(route('clearance.generate')); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="from" value="<?php echo e($_GET['from'] ?? ""); ?>">
                                            <input type="hidden" name="to" value="<?php echo e($_GET['to'] ?? ""); ?>">
                                            <input type="hidden" name="transaction_event_transaction_type" value="<?php echo e($_GET['transaction_event_transaction_type'] ?? ""); ?>">

                                            <div class="input-group date">
                                                <div class="custom-file" style="margin-right: 19px;">
                                                    <input name="file" id="logo1" type="file" class="custom-file-input" accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                                    <label for="logo1" class="custom-file-label">Upload excel file&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                            <br>
                                            <button id="print" type="submit" class="btn btn-primary" formtarget="_blank" style="float: right; margin-right: 17px;">Clear All Transactions</button>
                                            <button id="printReport" type="submit" class="btn btn-primary clear" formtarget="_blank" rel="<?php echo e(route('clearance.generate')); ?>" style="display: none"></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>


    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.sweetalert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $('#print').on('click', function (e) {

            let excel = $('#logo1').val();

            if(!excel) {
                alert('please import an excel file!');
                e.preventDefault();
                return;
            }

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "All the listed transaction will be cleared",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, clear Transactions!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#printReport').trigger('click');
                $('#print').hide();
                $('#excelClearance').hide();
                swal.close();

            })
        });
    </script>

    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>

    <script>
        <?php if(!empty($_GET)): ?>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($transactions->firstItem()); ?> to <?php echo e($transactions->lastItem()); ?> of <?php echo e($transactions->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
        <?php endif; ?>
    </script>

<?php $__env->stopSection(); ?>







<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/TransactionClearance/resources/views/clearance/transactionList.blade.php ENDPATH**/ ?>