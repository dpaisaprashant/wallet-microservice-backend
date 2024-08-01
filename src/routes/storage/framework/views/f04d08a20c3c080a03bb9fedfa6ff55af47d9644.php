<?php $__env->startSection('content'); ?>
    <div class="wrapper wrapper-content">
        
        <h2 style="margin-top: -15px; margin-left: 5px;">Yesterday (Date: <?php echo e(\Carbon\Carbon::yesterday()->format('Y-m-d')); ?>)</h2>
        <div class="row">
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-success float-right">Total</span>
                        <h5>PayPoint Transaction Count</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo e($stats['yesterday']['transaction']['count']); ?> </h1>
                        <small>Sum of PayPoint dispute transactions</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-success float-right">Total</span>
                        <h5>PayPoint Transaction Amount</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Rs. <?php echo e($stats['yesterday']['transaction']['amount']); ?> </h1>
                        <small>Sum of PayPoint Transactions </small>
                    </div>
                </div>
            </div>


            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-danger float-right">Total</span>
                        <h5>Pending Dispute Count</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Rs. <?php echo e($stats['yesterday']['pendingDispute']['count']); ?></h1>
                        <small>Number of PayPoint dispute transactions</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-danger float-right">Total</span>
                        <h5>Pending Dispute Amount</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Rs. <?php echo e($stats['yesterday']['pendingDispute']['amount']); ?></h1>
                        <small>Sum of PayPoint dispute transactions </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-primary float-right">Total</span>
                        <h5>Resolved Dispute Count</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Rs. <?php echo e($stats['yesterday']['resolvedDispute']['count']); ?></h1>
                        <small>Number of PayPoint resolved transactions</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-primary float-right">Total</span>
                        <h5>Resolved Dispute Amount</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Rs. <?php echo e($stats['yesterday']['resolvedDispute']['amount']); ?></h1>
                        <small>Sum of PayPoint resolved transactions </small>
                    </div>
                </div>
            </div>

        </div>

        
        <h2 style="margin-top: -20px; margin-left: 5px;">Today (Date: <?php echo e(\Carbon\Carbon::today()->format('Y-m-d')); ?>)</h2>
        <div class="row">
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-success float-right">Total</span>
                        <h5>PayPoint Transaction Count</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins"><?php echo e($stats['today']['transaction']['count']); ?> </h1>
                        <small>Sum of PayPoint dispute transactions</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-success float-right">Total</span>
                        <h5>PayPoint Transaction Amount</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Rs. <?php echo e($stats['today']['transaction']['amount']); ?> </h1>
                        <small>Sum of PayPoint Transactions </small>
                    </div>
                </div>
            </div>


            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-danger float-right">Total</span>
                        <h5>Pending Dispute Count</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Rs. <?php echo e($stats['today']['pendingDispute']['count']); ?></h1>
                        <small>Number of PayPoint dispute transactions</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-danger float-right">Total</span>
                        <h5>Pending Dispute Amount</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Rs. <?php echo e($stats['today']['pendingDispute']['amount']); ?></h1>
                        <small>Sum of PayPoint dispute transactions </small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-primary float-right">Total</span>
                        <h5>Resolved Dispute Count</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Rs. <?php echo e($stats['today']['resolvedDispute']['count']); ?></h1>
                        <small>Number of PayPoint resolved transactions</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px">
                        <span class="label label-primary float-right">Total</span>
                        <h5>Resolved Dispute Amount</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">Rs. <?php echo e($stats['today']['resolvedDispute']['amount']); ?></h1>
                        <small>Sum of PayPoint resolved transactions </small>
                    </div>
                </div>
            </div>

        </div>

        
        <div class="row">
            
            <div class="col-lg-8">

                <div class="ibox" style="margin-bottom: 10px;">
                    <div class="ibox-title" style="padding-right: 15px">
                        <h5>Pending Disputes</h5>
                        <div class="ibox-content" style="height: 20vh">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" title="NPay transactions list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Transaction Date</th>
                                        <th>Dispute Date</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $disputes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dispute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="gradeC">
                                            <td><?php echo e($loop->index + 1); ?></td>
                                            <td><?php echo e($dispute->disputeable->created_at); ?></td>
                                            <td>
                                                <?php echo e($dispute->created_at); ?>

                                            </td>
                                            <td>
                                                <span class="badge badge-warning">PENDING</span>
                                            </td>
                                            <td>
                                                Rs. <?php echo e($dispute->disputeable->amount); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ibox">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <h5>Clearance</h5>
                        <div class="ibox-content" style="height: 20vh">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" title="NPay transactions list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Clearance Date</th>
                                        <th>Transaction Count</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $clearances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clearance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="gradeC">
                                            <td><?php echo e($loop->index + 1); ?></td>
                                            <td><?php echo e($clearance->created_at); ?></td>
                                            <td>
                                                <?php echo e(count($clearance->clearanceTransactions)); ?>

                                            </td>
                                            <td>
                                                <?php echo $__env->make('admin.clearance.status', ['clearanceTransactions' => $clearance->clearanceTransactions], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </td>
                                            <td>
                                                Rs. <?php echo e($clearance->total_transaction_amount); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>

                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 id="graphTitlePaypoint">PayPoint Vendors Graph</h5>
                    </div>
                    <div class="ibox-content" id="graph-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="flot-chart" id="vendors" style="height: 45vh; margin-left: 35px;">
                                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <style>
        #graph-content {
            padding: 0px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        let vendorData = <?php echo $graph; ?>;
        let keys = Object.keys(vendorData);
        let values = Object.values(vendorData);

        let options = {
            series: values,
            chart: {
                width: 500,
                type: 'pie',
            },
            labels: keys,
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 500
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chart = new ApexCharts(document.querySelector("#flot-dashboard-chart"), options);
        chart.render();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.dashboard.stats.dashboardDesign', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/dashboard/stats/paypoint.blade.php ENDPATH**/ ?>