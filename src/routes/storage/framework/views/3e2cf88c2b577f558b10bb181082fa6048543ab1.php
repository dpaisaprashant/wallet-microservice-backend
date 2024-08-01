<?php $__env->startSection('content'); ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Reconciliation Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Reconciliation</strong>
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
                                        <div class="col-md-12">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="date" autocomplete="off" value="<?php echo e(!empty($_GET['date']) ? $_GET['date'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('report.reconciliation')); ?>"><strong>Generate Report</strong></button>
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
                <?php if(!empty($_GET['date'])): ?>
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Reconciliation for <?php echo e($data['from_date']); ?> <?php if(isset($data['to_date'])): ?> to <?php echo e($data['to_date']); ?> <?php endif; ?></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" title="Wallet user's list">
                                    <thead>
                                    <tr>
                                        <th>Particulars</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                    $debit = 0;
                                    $credit = 0;
                                    while ($i < count($data['ledger']))
                                    {
                                    if($data['ledger'][$i]->transaction_type != "Commissions")
                                    {
                                    ?>

                                    <tr>
                                        <td>
                                            <?php
                                            if ($data['ledger'][$i]->transaction_type == 'App\Models\UserReferralBonusTransaction') {
                                                echo "Referral Bonus";
                                            } else {
                                                echo $data['ledger'][$i]->transaction_type;
                                            }
                                            ?>
                                        </td>
                                        <td><?php
                                            if($data['ledger'][$i]->transaction_type == "Bank Transfer" ||
                                                $data['ledger'][$i]->transaction_type == "Paypoint Payments" ||
                                                $data['ledger'][$i]->transaction_type == "App\Models\NchlAggregatedPayment"
                                            ){
                                                echo $data['ledger'][$i]->total;


                                                $debit = $debit + $data['ledger'][$i]->total;
                                            }

                                            ?>

                                        </td>
                                        <td><?php
                                            if($data['ledger'][$i]->transaction_type == "NHCL Load" ||
                                                $data['ledger'][$i]->transaction_type == "NPS LOAD" ||
                                                $data['ledger'][$i]->transaction_type == "NPAY LOAD" ||
                                                $data['ledger'][$i]->transaction_type == "App\Models\UserReferralBonusTransaction" ||
                                                $data['ledger'][$i]->transaction_type == "App\Models\UsedUserReferral" ||
                                                $data['ledger'][$i]->transaction_type == "App\Models\NICAsiaCyberSourceLoadTransaction" ||
                                                $data['ledger'][$i]->transaction_type == "Cashback"
                                            ){
                                                echo $data['ledger'][$i]->total;
                                                $credit = $credit + $data['ledger'][$i]->total;
                                            }

                                            ?></td>
                                    </tr>

                                    <?php
                                    }
                                    $i++;
                                    }
                                    ?>
                                    <tr>
                                        <td>Paypoint Load For Clearance</td>
                                        <td></td>
                                        <td><?php $credit = $credit + $data['paypoint_load_clearance'];  echo $data['paypoint_load_clearance']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Lucky Winner</td>
                                        <td></td>
                                        <td><?php $credit = $credit+$data['lucky_winner']; echo $data['lucky_winner']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Casback</td>
                                        <td></td>
                                        <td><?php $credit = $credit+$data['cashback_total']; echo $data['cashback_total']; ?></td>
                                    </tr>

                                    <tr>
                                        <td>Commission</td>
                                        <td><?php $debit = $debit+$data['commission_total']; echo $data['commission_total']; ?></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>TOTAL</td>
                                        <td><?php echo $debit; ?></td>
                                        <td><?php echo $credit; ?></td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>

                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>OPENING WALLET BALANCE</td>
                                        <td><?php echo e($data['opening_balance']); ?></td>
                                        <td></td>

                                    </tr>

                                    <tr>
                                        <td>CLOSING WALLET BALANCE</td>
                                        <td><?php echo e($data['closing_balance']); ?></td>
                                        <td></td>

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






<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/app/Wallet/Report/resources/views/reconciliation/report.blade.php ENDPATH**/ ?>