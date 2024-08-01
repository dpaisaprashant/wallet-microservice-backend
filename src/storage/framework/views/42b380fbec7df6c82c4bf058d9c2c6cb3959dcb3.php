<?php if(!empty($preTransaction)): ?>
<a data-toggle="modal" href="#Specials<?php echo e($preTransaction->id); ?>"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
<div id="Specials<?php echo e($preTransaction->id); ?>" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Specials Info For <br> Pre-Transaction Id: <?php echo e($preTransaction->pre_transaction_id); ?></h3>
                        <hr>
                        <dl class="row m-t-md">
                            <dt class="col-md-3 text-right">Special 1: </dt>
                            <dd class="col-md-8">
                                <?php if(!empty($preTransaction->special1)): ?>
                                    <?php echo e($preTransaction->special1); ?>

                                <?php endif; ?>
                            </dd>

                            <dt class="col-md-3 text-right">Special 2: </dt>
                            <dd class="col-md-8">
                                <?php if(!empty($preTransaction->special2)): ?>
                                    <?php echo e($preTransaction->special2); ?>

                                <?php endif; ?>
                            </dd>

                            <dt class="col-md-3 text-right">Special 3: </dt>
                            <dd class="col-md-8">
                                <?php if(!empty($preTransaction->special3)): ?>
                                    <?php echo e($preTransaction->special3); ?>

                                <?php endif; ?>
                            </dd>

                            <dt class="col-md-3 text-right">Special 4: </dt>
                            <dd class="col-md-8">
                                <?php if(!empty($preTransaction->special4)): ?>
                                    <?php echo e($preTransaction->special4); ?>

                                <?php endif; ?>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH /var/www/html/app/Wallet/Microservice/resources/views/preTransactions/preTransactionSpecials.blade.php ENDPATH**/ ?>