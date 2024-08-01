<?php $__env->startSection('content'); ?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Refund</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Refund</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Refund</strong>
                </li>
            </ol>
        </div>
    </div>

    <?php echo $__env->make('admin.asset.notification.notify', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Enter user Mobile Number</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="<?php echo e(route('loadTestFund.create')); ?>" enctype="multipart/form-data" id="transactionIdForm">
                            <?php echo csrf_field(); ?>

                            <?php if(isset($_GET["amount"])): ?>
                                <div class="row" style="margin-top: 10px">
                                    <div class="col-sm-12">
                                        <div class="alert alert-warning" style="width: 100%">
                                            <i class="fa fa-info-circle"></i>&nbsp; Total Refunding amount (bonus balance + main balance) should be <b>Rs. <?php echo e($_GET["amount"]); ?></b>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="row" style="margin-top: 10px">
                                <div class="col-sm-12">
                                    <div class="alert alert-danger" style="width: 100%">
                                        <i class="fa fa-exclamation-triangle"></i>&nbsp; Please check the user's audit trial page before refunding the transaction!!. Once refunded the amount is added to user's wallet. The process cannot be undone if user spends the amount from their wallet.</b>
                                    </div>
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Mobile No</label>
                                <div class="col-sm-10">
                                    <input name="mobile_no" type="text" class="form-control" required <?php if(isset($_GET["mobile_no"])): ?> value="<?php echo e($_GET["mobile_no"]); ?>" <?php endif; ?>>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <?php if(isset($_GET["amount"])): ?>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Before Bonus Amount (in Rs.)</label>
                                <div class="col-sm-10">
                                    <input id="before_bonus_amount" name="before_bonus_amount" type="text" class="form-control">
                                    <small>Amount Should be in Rs.</small>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Bonus Amount (in Rs.)</label>
                                <div class="col-sm-10">
                                    <input id="bonus_amount" name="bonus_amount" type="text" class="form-control">
                                    <small>Amount Should be in Rs.</small>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Amount (in Rs.)</label>
                                <div class="col-sm-10">
                                    <input id="main_amount" name="amount" type="text" class="form-control" <?php if(isset($_GET["amount"])): ?> readonly <?php endif; ?>>
                                    <small>Amount Should be in Rs.</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Pre Transaction Id</label>
                                <div class="col-sm-10">
                                    <input name="pre_transaction_id" type="text" class="form-control" required <?php if(isset($_GET["pre_transaction_id"])): ?> value="<?php echo e($_GET["pre_transaction_id"]); ?>" <?php endif; ?>>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            

                            <div class="hr-line-dashed"></div>

                            <button id="handleBtn" class="btn btn-sm btn-primary m-t-n-xs" type="submit" formaction="<?php echo e(route('refund.create')); ?>"><strong>Create</strong></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <?php echo $__env->make('admin.asset.css.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.css.icheck', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <style>
        .icheckbox_square-green {
            margin-top: 5px;
        }
    </style>

    <!-- Sweet Alert -->
    <link href="<?php echo e(asset('admin/css/plugins/sweetalert/sweetalert.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make('admin.asset.js.chosen', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.asset.js.icheck', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <!-- Sweet alert -->
    <script src="<?php echo e(asset('admin/js/plugins/sweetalert/sweetalert.min.js')); ?>"></script>

    <?php if(isset($_GET["amount"])): ?>
    <script>
       $('#before_bonus_amount').on("change paste keyup", function () {

           var amountToRefund = parseFloat(`<?php echo e($_GET["amount"]); ?>`);
           var beforeBonusBalance = parseFloat($('#before_bonus_amount').val());

           if (beforeBonusBalance >= amountToRefund) {
               $('#bonus_amount').val(amountToRefund);
               $("#main_amount").val(0);
           } else {

               $('#bonus_amount').val(beforeBonusBalance);
               $("#main_amount").val(amountToRefund - beforeBonusBalance);
           }

           // var bonusBalanceAmount = $('#bonus_amount').val();
           // if (bonusBalanceAmount < 0) {
           //     alert("Amount cannot be less than 0");
           //     $('#bonus_amount').val(0);
           // }
           //
           // console.log("Bonus Balance Amount: " + bonusBalanceAmount)
           // var mainBalanceAmount = parseFloat(amountToRefund) - parseFloat(bonusBalanceAmount);
           //
           //     $("#main_amount").val(mainBalanceAmount);
           //
           //
           // if (bonusBalanceAmount > amountToRefund || mainBalanceAmount > amountToRefund) {
           //     alert("Amount cannot be greater than amount to refund");
           //     $('#bonus_amount').val(0);
           //     $("#main_amount").val(0);
           //     bonusBalanceAmount = 0;
           //     mainBalanceAmount = 0;
           // }
           //
           // if (bonusBalanceAmount < 0 || mainBalanceAmount < 0) {
           //     alert("Amount cannot be less than 0");
           //     $('#bonus_amount').val(0);
           //     $("#main_amount").val(0);
           // }

       });
    </script>
    <?php endif; ?>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin_design', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/refund/create.blade.php ENDPATH**/ ?>