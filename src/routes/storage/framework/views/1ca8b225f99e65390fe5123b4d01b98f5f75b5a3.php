<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Roles</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of roles</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Role</th>
                                    <th>Permissions</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeX">
                                    <td><?php echo e($loop->index + ($roles->perPage() * ($roles->currentPage() - 1)) + 1); ?></td>
                                    <td>
                                        &nbsp;<?php echo e($role->name); ?>

                                    </td>

                                    <td class="center">
                                        <?php if(!empty($role->permissions)): ?>
                                            <ul>
                                            <?php $__currentLoopData = $role->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <?php echo e($permission->name); ?>

                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </td>
                                    <td class="center">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Role edit')): ?>
                                        <a href="<?php echo e(route('role.edit', $role->id)); ?>" class="btn btn-sm btn-primary m-t-n-xs"><strong>Edit role</strong></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($roles->appends(request()->query())->links()); ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(asset('admin/css/plugins/dataTables/datatables.min.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('admin/css/plugins/chosen/bootstrap-chosen.css')); ?>" rel="stylesheet">

    <style>
        .chosen-container-single .chosen-single{
            height: 35px !important;
            border-radius: 0px;
        }

        .chosen-container-single .chosen-single span{
            margin-top: 5px;
            margin-left: 5px;
        }


        .pagination{
            padding-top: -20px;
            padding-left: 15px;
            padding-bottom: 200px;
        }

        .dataTables_wrapper{
            padding-bottom: 5px;
        }
    </style>

    <!-- Sweet Alert -->
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>


    <!-- Chosen -->
    <script src="<?php echo e(asset('admin/js/plugins/chosen/chosen.jquery.js')); ?>"></script>

    <script>
        $('.chosen-select').chosen({width: "100%"});
    </script>

    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>

    <script>
        $('.deactivate').click(function () {

            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "This user's profile will be deactivated",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, deactivate user!",
                closeOnConfirm: false
            }, function () {
                //window.location.href="";
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'post',
                    url: url,
                    data:{
                        user: 1
                    },
                    success:function (resp) {
                        console.log(resp);
                        location.reload()
                    }, error:function (resp) {
                        console.log(resp);
                    }
                });

            })
        });
    </script>


    <script src="<?php echo e(asset('admin/js/plugins/dataTables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js')); ?>"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                paging: false,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Role List'},
                    {extend: 'pdf', title: 'Role List'},

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

            let a = "Showing <?php echo e($roles->firstItem()); ?> to <?php echo e($roles->lastItem()); ?> of <?php echo e($roles->total()); ?> entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>

        let walletAmount = <?php if(!empty($_GET['wallet_balance'])): ?> `<?php echo e($_GET['wallet_balance']); ?>`; <?php else: ?> '0;100000'; <?php endif; ?>
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

        walletAmount = <?php if(!empty($_GET['transaction_payment'])): ?> `<?php echo e($_GET['transaction_payment']); ?>`; <?php else: ?> '0;100000'; <?php endif; ?>
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

        walletAmount = <?php if(!empty($_GET['transaction_loaded'])): ?> `<?php echo e($_GET['transaction_loaded']); ?>`; <?php else: ?> '0;100000'; <?php endif; ?>
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


        walletAmount = <?php if(!empty($_GET['transaction_number'])): ?> `<?php echo e($_GET['transaction_number']); ?>`; <?php else: ?> '0;1000'; <?php endif; ?>
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
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/role/view.blade.php ENDPATH**/ ?>