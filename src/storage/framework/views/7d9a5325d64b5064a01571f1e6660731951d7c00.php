
<div role="tabpanel" id="wallet" class="tab-pane">
    <div class="panel-body">
        <dl class="row m-t-md">

            <dt class="col-md-3 text-right">Total Balance</dt>
            <dd class="col-md-8">Rs. <?php echo e($user->wallet->balance); ?></dd>

            <dt class="col-md-3 text-right">Bonus Amount</dt>
            <dd class="col-md-8">Rs. <?php echo e($user->wallet->bonus_balance); ?></dd>

            <dt class="col-md-3 text-right">Bonus Points</dt>
            <dd class="col-md-8"><?php echo e($userBonus); ?></dd>

            <dt class="col-md-3 text-right">Last transaction</dt>
            <dd class="col-md-8"><?php echo e(date('M d, Y', strtotime($user->wallet->updated_at))); ?></dd>

        </dl>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/wallet.blade.php ENDPATH**/ ?>