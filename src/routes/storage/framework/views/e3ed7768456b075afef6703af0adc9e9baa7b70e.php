<tr class="gradeC">
    <td><?php echo e($loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1); ?></td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td><?php echo e($date[0]); ?></td>
    <td><?php echo e($date[1]); ?></td>
    <td><?php echo e($event->pre_transaction_id == null ? '---' : $event->pre_transaction_id); ?></td>
    <?php if($event->status == \App\Models\UsedUserReferral::STATUS_COMPLETE): ?>
    <td style="color: green; font-weight: bold">
        <?php if($user->id == $event->referred_from): ?>
            REFERRED FROM BONUS (user referred new user)
        <?php elseif($user->id == $event->referred_to): ?>
            REFERRED TO BONUS (user used referral code)
        <?php endif; ?>
    </td>
    <?php elseif($event->status == \App\Models\UsedUserReferral::STATUS_PROCESSING): ?>
        <td style="color: orangered; font-weight: bold">
            <?php if($user->id == $event->referred_from): ?>
                REFERRED FROM BONUS (user referred new user)
            <?php elseif($user->id == $event->referred_to): ?>
                REFERRED TO BONUS (user used referral code)
            <?php endif; ?>
        </td>
    <?php else: ?>
        <td style="color: red; font-weight: bold">
            <?php if($user->id == $event->referred_from): ?>
                REFERRED FROM BONUS (user referred new user)
            <?php elseif($user->id == $event->referred_to): ?>
                REFERRED TO BONUS (user used referral code)
            <?php endif; ?>
        </td>
    <?php endif; ?>
    <td>DPAISA</td>
    <td>
        <?php if($event->status == \App\Models\UsedUserReferral::STATUS_COMPLETE): ?>
            <span class="badge badge-primary"><?php echo e($event->status); ?></span>
        <?php elseif($event->status == \App\Models\UsedUserReferral::STATUS_PROCESSING): ?>
            <span class="badge badge-warning"><?php echo e($event->status); ?></span>
        <?php else: ?>
            <span class="badge badge-danger"><?php echo e($event->status); ?></span>
        <?php endif; ?>
    </td>
    <td></td>
    <?php if($event->status == \App\Models\UsedUserReferral::STATUS_COMPLETE): ?>
    <td style="color: green">
        <?php if($user->id == $event->referred_from): ?>
            Rs.<?php echo e($event->referred_from_amount); ?>

        <?php elseif($user->id == $event->referred_to): ?>
            Rs.<?php echo e($event->referred_to_amount); ?>

        <?php endif; ?>

    </td>
    <?php else: ?>
        <td>
            <?php if($user->id == $event->referred_from): ?>
                Rs.<?php echo e($event->referred_from_amount); ?>

            <?php elseif($user->id == $event->referred_to): ?>
                Rs.<?php echo e($event->referred_to_amount); ?>

            <?php endif; ?>

        </td>
    <?php endif; ?>
    <td>Rs. <?php echo e($event->current_balance); ?></td>
    <td>Rs. <?php echo e($event->current_bonus_balance); ?></td>
    <td>
        <?php echo $__env->make('admin.transaction.referral.detail', ['transaction' => $event], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </td>
</tr>
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/auditTrial/types/referral.blade.php ENDPATH**/ ?>