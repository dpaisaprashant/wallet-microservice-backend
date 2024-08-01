<div role="tabpanel" id="cardLoadCommission" class="tab-pane <?php if($activeTab == 'cardLoadCommission'): ?> active <?php endif; ?>">

    <div class="panel-body" id="cardLoadCommission">

            <div class="row">
                <div class="col-lg-12">

                                <form method="post" enctype="multipart/form-data" id="notificationForm" action="<?php echo e(route('user.cardLoadCommission', $user->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <h3>Card Load Commission</h3>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Card Load Commission Type</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="commission_type">
                                                <?php if(!empty(optional($userLoadCommission)->commission_type)): ?>
                                                    <option value="FLAT" <?php if(optional($userLoadCommission)->commission_type == 'FLAT'): ?> selected <?php endif; ?>>Flat</option>
                                                    <option value="PERCENTAGE" <?php if(optional($userLoadCommission)->commission_type == 'PERCENTAGE'): ?> selected <?php endif; ?>>Percentage</option>
                                                <?php else: ?>
                                                    <option value="FLAT">Flat</option>
                                                    <option value="PERCENTAGE">Percentage</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Card Load Commission Value</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e(optional($userLoadCommission)->commission_value ?? ""); ?>" name="commission_value" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


            </div>
        </div>


</div>
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/cardLoadCommission.blade.php ENDPATH**/ ?>