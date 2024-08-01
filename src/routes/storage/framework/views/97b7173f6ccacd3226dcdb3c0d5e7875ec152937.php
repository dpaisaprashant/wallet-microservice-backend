<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Backend Logs</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Logs</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Backend Logs</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Backend Logs</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content"
                         <?php if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ): ?> style="display: none" <?php endif; ?>>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="<?php echo e(route('backendLog.all')); ?>">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="log_name" placeholder="Log Name"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['log_name']) ? $_GET['log_name'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or Number"
                                                       class="form-control"
                                                       value="<?php echo e(!empty($_GET['user']) ? $_GET['user'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit">
                                            <strong>Filter</strong></button>
                                    </div>
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
                        <h5>List of Backend logs</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Backend logs">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Log Name</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>New Properties</th>
                                    <th>Old Properties</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="gradeC">
                                        <td><?php echo e($loop->index + ($logs->perPage() * ($logs->currentPage() - 1)) + 1); ?></td>
                                        <td>
                                            <?php echo e($log->log_name); ?>

                                        </td>
                                        <td>
                                            <?php echo e($log->description); ?>

                                        </td>
                                        <td>
                                            <?php echo e($log->causer['email']); ?>

                                        </td>

                                        <td class="center"><?php echo e($log->created_at); ?></td>

                                        <td class="center"><?php echo e($log->updated_at); ?></td>

                                        <td>
                                            <a data-toggle="modal" href="#modal-form-new<?php echo e($log->id); ?>">
                                                <button class="btn btn-warning btn-icon" type="button"><i
                                                        class="fa fa-info"></i></button>
                                            </a>
                                            <div id="modal-form-new<?php echo e($log->id); ?>" class="modal fade"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h3 class="m-t-none m-b">NEW PROPERTIES</h3>
                                                                    <hr>
                                                                    <dl class="row m-t-md">
                                                                        <?php $properties = json_decode($log->properties, true); ?>
                                                                        <?php if(isset($properties['attributes'])): ?>
                                                                            <?php $__currentLoopData = $properties['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <dt class="col-md-6 text-right"><?php echo e($key); ?></dt>
                                                                                <dd class="col-md-6"><?php echo e($value); ?></dd>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php endif; ?>
                                                                    </dl>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <?php if(isset($properties['old'])): ?>
                                                <a data-toggle="modal" href="#modal-form-old<?php echo e($log->id); ?>">
                                                    <button class="btn btn-warning btn-icon" type="button"><i
                                                            class="fa fa-info"></i></button>
                                                </a>
                                                <div id="modal-form-old<?php echo e($log->id); ?>" class="modal fade"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <h3 class="m-t-none m-b">OLD PROPERTIES</h3>
                                                                        <hr>
                                                                        <dl class="row m-t-md">
                                                                            <?php $properties = json_decode($log->properties, true); ?>
                                                                            <?php if(isset($properties['old'])): ?>
                                                                                <?php $__currentLoopData = $properties['old']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <dt class="col-md-6 text-right"><?php echo e($key); ?></dt>

                                                                                    <dd class="col-md-6"><?php echo e($value); ?></dd>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php endif; ?>
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <?php echo e($logs->appends(request()->query())->links()); ?>

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
    <script>
        $(document).ready(function (e) {
            let a = "Showing <?php echo e($logs->firstItem()); ?> to <?php echo e($logs->lastItem()); ?> of <?php echo e($logs->total()); ?> entries";
            $('.dataTables_info').text(a);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/logs/backendLogs/all.blade.php ENDPATH**/ ?>