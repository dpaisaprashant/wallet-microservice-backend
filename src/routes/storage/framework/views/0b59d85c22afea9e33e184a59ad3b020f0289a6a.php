<div role="tabpanel" id="userLoginHistoryAudit" class="tab-pane <?php if($activeTab == 'userLoginHistoryAudit'): ?> active <?php endif; ?>">
    

    <div class="panel-body" id="LoginHistoryAuditTable">
        <div class="table-responsive">
            <table id="LoginHistoryAuditTable" class="table table-striped table-bordered table-hover dataTables-example" title="Login History - <?php echo e($user->name); ?>">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Public IP</th>
                    <th>Server IP</th>
                    <th>Device</th>
                    <th>User Agent</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php global $walletAmount; $walletAmount = $_GET['wallet_amount'] ?? $user->wallet->balance ?>
                <?php $__currentLoopData = $loginHistoryAudits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1); ?></td>
                        <?php $date = explode(' ', $event->created_at) ?>
                        <td><?php echo e($date[0]); ?></td>
                        <td><?php echo e($date[1]); ?></td>
                        <td><?php echo e($event->public_ip); ?></td>
                        <td><?php echo e($event->server_ip); ?></td>
                        <td><?php echo e($event->device); ?></td>
                        <td><?php echo e($event->user_agent); ?></td>
                        <td>
                            <?php if($event->status == 1 && $event->tmp_enabled === 0): ?>
                                <b style="color: green">USER SUCCESSFULLY LOGGED IN</b>
                            <?php else: ?>
                                <b style="color: red">USER LOGIN ATTEMPT FAIL</b>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a data-toggle="modal" href="#modal-form-user-login-history-single<?php echo e($event->id); ?>"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>

                            <div id="modal-form-user-login-history-single<?php echo e($event->id); ?>" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="m-t-none m-b">Login History Detailed Information</h3>
                                                    <hr>
                                                    <dl class="row m-t-md">
                                                        <dt class="col-md-3 text-right">Public Id</dt>
                                                        <dd class="col-md-8"><?php echo e($event->public_ip); ?></dd>

                                                        <dt class="col-md-3 text-right">Server Id</dt>
                                                        <dd class="col-md-8"><?php echo e($event->server_ip); ?></dd>

                                                        <dt class="col-md-3 text-right">Device</dt>
                                                        <dd class="col-md-8"><?php echo e($event->device); ?></dd>

                                                        <dt class="col-md-3 text-right">User Agent</dt>
                                                        <dd class="col-md-8"><?php echo e($event->user_agent); ?></dd>


                                                        <dt class="col-md-3 text-right">Description</dt>
                                                        <dd class="col-md-8"><?php echo e($event->description); ?></dd>


                                                    </dl>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                </tbody>
            </table>
            <?php if(!empty($_GET['user-transaction-statement']) || !empty($_GET['user-transaction-event']) || !empty($_GET['all-audit-trials']) ): ?>
                <?php echo e($loginHistoryAudits->links()); ?>

            <?php else: ?>
                <?php echo e($loginHistoryAudits->appends(request()->query())->links()); ?>


            <?php endif; ?>

        </div>
    </div>



</div>

<?php $__env->startSection('pageScripts'); ?>

<?php $__env->stopSection(); ?>
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/auditTrial/userLoginHistoryAuditTrial.blade.php ENDPATH**/ ?>