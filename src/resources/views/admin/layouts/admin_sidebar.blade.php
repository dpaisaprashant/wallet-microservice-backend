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
                        <span class="block m-t-xs font-bold"><i class="fa fa-user"></i> &nbsp; {{ auth()->user()->name }}</span>
                        <span class="text-muted text-xs block"> <i class="fa fa-envelope"></i> &nbsp; {{ auth()->user()->email }}</span>
                    </a>

                </div>
                <div class="logo-element">
                    DP
                </div>
            </li>

            <li @if(preg_match('/dashboard/i', $url)) class="active" @endif>
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-diamond"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>

            @if(auth()->user()->hasAnyPermission(['Stat Dashboard KYC', 'Stat Dashboard paypoint', 'Stat Dashboard npay','Dashboard NCHL bank transfer','Dashboard NCHL load transaction']))
                <li @if($url == route('admin.dashboard.npay') || $url == route('admin.dashboard.paypoint') || $url == route('admin.dashboard.kyc'))class="active" @endif>
                    <a href="#"><i class="fa fa-bar-chart"></i> <span class="nav-label">Stat Dashboard</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('Stat Dashboard KYC')
                            <li><a href="{{ route('admin.dashboard.kyc') }}">KYC</a></li>
                        @endcan

                        {{--@can('Stat Dashboard paypoint')
                            <li><a href="{{ route('admin.dashboard.paypoint') }}">PayPoint</a></li>
                        @endcan--}}

                        {{--@can('Stat Dashboard npay')
                            <li><a href="{{ route('admin.dashboard.npay') }}">NPay</a></li>
                        @endcan--}}
                        {{--@can('Dashboard NCHL bank transfer')
                            <li><a href="{{ route('admin.dashboard.nchl.bankTransfer') }}">NCHL Bank Transfer</a></li>
                        @endcan--}}
                        {{--@can('Dashboard NCHL load transaction')
                            <li><a href="{{ route('admin.dashboard.nchl.loadTransaction') }}">NCHL Load Transaction</a>
                            </li>
                        @endcan--}}

                    </ul>
                </li>
            @endif

            {{--@can('Development tools view')
            <li  @if(preg_match('/development-tool/i', $url)) class="active" @endif>
                <a href="{{ route('developmentTool.index') }}"><i class="fa fa-bug"></i> <span class="nav-label">Development Tool</span></a>
            </li>
            @endcan--}}

            @if(auth()->user()->hasAnyPermission(['Backend user update profile', 'Backend user change password']))
                <li @if($url == route('backendUser.profile') || $url == route('backendUser.changePassword'))class="active" @endif>
                    <a href="#"><i class="fa fa-user-circle"></i> <span class="nav-label">My Profile</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('Backend user update profile')
                            <li><a href="{{ route('backendUser.profile') }}">Update Profile</a></li>
                        @endcan

                        @can('Backend user change password')
                            <li><a href="{{ route('backendUser.changePassword') }}">Change password</a></li>
                        @endcan
                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasPermissionTo('Backend users view') || auth()->user()->hasPermissionTo('Backend user create'))
                <li @if($url == route('backendUser.view') || $url == route('backendUser.create'))class="active" @endif>
                    <a href="#"><i class="fa fa-vcard"></i> <span class="nav-label">Backend Users</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        @can('Backend users view')
                            <li><a href="{{ route('backendUser.view') }}">View backend users</a></li>
                        @endcan

                        @can('Backend user create')
                            <li><a href="{{ route('backendUser.create') }}">Create backend user</a></li>
                        @endcan

                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasPermissionTo('Roles view') || auth()->user()->hasPermissionTo('Role create'))
                <li @if($url == route('role.view') || $url == route('role.create'))class="active" @endif>
                    <a href="#"><i class="fa fa-key"></i> <span class="nav-label">Roles</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        @can('Roles view')
                            <li><a href="{{ route('role.view') }}">View Roles</a></li>
                        @endcan

                        @can('Role create')
                            <li><a href="{{ route('role.create') }}">Create Role</a></li>
                        @endcan

                    </ul>
                </li>
            @endif

            {{-- @can('Bank list view')
             <li  @if($url == route('bankList')) class="active" @endif>
                 <a href="{{ route('bankList') }}"><i class="fa fa-bank"></i> <span class="nav-label">Bank List</span></a>
             </li>
             @endcan--}}

            @can('Users view')
                <li @if(preg_match('/users/i', $url)) class="active" @endif>
                    <a href="{{ route('user.view') }}"><i class="fa fa-users"></i> <span class="nav-label">Users</span></a>
                </li>
            @endcan

            {{-- @can('Group force password change')
                 <li @if(preg_match('/force-password/i', $url)) class="active" @endif>
                     <a href="{{ route('group.forcePasswordChange') }}"><i class="fa fa-cart-plus"></i> <span
                             class="nav-label">Force Password Change</span></a>
                 </li>
             @endcan--}}


            @can('Merchant profile')
                <li @if(preg_match('/merchans/i', $url)) class="active" @endif>
                    <a href="{{ route('merchant.view') }}"><i class="fa fa-cart-plus"></i> <span
                            class="nav-label">Merchants</span></a>
                </li>
            @endcan


            {{--@if(auth()->user()->hasPermissionTo('Merchant event list') || auth()->user()->hasPermissionTo('Merchant pending event list'))
            <li @if(preg_match('/event/i', $url)) class="active" @endif>
                <a href="#"><i class="fa fa-birthday-cake"></i> <span class="nav-label">Merchant Events</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    @can('Merchant event list')
                        <li><a href="{{ route('merchant.event.list') }}">All Events</a></li>
                    @endcan
                    @can('Merchant pending event list')
                        <li><a href="{{ route('merchant.event.pendingList') }}">Pending Events</a></li>
                    @endcan
                </ul>
            </li>
            @endif--}}

            @can('Deactivate users view')
                <li @if($url == route('user.deactivate.list')) class="active" @endif>
                    <a href="{{ route('user.deactivate.list') }}"><i class="fa fa-user-plus"></i> <span
                            class="nav-label">Deactivate Users</span></a>
                </li>
            @endcan

            @can('Locked users view')
                <li @if($url == route('user.locked.list')) class="active" @endif>
                    <a href="{{ route('user.locked.list') }}"><i class="fa fa-lock"></i> <span class="nav-label">Locked Users</span></a>
                </li>
            @endcan

            {{--@can('Merchant locked view')
                <li @if($url == route('merchant.locked.list')) class="active" @endif>
                    <a href="{{ route('merchant.locked.list') }}"><i class="fa fa-lock"></i> <span class="nav-label">Locked Merchants</span></a>
                </li>
            @endcan--}}

            @can('KYC not filled users view')
                <li @if(preg_match('/kyc-not-filled-user/i', $url)) class="active" @endif>
                    <a href="{{ route('user.kycNotFilled.view') }}"><i class="fa fa-user-secret"></i> <span
                            class="nav-label">KYC Not Filled Users</span></a>
                </li>
            @endcan

            @can('Unverified KYC users view')
                <li @if($url == route('user.unverifiedKYC.view')) class="active" @endif>
                    <a href="{{ route('user.unverifiedKYC.view') }}"><i class="fa fa-user-times"></i> <span
                            class="nav-label">Unverified KYC List</span></a>
                </li>
            @endcan

            {{--                <li @if($url == route('merchant.unverifiedMerchantKYC.view')) class="active" @endif>--}}
            {{--                    <a href="{{ route('merchant.unverifiedMerchantKYC.view') }}"><i class="fa fa-user-times"></i> <span--}}
            {{--                            class="nav-label">Unverified Merchant KYC List</span></a>--}}
            {{--                </li>--}}


            @can('KYC list changed by backend user view')
                <li @if($url == route('backendUser.kycList')) class="active" @endif>
                    <a href="{{ route('backendUser.kycList') }}"><i class="fa fa-list"></i> <span class="nav-label">Your Changed KYC List</span></a>
                </li>
            @endcan

            @can('Architecture vendor transaction')
                <li @if(preg_match('/vendor-transactions/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-history"></i> <span
                            class="nav-label">Commission and Cashback</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @foreach($walletVendors as $vendor)
                            <li>
                                <a href="{{ route('architecture.vendor.transaction', $vendor) }}">{{ ucwords(strtolower($vendor)) }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endcan



            @if(auth()->user()->hasPermissionTo('View BFI Merchant') || auth()->user()->hasPermissionTo('View BFI user') || auth()->user()->hasPermissionTo('View bfi execute payment') || auth()->user()->hasPermissionTo('View bfi to user fund transfer') || auth()->user()->hasPermissionTo('View user to bfi fund transfer'))
                <li @if($url == route('bfi.view') || $url == route('bfi.user.view')) class="active" @endif>
                    <a href="#"><i class="fa fa-history"></i> <span class="nav-label">BFI</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('View BFI Merchant')
                            <li><a href="{{ route('bfi.view') }}">BFI Merchant</a></li>
                        @endcan
                        @can('View BFI user')
                            <li><a href="{{ route('bfi.user.view') }}">BFI User</a></li>
                        @endcan
                        @can('View bfi execute payment')
                            <li>
                                <a href="{{ route('view.bfi.execute.payment') }}">BFI Execute Payment</a>
                            </li>
                        @endcan
                        @can('View bfi to user fund transfer')
                            <li>
                                <a href="{{ route('view.bfi.to.user.fund.transfer') }}">BFI to user fund transfer</a>
                            </li>
                        @endcan
                        @can('View user to bfi fund transfer')
                            <li>
                                <a href="{{ route('view.user.to.bfi.fund.transfer') }}">User to bfi fund transfer</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif



            @if(auth()->user()->hasPermissionTo('Agent view') || auth()->user()->hasPermissionTo('Agent create'))
                <li @if($url == route('agent.view') || $url == route('agent.create')) class="active" @endif>
                    <a href="#"><i class="fa fa-history"></i> <span class="nav-label">Agents</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('Agent view')
                            <li><a href="{{ route('agent.view') }}">View Agent</a></li>
                        @endcan
                        {{--@can('Agent create')
                            <li><a href="{{ route('agent.create') }}">Create Agent</a></li>
                        @endcan--}}
                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasPermissionTo('Agent type view') || auth()->user()->hasPermissionTo('Agent type create') || auth()->user()->hasPermissionTo('View and update agent type hierarchy cashback'))
                <li @if($url == route('agent.type.view') || $url == route('agent.type.create') ) class="active" @endif>
                    <a href="#"><i class="fa fa-list-ul"></i> <span class="nav-label">Agent Types</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('Agent type view')
                            <li><a href="{{ route('agent.type.view') }}">View Agent Type</a></li>
                        @endcan
                        @can('Agent type create')
                            <li><a href="{{ route('agent.type.create') }}">Create Agent Type</a></li>
                        @endcan
                        @can('View and update agent type hierarchy cashback')
                            <li @if(preg_match('/vendor-transactions/i', $url)) class="active" @endif>
                                <a href="{{route('view.agent.type.hierarchy.cashback')}}">
                                    <span
                                        class="nav-label">Agent Type Hierarchy Cashback</span></a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            {{-- <li @if(preg_match('/load-test/i', $url)) class="active" @endif>
                 <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Load Test Funds</span><span
                         class="fa arrow"></span></a>
                 <ul class="nav nav-second-level collapse">
                     <li><a href="{{ route('loadTestFund.index') }}">View Load Test Funds</a></li>

                     <li><a href="{{ route('loadTestFund.create') }}">Create Load Test Funds</a></li>
                 </ul>
             </li>--}}

            {{--<li @if(preg_match('/load-for-paypoint/i', $url)) class="active" @endif>
                <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Load For Paypoint</span><span
                        class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li><a href="{{ route('paypoint.loadTestFund.index') }}">View Load For Paypoint</a></li>

                    <li><a href="{{ route('paypoint.loadTestFund.create') }}">Create Load For Paypoint</a></li>
                </ul>
            </li>--}}
            @if(auth()->user()->hasPermissionTo('Refund view') || auth()->user()->hasPermissionTo('Refund create'))
                <li @if(preg_match('/refund/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Refund</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('Refund view')
                            <li><a href="{{ route('refund.index') }}">View Refund</a></li>
                        @endcan
                        @can('Refund create')
                            <li><a href="{{ route('refund.create') }}">Create Refund</a></li>
                        @endcan
                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasPermissionTo('Repost transaction npay') || auth()->user()->hasPermissionTo('Repost transaction nps') || auth()->user()->hasPermissionTo('Repost transaction connectips'))
                <li @if(preg_match('/repost/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Repost Transaction</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('Repost transaction npay')
                            <li><a href="{{ route('repost.npay') }}">NPay Repost</a></li>
                        @endcan
                        @can('Repost transaction nps')
                            <li><a href="{{ route('repost.nps') }}">NPS Repost</a></li>
                        @endcan
                        @can('Repost transaction connectips')
                            <li><a href="{{ route('repost.connectIPS') }}">Connect IPS Repost</a></li>
                        @endcan
                    </ul>
                </li>
            @endif



            @can('View pre-transactions')
                <li @if($url == route('preTransaction.view')) class="active" @endif>
                    <a href="{{route('preTransaction.view')}}"><i class="fa fa-handshake-o"></i> <span
                            class="nav-label">Pre Transactions</span></a>
                </li>
            @endcan

            @can('View request info')
                <li @if($url == route('requestinfo.index')) class="active" @endif>
                    <a href="{{route('requestinfo.index')}}"><i class="fa fa-handshake-o"></i> <span
                            class="nav-label">Requests Info</span></a>
                </li>
            @endcan


            @if(auth()->user()->hasAnyPermission(['Complete transaction view', 'Fund transfer view', 'Fund request view', 'EBanking view', 'Paypoint view','Transaction nps view','Transaction nchl bank transfer','Transaction nchl load','Nicasia cybersource load transaction','Cellpay user transaction view','Nicasia cybersource view']))
                <li @if($url == route('transaction.complete') || $url == route('transaction.userToUserFundTransfer') || $url == route('fundRequest') || $url == route('eBanking') || $url == route('paypoint'))class="active" @endif>
                    <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Transactions</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        @can('Complete transaction view')
                            <li><a href="{{ route('transaction.complete') }}">Complete Transactions</a></li>
                        @endcan

                        @can('Fund transfer view')
                            <li><a href="{{ route('transaction.userToUserFundTransfer') }}">Fund Transfers</a></li>
                        @endcan

                        @can('Fund request view')
                            <li><a href="{{ route('fundRequest') }}">Fund Requests</a></li>
                        @endcan

                        @can('EBanking view')
                            <li><a href="{{ route('eBanking') }}">NPay Web/Mobile Banking</a></li>
                        @endcan
                        @can('Transaction nps view')
                            <li><a href="{{ route('nps') }}">Nps Web/Mobile Banking</a></li>
                        @endcan

                        @can('View khalti details')
                            <li><a href="{{ route('khalti.transaction') }}">Khalti</a></li>
                        @endcan

                        {{--@can('Paypoint view')
                            <li><a href="{{ route('paypoint') }}">Paypoint Transactions</a></li>
                        @endcan--}}

                        @can('Transaction nchl load')
                            <li><a href="{{ route('nchl.loadTransaction') }}">NCHL Load</a></li>
                        @endcan
                        @can('Transaction nchl bank transfer')
                            <li><a href="{{ route('nchl.bankTransfer') }}">NCHL Bank Transfer</a></li>
                        @endcan

                        {{--@can('Nicasia cybersource load transaction')
                            <li><a href="{{ route('nicasia.cyberSourceLoad') }}">All card load transaction</a></li>
                        @endcan--}}

                       {{-- @can('Nicasia cybersource view')
                            <li><a href="{{ route('nicAsia.viewCyberSourceLoad') }}">NIC Asia Transaction</a></li>
                        @endcan--}}

                        @can('View request info')
                            <li><a href="{{ route('requestinfo.index') }}">View Requests Info</a></li>
                        @endcan

                        {{--@can('Cellpay user transaction view')
                            <li><a href="{{route('cellPayUserTransaction.view')}}">CellPay Transactions</a></li>
                        @endcan--}}
                    </ul>
                </li>
            @endif

            {{--@if(auth()->user()->hasAnyPermission(['Failed paypoint view', 'Failed npay view']))
                <li @if($url == route('userTransaction.failed') || $url == route('userLoadTransaction.failed')) class="active" @endif>
                    <a href="#"><i class="fa fa-recycle"></i> <span class="nav-label">Failed Transactions</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('Failed paypoint view')
                            <li><a href="{{ route('userTransaction.failed') }}">Failed Paypoint Transactions</a></li>
                        @endcan

                        @can('Failed npay view')
                        <li><a href="{{ route('userLoadTransaction.failed') }}">Failed NPay Transactions</a></li>
                        @endcan
                    </ul>
                </li>
            @endif--}}

            @if(auth()->user()->hasAnyPermission(['View request info']))
                @can('View request info')
                    <li><a href="{{ route('requestinfo.index') }}"><i class="fa fa-info-circle"></i> View Requests Info</a>
                    </li>
                @endcan
            @endif


            @if(auth()->user()->hasAnyPermission(['Clearance npay', 'Clearance paypoint']))
                <li @if($url == route('clearance.transactions') || $url == route('clearance.generate')) class="active" @endif>
                    <a href="{{ route('clearance.transactions') }}"><i class="fa fa-handshake-o"></i> <span
                            class="nav-label">Clearance</span></a>
                </li>
            @endif

            {{--@if(auth()->user()->hasAnyPermission(['Clearance npay view', 'Clearance paypoint view']))
                <li @if($url == route('clearance.npayView') || $url == route('clearance.paypointView')) class="active" @endif>
                    <a href="#"><i class="fa fa-handshake-o"></i> <span class="nav-label">View Clearance</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        @can('Clearance npay view')
                        <li><a href="{{ route('clearance.npayView') }}">NPay</a></li>
                        @endcan

                        @can('Clearance paypoint view')
                            <li><a href="{{ route('clearance.paypointView') }}">Paypoint</a></li>
                        @endcan

                    </ul>
                </li>
            @endif--}}

            {{--@if(auth()->user()->hasAnyPermission(['Dispute view', 'Dispute create']))
                <li @if(preg_match('/dispute/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-times-rectangle"></i> <span class="nav-label">Single Dispute</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('Dispute view')
                            <li><a href="{{ route('dispute.view.all') }}">View Disputes</a></li>
                        @endcan

                        @can('Dispute create')
                            <li><a href="{{ route('dispute.singleTransaction') }}">Create Dispute</a></li>
                        @endcan
                    </ul>
                </li>
            @endif--}}

            @if(auth()->user()->hasAnyPermission(['View all audit trial', 'View npay audit trial', 'View paypoint audit trial','View nchl bank transfer audit trail','View nchl load transaction audit trail']))
                <li @if($url == route('auditTrail.all') || $url == route('auditTrail.nPay') || $url == route('auditTrail.payPoint')) class="active" @endif>
                    <a href="#"><i class="fa fa-history"></i> <span class="nav-label">Audit Trial</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('View all audit trial')
                            <li><a href="{{ route('auditTrail.all') }}">All</a></li>
                        @endcan

                        @can('View npay audit trial')
                            <li><a href="{{ route('auditTrail.nPay') }}">NPay</a></li>
                        @endcan

                        {{--@can('View paypoint audit trial')
                            <li><a href="{{ route('auditTrail.payPoint') }}">PayPoint</a></li>
                        @endcan--}}
                        @can('View nchl bank transfer audit trail')
                            <li><a href="{{ route('auditTrail.nchl.bankTransfer') }}">NCHL Bank Transfer</a></li>
                        @endcan
                        @can('View nchl load transaction audit trail')
                            <li><a href="{{ route('auditTrail.nchl.loadTransaction') }}">NCHL Load Transaction</a></li>
                        @endcan
                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasAnyPermission(['Monthly report view', 'Yearly report view','Report paypoint','Report npay','Report nchl load','Report referral','Report register using referral user','Report subscriber daily','Report reconciliation','Report nrb active and inactive user','Report non bank payment','Report wallet end balance','Report admin kyc','Report commission']))
                <li @if(preg_match('/report/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Report</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('Monthly report view')
                            <li><a href="{{ route('report.monthly') }}">Monthly Report</a></li>
                        @endcan
                        @can('Yearly report view')
                            <li><a href="{{ route('report.yearly') }}">Yearly Report</a></li>
                        @endcan
                        {{--@can('Report paypoint')
                            <li><a href="{{ route('report.paypoint') }}">PayPoint Report</a></li>
                        @endcan--}}
                        @can('Report npay')
                            <li><a href="{{ route('report.npay') }}">NPay Report</a></li>
                        @endcan
                        @can('Report nchl load')
                            <li><a href="{{ route('report.nchl.load') }}">NCHL Load Report</a></li>
                        @endcan
                        @can('Report referral')
                            <li><a href="{{ route('referral.report') }}">Referral Report</a></li>
                        @endcan
                        @can('Report register using referral user')
                            <li><a href="{{ route('referral.registerUsingReferralUserReport') }}">Registered Using
                                    Referral
                                    Report</a></li>
                        @endcan
                        @can('Report subscriber daily')
                            <li><a href="{{ route('report.subscriber') }}">Subscriber Report</a></li>
                        @endcan
                        @can('Report reconciliation')
                            <li><a href="{{ route('report.reconciliation') }}">Reconciliation Report</a></li>
                        @endcan
                        @can('Report reconciliation')
                            <li><a href="{{ route('mismatched.reconciliation') }}">Mismatchced Reconciliation Report</a>
                            </li>
                        @endcan
                        {{--<li><a href="{{ route('report.user.reconciliation') }}">User Reconciliation Report</a></li>--}}
                        @can('Report nrb active and inactive user')
                            <li><a href="{{ route('report.nrb.activeInactiveUser') }}">NRB Active/Inactive User
                                    Report</a>
                            </li>
                        @endcan
                        @can('Report nrb agent')
                            <li><a href="{{ route('report.agent') }}">NRB Agent Report</a></li>
                        @endcan
                        @can('Report non bank payment')
                            <li><a href="{{ route('report.nonBankPaymentReport') }}">Non bank payment report</a></li>
                        @endcan
                        @can('Report wallet end balance')
                            <li><a href="{{ route('wallet.endbalance') }}">Wallet end balance report</a></li>
                        @endcan
                        @can('Report admin kyc')
                            <li><a href="{{ route('report.adminKyc') }}">Admin kyc report</a></li>
                        @endcan
                        @can('Report commission')
                            <li><a href="{{ route('commission.report') }}">Commission report</a></li>
                        @endcan
                            @can('View mismatched user balance and bonus balance')
                                <li><a href="{{route('report.mismatchedUserBalance')}}">Mismatched User Balance</a></li>
                            @endcan
                    </ul>
                </li>
            @endif


            @if(auth()->user()->hasAnyPermission(['View blocked ip', 'View whitelisted ip']))
                <li @if(preg_match('/report/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-server"></i> <span class="nav-label">Block / Whitelist IPs</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('View blocked ip')
                            <li @if($url == route('blockedip.view')) class="active" @endif>
                                <a href="{{ route('blockedip.view') }}"><i class="fa fa-lock"></i> <span
                                        class="nav-label">Block IP</span></a>
                            </li>
                        @endcan
                        @can('View whitelisted ip')
                            <li @if($url == route('whitelistedIP.view')) class="active" @endif>
                                <a href="{{ route('whitelistedIP.view') }}"><i class="fa fa-check-square"></i> <span
                                        class="nav-label">Whitelist IP</span></a>
                            </li>
                        @endcan
                    </ul>
                </li>

            @endif

            @if(auth()->user()->hasAnyPermission(['User session log view', 'Backend user log view' , 'Auditing log view', 'Profiling log view', 'Statistics log view', 'Development log view','Api log']))
                <li @if(preg_match('/log/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-th-list"></i> <span class="nav-label">Logs</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('User session log view')
                            <li><a href="{{ route('admin.log.userSession') }}">User Session Log</a></li>
                        @endcan

                        @can('Backend user log view')
                            <li><a href="{{ route('backendLog.all') }}">Backend Log</a></li>
                        @endcan
                        @can('Api log')
                            <li><a href="{{ route('apiLog.all') }}">API Log</a></li>
                        @endcan

                        {{--@can('Auditing log view')
                        <li><a href="{{ route('admin.log.auditing') }}">Auditing Log</a></li>
                        @endcan
                        @can('Profiling log view')
                        <li><a href="{{ route('admin.log.profiling') }}">Profiling Log</a></li>
                        @endcan
                        @can('Statistics log view')
                        <li><a href="{{ route('admin.log.statistics') }}">Statistics Log</a></li>
                        @endcan
                        @can('Development log view')
                        <li><a href="{{ route('admin.log.development') }}">Development Log</a></li>
                        @endcan--}}
                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasAnyPermission(['Notification view', 'Notification create']))
                <li @if(preg_match('/notification/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-bell-o"></i> <span class="nav-label">Notifications</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        @can('Notification view')
                            <li><a href="{{ route('notification.view') }}">View Notification</a></li>
                        @endcan

                        @can('Notification create')
                            <li><a href="{{ route('notification.create') }}">Create Notification</a></li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @if(auth()->user()->hasAnyPermission(['Sparrow SMS view', 'Sparrow SMS detail view']))
                <li @if(preg_match('/sparrow/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-envelope"></i> <span class="nav-label"> SMS</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        @can('Sparrow SMS view')
                            <li>
                                <a href="{{ route('sparrow.view') }}"> <span class="nav-label"> SMS</span></a>
                            </li>
                        @endcan

                        @can('Sparrow SMS detail view')
                            <li>
                                <a href="{{ route('sparrow.detail') }}"> <span class="nav-label"> SMS Detail</span></a>
                            </li>
                        @endcan

                        @can('Miracle info SMS view')
                            <li>
                                <a href="{{route('miracle-info.view')}}"><span class="nav-label">Miracle Info SMS</span></a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasAnyPermission(['General page setting view', 'General page setting create']))
                <li @if(preg_match('/general/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">General Page Setting</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('General page setting view')
                            <li><a href="{{ route('general.setting.index') }}">View General Pages</a></li>
                        @endcan

                        @can('General page setting create')
                            <li><a href="{{ route('general.setting.create') }}">Create General Pages</a></li>
                        @endcan
                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasAnyPermission([
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
                ]))
                <li @if(preg_match('/settings/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Settings</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">

                        @can('General setting view')
                            <li><a href="{{ route('settings.general') }}">General Setting</a></li>
                        @endcan

                        @can('Merchant setting view')
                            <li><a href="{{ route('settings.merchant') }}">Merchant Setting</a></li>
                        @endcan

                        @can('Npay setting view')
                            <li><a href="{{ route('settings.npay') }}">Npay Setting</a></li>
                        @endcan

                        @can('Nps setting view')
                            <li><a href="{{ route('settings.nps') }}">NPS Setting</a></li>
                        @endcan

                        {{--@can('Paypoint setting view')
                            <li><a href="{{ route('settings.paypoint') }}">Paypoint Setting</a></li>
                        @endcan--}}

                        @can('Nchl load setting view')
                            <li><a href="{{ route('settings.nchl.load') }}">NCHL Load Setting</a></li>
                        @endcan
                        @can('Nchl bank transfer setting view')
                            <li><a href="{{ route('settings.nchl.bankTransfer') }}">NCHL Bank Transfer Setting</a></li>
                        @endcan
                        @can('Nchl aggregated setting view')
                            <li><a href="{{ route('settings.nchl.aggregatedPayments') }}">NCHL Aggregated Payments
                                    Setting</a></li>
                        @endcan
                        @can('Nicasia cybersource setting view')
                            <li><a href="{{ route('settings.nicAsiaCyberSource') }}">CyberSource Load Setting</a></li>
                        @endcan

                        @can('Limits setting view')
                            <li><a href="{{ route('settings.limit') }}">Limits Setting</a></li>
                        @endcan

                        {{--@can('Paypoint commission setting view')
                            <li><a href="{{ route('settings.paypoint.commission') }}">PayPoint Commission Setting</a></li>
                        @endcan--}}

                        {{-- @can('Paypoint cashback setting view')
                             <li><a href="{{ route('settings.cashback') }}">CashBack Setting</a></li>
                         @endcan--}}

                        {{--@can('Transaction fee setting view')
                            <li><a href="{{ route('settings.transactionFee') }}">Transaction Fee Setting</a></li>
                        @endcan--}}

                        {{--@can('KYC setting view')
                            <li><a href="{{ route('settings.kyc') }}">KYC Setting</a></li>
                        @endcan--}}
                        @can('Referral setting view')
                            <li><a href="{{ route('settings.referral') }}">Referral Setting</a></li>
                        @endcan
                        @can('Bonus setting view')
                            <li><a href="{{ route('settings.bonus') }}">Bonus Setting</a></li>
                        @endcan
                        @can('Notification setting view')
                            <li><a href="{{ route('settings.notification') }}">Notification Setting</a></li>
                        @endcan
                        @can('Redirect setting view')
                            <li><a href="{{ route('settings.redirect') }}">Redirect Setting</a></li>
                        @endcan

                        {{--@can('OTP setting view')
                            <li><a href="{{ route('settings.otp') }}">OTP Setting</a></li>
                        @endcan--}}
                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasAnyPermission(['Frontend header view', 'Frontend service view', 'Frontend about view', 'Frontend process view']))
                <li @if(preg_match('/frontend/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Frontend Settings</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('Frontend header view')
                            <li><a href="{{ route('frontend.header') }}">Headers</a></li>
                        @endcan

                        @can('Frontend service view')
                            <li><a href="{{ route('frontend.service.index') }}">Services</a></li>
                        @endcan

                        @can('Frontend about view')
                            <li><a href="{{ route('frontend.about.index') }}">Abouts</a></li>
                        @endcan

                        @can('Frontend process view')
                            <li><a href="{{ route('frontend.process.index') }}">Processes</a></li>
                        @endcan

                        @can('Frontend banner view')
                            <li><a href="{{ route('frontend.banner.index') }}">Banners</a></li>
                        @endcan
                        @can('Frontend contact view')
                            <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                        @endcan
                    </ul>
                </li>
            @endif

            @if(auth()->user()->hasAnyPermission(['View wallet service', 'Yearly report view','Report paypoint','Report npay','Report nchl load','Report referral','Report register using referral user','Report subscriber daily','Report reconciliation','Report nrb active and inactive user','Report non bank payment','Report wallet end balance','Report admin kyc','Report commission']))
                <li @if(preg_match('/report/i', $url)) class="active" @endif>
                    <a href="#"><i class="fa fa-line-chart"></i> <span class="nav-label">Developers option</span><span
                            class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can('View wallet service')
                            <li><a href="{{route('wallet.service.view')}}">Wallet Service</a></li>
                        @endcan
                        @can('View wallet permission transaction type')
                            <li><a href="{{route('wallet.permission.transaction.type.view')}}">Wallet Permission
                                    Transaction Type</a></li>
                        @endcan
                        @can('View wallet transaction type')
                            <li><a href="{{route('wallet.transaction.type.view')}}">Wallet Transaction Type</a></li>
                        @endcan
                        @can('View seeder list')
                            <li><a href="{{ route('view.seeder') }}">Run seeder</a></li>
                        @endcan


                    </ul>
                </li>
            @endif

        </ul>
    </div>
</nav>
