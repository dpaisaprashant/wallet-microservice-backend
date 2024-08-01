<?php $__env->startSection('content'); ?>
       
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all careers opportunities</h5>

                            <div class="ibox-tools" style="top: 8px;">
                                <a class="btn btn-primary" href=""> <i class="fa fa-plus-circle"></i> Add New
                                    Job</a>
                            </div>

                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>No. of opening</th>
                                            <th>Domain</th>
                                            <th>Location</th>
                                            <th>Salary</th>
                                            <th>Job Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            <tr>
                                                <td>gregt</td>
                                                <td>tgr</td>
                                                <td>trgtr</td>
                                                <td>ddd </td>
                                                <td>efe</td>
                                                <td>ferf</td>
                                               
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href=""><button
                                                                type="button" class="btn btn-primary">Edit</button></a>
                                                        <a href=""><button
                                                                type="button" class="btn btn-danger">Delete</button></a>
                                                    </div>
                                                </td>
                                            </tr>
                                   
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

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/career/career.blade.php ENDPATH**/ ?>