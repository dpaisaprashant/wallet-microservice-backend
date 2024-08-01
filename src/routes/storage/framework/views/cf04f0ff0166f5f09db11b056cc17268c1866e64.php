<?php if(count($transaction->userExecutePayment) > 0): ?>
    <?php $__currentLoopData = $transaction->userExecutePayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $execute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if($transaction->userExecutePayment->count() ==  1 ): ?>
            <?php $color = 'warning' ?>
        <?php elseif($execute->code == 000): ?>
            <?php $color = 'primary' ?>
        <?php else: ?>
            <?php $color = 'danger' ?>
        <?php endif; ?>


        <a data-toggle="modal" title="Response" href="#modal-form-response-paypoint<?php echo e($key . '-' .$transaction->id); ?>">
            <button class="btn btn-<?php echo e($color); ?> btn-icon" type="button"><i class="fa fa-info"></i></button>
        </a>
        <div id="modal-form-response-paypoint<?php echo e($key . '-' . $transaction->id); ?>" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">Execute Payment Response Detailed Information</h3>
                                <hr>
                                <dl class="row m-t-md">

                                    <?php $response = json_decode($execute->response, true)?>
                                        <?php if(! is_array($response)): ?>
                                            <?php $response = json_decode($response) ?>
                                        <?php endif; ?>
                                    <?php foreach ($response as $key => $value) { ?>

                                    <dt class="col-md-3 text-right"><?php echo e($key); ?></dt>
                                    <?php if($key == 'amount' ): ?>
                                        <dd class="col-md-8">Rs. <?php echo e(empty($value) ? 0 : $value / 100); ?></dd>
                                    <?php else: ?>
                                        <dd class="col-md-8"><?php print_r($value) ?></dd>
                                    <?php endif; ?>

                                    <?php }?>

                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <a data-toggle="modal" href="#modal-form-response-paypoint<?php echo e($transaction->id); ?>">
        <button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button>
    </a>
    <div id="modal-form-response-paypoint<?php echo e($transaction->id); ?>" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Check Payment Response Detailed Information</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php $response = json_decode($transaction->response, true)?>
                                <?php if(! is_array($response)): ?>
                                    <?php $response = json_decode($response) ?>
                                <?php endif; ?>

                                <?php if($response != null): ?>
                                    <?php foreach ($response as $key => $value) { ?>


                                    <?php if($key == 'amount' ): ?>
                                        <dt class="col-md-3 text-right"><?php echo e($key); ?></dt>
                                        <dd class="col-md-8">Rs. <?php echo e(empty($value) ? 0 : $value / 100); ?></dd>
                                    <?php else: ?>
                                        <?php if(is_string($value)): ?>
                                            <dt class="col-md-3 text-right"><?php echo e($key); ?></dt>
                                            <dd class="col-md-8"><?php echo e($value); ?></dd>
                                        <?php else: ?>
                                            <?php if(is_array($value)): ?>
                                                <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key1 => $value1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(is_string($value1)): ?>
                                                        <dt class="col-md-3 text-right"><?php echo e($key1); ?></dt>
                                                        <dd class="col-md-8"><?php echo e($value1); ?></dd>
                                                    <?php else: ?>
                                                        <?php $__currentLoopData = (array)$value1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php if(is_string($value2)): ?>
                                                                <dt class="col-md-3 text-right"><?php echo e($key2); ?></dt>
                                                                <dd class="col-md-8"><?php echo e(($value2)); ?></dd>
                                                            <?php else: ?>
                                                                <?php $__currentLoopData = (array)$value2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key3 => $value3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php if(is_string($value3)): ?>
                                                                        <dt class="col-md-3 text-right"><?php echo e($key3); ?></dt>
                                                                        <dd class="col-md-8"><?php echo e(($value3)); ?></dd>
                                                                    <?php else: ?>
                                                                        <?php $__currentLoopData = (array)$value3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key4 => $value4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if(is_string($value4)): ?>
                                                                                <dt class="col-md-3 text-right"><?php echo e($key4); ?></dt>
                                                                                <dd class="col-md-8"><?php echo e(($value4)); ?></dd>
                                                                            <?php endif; ?>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php endif; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                    <dt class="col-md-3 text-right"><?php echo e($key); ?></dt>
                                                    <dd class="col-md-8"><?php print_r($value) ?></dd>
                                            <?php endif; ?>
                                            <?php /*echo "<pre>"; print_r($value); */?>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php }?>
                                <?php endif; ?>

                            </dl>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/transaction/paypoint/response.blade.php ENDPATH**/ ?>