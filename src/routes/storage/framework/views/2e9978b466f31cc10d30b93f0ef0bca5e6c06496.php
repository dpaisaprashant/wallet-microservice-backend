<?php if($event->status == \App\Models\Merchant\MerchantEvent::STATUS_PROCESSING): ?>
    <span class="badge badge-warning"><?php echo e($event->status); ?></span>
<?php elseif($event->status == \App\Models\Merchant\MerchantEvent::STATUS_ACCEPTED): ?>
    <span class="badge badge-primary"><?php echo e($event->status); ?></span>
<?php else: ?>
    <span class="badge badge-danger"><?php echo e($event->status); ?></span>
<?php endif; ?>
<?php /**PATH /var/www/html/app/Wallet/Merchant/resources/views/merchantEvent/status.blade.php ENDPATH**/ ?>