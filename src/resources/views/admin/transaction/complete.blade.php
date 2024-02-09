@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>All</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
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

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('transaction.complete') }}" id="filter">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="uid" placeholder="User Transaction ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['uid']) ? $_GET['uid'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="pre_transaction_id"
                                                       placeholder="Pre Transaction Id" class="form-control"
                                                       value="{{ !empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : '' }}">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row" style="margin-top: 20px">
                                        {{-- <div class="col-md-6">
                                             <label for="ionrange_amount">Amount</label>
                                             <input type="text" name="amount" class="ionrange_amount">
                                         </div>--}}

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="From Amount"
                                                       name="from_amount" autocomplete="off"
                                                       value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="To Amount"
                                                       name="to_amount" autocomplete="off"
                                                       value="{{ !empty($_GET['to_amount']) ? $_GET['to_amount'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 40px;">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="User Type..." class="chosen-select"
                                                        tabindex="2"
                                                        name="user_type">
                                                    <option value="" selected disabled>User Type...</option>
                                                    @if(!empty($_GET['user_type']))
                                                        <option value="all"
                                                                @if($_GET['user_type'] == 'all') selected @endif>All
                                                        </option>
                                                        <option value="user"
                                                                @if($_GET['user_type'] == 'user') selected @endif>User
                                                        </option>
                                                        <option value="merchant"
                                                                @if($_GET['user_type'] == 'merchant') selected @endif>
                                                            Merchant
                                                        </option>
                                                        <option value="agent"
                                                                @if($_GET['user_type'] == 'agent') selected @endif>Agent
                                                        </option>
                                                    @else
                                                        <option value="all">All</option>
                                                        <option value="user">User</option>
                                                        <option value="merchant">Merchant</option>
                                                        <option value="agent">Agent</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Vendor...." class="chosen-select"
                                                        tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['vendor']))

                                                        @foreach($getAllUniqueVendors as $getAllUniqueVendor)
                                                            <option value="{{$getAllUniqueVendor}}"
                                                                    @if($_GET['vendor']  == $getAllUniqueVendor) selected @endif >{{$getAllUniqueVendor}}</option>
                                                        @endforeach

                                                    @else
                                                        @foreach($getAllUniqueVendors as $getAllUniqueVendor)
                                                            <option
                                                                value="{{$getAllUniqueVendor}}">{{$getAllUniqueVendor}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="service">
                                                    <option value="" selected disabled>Select Service Type...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['service']))
                                                        @foreach($walletServiceTypes as $serviceType)
                                                            <option value="{{ $serviceType }}"
                                                                    @if($_GET['service'] == $serviceType) selected @endif>{{ $serviceType }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($walletServiceTypes as $serviceType)
                                                            <option
                                                                value="{{ $serviceType }}"> {{ $serviceType }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction type..."
                                                        class="chosen-select" tabindex="2" name="transaction_type">
                                                    <option value="" selected disabled>Select Transaction Type...
                                                    </option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['transaction_type']))
                                                        @foreach($transactionTypes as $key => $transactionType)
                                                            <option value="{{ $key }}"
                                                                    @if($_GET['transaction_type'] == $key) selected @endif>{{ $transactionType }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($transactionTypes as $key => $transactionType)
                                                            <option value="{{ $key }}"> {{ $transactionType }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('transaction.complete') }}"><strong>Filter</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('transaction.complete.excel') }}">
                                            <strong>Excel</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($_GET))
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all transactions</h5>

                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> {{ $totalTransactionCount }}</h5>
                            <h5><b>Total Amount Sum:</b> Rs. {{ $totalTransactionAmountSum }}</h5>
                            <h5><b>Total Fee Sum:</b> Rs. {{ $totalTransactionFeeSum }}</h5>
<h5><b>Total Cashback Sum: </b> Rs. {{ $totalTransactionCashbackSum }}
 <h5><b>Total Commission Sum:</b> Rs. {{ $totalTransactionCommissionSum }}</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Complete transactions list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction ID</th>
                                        <th>UID</th>
                                        <th>Transaction ID</th>
                                        <th>User</th>
                                        <th>Vendor</th>
                                        <th>Service Type</th>
                                        <th>Amount</th>
                                        <th>Transaction Fee</th>
                                        <th>Cashback amount</th>
                                        <th>Commission</th>
                                        <th>Status</th>
                                        {{--<th>UserType</th>--}}
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($transactions as $transaction)
                                        <tr class="gradeC">
                                            <td>{{ $loop->index + ($transactions->perPage() * ($transactions->currentPage() - 1)) + 1 }}</td>
                                            <td>{{ $transaction->pre_transaction_id }}</td>
                                            <td>{{ $transaction->uid ?? '---' }}</td>
                                            <td>
                                                @if(!empty($transaction->transactionable->transaction_id))
                                                    {{ $transaction->transactionable->transaction_id}}
                                                @elseif(!empty($transaction->transactionable->refStan))
                                                    {{ $transaction->transactionable->refStan}}
                                                @else
                                                    {{ $transaction->id }}
                                                @endif
                                            </td>
                                            <td>
<<<<<<< HEAD
                                                <a @can('User profile') href="{{route('user.profile', $transaction->user_id)}}" @endcan> {{ $transaction->user['mobile_no'] ?? '' }} <br>



=======
                                                <a @can('User profile') href="{{route('user.profile', $transaction->user_id)}}" @endcan> {{ $transaction->user['mobile_no'] }} <br>
>>>>>>> 0488a35f (blog management)
                                                </a>
                                            </td>
                                            <td>
                                                {{ $transaction->vendor }}
                                            </td>
                                            <td>
                                                {{ $transaction->service_type }}
                                            </td>
                                            <td class="center">Rs. {{ $transaction->amount }}</td>
                                            <td class="center">
                                                Rs. {{ $transaction->fee }}
                                            </td>
                                            <td>
                                                Rs. {{ $transaction->cashback_amount }}
                                            </td>
<td>Rs. {{ $transaction->commission_amount }}</td>
                                            <td>
                                                <span class="badge badge-primary">Complete</span>
                                            </td>
                                        {{--    <td>
                                                @if($transaction->user->userType != null)
                                                    <span class="badge badge-primary">User</span>
                                                    @elseif($transaction->user->merchant != null)
                                                    <span class="badge badge-danger">Merchant</span>
                                                    @elseif($transaction->user->agent != null && $transaction->user->isValidAgentOrSubAgent())
                                                    <span class="badge badge-pill">Agent</span>
                                                @endif
                                            </td>--}}
                                            <td class="center">{{ $transaction->created_at }}</td>
                                            <td>
                                                @include('admin.transaction.transactionActionButtons', ['transaction' => $transaction])
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $transactions->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection


@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries";
            $('.dataTables_info').text(a);
        });
        @endif
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`;
        @else '0;100000'; @endif
        let split = amount.split(';');
        $(".ionrange_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });
    </script>

    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection


