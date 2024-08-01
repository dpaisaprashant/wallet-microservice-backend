<?php if(count($transaction->userExecutePayment) > 0): ?>
    <?php $__currentLoopData = $transaction->userExecutePayment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $execute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <?php if($transaction->userExecutePayment->count() ==  1 ): ?>
            <?php $color = 'warning' ?>
        <?php elseif($execute->code == 000): ?>
            <?php $color = 'primary' ?>
        <?php else: ?>
            <?php $color = 'danger' ?>
        <?php endif; ?>


        <a data-toggle="modal" title="Request" href="#modal-form-request-paypoint<?php echo e($key .'-'. $transaction->id); ?>"><button class="btn btn-<?php echo e($color); ?> btn-icon" type="button"><i class="fa fa-info"></i></button></a>
        <div id="modal-form-request-paypoint<?php echo e($key .'-'. $transaction->id); ?>" class="modal fade" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="m-t-none m-b">Execute Payment Request Detailed Information</h3>
                                <hr>
                                <dl class="row m-t-md">

                                    <?php $request =  json_decode($execute->request, true)?>
                                        <?php if(! is_array($request)): ?>
                                            <?php $request = json_decode($request) ?>
                                        <?php endif; ?>
                                    <?php foreach ($request as $key => $value) { ?>

                                    <dt class="col-md-3 text-right"><?php echo e($key); ?></dt>
                                    <?php if($key == 'amount' ): ?>
                                        <dd class="col-md-8">Rs. <?php echo e(empty($value) ? 0 : $value / 100); ?></dd>
                                    <?php else: ?>
                                        <dd class="col-md-8"><?php echo e($value); ?></dd>
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
    <a data-toggle="modal" href="#modal-form-request-paypoint<?php echo e($transaction->id); ?>"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-form-request-paypoint<?php echo e($transaction->id); ?>" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Check Payment Request Detailed Information</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php $request = json_decode($transaction->request, true)?>
                                <?php if(! is_array($request)): ?>
                                    <?php $request = json_decode($request) ?>
                                <?php endif; ?>
                                <?php if($request != null): ?>
                                    <?php foreach ($request as $key => $value) { ?>

                                    <dt class="col-md-3 text-right"><?php echo e($key); ?></dt>
                                    <?php if($key == 'amount' ): ?>
                                        <dd class="col-md-8">Rs. <?php echo e(empty($value) ? 0 : $value / 100); ?></dd>
                                    <?php else: ?>
                                        <dd class="col-md-8"><?php echo e($value); ?></dd>
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
<?php /**PATH /var/www/html/resources/views/admin/transaction/paypoint/request.blade.php ENDPATH**/ ?>