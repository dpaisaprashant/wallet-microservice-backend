<tr class="gradeC">
    <td><?php echo e($loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1); ?></td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td><?php echo e($date[0]); ?></td>
    <td><?php echo e($date[1]); ?></td>
    <td><?php echo e($event->pre_transaction_id == null ? '---' : $event->pre_transaction_id); ?></td>
    <td style="color: green; font-weight: bold">KYC FILLED</td>
    <td>---</td>
    <td>---</td>
    <td></td>
    <td>---</td>
    <td>Rs. <?php echo e($event->current_balance); ?></td>
    <td>Rs. <?php echo e($event->current_bonus_balance); ?></td>
    <td>
        <?php echo $__env->make('admin.user.kyc.detail', ['user' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </td>
</tr>
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/auditTrial/types/kycFilled.blade.php ENDPATH**/ ?>