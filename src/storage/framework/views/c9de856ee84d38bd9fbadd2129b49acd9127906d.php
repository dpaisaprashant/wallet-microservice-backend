<?php if(strtoupper($transaction->status) == 'SUCCESS'): ?>
    <?php if(isset($transaction->transactionEvent)): ?>
        <?php if($transaction->transactionEvent->refundTransaction): ?>
            <span class="badge badge-inverse"><?php echo e(strtoupper("Success Tran. DISPUTE & REFUNDED")); ?></span>
        <?php else: ?>
            <span class="badge badge-primary"><?php echo e(strtoupper($transaction->status)); ?></span>
        <?php endif; ?>
    <?php endif; ?>
<?php elseif(strtoupper($transaction->status) == 'FAILED'): ?>
    <?php if(isset($transaction->refundTransaction)): ?>
        <span class="badge badge-inverse"><?php echo e(strtoupper("Failed Tran. DISPUTE & REFUNDED")); ?></span>
    <?php else: ?>
        <span class="badge badge-danger"><?php echo e(strtoupper($transaction->status)); ?></span>
    <?php endif; ?>
<?php else: ?>
    <span class="badge badge-warning">NO RESPONSE</span>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/transaction/preTransaction/status.blade.php ENDPATH**/ ?>