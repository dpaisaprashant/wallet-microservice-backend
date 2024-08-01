<?php if($transaction->response === 0 && $transaction->status == 1): ?>
    <span class="badge badge-danger">Rejected</span>
<?php elseif($transaction->response === 0 && $transaction->status === 0): ?>
    <span class="badge badge-warning">Pending</span>
<?php elseif($transaction->status == 1 && $transaction->response == 1): ?>
    <span class="badge badge-primary">Accepted</span>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/transaction/fundRequest/responseStatus.blade.php ENDPATH**/ ?>