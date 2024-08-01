<?php if(empty($kyc)): ?>
    <span class="badge badge-danger">not filled</span>
<?php elseif($kyc->accept === null): ?>
    <span class="badge badge-warning">not verified</span>
<?php elseif($kyc->accept === 0): ?>
    <span class="badge badge-danger">kyc rejected</span>
<?php elseif($kyc->accept == 1): ?>
    <span class="badge badge-primary">verified</span>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/user/kyc/status.blade.php ENDPATH**/ ?>