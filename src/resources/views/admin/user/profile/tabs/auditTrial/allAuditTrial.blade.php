<div role="tabpanel" id="allAuditTrial" class="tab-pane @if($activeTab == 'allAuditTrial') active @endif">
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
                <div class="ibox-content" @if( empty($_GET) || (count($_GET) === 1)  ) style="display: none"  @endif>
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="get">
                                <input type="hidden" name="transaction_type" value="all-audit-trials">
                                <input type="hidden" name="user" value="{{ $user->mobile_no }}">

                                <div class="row">
                                    <div class="col-md-6" >
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6" >
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('user.profile', $user->id) }}"><strong>Filter</strong></button>
                                </div>
                                <div>
                                    <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.allAuditTrial.excel', $user->id) }}"><strong>Excel</strong></button>
                                </div>
                                @include('admin.asset.components.clearFilterButton')
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body" id="AllAuditTable">
        <div class="table-responsive">
            <table id="AllAuditTable" class="table table-striped table-bordered table-hover dataTables-example" title="Audit Trial - {{ $user->name }}">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Time</th>
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
                @foreach($allAudits as $event)
                    @if($event instanceof  \App\Models\UserLoginHistory)
                        @include('admin.user.profile.tabs.auditTrial.types.userLoginHistory')
                    @elseif($event instanceof \App\Models\Microservice\PreTransaction)
                        @include('admin.user.profile.tabs.auditTrial.types.preTransaction')
                    {{--@elseif($event instanceof \App\Models\Microservice\RequestInfo)
                        @include('admin.user.profile.tabs.auditTrial.types.requestInfo')--}}
                   {{-- @elseif($event instanceof \App\Models\UserToUserFundTransfer)
                        @include('admin.user.profile.tabs.auditTrial.types.fundTransfer')--}}
                    @elseif($event instanceof \App\Models\UserLoadTransaction)
                        @include('admin.user.profile.tabs.auditTrial.types.userLoadTransaction')
                    {{--@elseif($event instanceof \App\Models\FundRequest)
                        @include('admin.user.profile.tabs.auditTrial.types.fundRequest')--}}
                    @elseif($event instanceof \App\Models\UserCheckPayment)
                        @include('admin.user.profile.tabs.auditTrial.types.userTransaction')
                    @elseif($event instanceof \App\Models\NchlLoadTransaction)
                        @include('admin.user.profile.tabs.auditTrial.types.nchlLoadTransaction')
                    @elseif($event instanceof \App\Models\NchlBankTransfer)
                        @include('admin.user.profile.tabs.auditTrial.types.nchlBankTransfer')
                    @elseif($event instanceof \App\Models\NchlAggregatedPayment)
                        @include('admin.user.profile.tabs.auditTrial.types.nchlAggregatedPayment')
                    @elseif($event instanceof \App\Models\NICAsiaCyberSourceLoadTransaction)
                        @include('admin.user.profile.tabs.auditTrial.types.nicAsiaCyberSourceTransactions')
                    @elseif($event instanceof \App\Wallet\Commission\Models\Commission && $event->module == 'cashback')
                        @include('admin.user.profile.tabs.auditTrial.types.cashback')
                    @elseif($event instanceof \App\Wallet\Commission\Models\Commission && $event->module == 'commission')
                        @include('admin.user.profile.tabs.auditTrial.types.commission')
                    @elseif($event instanceof \App\Models\UserKYC)
                        @include('admin.user.profile.tabs.auditTrial.types.kycFilled')
                    @elseif($event instanceof \App\Models\AdminUserKYC)
                        @include('admin.user.profile.tabs.auditTrial.types.kycAcceptReject')
                    @elseif($event instanceof \App\Models\UserActivity)
                        @include('admin.user.profile.tabs.auditTrial.types.userActivity')
                    @elseif($event instanceof \App\Models\LoadTestFund)
                        @include('admin.user.profile.tabs.auditTrial.types.loadTestFunds')
                    @elseif($event instanceof \App\Models\UsedUserReferral)
                        @include('admin.user.profile.tabs.auditTrial.types.referral')
                    @elseif($event instanceof \App\Models\UserReferralBonusTransaction)
                        @include('admin.user.profile.tabs.auditTrial.types.referralBonus')
                    @elseif($event instanceof \App\Models\MerchantTransaction)
                        @include('admin.user.profile.tabs.auditTrial.types.merchantTransaction')
                    @endif
                @endforeach
                </tbody>
            </table>
            {{ $allAudits->appends(request()->query())->links() }}
        </div>
    </div>
</div>

