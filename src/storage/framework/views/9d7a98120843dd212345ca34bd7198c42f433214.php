<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Admin Users</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>List of backend users</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Backend user list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Role</th>

                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="gradeX">
                                    <td><?php echo e($loop->index + ($users->perPage() * ($users->currentPage() - 1)) + 1); ?></td>
                                    <td>
                                        &nbsp;<?php echo e($user->name); ?>

                                    </td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->mobile_no); ?></td>
                                    <td class="center">
                                        <?php if(!empty($user->roles)): ?>
                                            <ul>
                                            <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($role->name); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </ul>
                                        <?php endif; ?>
                                    </td>
                                    <td class="center">

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Backend user update permission')): ?>
                                        <a href="<?php echo e(route('backendUser.permission', $user->id)); ?>" class="btn btn-sm btn-primary m-t-n-xs"><strong>Update permissions</strong></a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Backend user update role')): ?>
                                        <a href="<?php echo e(route('backendUser.role', $user->id)); ?>" class="btn btn-sm btn-info m-t-n-xs"><strong>Update Role</strong></a>
                                        <?php endif; ?>

                                            <br><br>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Backend user reset password')): ?>
                                        <form action="<?php echo e(route('backendUser.resetPassword')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <input id="resetValue" type="hidden" name="admin_id" value="<?php echo e($user->id); ?>">
                                            <button href="<?php echo e(route('backendUser.role', $user->id)); ?>" class="reset btn btn-sm btn-danger m-t-n-xs" rel="<?php echo e($user->id); ?>"><strong>Reset Password</strong></button>
                                            <button id="resetBtn-<?php echo e($user->id); ?>" style="display: none" type="submit" href="<?php echo e(route('backendUser.role', $user->id)); ?>"  class="resetBtn btn btn-sm btn-danger m-t-n-xs"><strong>Reset Password</strong></button>
                                        </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($users->appends(request()->query())->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "This user's password will be changed to 'password'",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, reset password",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>

    <?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($users->firstItem()); ?> to <?php echo e($users->lastItem()); ?> of <?php echo e($users->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/backendUser/view.blade.php ENDPATH**/ ?>