<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NPay Transaction Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>NPay</strong>
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


                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
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
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('report.npay')); ?>"><strong>Generate Report</strong></button>
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
                <?php if(!empty($_GET['from']) && !empty($_GET['to'])): ?>
                    <div class="ibox ">
                    <div class="ibox-title">
                        <h5>NPay report from <?php echo e($_GET['from'] . ' to ' . $_GET['to']); ?></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Wallet user's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Service List</th>
                                    <th>Total Trans. count</th>
                                    <th>Total Trans. amount</th>
                                    <th>Transaction Fee %</th>
                                    <th>Total Transaction Fee amount</th>
                                    <th>Total Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $totalCount = 0;
                                $totalAmount = 0;
                                $totalTransactionFee = 0;
                                $finalTotalAmount = 0;
                                ?>
                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index +  1); ?></td>
                                        <td>
                                           <?php echo e($key); ?>

                                        </td>
                                        <td><?php echo e($service['count']); ?></td>

                                        <td>Rs. <?php echo e($service['amount']); ?></td>

                                        <td>---</td>

                                        <td>Rs. <?php echo e($service['transactionFee']); ?></td>

                                        <td>Rs. <?php echo e($service['totalAmount']); ?></td>
                                    </tr>
                                    <?php
                                        $totalCount = $totalCount + $service['count'];
                                        $totalAmount = $totalAmount + $service['amount'];
                                        $totalTransactionFee += $service['transactionFee'];
                                        $finalTotalAmount += $service['totalAmount']
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td><b>Total</b></td>
                                    <td><?php echo e($totalCount); ?></td>
                                    <td>Rs. <?php echo e($totalAmount); ?></td>
                                    <td></td>
                                    <td>Rs. <?php echo e($totalTransactionFee); ?></td>
                                    <td>Rs. <?php echo e($finalTotalAmount); ?></td>
                                </tr>
                                </tfoot>
                            </table>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>






<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/report/npay.blade.php ENDPATH**/ ?>