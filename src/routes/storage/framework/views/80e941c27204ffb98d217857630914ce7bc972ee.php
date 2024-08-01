<?php if(!empty($transaction->validation_response)): ?>
    <a data-toggle="modal" href="#modal-form-nchl-load-transaction-validation-response<?php echo e($transaction->id); ?>"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-form-nchl-load-transaction-validation-response<?php echo e($transaction->id); ?>" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Validation Response</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php $response =  json_decode($transaction->validation_response, true)?>

                                <?php foreach ($response as $key => $value) { ?>

                                <dt class="col-md-5 text-right"><?php echo e($key); ?></dt>
                                <dd class="col-md-6">
                                    <?php if($key == 'txnAmt'): ?>
                                        <?php echo e($value / 100); ?>

                                    <?php else: ?>
                                        <?php echo e($value); ?>

                                    <?php endif; ?>
                                </dd>

                                <?php }?>
                                    <dt class="col-md-5 text-right">Reference Id</dt>
                                    <dd class="col-md-6">
                                        <?php echo e($transaction->reference_id); ?>

                                    </dd>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>

<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/transaction/nchlLoadTransaction/response.blade.php ENDPATH**/ ?>