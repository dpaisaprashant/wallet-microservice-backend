<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Agent Type</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent Type</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Agent Type</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Create Agent Type</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="col-md-12">
                            <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                        <form method="post" action="<?php echo e(route('agent.type.create')); ?>" enctype="multipart/form-data" id="transactionIdForm">
                            <?php echo csrf_field(); ?>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Agent Type</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Parent Agent</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="agent_type_id">
                                        <option value="" selected>Main Agent</option>
                                        <?php $__currentLoopData = $parentAgents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($agent->id); ?>"><?php echo e($agent->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>


                           

                            <div class="hr-line-dashed"></div>


                            <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Create Agent Type</strong></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/agentType/create.blade.php ENDPATH**/ ?>