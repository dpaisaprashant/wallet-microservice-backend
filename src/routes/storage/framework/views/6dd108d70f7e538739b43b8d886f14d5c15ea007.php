<tr class="gradeC">
    <td><?php echo e($loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1); ?></td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td><?php echo e($date[0]); ?></td>
    <td><?php echo e($date[1]); ?></td>
    <td><?php echo e($event->pre_transaction_id == null ? '---' : $event->pre_transaction_id); ?></td>
    <td style="color: green; font-weight: bold">
        CASHBACK Id: <?php echo e($event->transactions['id']); ?>

        <?php if(optional($event->transactions)->cashbackPull): ?>
            <br>
            <span style="color: orange">Cashback pull pre transaction id: </span> <?php echo e($event->transactions->cashbackPull->pre_transaction_id); ?>

        <?php endif; ?>
    </td>
    <td><?php echo e($event->transactions['vendor']); ?></td>
    <td>
        <?php if(optional($event->transactions)->cashbackPull): ?>
            <span class="badge badge-inverse">CASHBACK PULLED</span>
        <?php else: ?>
            ---
        <?php endif; ?>
    </td>
    <td></td>
    <td style="color: green">
        Rs.<?php echo e($event->transactions['amount']); ?>

    </td>
    <td>Rs. <?php echo e($event->current_balance); ?></td>
    <td>Rs. <?php echo e($event->current_bonus_balance); ?></td>
    <td></td>
</tr>
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/auditTrial/types/cashback.blade.php ENDPATH**/ ?>