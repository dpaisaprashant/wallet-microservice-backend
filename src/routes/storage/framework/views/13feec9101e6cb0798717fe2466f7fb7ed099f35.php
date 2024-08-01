<?php $__env->startSection('content'); ?>
       
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all feedbacks from customers</h5>



                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
                                    <thead>
                                        <tr>
                                            <th>Services</th>
                                            <th>Description</th>
                                            <th>Suppporting image</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($feedback->services); ?></td>
                                                <td><?php echo e($feedback->description); ?></td>
                                                <td><?php echo e($feedback->image); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
<?php $__env->stopSection(); ?>
<?php if(session('status')): ?>
    <script>
        alert('<?php echo e(session('status')); ?>');
    </script>
<?php endif; ?>

<?php if(session('success')): ?>
  <script>
      alert('<?php echo e(session('success')); ?>');
  </script> 
<?php endif; ?>   

<?php if(session('error')): ?>
  <script>
      alert('<?php echo e(session('error')); ?>');
  </script> 
<?php endif; ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/feedback/feedback.blade.php ENDPATH**/ ?>