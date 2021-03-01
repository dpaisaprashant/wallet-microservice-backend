<div role="tabpanel" id="userLoginHistoryAudit" class="tab-pane @if($activeTab == 'userLoginHistoryAudit') active @endif">
    {{--<div class="row" style="margin-top: 10px;">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Filter Transactions</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" @if( empty($_GET) || (count($_GET) === 1)  ) style="display: none"  @endif>
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="get" action="{{ route('user.profile' , $user->id) }}">
                                <input type="hidden" value="user-transaction-statement" name="transaction_type">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="input-group date">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                            <input id="date_transaction_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group date">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                            <input id="date_transaction_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select data-placeholder="Select Vendor...." class="chosen-select"  tabindex="2" name="vendor">
                                                <option value="" selected disabled>Select Vendor...</option>
                                                <option value="">All</option>
                                                @if(!empty($_GET['vendor']))
                                                    @foreach($vendors as $vendor)
                                                        <option value="{{$vendor}}" @if($_GET['vendor']  == $vendor) selected @endif >{{$vendor}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($vendors as $vendor)
                                                        <option value="{{$vendor}}"  >{{$vendor}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2" name="service">
                                                <option value="" selected disabled>Select Service Type...</option>
                                                <option value="">All</option>
                                                @if(!empty($_GET['service']))
                                                        @foreach($serviceTypes as $serviceType)
                                                            <option value="{{ $serviceType }}" @if($_GET['service'] == $serviceType) selected @endif>{{ $serviceType }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($serviceTypes as $serviceType)
                                                            <option value="{{ $serviceType }}"> {{ $serviceType }} </option>
                                                        @endforeach
                                                    @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">

                                    <div class="col-md-6" style="margin-top: 15px;">
                                        <div class="i-checks" for="ionrange_credit">

                                            @if(!empty($_GET['debit']))

                                                <label style="margin-right: 30px;">
                                                    <input type="radio" value="true" name="debit" @if($_GET['debit'] == 'true') checked="" @endif> <i></i> Filter Debit
                                                </label>

                                                <label>
                                                    <input type="radio"  value="false" name="debit" @if($_GET['debit'] == 'false') checked="" @endif> <i></i> Filter Credit
                                                </label>

                                            @else

                                                <label style="margin-right: 30px;">
                                                    <input type="radio" value="true" name="debit"  checked=""> <i></i> Filter Debit
                                                </label>

                                                <label>
                                                    <input type="radio"  value="false" name="debit"> <i></i> Filter Credit
                                                </label>

                                            @endif
                                        </div>
                                        <input type="text" name="debit_range" class="ionrange_debit">
                                    </div>

                                    <div class="col-md-6" style="margin-top: 18px;">
                                        <label for="ionrange_balance_transaction_statement">Balance</label>
                                        <input type="text" name="balance" class="ionrange_balance_transaction_statement">
                                    </div>
                                </div>



                                <div class="row">

                                    <div class="col-md-6" style="margin-top: 37px;">

                                        <div class="form-group">
                                            <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                <option value="" selected disabled>Sort By...</option>
                                                <option value="debit">Debit</option>
                                                <option value="credit">Credit</option>
                                                <option value="balance">Balance</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>Filter</strong></button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>--}}

    <div class="panel-body" id="LoginHistoryAuditTable">
        <div class="table-responsive">
            <table id="LoginHistoryAuditTable" class="table table-striped table-bordered table-hover dataTables-example" title="Login History - {{ $user->name }}">
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
                @foreach($loginHistoryAudits as $event)
                    <tr>
                        <td>{{ $loop->index + ($allAudits->perPage() * ($allAudits->currentPage() - 1)) + 1 }}</td>
                        <?php $date = explode(' ', $event->created_at) ?>
                        <td>{{ $date[0] }}</td>
                        <td>{{ $date[1] }}</td>
                        <td>{{ $event->public_ip }}</td>
                        <td>{{ $event->server_ip }}</td>
                        <td>{{ $event->device }}</td>
                        <td>{{ $event->user_agent }}</td>
                        <td>
                            @if($event->status == 1 && $event->tmp_enabled === 0)
                                <b style="color: green">USER SUCCESSFULLY LOGGED IN</b>
                            @else
                                <b style="color: red">USER LOGIN ATTEMPT FAIL</b>
                            @endif
                        </td>
                        <td>
                            <a data-toggle="modal" href="#modal-form-user-login-history-single{{$event->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>

                            <div id="modal-form-user-login-history-single{{ $event->id }}" class="modal fade" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="m-t-none m-b">Login History Detailed Information</h3>
                                                    <hr>
                                                    <dl class="row m-t-md">
                                                        <dt class="col-md-3 text-right">Public Id</dt>
                                                        <dd class="col-md-8">{{ $event->public_ip }}</dd>

                                                        <dt class="col-md-3 text-right">Server Id</dt>
                                                        <dd class="col-md-8">{{ $event->server_ip }}</dd>

                                                        <dt class="col-md-3 text-right">Device</dt>
                                                        <dd class="col-md-8">{{ $event->device }}</dd>

                                                        <dt class="col-md-3 text-right">User Agent</dt>
                                                        <dd class="col-md-8">{{ $event->user_agent }}</dd>


                                                        <dt class="col-md-3 text-right">Description</dt>
                                                        <dd class="col-md-8">{{ $event->description }}</dd>


                                                    </dl>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
            @if(!empty($_GET['user-transaction-statement']) || !empty($_GET['user-transaction-event']) || !empty($_GET['all-audit-trials']) )
                {{ $loginHistoryAudits->links() }}
            @else
                {{ $loginHistoryAudits->appends(request()->query())->links() }}

            @endif

        </div>
    </div>



</div>

@section('pageScripts')

@endsection
