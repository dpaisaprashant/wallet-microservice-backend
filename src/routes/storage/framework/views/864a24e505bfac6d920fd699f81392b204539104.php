<?php if(session('error')): ?>
    <div class="col-md-12">
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?php echo e(session('error')); ?>

        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/asset/notification/error.blade.php ENDPATH**/ ?>