<?php if($transaction->transaction_type == \App\Models\UserToUserFundTransfer::class): ?>
    <?php echo $__env->make('admin.transaction.fundTransfer.detail', ['transaction' => $transaction->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <a href="<?php echo e(route('userToUserFundTransfer.detail', $transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php elseif($transaction->transaction_type == \App\Models\UserLoadTransaction::class): ?>
    <?php echo $__env->make('admin.transaction.npay.detail', ['transaction' => $transaction->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <a href="<?php echo e(route('eBanking.detail', $transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php elseif($transaction->transaction_type == \App\Models\UserTransaction::class): ?>
    <?php echo $__env->make('admin.transaction.paypoint.detail', ['transaction' => $transaction->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(optional(optional($transaction->transactionable)->checkTransaction)->id != null): ?>
        <a href="<?php echo e(route('paypoint.detail', $transaction->transactionable->checkTransaction->id)); ?>">    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
    <?php endif; ?>
<?php elseif($transaction->transaction_type == \App\Models\FundRequest::class): ?>
    <?php echo $__env->make('admin.transaction.fundRequest.detail', ['transaction' => $transaction->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <a href="<?php echo e(route('fundRequest.detail', $transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php elseif($transaction->transaction_type == 'App\Models\NchlBankTransfer'): ?>
    <?php echo $__env->make('admin.transaction.nchlBankTransfer.account', ['transaction' => $transaction->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <a href="<?php echo e(route('nchl.bankTransfer.detail', $transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php elseif($transaction->transaction_type == \App\Models\NchlLoadTransaction::class): ?>
    <?php echo $__env->make('admin.transaction.nchlLoadTransaction.response', ['transaction' => $transaction->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <a href="<?php echo e(route('nchl.loadTransaction.detail', $transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php elseif($transaction->transaction_type == 'App\Models\KhaltiUserTransaction'): ?>
    <a href="<?php echo e(route('khalti.payment.detail', $transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php elseif($transaction->transaction_type == \App\Models\CellPayUserTransaction::class): ?>
    <a href="<?php echo e(route('cellPayUserTransaction.detail',$transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php elseif($transaction->transaction_type == \App\Models\LoadTestFund::class): ?>
    <a href="<?php echo e(route('loadTestFund.detail',$transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php elseif($transaction->transaction_type == \App\Models\NchlAggregatedPayment::class): ?>
    <a href="<?php echo e(route('nchl.aggregatedPayment.detail',$transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php elseif($transaction->transaction_type == \App\Models\NICAsiaCyberSourceLoadTransaction::class): ?>
    <a href="<?php echo e(route('nicAsia.detailCyberSourceLoad',$transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php elseif($transaction->transaction_type == \App\Models\NpsLoadTransaction::class): ?>
    <a href="<?php echo e(route('nps.detail',$transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>






<?php elseif($transaction->transaction_type == \App\Models\MerchantTransaction::class): ?>
    <a href="<?php echo e(route('merchant-transaction.detail',$transaction->transaction_id)); ?>"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

<?php endif; ?>
<?php /**PATH /var/www/html/resources/views/admin/transaction/transactionActionButtons.blade.php ENDPATH**/ ?>