<div role="tabpanel" id="referralBonus" class="tab-pane <?php if($activeTab == 'referralBonus'): ?> active <?php endif; ?>">

    <div class="panel-body" id="referralBonus">

            <div class="row">
                <div class="col-lg-12">

                                <form method="post" enctype="multipart/form-data" id="notificationForm" action="<?php echo e(route('user.referralBonus', $user->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <h3>Registration</h3>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Referral Old user amount on Registration(Code owner)</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e($user->userReferralBonus->code_owner_register_accept_value ?? ''); ?>" name="code_owner_register_accept_value" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Referral New user amount on Registration (Code user)</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e($user->userReferralBonus->code_user_register_accept_value ?? ''); ?>" name="code_user_register_accept_value" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

                                    <h3>KYC Accept</h3>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Referral Old user amount on KYC accept(Code owner)</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e($user->userReferralBonus->code_owner_kyc_accept_value ?? ''); ?>" name="code_owner_kyc_accept_value" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Referral New user amount on KYC accept (Code user)</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e($user->userReferralBonus->code_user_kyc_accept_value ?? ''); ?>" name="code_user_kyc_accept_value" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <h3>First Transaction</h3>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Referral Old user amount on first transaction(Code owner)</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e($user->userReferralBonus->code_owner_first_transaction_value ?? ''); ?>" name="code_owner_first_transaction_value" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Referral New user amount on first transaction (Code user)</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e($user->userReferralBonus->code_user_first_transaction_value ?? ''); ?>" name="code_user_first_transaction_value" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <div class="hr-line-dashed"></div>
                                    <h3>Min Limit</h3>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Min Load Limit</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e($user->userReferralLimit->min_load_limit ?? ''); ?>" name="min_load_limit" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Min Payment Limit</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e($user->userReferralLimit->min_payment_limit ?? ''); ?>" name="min_payment_limit" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="hr-line-dashed"></div>
                                    <h3>Referral Hold Amount</h3>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Hold Amount Before 1st Transaction</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e($user->userReferralLimit->hold_amount ?? ''); ?>" name="hold_amount" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                    <h3>First Transaction Amount</h3>
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Utility Payment >= than this amount is considered to be 1st transaction</label>
                                        <div class="col-sm-10">
                                            <input value="<?php echo e($user->userReferralLimit->first_transaction_amount ?? ''); ?>" name="first_transaction_amount" type="text" class="form-control">
                                            <small>*amount in paisa</small>
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>

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
<?php /**PATH /var/www/html/resources/views/admin/user/profile/tabs/referralBonus.blade.php ENDPATH**/ ?>