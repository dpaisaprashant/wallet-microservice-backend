<?php $__env->startSection('content'); ?>

    <body>
        <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js" ></script>
        <style>
            .ck-editor__editable {
                    min-height: 100px;
                }
        </style>
        <div class="ibox-content">

            <h2>Add Job</h2>
            <form action="<?php echo e(route('store-job')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" name="title" value="<?php echo e(old('title')); ?>">
                    <?php $__errorArgs = ['title'];
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

                <div class="form-group">
                    <label for="opening">No. of Opening</label>
                    <input type="text" class="form-control" id="opening" placeholder="Openings" name="opening" value="<?php echo e(old('opening')); ?>">
                    <?php $__errorArgs = ['opening'];
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

                <div class="form-group">
                    <label for="domain">Domain</label>
                    <select name="domain" id="domain" class="form-control">
                        <option value="">Select Domain</option>
                        <option value="Information Technology">Information Technology</option>
                    </select>                    
                    <?php $__errorArgs = ['domain'];
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

                <div class="form-group">
                    <label for="image">Location</label>
                    <select name="location" id="location" class="form-control">
                        <option value="">Select Location</option>
                        <option value="New Baneshwor">New Baneshwor</option>
                    </select>
                    <?php $__errorArgs = ['location'];
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

                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" class="form-control" id="salary" placeholder="Salary" name="salary" value="<?php echo e(old('salary')); ?>">

                    <?php $__errorArgs = ['salary'];
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

                <div class="form-group">
                    <label for="description">Job description</label>
                   <textarea class="form-control" id="description" placeholder="Job Description" rows="3" name="description"><?php echo e(old('description')); ?></textarea>
                    <?php $__errorArgs = ['description'];
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

                <div class="form-group">
                    <label for="specification">Job Specification</label>
                   <textarea class="form-control" id="specification" placeholder="Job Specification" rows="3" name="specification"><?php echo e(old('specification')); ?></textarea>
                    <?php $__errorArgs = ['specification'];
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
                <div>
                    <button class="btn btn-primary">Send</button>
                </div>

        </form>
       <script>
        const names=['description', 'specification']
        names.forEach(name=> {
            ClassicEditor
                .create(document.querySelector(`[name="${name}"]`))
                .catch(error => {
                    console.error(error);
                });
                });
        </script>
    <br>
    <?php $__env->stopSection(); ?>


</body>

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

<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/career/add_job.blade.php ENDPATH**/ ?>