<?php if(strtoupper($NicTransaction->status) == 'SUCCESS'): ?>
    <span class="badge badge-primary"><?php echo e(strtoupper($NicTransaction->status)); ?></span>
<?php elseif(strtoupper($NicTransaction->status) == 'PROCESSING'): ?>
    <span class="badge badge-warning">PROCESSING</span>
<?php elseif(empty($NicTransaction->status)): ?>
    <span class="badge badge-warning">NOT COMPLETED</span>
<?php else: ?>
    <span class="badge badge-danger"><?php echo e($NicTransaction->status); ?></span>
<?php endif; ?>
<?php /**PATH /var/www/html/app/Wallet/NicAsia/resources/views/status.blade.php ENDPATH**/ ?>