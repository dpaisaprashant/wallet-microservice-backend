<div role="tabpanel" id="loadFund" class="tab-pane @if($activeTab == 'loadFund') active @endif">
    <div class="row" style="margin-top: 10px;">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title collapse-link">
                    <h5>Filter Load Funds</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content" @if( empty($_GET) || ( count($_GET) === 1)  ) style="display: none"  @endif>
                    <div class="row">
                        <div class="col-sm-12">
                            <form role="form" method="get" >
                                <input type="hidden" name="transaction_type" value="user-load-fund">
                                <input type="hidden" name="user" value="{{ $user->mobile_no }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="bank" placeholder="Bank" class="form-control" value="{{ !empty($_GET['bank']) ? $_GET['bank'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2" name="status">
                                                <option value="" selected disabled>Select Status...</option>
                                                <option value="" >All</option>
                                                @if(!empty($_GET['status']))
                                                    <option value="completed" @if($_GET['status']  == 'completed') selected @endif>Complete</option>
                                                    <option value="validated" @if($_GET['status']  == 'validated') selected @endif>Validates</option>
                                                @else
                                                    <option value="completed">Complete</option>
                                                    <option value="validated">Validates</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                <option value="" selected disabled>Sort By...</option>
                                                @if(!empty($_GET['sort']))
                                                    <option value="date" @if($_GET['sort'] == 'date') selected @endif>Latest Date</option>
                                                    <option value="amount" @if($_GET['sort'] == 'amount') selected @endif>Highest amount</option>
                                                @else
                                                    <option value="created_at">Date</option>
                                                    <option value="amount">Amount</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="ionrange_balance">Amount</label>
                                        <input type="text" name="amount" class="ionrange_load_fund_amount">
                                    </div>

                                    <div class="col-md-3" style="padding-top: 40px;">
                                        <div class="input-group date">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="padding-top: 40px;">
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
                                    <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.npay.excel') }}"><strong>Excel</strong></button>
                                </div>
                                @include('admin.asset.components.clearFilterButton')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body" id="userLoadFundTable">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" title="{{ $user->name }}'s load fund transactions">
                <thead>
                <tr>
                    <th>s.No.</th>
                    <th>Transaction ID</th>
                    <th>Bank</th>
                    <th>Description</th>
                    <th>Gateway Ref no.</th>
                    <th>Amount</th>
                    <th>Commission</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($userLoadTransactions as $transaction)
                    <tr class="gradeC">
                        <td>{{ $loop->index + ($userLoadTransactions->perPage() * ($userLoadTransactions->currentPage() - 1)) + 1 }}</td>
                        <td>
                            {{ $transaction->transaction_id }}
                        </td>

                        <td>
                            {{ $transaction->payment_mode }}
                        </td>
                        <td>
                            {{ $transaction->description }}
                        </td>
                        <td>{{ $transaction->gateway_ref_no }}</td>
                        <td class="center">Rs.{{ $transaction->amount }}</td>
                        @if(!empty($transaction->commission))
                            <td class="center">Rs.{{ round($transaction->commission['after_amount'] - $transaction->commission['before_amount'], 2) }}</td>
                        @else
                            <td class="center">
                            Rs. 0
                            </td>
                        @endif
                        <td>
                            @if($transaction->status == 'COMPLETED')
                                <span class="badge badge-primary">{{ $transaction->status }}</span>
                            @elseif($transaction->status == 'VALIDATED')
                                <span class="badge badge-warning">{{ $transaction->status }}</span>
                            @endif
                        </td>
                        <td class="center">{{ $transaction->updated_at }}</td>
                        <td>
                            @can('Fund transfer detail')
                                <a href="{{ route('eBanking.detail', $transaction->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
                            @endcan
                            <a data-toggle="modal" href="#modal-form{{$transaction->id}}"><button class="btn btn-warning btn-icon" type="button"><i class="fa fa-info"></i></button></a>
                            <div id="modal-form{{ $transaction->id }}" class="modal fade" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <h3 class="m-t-none m-b">Transaction Detailed Information</h3>
                                                        <hr>
                                                        <dl class="row m-t-md">
                                                            <dt class="col-md-3 text-right">Transaction ID</dt>
                                                            <dd class="col-md-8">
                                                                {{ $transaction->transaction_id }}
                                                            </dd>

                                                            <dt class="col-md-3 text-right">Process Id</dt>
                                                            <dd class="col-md-8">
                                                                {{ $transaction->process_id }}
                                                            </dd>

                                                            <dt class="col-md-3 text-right">Gateway Ref No.</dt>
                                                            <dd class="col-md-8">
                                                                {{ $transaction->gateway_ref_no }}
                                                            </dd>

                                                            <dt class="col-md-3 text-right">Payment Mode</dt>
                                                            <dd class="col-md-8">{{ $transaction->payment_mode}}</dd>

                                                            <dt class="col-md-3 text-right">Description</dt>
                                                            <dd class="col-md-8">{{ $transaction->description}}</dd>

                                                            <dt class="col-md-3 text-right">Amount</dt>
                                                            <dd class="col-md-8">Rs.{{ $transaction->amount }}</dd>

                                                            <dt class="col-md-3 text-right">Commission</dt>
                                                            <dd class="col-md-8">Rs.9</dd>

                                                            <dt class="col-md-3 text-right">Date</dt>
                                                            <dd class="col-md-8">{{ $transaction->created_at }}</dd>

                                                            <dt class="col-md-3 text-right">Account</dt>
                                                            <dd class="col-md-8">{{ $transaction->account }}</dd>

                                                            <dt class="col-md-3 text-right">User</dt>
                                                            <dd class="col-md-8">{{ $transaction->user['name'] }}</dd>

                                                            <dt class="col-md-3 text-right">KYC Status</dt>
                                                            <dd class="col-md-8">
                                                                @if(empty($transaction->user->kyc))
                                                                    <i style="color: red;" class="fa fa-times-circle"></i> Not Filled
                                                                @elseif($transaction->user->kyc->status == 0)
                                                                    <i style="color: red;" class="fa fa-times-circle"></i> KYC not verified
                                                                @elseif($transaction->user->kyc->status == 1)
                                                                    <i style="color: green;" class="fa fa-check-circle"></i> KYC verified
                                                                @endif
                                                            </dd>
                                                        </dl>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{--<a href="{{route('transactionDetail')}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>View Details</strong></a>--}}
                        </td>
                    </tr>
                @endforeach

                </tbody>

            </table>

            @if(!empty($_GET['user-transaction-statement']) || !empty($_GET['user-transaction-event']) )
                {{ $userLoadTransactions->links() }}
            @else
                @if(!empty($_GET['transaction_type']))
                    @if($_GET['transaction_type'] == 'user-load-fund')
                        {{ $userLoadTransactions->appends(request()->query())->links() }}
                    @else
                        {{ $userLoadTransactions->links() }}
                    @endif
                @else
                    {{ $userLoadTransactions->links() }}
                @endif

            @endif
        </div>

    </div>
</div>
