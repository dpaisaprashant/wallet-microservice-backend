<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Agent Types</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent Types</strong>
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
                    <div class="ibox-title">
                        <h5>List of agent types</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Agent type's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Agent Types</th>
                                    <th>Sub Agent of</th>
                                    
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $agentTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                        <td><?php echo e($loop->index + ($agentTypes->perPage() * ($agentTypes->currentPage() - 1)) + 1); ?></td>
                                        <td>
                                            <?php echo e($type->name); ?>

                                        </td>
                                        <td>
                                            <?php echo e(optional($type->parentAgentType)->name); ?>

                                        </td>
                                        


                                        <td class="center">
                                           

                                            <a href="<?php echo e(route('agent.type.limit', $type->id)); ?>" style="margin-top: 5px;"
                                               title="Limit"
                                               class="btn btn-sm btn-icon btn-info m-t-n-xs"
                                            ><i class="fa fa-file"></i></a>

                                            <a href="<?php echo e(route('agent.type.update', $type)); ?>" style="margin-top: 5px;"
                                               title="Edit"
                                               class="btn btn-sm btn-icon btn-success m-t-n-xs"
                                            ><i class="fa fa-pencil"></i></a>

                                            <form action="<?php echo e(route('agent.type.delete', $type->id)); ?>" method="post" style="display: inline-block">
                                                <?php echo csrf_field(); ?>
                                                <button style="margin-top: 5px; display: inline-block"
                                                        class="reset btn btn-sm btn-icon btn-danger m-t-n-xs"
                                                        rel="<?php echo e($type->id); ?>"><i class="fa fa-trash"></i></button>
                                                <button id="resetBtn-<?php echo e($type->id); ?>" style="display: none"
                                                        type="submit"><strong>Reset Password</strong></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($agentTypes->appends(request()->query())->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>


    <?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function (e) {

            let a = "Showing <?php echo e($agentTypes->firstItem()); ?> to <?php echo e($agentTypes->lastItem()); ?> of <?php echo e($agentTypes->total()); ?> entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        let walletAmount = <?php if(!empty($_GET['wallet_balance'])): ?> `<?php echo e($_GET['wallet_balance']); ?>`;
        <?php else: ?> '0;100000'; <?php endif; ?>
        let split = walletAmount.split(';');


        $(".ionrange_wallet_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = <?php if(!empty($_GET['transaction_payment'])): ?> `<?php echo e($_GET['transaction_payment']); ?>`;
        <?php else: ?> '0;100000';
        <?php endif; ?>
            split = walletAmount.split(';');

        $(".ionrange_payment_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = <?php if(!empty($_GET['transaction_loaded'])): ?> `<?php echo e($_GET['transaction_loaded']); ?>`;
        <?php else: ?> '0;100000';
        <?php endif; ?>
            split = walletAmount.split(';');

        $(".ionrange_loaded_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });


        walletAmount = <?php if(!empty($_GET['transaction_number'])): ?> `<?php echo e($_GET['transaction_number']); ?>`;
        <?php else: ?> '0;1000';
        <?php endif; ?>
            split = walletAmount.split(';');

        $(".ionrange_number").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: split[0],
            to: split[1],
        });


    </script>

    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "This user will be removed from agent",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, remove",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/agentType/view.blade.php ENDPATH**/ ?>