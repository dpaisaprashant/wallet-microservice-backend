<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title collapse-link">
                <h5>Filter <?php echo e($title); ?></h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content"
                 <?php if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ): ?> style="display: none" <?php endif; ?>>
                <div class="row">
                    <div class="col-sm-12">
                        <form role="form" method="get">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Enter User Name"
                                               class="form-control"
                                               value="<?php echo e(!empty($_GET['name']) ? $_GET['name'] : ''); ?>">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" name="number" placeholder="Enter Contact Number"
                                               class="form-control"
                                               value="<?php echo e(!empty($_GET['number']) ? $_GET['number'] : ''); ?>">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <input type="email" name="email" placeholder="Enter Email"
                                           class="form-control"
                                           value="<?php echo e(!empty($_GET['email']) ? $_GET['email'] : ''); ?>">
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select data-placeholder="User Type ..." class="chosen-select"
                                                tabindex="2" name="user_type">
                                            <option value="" selected disabled>User Type...</option>
                                            <?php if(!empty($_GET['user_type'])): ?>
                                                <option value="all"
                                                        <?php if($_GET['user_type']  == 'all'): ?> selected <?php endif; ?> >All
                                                </option>
                                                <option value="normal"
                                                        <?php if($_GET['user_type']  == 'user'): ?> selected <?php endif; ?> >
                                                    User
                                                </option>
                                                <option value="agent"
                                                        <?php if($_GET['user_type']  == 'agent'): ?> selected <?php endif; ?> >
                                                    Agent
                                                </option>

                                            <?php else: ?>
                                                <option value="all">All</option>
                                                <option value="user">User</option>
                                                <option value="agent">Agent</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>
                                


                                <div class="col-md-6" style="padding-bottom: 15px;">
                                    <label for="transaction_number">From User Registration Date</label>
                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                        <input id="date_load_from" type="text" class="form-control date_from"
                                               placeholder="From" name="from" autocomplete="off"
                                               value="<?php echo e(!empty($_GET['from']) ? $_GET['from'] : ''); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding-bottom: 15px;">
                                    <label for="transaction_number">To User Registration Date</label>
                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                        <input id="date_load_to" type="text" class="form-control date_to"
                                               placeholder="To" name="to" autocomplete="off"
                                               value="<?php echo e(!empty($_GET['to']) ? $_GET['to'] : ''); ?>">
                                    </div>
                                </div>


                                <div class="col-md-6" style="padding-bottom: 15px;">
                                    <label for="transaction_number">From User KYC Created Date</label>
                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                        <input id="date_load_from" type="text" class="form-control date_from"
                                               placeholder="From KYC Created Date" name="from_kyc_date" autocomplete="off"
                                               value="<?php echo e(!empty($_GET['from_kyc_date']) ? $_GET['from_kyc_date'] : ''); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding-bottom: 15px;">
                                    <label for="transaction_number">To User KYC Created Date</label>
                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                        <input id="date_load_to" type="text" class="form-control date_to"
                                               placeholder="To KYC Created Date" name="to_kyc_date" autocomplete="off"
                                               value="<?php echo e(!empty($_GET['to_kyc_date']) ? $_GET['to_kyc_date'] : ''); ?>">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="transaction_number">Transaction Number</label>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="From Transaction Amount"
                                                       name="from_transaction_number" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from_transaction_number']) ? $_GET['from_transaction_number'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="To Transaction Amount"
                                                       name="to_transaction_number" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to_transaction_number']) ? $_GET['to_transaction_number'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-md-6">
                                    <label for="wallet_balance">Wallet Balance</label>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="From Wallet balance"
                                                       name="from_wallet_balance" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from_wallet_balance']) ? $_GET['from_wallet_balance'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="To Wallet balance" name="to_wallet_balance"
                                                       autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to_wallet_balance']) ? $_GET['to_wallet_balance'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="transaction_amount">Transaction Payment</label>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="From Transaction payment"
                                                       name="from_transaction_payment" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from_transaction_payment']) ? $_GET['from_transaction_payment'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="To Transaction payment"
                                                       name="to_transaction_payment" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to_transaction_payment']) ? $_GET['to_transaction_payment'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="transaction_amount">Transaction Loaded</label>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="From Transaction loaded"
                                                       name="from_transaction_loaded" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['from_transaction_loaded']) ? $_GET['from_transaction_loaded'] : ''); ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                <input type="number" class="form-control"
                                                       placeholder="To Transaction loaded"
                                                       name="to_transaction_loaded" autocomplete="off"
                                                       value="<?php echo e(!empty($_GET['to_transaction_loaded']) ? $_GET['to_transaction_loaded'] : ''); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <br><label>Phone Verification</label><br>
                                    <div class="form-group">
                                        <select data-placeholder="Phone Verification..." class="chosen-select"
                                                tabindex="2" name="verification">
                                            <option value="" selected disabled>Phone Verification...</option>
                                            <?php if(!empty($_GET['verification'])): ?>
                                                <option value="all"
                                                        <?php if($_GET['verification']  == 'all'): ?> selected <?php endif; ?> >
                                                    All
                                                </option>
                                                <option value="verified"
                                                        <?php if($_GET['verification']  == 'verified'): ?> selected <?php endif; ?> >
                                                    Verified
                                                </option>
                                                <option value="unverified"
                                                        <?php if($_GET['verification'] == 'unverified'): ?> selected <?php endif; ?>>
                                                    Unverified
                                                </option>
                                            <?php else: ?>
                                                <option value="all">All</option>
                                                <option value="verified">Verified</option>
                                                <option value="unverified">Unverified</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <br><label>Referral Code</label><br>
                                    <input type="text" class="form-control" placeholder="Referral Code"
                                           name="referral_code" autocomplete="off"
                                           value="<?php echo e(!empty($_GET['referral_code']) ? $_GET['referral_code'] : ''); ?>">
                                </div>
                                <div class="col-md-4">
                                    <br><label>Kyc Status</label><br>
                                    <div class="form-group">
                                        <select data-placeholder="Kyc Status..." class="chosen-select"
                                                tabindex="2" name="kyc_status">
                                            <option value="" selected disabled>Kyc Status...</option>
                                            <?php if(!empty($_GET['kyc_status'])): ?>
                                                <option value="all"
                                                        <?php if($_GET['kyc_status']  == 'all'): ?> selected <?php endif; ?> >All
                                                </option>
                                                <option value="verified"
                                                        <?php if($_GET['kyc_status']  == 'verified'): ?> selected <?php endif; ?> >
                                                    Accepted
                                                </option>
                                                <option value="unverified"
                                                        <?php if($_GET['kyc_status']  == 'unverified'): ?> selected <?php endif; ?> >
                                                    Rejected
                                                </option>
                                                <option value="pending"
                                                        <?php if($_GET['kyc_status'] == 'pending'): ?> selected <?php endif; ?>>
                                                    Pending
                                                </option>
                                                <option value="notfilled"
                                                        <?php if($_GET['kyc_status'] == 'notfilled'): ?> selected <?php endif; ?>>
                                                    Not filled
                                                </option>
                                            <?php else: ?>
                                                <option value="all">All</option>
                                                <option value="verified">Accepted</option>
                                                <option value="unverified">Rejected</option>
                                                <option value="pending">Pending</option>
                                                <option value="notfilled">Not filled</option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                </div>

                                    <div class="col-md-4">
                                        <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-home""></i>
                                                    </span>
                                            <select data-placeholder="Choose District..." class="chosen-select"  tabindex="2" name="district">
                                                <option value="" selected disabled>Select District ...</option>
                                                <option value="">All</option>
                                                <?php if(!empty($_GET['district'])): ?>
                                                    <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($district); ?>" <?php if($_GET['district'] == $district): ?> selected <?php endif; ?>><?php echo e($district); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <?php $__currentLoopData = $districts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $district): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($district); ?>"> <?php echo e($district); ?> </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <br>
                            <div>
                                <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                        ><strong>Filter</strong></button>
                            </div>

                            <div>
                                <?php if(isset($excelRoute)): ?>
                                    <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                            type="submit" style="margin-right: 10px;"
                                            formaction="<?php echo e(route($excelRoute)); ?>"><strong>Excel</strong></button>
                                <?php else: ?>
                                    <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                            type="submit" style="margin-right: 10px;"
                                            formaction="<?php echo e(route('user.excel')); ?>"><strong>Excel</strong></button>
                                <?php endif; ?>
                            </div>
                            <?php echo $__env->make('admin.asset.components.clearFilterButton', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/resources/views/admin/userFilter/user-filter.blade.php ENDPATH**/ ?>