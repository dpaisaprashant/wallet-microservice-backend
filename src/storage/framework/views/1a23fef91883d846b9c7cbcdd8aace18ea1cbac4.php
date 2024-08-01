<?php if($agent->status === \App\Models\Agent::STATUS_PROCESSING): ?>
    <span class="badge badge-warning">Processing</span>
<?php elseif($agent->status === \App\Models\Agent::STATUS_REJECTED): ?>
    <span class="badge badge-danger">Rejected</span>
<?php elseif($agent->status == \App\Models\Agent::STATUS_ACCEPTED): ?>
    <span class="badge badge-primary">Accepted</span>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/agent/status.blade.php ENDPATH**/ ?>