<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Miracle-Info SMS List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>SMS</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        <div class="wrapper wrapper-content">
            
            <h2 style="margin-top: -5px; margin-left: 5px;">Miracle SMS Dashboard</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox ">
                        <div class="ibox-title" style="padding-right: 15px;">
                            <span class="label label-success float-right">Total</span>
                            <h5>Miracle-Info SMS Sent</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?php echo e($smsCount); ?></h1>
                            <small>Number of SMS sent </small>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="ibox ">
                        <div class="ibox-title" style="padding-right: 15px;">
                            <span class="label label-success float-right">Balance</span>
                            <h5>Miracle-Info SMS Balance</h5>
                        </div>
                        <div class="ibox-content">
                            <form action="<?php echo e(route('miracle-info.view')); ?>" method="post" style="display: inline">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-sm btn-primary"> Check balance</button>
                            </form>
                            <?php if($balance): ?>
                                <b><p style="padding-top: 5px"><?php echo e($balance); ?></p></b>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of SMS</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="SMS List">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Mobile Number</th>
                                    <th>Description</th>
                                    <th>Rate</th>
                                    <th>Created At</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index + 1); ?></td>
                                        <td>
                                            <?php echo e($message->mobile_no); ?>

                                        </td>
                                        <td>
                                            <?php echo e($message->description); ?>

                                        </td>
                                        <td class="center">
                                            <?php echo e($message->rate); ?>

                                        </td>
                                        <td class="center">
                                            <?php echo e($message->created_at); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($messages->appends(request()->query())->links()); ?>

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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($messages->firstItem()); ?> to <?php echo e($messages->lastItem()); ?> of <?php echo e($messages->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/MiracleInfoSms/resources/views/viewMiracleInfoSms.blade.php ENDPATH**/ ?>