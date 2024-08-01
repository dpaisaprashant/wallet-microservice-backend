<?php $__env->startSection('content'); ?>
    <html>

    <body>
        <form action="<?php echo e(route('store-tag')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="d-flex">
                <div class="form-group mb-0 mr-2">
                    <label for="name">Enter Blog Tag:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter tag">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <button class="btn btn-primary align-self-end">Submit</button>
            </div>
        </form>

        <br>
        <h2>Tag-list</h2>
        <div class="ibox-content">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example"
                    title="General settings list">
                    <thead>
                        <tr>
                            <th>Tag</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td type="text"><?php echo e($tag->name); ?></td>
                                 
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="<?php echo e(route('edit-tag', $tag->id)); ?>"><button type="button"
                                                class="btn btn-primary">Edit</button></a>
                                        <a href="<?php echo e(route('delete-tag', $tag->id)); ?>"><button type="button"
                                                class="btn btn-danger">Delete</button></a>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>

    </html>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/blog/tag.blade.php ENDPATH**/ ?>