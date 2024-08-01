<div role="tabpanel" id="allAuditTrial" class="tab-pane <?php if($activeTab == 'allAuditTrial'): ?> active <?php endif; ?>">
    <div class="row" style="margin-top: 10px;">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title collapse-link">
                    <h5>Filter Audit</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" <?php if( empty($_GET) || (count($_GET) === 1)  ): ?> style="display: none"  <?php endif; ?>>
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="get">
                                <input type="hidden" name="transaction_type" value="all-audit-trials">
                                <input type="hidden" name="user" value="<?php echo e($user->mobile_no); ?>">

                                <div class="row">
                                    <div class="col-md-6" >
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6" >
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="<?php echo e(route('user.profile', $user->id)); ?>"><strong>Filter</strong></button>
                                </div>
                                <div>
                                    <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="<?php echo e(route('user.allAuditTrial.excel', $user->id)); ?>"><strong>Excel</strong></button>
                                </div>
                                <?php echo $__env->make('admin.asset.components.clearFilterButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body" id="AllAuditTable">
        <div class="table-responsive">
            <table id="AllAuditTable" class="table table-striped table-bordered table-hover dataTables-example" title="Audit Trial - <?php echo e($user->name); ?>">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Pre Transaction</th>
                    <th>Description</th>
                    <th>Vendor</th>
                    <th>Status</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Balance</th>
                    <th>Bonus Balance</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $allAudits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php if($event instanceof \App\Models\Microservice\PreTransaction): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.preTransaction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                   
                    <?php elseif($event instanceof \App\Models\UserLoadTransaction): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.userLoadTransaction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                    <?php elseif($event instanceof \App\Models\UserCheckPayment): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.userTransaction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\NchlLoadTransaction): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.nchlLoadTransaction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\NchlBankTransfer): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.nchlBankTransfer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\NchlAggregatedPayment): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.nchlAggregatedPayment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\NICAsiaCyberSourceLoadTransaction): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.nicAsiaCyberSourceTransactions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Wallet\Commission\Models\Commission && $event->module == 'cashback'): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.cashback', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Wallet\Commission\Models\Commission && $event->module == 'commission'): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.commission', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\UserKYC): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.kycFilled', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\AdminUserKYC): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.kycAcceptReject', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\UserActivity): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.userActivity', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\LoadTestFund): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.loadTestFunds', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\UsedUserReferral): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.referral', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\UserReferralBonusTransaction): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.referralBonus', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php elseif($event instanceof \App\Models\MerchantTransaction): ?>
                        <?php echo $__env->make('admin.user.profile.tabs.auditTrial.types.merchantTransaction', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php echo e($allAudits->appends(request()->query())->links()); ?>

        </div>
    </div>
</div>

<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/auditTrial/allAuditTrial.blade.php ENDPATH**/ ?>