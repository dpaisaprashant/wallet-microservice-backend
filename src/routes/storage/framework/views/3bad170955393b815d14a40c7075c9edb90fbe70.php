<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>User Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong><?php echo e($user->name); ?>'s transaction</strong>
                </li>
            </ol>
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

                    <div class="ibox-content" <?php if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ): ?> style="display: none"  <?php endif; ?>>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <input type="hidden" name="user" placeholder="Email or Number" class="form-control" value="<?php echo e($user->mobile_no); ?>">

                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="uid" placeholder="User Transaction ID" class="form-control" value="<?php echo e(!empty($_GET['uid']) ? $_GET['uid'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="<?php echo e(!empty($_GET['transaction_id']) ? $_GET['transaction_id'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Vendor...." class="chosen-select"  tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>
                                                    <?php if(!empty($_GET['vendor'])): ?>
                                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($vendor); ?>" <?php if($_GET['vendor']  == $vendor): ?> selected <?php endif; ?> ><?php echo e($vendor); ?></option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($vendor); ?>"  ><?php echo e($vendor); ?></option>
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

                                    <div class="row">
                                        <div class="col-md-6" style="margin-top: 40px;">
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
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('user.transaction', $user->id)); ?>"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="<?php echo e(route('user.transaction.complete.excel')); ?>"><strong>Excel</strong></button>
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
                        <h5>List of <?php echo e($user->name); ?>'s transactions</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>UID</th>
                                    <th>Transaction ID</th>
                                    <th>User</th>
                                    <th>Vendor</th>
                                    <th>Service Type</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeC">
                                        <td><?php echo e($loop->index + ($transactions->perPage() * ($transactions->currentPage() - 1)) + 1); ?></td>
                                        <td><?php echo e($transaction->uid); ?></td>
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
                                            <?php echo e($transaction->user['mobile_no']); ?>

                                        </td>
                                        <td>
                                            <?php echo e($transaction->vendor); ?>

                                        </td>
                                        <td>
                                            <?php echo e($transaction->service_type); ?>

                                        </td>
                                        <td class="center">Rs. <?php echo e($transaction->amount); ?></td>
                                        <td>
                                            <span class="badge badge-primary">Colmplete</span>
                                        </td>
                                        <td class="center"><?php echo e($transaction->created_at); ?></td>
                                        <td>
                                            <?php if($transaction->transaction_type == 'App\Models\UserToUserFundTransfer'): ?>
                                                <?php echo $__env->make('admin.transaction.fundTransfer.detail', ['transaction' => $transaction->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <a href="<?php echo e(route('userToUserFundTransfer.detail', $transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                                            <?php elseif($transaction->transaction_type == 'App\Models\UserLoadTransaction'): ?>

                                                <?php echo $__env->make('admin.transaction.npay.detail', ['transaction' => $transaction->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <a href="<?php echo e(route('eBanking.detail', $transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                                            <?php elseif($transaction->transaction_type == 'App\Models\UserTransaction'): ?>

                                                <?php echo $__env->make('admin.transaction.paypoint.detail', ['transaction' => $transaction->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <a href="<?php echo e(route('paypoint.detail', $transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                                            <?php elseif($transaction->transaction_type == 'App\Models\FundRequest'): ?>

                                                <?php echo $__env->make('admin.transaction.fundRequest.detail', ['transaction' => $transaction->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                <a href="<?php echo e(route('fundRequest.detail', $transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                                            <?php endif; ?>
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
    <link href="<?php echo e(asset('admin/css/plugins/dataTables/datatables.min.css')); ?>" rel="stylesheet">

    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style>
        .pagination{
            padding-top: -20px;
            padding-left: 15px;
            padding-bottom: 200px;
        }

        .dataTables_wrapper{
            padding-bottom: 5px;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

   <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <script src="<?php echo e(asset('admin/js/plugins/dataTables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')); ?>"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                paginate: false,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Transactions of <?php echo e($user['mobile_no']); ?> account'},
                    {extend: 'pdf', title: 'Transactions of <?php echo e($user['mobile_no']); ?> account'},
                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });
        });

    </script>

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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/user/transaction.blade.php ENDPATH**/ ?>