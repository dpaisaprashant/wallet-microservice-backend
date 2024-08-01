<?php if(strtoupper($transaction->debit_response_message) == 'SUCCESS'): ?>
    <span class="badge badge-primary"><?php echo e(strtoupper($transaction->debit_response_message)); ?></span>
<?php elseif(empty($transaction->debit_response_message)): ?>
    <span class="badge badge-warning">NOT COMPLETED</span>
<?php elseif(strtoupper($transaction->debit_response_message) == 'ERROR'): ?>
    <span class="badge badge-danger"><?php echo e($transaction->debit_response_message); ?></span>
<?php else: ?>
    <span class="badge badge-warning"><?php echo e($transaction->debit_response_message); ?></span>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/transaction/nchlBankTransfer/debitStatus.blade.php ENDPATH**/ ?>