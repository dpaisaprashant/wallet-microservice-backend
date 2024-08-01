<?php if(!empty($transaction->userExecutePayment) || count($transaction->userExecutePayment) !== 0): ?>

    <?php $__currentLoopData = $transaction->userExecutePayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $execute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($execute->code == 000): ?>
            <?php $color = 'primary' ?>
            <span class="badge badge-primary">complete</span>
        <?php else: ?>
            <?php $color = 'danger' ?>
            <span class="badge badge-danger">failed</span>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if(count($transaction->userExecutePayment) === 0): ?>
        <?php $color = 'danger' ?>
        <span class="badge badge-danger">failed</span>
    <?php endif; ?>

<?php else: ?>
    <?php $color = 'danger' ?>
    <span class="badge badge-danger">failed</span>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/transaction/paypoint/status.blade.php ENDPATH**/ ?>