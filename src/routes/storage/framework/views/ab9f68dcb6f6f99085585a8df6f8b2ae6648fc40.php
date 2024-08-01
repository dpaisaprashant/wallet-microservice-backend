<?php $__env->startSection('content'); ?>
       
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all blogs</h5>

                            <div class="ibox-tools" style="top: 8px;">
                                <a class="btn btn-primary" href="<?php echo e(route('blog.post_form')); ?>"> <i class="fa fa-plus-circle"></i> Add New
                                    Post</a>
                            </div>

                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Author</th>
                                            <th>Featured image</th>
                                            <th>Tag</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($value->title); ?></td>
                                                <td><?php echo $value->description; ?></td>
                                                <td><?php echo e($value->author); ?></td>
                                                <td><img src="<?php echo e(asset('storage/' . $value->image)); ?>" alt="Post's Image" style="width: 600px; height: 200px;">
                                                </td>
                                                <?php $__currentLoopData = $value->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <td><?php echo e($tag->name); ?></td>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <td><?php echo e($value->types->name); ?></td>
                                                <td><a href="<?php echo e(route('changeStatus', $value->id)); ?>" class="btn btn-default"><?php echo e($value->status); ?></a></td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="<?php echo e(route('edit-post', $value->id)); ?>"><button
                                                                type="button" class="btn btn-primary">Edit</button></a>
                                                        <a href="<?php echo e(route('delete-post', $value->id)); ?>"><button
                                                                type="button" class="btn btn-danger">Delete</button></a>
                                                    </div>
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

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/blog/post.blade.php ENDPATH**/ ?>