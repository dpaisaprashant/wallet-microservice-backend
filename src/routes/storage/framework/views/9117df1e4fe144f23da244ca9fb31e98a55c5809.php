<?php $__env->startSection('content'); ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Wallet Ledger</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
            </li>

            <li class="breadcrumb-item active">
                <strong>Report</strong>
            </li>

            <li class="breadcrumb-item active">
                <strong>Wallet Ledger</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title collapse-link">
                    <h5>Select Date</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="get">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                            <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from_date" autocomplete="off" value="<?php echo e(!empty($_GET['from_date']) ? $_GET['from_date'] : ''); ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                            <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to_date" autocomplete="off" value="<?php echo e(!empty($_GET['to_date']) ? $_GET['to_date'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('report.range.wallet_ledger')); ?>"><strong>Generate Report</strong></button>
                                </div>
                                <?php echo $__env->make('admin.asset.components.clearFilterButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <?php if(!empty($_GET['from_date']) || !empty($_GET['to_date'])): ?>
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Wallet Ledger for <?php echo e($data['from_date']); ?> <?php if(isset($data['to_date'])): ?> to <?php echo e($data['to_date']); ?> <?php endif; ?></h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" title="Wallet user's list">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Particulars</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>-</td>
                                <td>OPENING BALANCE</td>
                                <td>-</td>
                                <td>-</td>
                                
                                <td><?php echo e($data['opening_balance']); ?>

                            </tr>

                            <?php
                            $transaction = $data['transactions'];
                            //$balance = round($data['opening_balance']);
                            $balance = $data['opening_balance'];
                            ?>

                            <?php for($i= 0; $i < count($transaction); $i++) { ?>

                            <?php
                            if($transaction[$i]->account_type == "debit"){
                                $balance = $balance - $transaction[$i]->amount/100;
                            }
                            elseif ($transaction[$i]->account_type == "credit"){
                                $balance = $balance + $transaction[$i]->amount/100;
                            }
                            ?>
                            <tr>
                                <td><?php echo e($i+1); ?></td>
                                <td>
                                    <?php

                                    $pre_transaction_id = $transaction[$i]->pre_transaction_id;
                                    if($transaction[$i]->pre_transaction_id == null){

                                        if($transaction[$i-1]->commissionable_id = $transaction[$i]->commissionable_id){
                                            $pre_transaction_id = $transaction[$i-1]->pre_transaction_id;
                                        }else if($transaction[$i-1]->commissionable_id = $transaction[$i]->commissionable_id){
                                            $pre_transaction_id = $transaction[$i+1]->pre_transaction_id;
                                        }

                                    }
                                    ?>
                                    <?php echo e($pre_transaction_id); ?>/<?php echo e($transaction[$i]->vendor); ?>/<?php echo e($transaction[$i]->service_type); ?>

                                </td>
                                <td><?php if($transaction[$i]->account_type == "debit"): ?> <?php echo e($transaction[$i]->amount/100); ?> <?php endif; ?></td>
                                <td><?php if($transaction[$i]->account_type == "credit"): ?> <?php echo e($transaction[$i]->amount/100); ?> <?php endif; ?></td>
                                <td><?php echo e($balance); ?></td>

                            </tr>

                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td>-</td>
                                <td>CLOSING BALANCE</td>
                                <td>-</td>
                                <td>-</td>
                                <td><?php echo e($data['closing_balance']); ?></td>
                                
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>


<?php echo $__env->make('admin.asset.css.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.asset.css.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php echo $__env->make('admin.asset.js.datepicker', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('admin.asset.js.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>






<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Report/resources/views/walletLedger/report.blade.php ENDPATH**/ ?>