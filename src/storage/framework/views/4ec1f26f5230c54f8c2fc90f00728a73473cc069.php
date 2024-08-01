<?php $__env->startSection('content'); ?>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <style>
        .ck-editor__editable {
            min-height: 100px;
        }
    </style>
    <body>
        <div class="ibox-content">
            <h2>Form</h2>
            <form action="<?php echo e(route('update-post', $posts->id)); ?>" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title" name="title"
                        value="<?php echo e($posts->title); ?>">
                </div>
                 <div class="form-group">
                    <label for="title">Short-Title</label>
                    <input type="text" class="form-control" id="slug" placeholder="Short-Title" name="slug" value="<?php echo e($posts->slug); ?>">
                    <?php $__errorArgs = ['slug'];
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
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" placeholder="Description" name="description"><?php echo old('description', $posts->description); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" placeholder="Name" name="author"  
                        value="<?php echo e($posts->author); ?> ">
                </div>

                <div class="form-group">
                    <label for="image">Feature Image</label>
                    <input type="file" class="form-control" id="image" placeholder="Image" name="image">
                    <img src="<?php echo e(asset('storage/' . $posts->image)); ?>" alt="User Image">
                </div>

                <div class="form-group">
                    <label for="tag">Tag</label>
                    <select name="tag[]" id="tag" class="form-control" multiple>

                        <option value="">Select Tag</option>
                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tag->id); ?>" <?php echo e($tag->id == $posts->tag ? 'selected' : ''); ?>>
                                <?php echo e($tag->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type">
                        <option value="">Select Type</option>
                        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->id); ?>" <?php echo e($type->id == $posts->type ? 'selected' : ''); ?>>
                                <?php echo e($type->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status">
                        <option value="draft" <?php echo e($posts->status == 'draft' ? 'selected' : ''); ?>>Draft</option>
                        <option value="published" <?php echo e($posts->status == 'published' ? 'selected' : ''); ?>>Published</option>
                    </select>
                </div>
                <div>
                <button class="btn btn-primary">Send</button>
                </div>

        </form>
        </div>
        <script>
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error(error);
                });
        </script>
<br>
    <?php $__env->stopSection(); ?>
<script>
    $(document).ready(function() {
        $('#tag').select2();
    });
</script>
<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/blog/edit_post.blade.php ENDPATH**/ ?>