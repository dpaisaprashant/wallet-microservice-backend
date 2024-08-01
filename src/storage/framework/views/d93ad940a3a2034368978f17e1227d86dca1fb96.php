<?php if($user->userType !=null): ?>
    <span
        class="badge badge-success">User type : <?php echo e(optional($user->userType)->name); ?></span><br>
<?php endif; ?>

<?php if($user->merchant != null): ?>
    <?php if(optional($user->merchant->merchantType)->name == "normal"): ?>
        <span class="badge badge-primary">Merchant type : <?php echo e(optional($user->merchant->merchantType)->name); ?></span>
        <?php elseif(optional($user->merchant->merchantType)->name == "reseller"): ?>
        <span class="badge badge-danger">Merchant type : <?php echo e(optional($user->merchant->merchantType)->name); ?></span>
    <?php endif; ?>
    <br>
<?php endif; ?>
<?php if($user->agent != null && $user->isValidAgentOrSubAgent()): ?>
    <span class="badge badge-danger">Agent type :
        <?php if($user->agent != null): ?>
            <?php echo e(optional($user->agent->agentType)->name); ?>

        <?php endif; ?>
    </span>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/user/userType/displayUserTypes.blade.php ENDPATH**/ ?>