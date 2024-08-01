<tr class="gradeC">
    <?php
        $json_response = $event->json_response;
        $json_response = json_decode($json_response,true);
        $tx_id = $json_response['trxnId'] ?? null;
    ?>

    <td><?php echo e($loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1); ?></td>
    <?php $date = explode(' ', $event->created_at) ?>
    <td><?php echo e($date[0]); ?></td>
    <td><?php echo e($date[1]); ?></td>
    <td><?php if(empty($tx_id)): ?>
            <?php echo e($event->pre_transaction_id == null ? '---' : $event->pre_transaction_id); ?>

            <br>
        <?php endif; ?>
        <?php if(isset($event->userTransaction) ): ?>
            <b>RefStan :</b> <?php echo e($event->userTransaction['refStan']); ?>

        <?php elseif(isset($event->userLoadTransaction)): ?>
            <b>Gateway Ref
                No:</b> <?php echo e($event->userLoadTransaction['gateway_ref_no']); ?>

        <?php elseif(isset($event->nchlLoadTransaction)): ?>
            <b>Transaction
                Id:</b> <?php echo e($event->nchlLoadTransaction['transaction_id']); ?>

        <?php elseif(isset($event->nicAsiaCyberSourceLoad) ): ?>
            <b>Reference
                No:</b><?php echo e($event->nicAsiaCyberSourceLoad['reference_number']); ?>

            <br>
            <b>Transaction
                UID:</b><?php echo e($event->nicAsiaCyberSourceLoad['transaction_uuid']); ?>

        <?php elseif(isset($event->nchlBankTransfer)): ?>
            <b>Transaction Id:</b><?php echo e($event->nchlBankTransfer['transaction_id']); ?>

            <?php elseif(isset($event->nchlAggregatePayment)): ?>
            <b>Transaction Id:</b><?php echo e($event->nchlAggregatePayment['transaction_id']); ?><br>
            <b>Ref Id:</b><?php echo e($event->nchlAggregatePayment['ref_id']); ?><br>
        
        <?php endif; ?>


        <?php if(!empty($tx_id)): ?>
            <b>SFACL Txn id:</b> <?php echo e($tx_id); ?>

        <?php endif; ?>
    </td>
    <td>
        <?php echo e($event->description); ?>

        <?php if(!empty($tx_id)): ?>
            <br>
            <b>Pre Transaction Id: </b> <?php echo e($event->pre_transaction_id); ?>

        <?php endif; ?>

    </td>

    <td>
        <?php $transaction = json_decode($event->json_response, true) ?>
        <?php if(is_array($transaction) && isset($transaction['transaction']) && isset($transaction['transaction']['vendor'])): ?>
            <?php echo e($transaction['transaction']['vendor']); ?>

        <?php else: ?>
            <?php if(is_string($transaction)): ?>
                <?php $transaction = json_decode($transaction, true) ?>
            <?php endif; ?>
            <?php if(is_array($transaction) && isset($transaction['transaction']) && isset($transaction['transaction']['vendor'])): ?>
                <?php echo e($transaction['transaction']['vendor']); ?>

            <?php elseif($event->transactionEvent): ?>
                <?php echo e($event->transactionEvent->vendor); ?>

            <?php else: ?>
                <?php echo e($event->vendor); ?>

            <?php endif; ?>
        <?php endif; ?>
    </td>
    <td>
        <?php echo $__env->make('admin.transaction.preTransaction.status', ['transaction' => $event], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </td>
    <?php if($event->transaction_type == 'debit'): ?>
        <?php if(strtoupper($event->status) == 'SUCCESS'): ?>
            <td style="color: red">Rs.<?php echo e($event->amount); ?></td>
        <?php else: ?>
            <td>Rs.<?php echo e($event->amount); ?></td>
        <?php endif; ?>
    <?php else: ?>
        <td></td>
    <?php endif; ?>

    <?php if($event->transaction_type == 'credit'): ?>
        <?php if(strtoupper($event->status) == 'SUCCESS'): ?>
            <td style="color: green">Rs.<?php echo e($event->amount); ?></td>
        <?php else: ?>
            <td>Rs.<?php echo e($event->amount); ?></td>
        <?php endif; ?>
    <?php else: ?>
        <td></td>
    <?php endif; ?>

    <td>Rs. <?php echo e($event->current_balance); ?></td>
    <td>Rs. <?php echo e($event->current_bonus_balance); ?></td>
    <td>
        <?php if($event->status == 'FAILED'): ?>
            <?php echo $__env->make('admin.transaction.preTransaction.response', ['transaction' => $event], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php if($event->microservice_type == 'PAYPOINT'): ?>
            <?php if(!empty($event->userCheckPayment)): ?>
                <?php echo $__env->make('admin.transaction.paypoint.request', ['transaction' => $event->userCheckPayment], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('admin.transaction.paypoint.response', ['transaction' => $event->userCheckPayment], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <a href="<?php echo e(route('paypoint.detail', $event->userCheckPayment->id)); ?>" title="Transaction Detail">
                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                </a>
            <?php endif; ?>
            
       
        <?php elseif(!empty($event->transactionEvent)): ?>
            <?php if($event->transactionEvent instanceof \App\Models\UserToUserFundTransfer): ?>
                <?php echo $__env->make('admin.transaction.fundTransfer.detail', [$event->transactionEvent->transactionable], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <a href="<?php echo e(route('userToUserFundTransfer.detail', $event->transactionEvent->transaction_id)); ?>">
                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        
        
        
        
        
        
        

        <?php if($event->microservice_type == "BFI"): ?>
            <?php if(!empty($event->userToBFIFundTransfer)): ?>
                <a href="<?php echo e(route('user.to.bfi.fund.transfer.check.payment', $event->userToBFIFundTransfer->id)); ?>"  title="BFI">
                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                </a>
            <?php endif; ?>

            <?php if(!empty($event->bfiToUserFundTransfer)): ?>
                <a href="<?php echo e(route('view.bfi.to.user.check.payment', $event->bfiToUserFundTransfer->id)); ?>">
                    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button>
                </a>
            <?php endif; ?>

        <?php endif; ?>

        <?php if($event->nicAsiaCyberSourceLoad): ?>
            <a href="<?php echo e(route('nicAsia.detailCyberSourceLoad',$event->nicAsiaCyberSourceLoad->id)); ?>"  title="nicAsiaCyberSourceLoad"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        <?php elseif($event->userloadTransaction): ?>
            <a href="<?php echo e(route('eBanking.detail', $event->userLoadTransaction->id)); ?>" title="eBanking Detail"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        




        
            <?php elseif($event->userTransaction): ?>
            <a href="<?php echo e(route('paypoint.detail', $event->userTransaction->id)); ?>" title="Pay Point Detail">    <button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        
        

         



            
        <?php elseif($event->nchlBankTransfer): ?>
            <a href="<?php echo e(route('nchl.bankTransfer.detail', $event->nchlBankTransfer->id)); ?>" title="NCHL Bank Transfer"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        <?php elseif($event->nchlLoadTransaction): ?>
            <a href="<?php echo e(route('nchl.loadTransaction.detail', $event->nchlLoadTransaction->id)); ?>" title="NCHL Load Transaction"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        <?php elseif($event->nchlAggregatePayment): ?>
            <a href="<?php echo e(route('nchl.aggregatedPayment.detail',$event->nchlAggregatePayment->id)); ?>" title="NCHL Aggregate PAyment><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        
        <?php elseif(optional($event->transactionEvent)->transaction_type == \App\Models\UserToUserFundTransfer::class): ?>
            <a href="<?php echo e(route('userToUserFundTransfer.detail', $event->transactionEvent->transaction_id)); ?>" title="User To Use Fund Transfer"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        <?php elseif(optional($event->transactionEvent)->transaction_type == \App\Models\FundRequest::class): ?>
            <a href="<?php echo e(route('fundRequest.detail', $event->transactionEvent->transaction_id)); ?>" title="Fund Request"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        <?php elseif($event->npsLoadTransaction): ?>
                <a href="<?php echo e(route('nps.detail',$event->npsLoadTransaction->id)); ?>" title="NPS Detail"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
        <?php endif; ?>







    </td>
</tr>
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/auditTrial/types/preTransaction.blade.php ENDPATH**/ ?>