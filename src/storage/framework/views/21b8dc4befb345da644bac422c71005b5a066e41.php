<?php
$url = url()->current();
//$today = \Carbon\Carbon::now()->format('d M, Y');
?>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header" style="background-color: #2f4050 !important;">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold"><i class="fa fa-user"></i> &nbsp; <?php echo e(auth()->user()->name); ?></span>
                        <span class="text-muted text-xs block"> <i class="fa fa-envelope"></i> &nbsp; <?php echo e(auth()->user()->email); ?></span>
                    </a>

                </div>
                <div class="logo-element">
                    DP
                </div>
            </li>

            <li <?php if(preg_match('/dashboard/i', $url)): ?> class="active" <?php endif; ?>>
                <a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-diamond"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>
           
            <?php if(auth()->user()->hasAnyPermission(['Stat Dashboard KYC', 'Stat Dashboard paypoint', 'Stat Dashboard npay','Dashboard NCHL bank transfer','Dashboard NCHL load transaction'])): ?>
                <li <?php if($url == route('admin.dashboard.npay') || $url == route('admin.dashboard.paypoint') || $url == route('admin.dashboard.kyc')): ?>class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-bar-chart"></i> <span class="nav-label">Stat Dashboard</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Stat Dashboard KYC')): ?>
                            <li><a href="<?php echo e(route('admin.dashboard.kyc')); ?>">KYC</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Stat Dashboard paypoint')): ?>
                            <li><a href="<?php echo e(route('admin.dashboard.paypoint')); ?>">PayPoint</a></li>
                        <?php endif; ?>

                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Dashboard NCHL bank transfer')): ?>
                            <li><a href="<?php echo e(route('admin.dashboard.nchl.bankTransfer')); ?>">NCHL Bank Transfer</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Dashboard NCHL load transaction')): ?>
                            <li><a href="<?php echo e(route('admin.dashboard.nchl.loadTransaction')); ?>">NCHL Load Transaction</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            

            <?php if(auth()->user()->hasAnyPermission(['Backend user update profile', 'Backend user change password'])): ?>
                <li <?php if($url == route('backendUser.profile') || $url == route('backendUser.changePassword')): ?>class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-user-circle"></i> <span class="nav-label">My Profile</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Backend user update profile')): ?>
                            <li><a href="<?php echo e(route('backendUser.profile')); ?>">Update Profile</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Backend user change password')): ?>
                            <li><a href="<?php echo e(route('backendUser.changePassword')); ?>">Change password</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('Backend users view') || auth()->user()->hasPermissionTo('Backend user create')): ?>
                <li <?php if($url == route('backendUser.view') || $url == route('backendUser.create')): ?>class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-vcard"></i> <span class="nav-label">Backend Users</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Backend users view')): ?>
                            <li><a href="<?php echo e(route('backendUser.view')); ?>">View backend users</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Backend user create')): ?>
                            <li><a href="<?php echo e(route('backendUser.create')); ?>">Create backend user</a></li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('Roles view') || auth()->user()->hasPermissionTo('Role create')): ?>
                <li <?php if($url == route('role.view') || $url == route('role.create')): ?>class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-key"></i> <span class="nav-label">Roles</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Roles view')): ?>
                            <li><a href="<?php echo e(route('role.view')); ?>">View Roles</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Role create')): ?>
                            <li><a href="<?php echo e(route('role.create')); ?>">Create Role</a></li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            


            <li <?php if(preg_match('/users/i', $url)): ?> class="active" <?php endif; ?>>
                <a href="javascript:void(0)"><i class="fa fa-users"></i> <span class="nav-label">Users</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Users view')): ?>
                        <li><a href="<?php echo e(route('user.view')); ?>">View all Users</a></li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Rejected user kyc')): ?>
                        <li><a href="<?php echo e(route('reject.kycUsers')); ?>">Rejected User KYC</a></li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Accepted user kyc')): ?>
                        <li><a href="<?php echo e(route('accept.kycUsers')); ?>">Accepted User KYC</a></li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Pending user kyc')): ?>
                        <li><a href="<?php echo e(route('pending.kycUsers')); ?>">Pending User KYC</a></li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('KYC not filled users')): ?>
                        <li><a href="<?php echo e(route('kycNotFilled.Users')); ?>">KYC not filled users</a></li>
                    <?php endif; ?>
                </ul>
            </li>


            


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Merchant profile')): ?>
                <li <?php if(preg_match('/merchant/', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cart-plus"></i> <span class="nav-label">Merchants</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        
                        <li><a href="<?php echo e(route('merchant.view')); ?>">View Merchants</a></li>
                        

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View unverified merchant kyc')): ?>
                            <li><a href="<?php echo e(route('merchant.unverifiedMerchantKYC.view')); ?>">Unverified Merchant KYC</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Accepted merchant kyc')): ?>
                            <li><a href="<?php echo e(route('merchant.acceptedMerchantKYC.view')); ?>">Accepted Merchant KYC</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Rejected merchant kyc')): ?>
                            <li><a href="<?php echo e(route('merchant.rejectedMerchantKYC.view')); ?>">Rejected Merchant KYC</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('KYC not filled merchant')): ?>
                            <li><a href="<?php echo e(route('merchant.unfilledMerchantKYC.view')); ?>">Unfilled Merchant KYC</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create merchant')): ?>
                            <li><a href="<?php echo e(route('create.merchant.view')); ?>">Create Merchant</a></li>
                        <?php endif; ?>

                        

                        

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Merchant Ledger')): ?>
                            <li><a href="<?php echo e(route('admin.merchant.ledger.index')); ?>">Merchant Ledger</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View magnus linked accounts')): ?>
                            <li><a href="<?php echo e(route('admin.magnus.linked-account')); ?>">Magnus Linked Accounts</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('Merchant event list') || auth()->user()->hasPermissionTo('Merchant pending event list')): ?>
                <li <?php if(preg_match('/event/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-birthday-cake"></i> <span class="nav-label">Merchant Events</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Merchant event list')): ?>
                            <li><a href="<?php echo e(route('merchant.event.list')); ?>">All Events</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Merchant pending event list')): ?>
                            <li><a href="<?php echo e(route('merchant.event.pendingList')); ?>">Pending Events</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Deactivate users view')): ?>
                <li <?php if($url == route('user.deactivate.list')): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo e(route('user.deactivate.list')); ?>"><i class="fa fa-user-plus"></i> <span
                            class="nav-label">Deactivate Users</span></a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Locked users view')): ?>
                <li <?php if($url == route('user.locked.list')): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo e(route('user.locked.list')); ?>"><i class="fa fa-lock"></i> <span class="nav-label">Locked Users</span></a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Merchant locked view')): ?>
                <li <?php if($url == route('merchant.locked.list')): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo e(route('merchant.locked.list')); ?>"><i class="fa fa-lock"></i> <span class="nav-label">Locked Merchants</span></a>
                </li>
            <?php endif; ?>

            
            
            
            
            
            

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View admin edited kyc')): ?>
                <li <?php if(preg_match('/admin-updated-user-kyc/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo e(route('user.showAdminUpdatedKyc')); ?>"><i class="fa fa-user-secret"></i> <span
                            class="nav-label">Admin Updated KYC List</span></a>
                </li>
            <?php endif; ?>

            
            
            
            
            
            

            
            
            
            


            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('KYC list changed by backend user view')): ?>
                <li <?php if($url == route('backendUser.kycList')): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo e(route('backendUser.kycList')); ?>"><i class="fa fa-list"></i> <span class="nav-label">Your Changed KYC List</span></a>
                </li>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Architecture vendor transaction')): ?>
                <li <?php if(preg_match('/vendor-transactions/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-history"></i> <span
                            class="nav-label">Commission and Cashback</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php $__currentLoopData = $walletVendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vendor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('architecture.vendor.transaction', $vendor)); ?>"><?php echo e(ucwords(strtolower($vendor))); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
            <?php endif; ?>



            <?php if(auth()->user()->hasPermissionTo('View BFI Merchant') || auth()->user()->hasPermissionTo('View BFI user') || auth()->user()->hasPermissionTo('View bfi execute payment') || auth()->user()->hasPermissionTo('View bfi to user fund transfer') || auth()->user()->hasPermissionTo('View user to bfi fund transfer')): ?>
                <li <?php if($url == route('bfi.view') || $url == route('bfi.user.view')): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-history"></i> <span class="nav-label">BFI</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View BFI Merchant')): ?>
                            <li><a href="<?php echo e(route('bfi.view')); ?>">BFI Merchant</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View BFI user')): ?>
                            <li><a href="<?php echo e(route('bfi.user.view')); ?>">BFI User</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View bfi execute payment')): ?>
                            <li>
                                <a href="<?php echo e(route('view.bfi.execute.payment')); ?>">BFI Execute Payment</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View bfi to user fund transfer')): ?>
                            <li>
                                <a href="<?php echo e(route('view.bfi.to.user.fund.transfer')); ?>">BFI to user fund transfer</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View user to bfi fund transfer')): ?>
                            <li>
                                <a href="<?php echo e(route('view.user.to.bfi.fund.transfer')); ?>">User to bfi fund transfer</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>



            <?php if(auth()->user()->hasPermissionTo('Agent view') || auth()->user()->hasPermissionTo('Agent create')): ?>
                <li <?php if($url == route('agent.view') || $url == route('agent.create')): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-history"></i> <span class="nav-label">Agents</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Agent view')): ?>
                            <li><a href="<?php echo e(route('agent.view')); ?>">View Agent</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Agent create')): ?>
                            <li><a href="<?php echo e(route('agent.create')); ?>">Create Agent</a></li>
                        <?php endif; ?>
                        <li><a href="<?php echo e(route('agent.AdminAlteredAgents')); ?>">Admin Altered Agents</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasPermissionTo('Agent type view') || auth()->user()->hasPermissionTo('Agent type create') || auth()->user()->hasPermissionTo('View and update agent type hierarchy cashback')): ?>
                <li <?php if($url == route('agent.type.view') || $url == route('agent.type.create') ): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-list-ul"></i> <span class="nav-label">Agent Types</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Agent type view')): ?>
                            <li><a href="<?php echo e(route('agent.type.view')); ?>">View Agent Type</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Agent type create')): ?>
                            <li><a href="<?php echo e(route('agent.type.create')); ?>">Create Agent Type</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View and update agent type hierarchy cashback')): ?>
                            <li <?php if(preg_match('/vendor-transactions/i', $url)): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(route('view.agent.type.hierarchy.cashback')); ?>">
                                    <span
                                        class="nav-label">Agent Type Hierarchy Cashback</span></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <li <?php if(preg_match('/load-test/i', $url)): ?> class="active" <?php endif; ?>>
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Load Test Funds</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo e(route('loadTestFund.index')); ?>">View Load Test Funds</a></li>

                    <li><a href="<?php echo e(route('loadTestFund.create')); ?>">Create Load Test Funds</a></li>
                </ul>
            </li>

            <li <?php if(preg_match('/load-for-paypoint/i', $url)): ?> class="active" <?php endif; ?>>
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Load For Paypoint</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="<?php echo e(route('paypoint.loadTestFund.index')); ?>">View Load For Paypoint</a></li>

                    <li><a href="<?php echo e(route('paypoint.loadTestFund.create')); ?>">Create Load For Paypoint</a></li>
                </ul>
            </li>


            <?php if(auth()->user()->hasPermissionTo('Refund view') || auth()->user()->hasPermissionTo('Refund create')): ?>
                <li <?php if(preg_match('/refund/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Refund</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Refund view')): ?>
                            <li><a href="<?php echo e(route('refund.index')); ?>">View Refund</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Refund create')): ?>
                            <li><a href="<?php echo e(route('refund.create')); ?>">Create Refund</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Refund create pretransaction')): ?>
                            <li><a href="<?php echo e(route('refund.pretransaction.create')); ?>">Create Pretransaction</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Refund view pretransaction')): ?>
                            <li><a href="<?php echo e(route('refund.pretransaction.view')); ?>">View Refunded Pretransactions</a>
                            </li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            
            
            
            
            
            
            
            
            
            


            <?php if(auth()->user()->hasPermissionTo('Lucky winner view') || auth()->user()->hasPermissionTo('Lucky winner create')): ?>
                <li <?php if(preg_match('/lucky/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Winner Deposit</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Lucky winner view')): ?>
                            <li><a href="<?php echo e(route('luckyWinner.index')); ?>">View Winner Deposits</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Lucky winner create')): ?>
                            <li><a href="<?php echo e(route('luckyWinner.create')); ?>">Create Winner Deposit</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            

            <?php if(auth()->user()->hasPermissionTo('Repost transaction npay') || auth()->user()->hasPermissionTo('Repost transaction nps') || auth()->user()->hasPermissionTo('Repost transaction connectips')): ?>
                <li <?php if(preg_match('/repost/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Repost Transaction</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Repost transaction npay')): ?>
                            <li><a href="<?php echo e(route('repost.npay')); ?>">NPay Repost</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Repost transaction nps')): ?>
                            <li><a href="<?php echo e(route('repost.nps')); ?>">NPS Repost</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Repost transaction connectips')): ?>
                            <li><a href="<?php echo e(route('repost.connectIPS')); ?>">Connect IPS Repost</a></li>
                        <?php endif; ?>
                            
                            
                    </ul>
                </li>
            <?php endif; ?>



            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View pre-transactions')): ?>
                <li <?php if($url == route('preTransaction.view')): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo e(route('preTransaction.view')); ?>"><i class="fa fa-handshake-o"></i> <span
                            class="nav-label"> Pre Transactions</span></a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['View request info'])): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View request info')): ?>
                    <li><a href="<?php echo e(route('requestinfo.index')); ?>"><i class="fa fa-info-circle"></i><span
                                class="nav-label">&nbsp Requests Info</span></a></li>
                <?php endif; ?>
            <?php endif; ?>


            <?php if(auth()->user()->hasAnyPermission(['Complete transaction view', 'Fund transfer view', 'Fund request view', 'EBanking view', 'Paypoint view','Transaction nps view','Transaction nchl bank transfer','Transaction nchl load','Nicasia cybersource load transaction','Cellpay user transaction view','Nicasia cybersource view'])): ?>
                <li <?php if($url == route('transaction.complete') || $url == route('transaction.userToUserFundTransfer') || $url == route('fundRequest') || $url == route('eBanking') || $url == route('paypoint')): ?>class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Transactions</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Complete transaction view')): ?>
                            <li><a href="<?php echo e(route('transaction.complete')); ?>">Complete Transactions</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Complete transaction view')): ?>
                            <li><a href="<?php echo e(route('transaction.complete.user')); ?>">Complete Transactions User</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Fund transfer view')): ?>
                            <li><a href="<?php echo e(route('transaction.userToUserFundTransfer')); ?>">Fund Transfers</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Fund request view')): ?>
                            <li><a href="<?php echo e(route('fundRequest')); ?>">Fund Requests</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('EBanking view')): ?>
                            <li><a href="<?php echo e(route('eBanking')); ?>">NPay Web/Mobile Banking</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Transaction nps view')): ?>
                            <li><a href="<?php echo e(route('nps')); ?>">Nps Web/Mobile Banking</a></li>
                        <?php endif; ?>

                        

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Paypoint view')): ?>
                            <li><a href="<?php echo e(route('paypoint')); ?>">Paypoint Transactions</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Transaction nchl load')): ?>
                            <li><a href="<?php echo e(route('nchl.loadTransaction')); ?>">NCHL Load</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Transaction nchl bank transfer')): ?>
                            <li><a href="<?php echo e(route('nchl.bankTransfer')); ?>">NCHL Bank Transfer</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View nchl aggregated payment')): ?>
                            <li><a href="<?php echo e(route('nchl.aggregatePayment')); ?>">NCHL Aggregated Payment</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Nicasia cybersource view')): ?>
                            <li><a href="<?php echo e(route('nicAsia.viewCyberSourceLoad')); ?>">NIC Asia Transaction</a></li>
                        <?php endif; ?>



                        

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Cellpay user transaction view')): ?>
                            <li><a href="<?php echo e(route('cellPayUserTransaction.view')); ?>">CellPay Transactions</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View load wallet')): ?>
                            <li><a href="<?php echo e(route('npsaccountlinkload.view')); ?>">Account Link</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Merchant revenue view')): ?>
                            <li><a href="<?php echo e(route('merchant-transaction.index')); ?>">Merchant Transactions</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View ticket sale report')): ?>
                            <li><a href="<?php echo e(route('transactions.ticketSalesReport')); ?>">Ticket Sales Report</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View load test fund report')): ?>
                            <li><a href="<?php echo e(route('transactions.loadTestFundReport')); ?>">Lucky Winners Report</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Transaction nps view')): ?>
                            <li><a href="<?php echo e(route('transactions.nepalQRpayment')); ?>">NepalQR Payment</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['View load wallet'])): ?>
                <li><a href="<?php echo e(route('linkedaccounts.view')); ?>"><i class="fa fa-link"></i>Linked Accounts</a></li>
            <?php endif; ?>


            <?php if(auth()->user()->hasAnyPermission(['Failed paypoint view', 'Failed npay view'])): ?>
                <li <?php if($url == route('userTransaction.failed') || $url == route('userLoadTransaction.failed')): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-recycle"></i> <span class="nav-label">Failed Transactions</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Failed paypoint view')): ?>
                            <li><a href="<?php echo e(route('userTransaction.failed')); ?>">Failed Paypoint Transactions</a></li>
                        <?php endif; ?>

                        
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['Clearance npay', 'Clearance paypoint'])): ?>
                <li <?php if($url == route('clearance.transactions') || $url == route('clearance.generate')): ?> class="active" <?php endif; ?>>
                    <a href="<?php echo e(route('clearance.transactions')); ?>"><i class="fa fa-handshake-o"></i> <span
                            class="nav-label">Clearance</span></a>
                </li>
            <?php endif; ?>

            

            

            
            
            
            
            
            
            
            <li <?php if($url == route('ViewNEASettlement')): ?> class="active" <?php endif; ?>>
                <a href="<?php echo e(route('ViewNEASettlement')); ?>"><i class="fa fa-handshake-o"></i> <span
                        class="nav-label">NEA Settlement</span></a>
            </li>
            




            

            

            

            
            
            
            
            
            

            <?php if(auth()->user()->hasAnyPermission(['Monthly report view', 'Yearly report view','Report paypoint','Report npay','Report nchl load','Report referral','Report register using referral user','Report subscriber daily','Report reconciliation','Report nrb active and inactive user','Report non bank payment','Report wallet end balance','Report admin kyc','Report commission'])): ?>
                <li <?php if(preg_match('/report/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Report</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        
                        
                        
                        
                        
                        

                        
                        <li><a href="<?php echo e(route('report.audit.mismatch')); ?>">Audit Trail Mismatch Report</a></li>
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report paypoint')): ?>
                            <li><a href="<?php echo e(route('report.paypoint')); ?>">PayPoint Report</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report npay')): ?>
                            <li><a href="<?php echo e(route('report.npay')); ?>">NPay Report</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report nchl load')): ?>
                            <li><a href="<?php echo e(route('report.nchl.load')); ?>">NCHL Load Report</a></li>
                        <?php endif; ?>
                        
                        
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report register using referral user')): ?>
                            <li><a href="<?php echo e(route('referral.registerUsingReferralUserReport')); ?>">Registered Using
                                    Referral
                                    Report</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report subscriber daily')): ?>
                            <li><a href="<?php echo e(route('report.subscriber')); ?>">Subscriber Report</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report reconciliation')): ?>
                            <li><a href="<?php echo e(route('report.dailyDashboard')); ?>">Daily Dashboard</a></li>
                            <li><a href="<?php echo e(route('report.reconciliation')); ?>">Reconciliation Report</a></li>
                            <li><a href="<?php echo e(route('report.range.reconciliation')); ?>">Reconciliation Range Report</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report reconciliation')): ?>
                            <li><a href="<?php echo e(route('report.range.wallet_ledger')); ?>">Wallet Ledger</a></li>
                        <?php endif; ?>



                        

                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report wallet end balance')): ?>
                            <li><a href="<?php echo e(route('wallet.endbalance')); ?>">Wallet end balance report</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report admin kyc')): ?>
                            <li><a href="<?php echo e(route('report.adminKyc')); ?>">Admin kyc report</a></li>
                        <?php endif; ?>
                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View mismatched user balance and bonus balance')): ?>
                            <li><a href="<?php echo e(route('report.mismatchedUserBalance')); ?>">Mismatched User Balance</a></li>

                            
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View lucky winner report')): ?>
                            <li><a href="<?php echo e(route('report.lucky.winner')); ?>">Lucky Winners Report</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View ticket sale report')): ?>
                            <li><a href="<?php echo e(route('report.ticket.sale')); ?>">Ticket Sales Report</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report user registered by user')): ?>
                            <li><a href="<?php echo e(route('report.user-registered-by-user')); ?>">Users Registered By Agents</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View wallet payables')): ?>
                            <li><a href="<?php echo e(route('report.walletPayablesReport')); ?>">Wallet Payables Report</a></li>
                        <?php endif; ?>

                        
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['Monthly report view', 'Yearly report view','Report paypoint','Report npay','Report nchl load','Report referral','Report register using referral user','Report subscriber daily','Report reconciliation','Report nrb active and inactive user','Report non bank payment','Report wallet end balance','Report admin kyc','Report commission'])): ?>
                <li <?php if(preg_match('/report/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">NRB Annex Reports</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Monthly report view')): ?>
                            <li><a href="<?php echo e(route('report.nrb.annex.agent.payments')); ?>">Nrb Annex 10.1.5 Agent
                                    Report</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Monthly report view')): ?>
                            <li><a href="<?php echo e(route('report.nrb.annex.customer.payments')); ?>">Nrb Annex 10.1.5 Initiated
                                    Customer Report</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Monthly report view')): ?>
                            <li><a href="<?php echo e(route('report.nrb.annex.merchant.payments')); ?>">Nrb Annex 10.1.6 Report</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Monthly report view')): ?>
                            <li><a href="<?php echo e(route('report.statement.settlement.bank')); ?>">Statement Settlement Bank
                                    Report</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report nrb active and inactive user')): ?>
                            <li><a href="<?php echo e(route('report.active.inactive.user')); ?>">NRB Active/Inactive User Report</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report nrb active and inactive user')): ?>
                            <li><a href="<?php echo e(route('report.active.inactive.user.new')); ?>">NRB Active/Inactive User Report
                                    (New Changes)</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report nrb active and inactive user')): ?>
                            <li><a href="<?php echo e(route('report.active.inactive.user.slab')); ?>">NRB Active/Inactive User Slab
                                    Report</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report nrb active and inactive user')): ?>
                            <li><a href="<?php echo e(route('report.nrb.annex.agent.payment')); ?>">NRB Annex 10.1.11
                                    Report</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report nrb reconciliation')): ?>
                            <li><a href="<?php echo e(route('report.nrb.annex.reconciliation')); ?>">NRB Reconciliation Report</a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Agent details view')): ?>
                            <li><a href="<?php echo e(route('agent.detail')); ?>">22 Part Three Agent Details</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Nrb each agent report view')): ?>
                            <li><a href="<?php echo e(route('report.nrb.annex.agent.each')); ?>">22 Part Four Agents Details</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            

            <?php if(auth()->user()->hasAnyPermission(['Report device info'])): ?>
                <li <?php if(preg_match('/report/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-line-chart"></i> <span
                            class="nav-label">Miscellaneous Reports</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Report device info')): ?>
                            <li><a href="<?php echo e(route('report.device.info')); ?>">Device Info Report</a></li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['View blocked ip', 'View whitelisted ip'])): ?>
                <li <?php if(preg_match('/ip/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-server"></i> <span class="nav-label">Block / Whitelist IPs</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View blocked ip')): ?>
                            <li <?php if($url == route('blockedip.view')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(route('blockedip.view')); ?>"><i class="fa fa-lock"></i> Block IP</a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View whitelisted ip')): ?>
                            <li <?php if($url == route('whitelistedIP.view')): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(route('whitelistedIP.view')); ?>"><i class="fa fa-check-square"></i> Whitelist
                                    IP</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['User session log view', 'Backend user log view' , 'Auditing log view', 'Profiling log view', 'Statistics log view', 'Development log view','Api log'])): ?>
                <li <?php if(preg_match('/log/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-th-list"></i> <span class="nav-label">Logs</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('User session log view')): ?>
                            <li><a href="<?php echo e(route('admin.log.userSession')); ?>">User Session Log</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Backend user log view')): ?>
                            <li><a href="<?php echo e(route('backendLog.all')); ?>">Backend Log</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Api log')): ?>
                            <li><a href="<?php echo e(route('apiLog.all')); ?>">API Log</a></li>
                        <?php endif; ?>

                        
                    </ul>
                </li>
            <?php endif; ?>



            <?php if(auth()->user()->hasPermissionTo('View issue ticket')): ?>
                <li <?php if($url == route('issue.ticket.view')): ?>class="active" <?php endif; ?>>
                    <a href="<?php echo e(route('issue.ticket.view')); ?>"><i class="fa fa-ticket"></i> <span class="nav-label">Issues/Tickets</span></a>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['Notification view', 'Notification create'])): ?>
                <li <?php if(preg_match('/notification/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-bell-o"></i> <span class="nav-label">Notifications</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Notification view')): ?>
                            <li><a href="<?php echo e(route('notification.view')); ?>">View Notification</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Notification create')): ?>
                            <li><a href="<?php echo e(route('notification.create')); ?>">Create Notification</a></li>
                        <?php endif; ?>

                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['Sparrow SMS view', 'Sparrow SMS detail view'])): ?>
                <li <?php if(preg_match('/sparrow/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label"> SMS</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Sparrow SMS view')): ?>
                            <li>
                                <a href="<?php echo e(route('sparrow.view')); ?>"> <span class="nav-label"> SMS</span></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Sparrow SMS detail view')): ?>
                            <li>
                                <a href="<?php echo e(route('sparrow.detail')); ?>"> <span class="nav-label"> SMS Detail</span></a>
                            </li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Miracle info SMS view')): ?>
                            <li>
                                <a href="<?php echo e(route('miracle-info.view')); ?>"><span class="nav-label">Miracle Info SMS</span></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['General page setting view', 'General page setting create'])): ?>
                <li <?php if(preg_match('/general/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">General Page Setting</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('General page setting view')): ?>
                            <li><a href="<?php echo e(route('general.setting.index')); ?>">View General Pages</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('General page setting create')): ?>
                            <li><a href="<?php echo e(route('general.setting.create')); ?>">Create General Pages</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission([
                        'General setting view',
                        'Npay setting view',
                        'Paypoint setting view',
                        'Limits setting view',
                        'Paypoint commission setting view',
                        'Transaction fee setting view',
                        'KYC setting view',
                        'OTP setting view',
                        'Merchant setting view',
                        'Nps setting view',
                        'Nchl load setting view',
                        'Nchl bank transfer setting view',
                        'Nchl aggregated setting view',
                        'Nicasia cybersource setting view',
                        'Referral setting view',
                        'Bonus setting view',
                        'Notification setting view',
                        'Redirect setting view',
                        'Agent setting view',
                ])): ?>
                <li <?php if(preg_match('/settings/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Settings</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('General setting view')): ?>
                            <li><a href="<?php echo e(route('settings.general')); ?>">General Setting</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Merchant setting view')): ?>
                            <li><a href="<?php echo e(route('settings.merchant')); ?>">Merchant Setting</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Npay setting view')): ?>
                            <li><a href="<?php echo e(route('settings.npay')); ?>">Npay Setting</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Nps setting view')): ?>
                            <li><a href="<?php echo e(route('settings.nps')); ?>">NPS Setting</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Paypoint setting view')): ?>
                            <li><a href="<?php echo e(route('settings.paypoint')); ?>">Paypoint Setting</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Nchl load setting view')): ?>
                            <li><a href="<?php echo e(route('settings.nchl.load')); ?>">NCHL Load Setting</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Nchl bank transfer setting view')): ?>
                            <li><a href="<?php echo e(route('settings.nchl.bankTransfer')); ?>">NCHL Bank Transfer Setting</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Nchl aggregated setting view')): ?>
                            <li><a href="<?php echo e(route('settings.nchl.aggregatedPayments')); ?>">NCHL Aggregated Payments
                                    Setting</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Nicasia cybersource setting view')): ?>
                            <li><a href="<?php echo e(route('settings.nicAsiaCyberSource')); ?>">CyberSource Load Setting</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Limits setting view')): ?>
                            <li><a href="<?php echo e(route('settings.limit')); ?>">Limits Setting</a></li>
                        <?php endif; ?>

                        

                        

                        

                        
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Referral setting view')): ?>
                            <li><a href="<?php echo e(route('settings.referral')); ?>">Referral Setting</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Bonus setting view')): ?>
                            <li><a href="<?php echo e(route('settings.bonus')); ?>">Bonus Setting</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Notification setting view')): ?>
                            <li><a href="<?php echo e(route('settings.notification')); ?>">Notification Setting</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Redirect setting view')): ?>
                            <li><a href="<?php echo e(route('settings.redirect')); ?>">Redirect Setting</a></li>
                        <?php endif; ?>

                        

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Agent setting view')): ?>
                            <li><a href="<?php echo e(route('settings.agent')); ?>">Agent Setting</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('General setting view')): ?>
                            <li><a href="<?php echo e(route('settings.userActivityBonus')); ?>">User Activity Bonus Setting</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>
            
            <?php if(auth()->user()->hasAnyPermission(['Blog View'])): ?>
                <li <?php if(preg_match('/frontend/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Blogs</span><span
                            class="fa arrow"></span></a>
                     <ul class="nav nav-second-level collapse"> 
                         
                          
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Blog View')): ?>
                            <li><a href="<?php echo e(route('blog.post')); ?>">Posts</a></li>
                            <li><a href="<?php echo e(route('blog.type')); ?>">Types</a></li>
                            <li><a href="<?php echo e(route('blog.tag')); ?>">Tags</a></li>
                            <?php endif; ?>

                        
                        
                    </ul>
                </li>
            <?php endif; ?>

             <?php if(auth()->user()->hasAnyPermission(['Blog View'])): ?>
                <li <?php if(preg_match('/frontend/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Career</span><span
                            class="fa arrow"></span></a>
                     <ul class="nav nav-second-level collapse"> 
                         
                          
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Blog View')): ?>
                            <li><a href="<?php echo e(route('career.job')); ?>">Opportunities</a></li>
                            <li><a href="<?php echo e(route('career.domain')); ?>">Domain</a></li>
                            
                            <?php endif; ?>

                        

                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['Blog View'])): ?>
                <li <?php if(preg_match('/frontend/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Khalti-Services</span><span
                            class="fa arrow"></span></a>
                     <ul class="nav nav-second-level collapse"> 
                          
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Blog View')): ?>
                            <li><a href="<?php echo e(route('khalti.khalti_services')); ?>">Khalti_services</a></li>
                            <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

             <?php if(auth()->user()->hasAnyPermission(['Blog View'])): ?>
                <li <?php if(preg_match('/frontend/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Notification</span><span
                            class="fa arrow"></span></a>
                     <ul class="nav nav-second-level collapse"> 
                         
                          
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Blog View')): ?>
                            <li><a href="<?php echo e(route('appNotification.notification')); ?>">Message</a></li>
                            
                            <?php endif; ?>

                        

                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['Blog View'])): ?>
                <li <?php if(preg_match('/frontend/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Customer Feedback</span><span
                        class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse"> 
                         
                        
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Blog View')): ?>
                            <li><a href= "<?php echo e(route('feedback.feedback')); ?>">Feedbacks</a></li>
                            
                            <?php endif; ?>

                        

                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['Frontend header view', 'Frontend service view', 'Frontend about view', 'Frontend process view'])): ?>
                <li <?php if(preg_match('/frontend/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Frontend Settings</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if(strtolower(config('app.'.'name')) == 'dpaisa' || strtolower(config('app.'.'name')) == 'icash' || strtolower(config('app.'.'name')) == 'master'): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend header view')): ?>
                                <li><a href="<?php echo e(route('frontend.header')); ?>">Headers</a></li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(strtolower(config('app.'.'name')) == 'sajilopay' || strtolower(config('app.'.'name')) == 'master'): ?>
                            <li><a href="<?php echo e(route('frontend.multipleHeader')); ?>">Headers</a></li>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend service view')): ?>
                            <li><a href="<?php echo e(route('frontend.service.index')); ?>">Services</a></li>
                        <?php endif; ?>

                        <?php if(strtolower(config('app.'.'name')) == 'dpaisa' || strtolower(config('app.'.'name')) == 'icash' || strtolower(config('app.'.'name')) == 'master'): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend about view')): ?>
                                <li><a href="<?php echo e(route('frontend.about.index')); ?>">Abouts</a></li>
                            <?php endif; ?>
                        <?php endif; ?>


                        <?php if(strtolower(config('app.'.'name')) == 'dpaisa' || strtolower(config('app.'.'name')) == 'master'): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend process view')): ?>
                                <li><a href="<?php echo e(route('frontend.process.index')); ?>">Processes</a></li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend banner view')): ?>
                            <li><a href="<?php echo e(route('frontend.banner.index')); ?>">Banners</a></li>
                        <?php endif; ?>

                        <?php if(strtolower(config('app.'.'name')) == 'dpaisa' || strtolower(config('app.'.'name')) == 'master'): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend contact view')): ?>
                                <li><a href="<?php echo e(route('frontend.contact')); ?>">Contact</a></li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(strtolower(config('app.'.'name')) == 'dpaisa' || strtolower(config('app.'.'name')) == 'icash' || strtolower(config('app.'.'name')) == 'master' ): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend faq view')): ?>
                                <li><a href="<?php echo e(route('frontend.faq.index')); ?>">FAQs</a></li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(strtolower(config('app.'.'name')) == 'dpaisa' || strtolower(config('app.'.'name')) == 'master'): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend news view')): ?>
                                <li><a href="<?php echo e(route('frontend.news.index')); ?>">NEWS</a></li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if(strtolower(config('app.'.'name')) == 'dpaisa' || strtolower(config('app.'.'name')) == 'master'): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend solution view')): ?>
                                <li><a href="<?php echo e(route('frontend.solution.index')); ?>">Solutions</a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(strtolower(config('app.'.'name')) == 'dpaisa' || strtolower(config('app.'.'name')) == 'master'): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Frontend partner view')): ?>
                                <li><a href="<?php echo e(route('frontend.partner.index')); ?>">Partners</a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>

            <?php if(auth()->user()->hasAnyPermission(['View wallet service', 'Yearly report view','Report paypoint','Report npay','Report nchl load','Report referral','Report register using referral user','Report subscriber daily','Report reconciliation','Report nrb active and inactive user','Report non bank payment','Report wallet end balance','Report admin kyc','Report commission'])): ?>
                <li <?php if(preg_match('/developer/i', $url)): ?> class="active" <?php endif; ?>>
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Developers option</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View wallet service')): ?>
                            <li><a href="<?php echo e(route('wallet.service.view')); ?>">Wallet Service</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View wallet permission transaction type')): ?>
                            <li><a href="<?php echo e(route('wallet.permission.transaction.type.view')); ?>">Wallet Permission
                                    Transaction Type</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View wallet transaction type')): ?>
                            <li><a href="<?php echo e(route('wallet.transaction.type.view')); ?>">Wallet Transaction Type</a></li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View seeder list')): ?>
                            <li><a href="<?php echo e(route('view.seeder')); ?>">Run seeder</a></li>
                        <?php endif; ?>


                    </ul>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</nav>
<?php /**PATH /var/www/html/resources/views/admin/layouts/admin_sidebar.blade.php ENDPATH**/ ?>