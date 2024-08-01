<?php $__env->startSection('content'); ?>

<form method="POST" action="<?php echo e(route('store-notification')); ?>">
    <?php echo csrf_field(); ?>

    <div class="form-group">
        <label for="token">Token:</label>
        <textarea id="token" name="token" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="message">Message:</label>
        <textarea id="message" name="message" class="form-control" required></textarea>
    </div>

    <button type="submit">Save</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/appNotification/notification.blade.php ENDPATH**/ ?>