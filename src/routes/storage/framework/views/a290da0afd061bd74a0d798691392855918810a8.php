<a data-toggle="modal" href="#modal-form-fund-transfer<?php echo e($transaction->id); ?>"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
<div id="modal-form-fund-transfer<?php echo e($transaction->id); ?>" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Transaction Detailed Information</h3>
                        <hr>
                        <dl class="row m-t-md">
                            <dt class="col-md-3 text-right">Service Type</dt>
                            <dd class="col-md-8">Fund Request</dd>

                            <dt class="col-md-3 text-right">Amount</dt>
                            <dd class="col-md-8">Rs.<?php echo e($transaction->amount); ?></dd>

                            <dt class="col-md-3 text-right">Date</dt>
                            <dd class="col-md-8"><?php echo e($transaction->created_at); ?></dd>


                            <dt class="col-md-3 text-right">From User</dt>
                            <dd class="col-md-8"><?php echo e($transaction->fromUser['name']); ?></dd>

                            <dt class="col-md-3 text-right">To User</dt>
                            <dd class="col-md-8"><?php echo e($transaction->toUser['name'] ?? ""); ?></dd>

                        </dl>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/admin/transaction/fundTransfer/detail.blade.php ENDPATH**/ ?>