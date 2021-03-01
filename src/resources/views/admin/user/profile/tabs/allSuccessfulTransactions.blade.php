<div role="tabpanel" id="transaction" class="tab-pane @if($activeTab == 'transaction') active @endif">
    <div class="row" style="margin-top: 10px;">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title collapse-link">
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
                            <form role="form" method="get">
                                <input type="hidden" name="transaction_type" value="user-transaction-event">
                                <input type="hidden" name="user" value="{{ $user->mobile_no }}">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="uid" placeholder="User Transaction ID" class="form-control" value="{{ !empty($_GET['uid']) ? $_GET['uid'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
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
                                    <div class="col-md-6">
                                        <label for="ionrange_amount_transaction">Amount</label>
                                        <input type="text" name="amount" class="ionrange_amount_transaction">
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

                                <div class="row">
                                    <div class="col-md-6" style="margin-top: 40px;">
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

                                <div>
                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('user.profile', $user->id) }}"><strong>Filter</strong></button>
                                </div>
                                <div>
                                    <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.transaction.complete.excel') }}"><strong>Excel</strong></button>
                                </div>
                                @include('admin.asset.components.clearFilterButton')
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body" id="userTransactionEventTable">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" title="{{ $user->name }}'s successful transactions">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>UID</th>
                    <th>Transaction ID</th>
                    <th>Account</th>
                    <th>Vendor</th>
                    <th>Service Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($userTransactionEvents as $transaction)
                    <tr class="gradeC">
                        <td>{{ $loop->index + ($userTransactionEvents->perPage() * ($userTransactionEvents->currentPage() - 1)) + 1 }}</td>
                        <td>{{ $transaction->uid }}</td>
                        <td>
                            @if(!empty($transaction->transactionable->transaction_id))
                                {{ $transaction->transactionable->transaction_id}}
                            @elseif(!empty($transaction->transactionable->refStan))
                                {{ $transaction->transactionable->refStan}}
                            @else
                                {{$transaction->id}}
                            @endif
                        </td>
                        <td>
                            {{ $transaction->account }}
                        </td>
                        <td>
                            {{ $transaction->vendor }}
                        </td>
                        <td>
                            {{ $transaction->service_type }}
                        </td>
                        <td class="center">Rs. {{ $transaction->amount }}</td>

                        <td>
                            <span class="badge badge-primary">Colmplete</span>
                        </td>
                        <td class="center">{{ $transaction->created_at }}</td>
                        <td>
                            @if($transaction->transaction_type == 'App\Models\UserToUserFundTransfer')
                                @include('admin.transaction.fundTransfer.detail', ['transaction' => $transaction->transactionable])
                                <a href="{{ route('userToUserFundTransfer.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                            @elseif($transaction->transaction_type == 'App\Models\UserLoadTransaction')

                                @include('admin.transaction.npay.detail', ['transaction' => $transaction->transactionable])
                                <a href="{{ route('eBanking.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                            @elseif($transaction->transaction_type == 'App\Models\UserTransaction')

                                @include('admin.transaction.paypoint.detail', ['transaction' => $transaction->transactionable])
                                <a href="{{ route('paypoint.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                            @elseif($transaction->transaction_type == 'App\Models\FundRequest')

                                @include('admin.transaction.fundRequest.detail', ['transaction' => $transaction->transactionable])
                                <a href="{{ route('fundRequest.detail', $transaction->transaction_id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>

                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            @if(!empty($_GET['user-transaction-statement']) || !empty($_GET['user-load-fund']) )
                {{ $userTransactionEvents->links() }}
            @else
                @if(!empty($_GET['transaction_type']))
                    @if($_GET['transaction_type'] == 'user-transaction-event')
                        {{ $userTransactionEvents->appends(request()->query())->links() }}
                    @else
                        {{ $userTransactionEvents->links() }}
                    @endif
                @else
                    {{ $userTransactionEvents->links() }}
                @endif

            @endif
        </div>
    </div>
</div>
