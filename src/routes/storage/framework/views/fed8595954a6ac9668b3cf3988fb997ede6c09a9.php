<?php if(!empty($preTransaction)): ?>
    <a data-toggle="modal" href="#DeviceInfo<?php echo e($preTransaction->id); ?> ">
        <button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button>
    </a>
    <div id="DeviceInfo<?php echo e($preTransaction->id); ?>" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Device Info For <br> Pre-Transaction
                                Id: <?php echo e($preTransaction->pre_transaction_id); ?></h3>
                            <hr>
                            <?php
                                $json = json_decode($preTransaction->device_info,true);
                            ?>
                            <?php if(!empty($json)): ?>
                                <dl class="row m-t-md">
                                    <?php if(is_array($json) || is_object($json)): ?>

                                        <?php $__currentLoopData = $json; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(!is_array($value)): ?>
                                                <dt class="col-md-5 text-left"><?php echo e($key); ?> :</dt>
                                                <dd class="col-lg-offset-1"></dd>
                                                <dd class="col-md-5 text-left"><?php echo e($value == null ? 'Null' : $value); ?> </dd>
                                            <?php else: ?>
                                                <hr>
                                                <dt class="col-md-5 text-left"><?php echo e($key); ?> :</dt>
                                                <dd class="col-lg-offset-1"></dd>
                                                <dd class="col-md-5 text-left"></dd>
                                                <hr>

                                                <?php
                                                    $secondLevelResponse = $value;
                                                ?>
                                                <?php if(is_array($secondLevelResponse) || is_object($secondLevelResponse)): ?>
                                                    <?php $__currentLoopData = $secondLevelResponse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                        <?php if(is_string($value)): ?>
                                                            <dt class="col-md-5 text-left"><?php echo e($key); ?> :</dt>
                                                            <dd class="col-md-7 text-left"><?php echo e($value == null ? 'Null' : ($value)); ?> </dd>
                                                        <?php endif; ?>

                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php echo e((string)$json); ?>

                                    <?php endif; ?>

                                </dl>
                            <?php else: ?>
                                <dt class="text-left">No Data</dt>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/app/Wallet/Microservice/resources/views/preTransactions/preTransactionDeviceInfo.blade.php ENDPATH**/ ?>