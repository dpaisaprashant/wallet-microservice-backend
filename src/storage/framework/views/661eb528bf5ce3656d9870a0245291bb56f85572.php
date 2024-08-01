<?php if(!empty($transaction->json_response)): ?>
    <a data-toggle="modal" title="Response" href="#modal-form-response-preTransaction-error<?php echo e($transaction->id); ?>">
        <button class="btn btn-danger btn-icon" type="button"><i class="fa fa-info"></i></button>
    </a>
    <div id="modal-form-response-preTransaction-error<?php echo e($transaction->id); ?>" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Error Response</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php $response = json_decode($transaction->json_response, true)?>
                                <?php if(! is_array($response)): ?>
                                    <?php $response = json_decode($response, true) ?>
                                <?php endif; ?>
                                    <?php if(is_array($response)): ?>
                                        <?php foreach ($response as $key => $value) { ?>

                                <?php if(is_array($value)): ?>
                                    <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2 => $value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <dt class="col-md-4 text-right"><?php echo e($key2); ?></dt>
                                            <dd class="col-md-7"><?php print_r($value2) ?></dd>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                        <dt class="col-md-4 text-right"><?php echo e($key); ?></dt>
                                        <dd class="col-md-7"><?php print_r($value) ?></dd>
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
<?php /**PATH /var/www/html/resources/views/admin/transaction/preTransaction/response.blade.php ENDPATH**/ ?>