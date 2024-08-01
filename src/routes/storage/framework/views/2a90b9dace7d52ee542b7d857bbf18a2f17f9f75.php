<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Active Inactive User Report (New Changes)</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Active Inactive User Report</strong>
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
                                <form role="form" method="get" action="<?php echo e(route('report.active.inactive.user')); ?>"
                                      id="filter">
                                    <br>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Select Date</label>
                                        <div class="col-5">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text"
                                                       class="form-control date_from" placeholder="From"
                                                       name="from" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>"
                                                       required>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <br>



                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="<?php echo e(route('report.active.inactive.user.new')); ?>">
                                            <strong>Generate Report</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="<?php echo e(route('report.active.inactive.user.excel.new')); ?>">
                                            <i class="fa fa-table" aria-hidden="true"></i>
                                            <strong>Export to Excel</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <a class="btn btn-sm btn-warning float-right m-t-n-xs"
                                           style="margin-right: 10px;"
                                           href="<?php echo e(route('report.active.inactive.user.generated.new')); ?>">
                                            <strong><i class="fa fa-bar-chart"></i>&nbsp; View Generated
                                                Reports</strong></a>
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
                            <h5>List Generated for Active/Inactive User Report for date <?php echo e(request()->from); ?></h5>
                        </div>
                        <div class="ibox-content">
                            <div><b>Total Users : </b><?php echo e($totalUsers??0); ?></div>
                            <div><b>Total Balance : </b>Rs. <?php echo e(round($totalBalance??0,2)); ?></div>
                            <div><b>Opening Balance : </b>Rs. <?php echo e(round($openingBalance??0,2)); ?></div>
                            <div><b>(Active + Inactive) - Opening Balance : </b>Rs. <?php echo e($shouldBeZero??0); ?></div>

                            <br>
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover "
                                       title="active inactive list">
                                    <?php if(!is_array($activeInactiveUserReports)): ?>
                                        <div class="alert alert-warning">
                                            <i class="fa fa-info-circle"></i>
                                            <?php echo e($activeInactiveUserReports); ?>

                                        </div>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $activeInactiveUserReports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $title => $reports): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <thead>
                                            <tr class="gradeX">
                                                <td colspan="2"><h2><strong><b><?php echo e($title); ?></b></strong></h2></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(is_array($reports)): ?>
                                                <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reportTitle => $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="gradeX">
                                                        <td style="font-size: 16px">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo e($reportTitle); ?></strong>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <?php if(is_array($report)): ?>
                                                        <?php $__currentLoopData = $report; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valueTitle => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr class="gradeX">
                                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <strong><?php echo e($valueTitle); ?>: </strong>
                                                                </td>
                                                                <td><?php echo e($value); ?></td>
                                                            </tr>

                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            </tbody>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php endif; ?>
                                </table>
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
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Report/resources/views/nrb/active-inactive-user-report-new.blade.php ENDPATH**/ ?>