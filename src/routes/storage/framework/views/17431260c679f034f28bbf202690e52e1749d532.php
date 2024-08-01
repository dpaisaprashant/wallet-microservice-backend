<?php if(!empty($transaction->request)): ?>
    <a data-toggle="modal" href="#modal-form-nchl-bank-transfer-request-debtor<?php echo e($transaction->id); ?>"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-form-nchl-bank-transfer-request-debtor<?php echo e($transaction->id); ?>" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Debtor Request Info</h3>
                            <hr>
                            <dl class="row m-t-md">

                                <?php
                                    $request =  json_decode($transaction->request, true);
                                    $debtorRequest = $request['cipsBatchDetail'] ?? [];
                                    $creditorRequest = $request['cipsTransactionDetailList'][0] ?? [];
                                ?>
                                <?php foreach ($debtorRequest as $key => $value) { ?>

                                <dt class="col-md-5 text-right"><?php echo e($key); ?></dt>
                                <dd class="col-md-6">
                                    <?php if($key == 'txnAmt'): ?>
                                        <?php echo e($value / 100); ?>

                                    <?php else: ?>
                                            <?php print_r($value) ?>

                                    <?php endif; ?>
                                </dd>


                                <?php }?>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a data-toggle="modal" href="#modal-form-nchl-bank-transfer-request-creditor<?php echo e($transaction->id); ?>"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
    <div id="modal-form-nchl-bank-transfer-request-creditor<?php echo e($transaction->id); ?>" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Creditor Request Info</h3>
                            <hr>
                            <dl class="row m-t-md">


                                <?php foreach ($creditorRequest as $key => $value) { ?>

                                    <?php if(!empty($value)): ?>
                                        <dt class="col-md-5 text-right"><?php echo e($key); ?></dt>
                                        <dd class="col-md-6">
                                            <?php if($key == 'txnAmt'): ?>
                                                <?php echo e($value / 100); ?>

                                            <?php else: ?>
                                                <?php print_r($value) ?>

                                            <?php endif; ?>
                                        </dd>
                                    <?php endif; ?>
                                <?php }?>

                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/transaction/nchlBankTransfer/request.blade.php ENDPATH**/ ?>