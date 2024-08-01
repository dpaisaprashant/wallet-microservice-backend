<?php if(session('success')): ?>
    <div class="col-md-12">
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?php echo e(session('success')); ?>

        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/asset/notification/success.blade.php ENDPATH**/ ?>