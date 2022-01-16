@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Paypoint</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Paypoint</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Paypoint Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('paypoint') }}">
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
                                                <input type="text" name="refStan" placeholder="ref Stan"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['refStan']) ? $_GET['refStan'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
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

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose paypoint vendor..."
                                                        class="chosen-select" tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select paypoint vendor...
                                                    </option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['vendor']))
                                                        @foreach($paypointVendors as $vendor)
                                                            <option value="{{ $vendor }}"
                                                                    @if($_GET['vendor'] == $vendor) selected @endif>{{ $vendor }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($paypointVendors as $vendor)
                                                            <option value="{{ $vendor }}"> {{ $vendor }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['status']))
                                                        <option value="completed"
                                                                @if($_GET['status']  == 'completed') selected @endif>
                                                            Completed
                                                        </option>
                                                        <option value="failed"
                                                                @if($_GET['status']  == 'failed') selected @endif>Failed
                                                        </option>
                                                    @else
                                                        <option value="completed">Completed</option>
                                                        <option value="failed">Failed</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                            <label for="ionrange_balance">Amount</label>
                                            {{--                                            <input type="text" name="amount" class="ionrange_amount">--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="From Amount" name="from_amount"
                                                               autocomplete="off"
                                                               value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="To Amount" name="to_amount"
                                                               autocomplete="off"
                                                               value="{{ !empty($_GET['to_amount']) ? $_GET['to_amount'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="margin-top: 40px;">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <select data-placeholder="Sort By..." class="chosen-select"
                                                            tabindex="2" name="sort">
                                                        <option value="" selected disabled>Sort By...</option>
                                                        @if(!empty($_GET['sort']))
                                                            <option value="date"
                                                                    @if($_GET['sort'] == 'date') selected @endif>Latest
                                                                Date
                                                            </option>
                                                            <option value="amount"
                                                                    @if($_GET['sort'] == 'amount') selected @endif>
                                                                Highest amount
                                                            </option>
                                                        @else
                                                            <option value="date">Latest Date</option>
                                                            <option value="amount">Highest Amount</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="margin-top: 40px;">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <input type="number" class="form-control"
                                                           placeholder="Pre Transaction Id" name="pre_transaction_id"
                                                           autocomplete="off"
                                                           value="{{ !empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit">
                                            <strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('paypoint.excel') }}"><strong>Excel</strong>
                                        </button>
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
                            <h5>List of Paypoint (Utility) transactions</h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> {{ $totalPayPointTransactionCount }}</h5>
                            <h5><b>Total Amount Sum:</b> Rs. {{$totalPayPointTransactionSum}}</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="PayPoint transaction list">
                                    <thead>
                                    <tr>
                                        <th>s.No.</th>
                                        <th>UID</th>
                                        <th>PreTransaction ID</th>
                                        <th>Transaction ID</th>
                                        <th>Vendor</th>
                                        <th>RefStan</th>
                                        <th>User</th>
                                        <th>Amount</th>
                                        <th>CashBacck</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Request</th>
                                        <th>Response</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr class="gradeC">
                                            <td>{{ $loop->index + ($transactions->perPage() * ($transactions->currentPage() - 1)) + 1 }}</td>
                                            <td>
                                                {{ $transaction->userTransaction->transactions->uid ?? '---'}}
                                            </td>
                                            <td>{{$transaction->pre_transaction_id}}</td>
                                            <td>
                                                {{ $transaction->transaction_id }}
                                            </td>
                                            <td>
                                                {{ $transaction->userTransaction['vendor'] ?? '' }}
                                            </td>
                                            <td>
                                                {{ $transaction->refStan }}
                                            </td>
                                            <td>
                                                @if(!empty($transaction->user))
                                                    <a @can('User profile') href="{{route('user.profile', $transaction->user['id'])}}" @endcan>{{ $transaction->user['mobile_no']}}</a>
                                                @elseif(!empty($transaction->requestInfo->user))
                                                    <a @can('User profile') href="{{route('user.profile', $transaction->requestInfo->user->id)}}" @endcan>{{ $transaction->requestInfo->user->mobile_no}}</a>
                                                @elseif(!empty($transaction->preTransaction->user))
                                                    <a @can('User profile') href="{{route('user.profile', $transaction->preTransaction->user->id)}}" @endcan>{{ $transaction->preTransaction->user->mobile_no}}</a>
                                                @elseif(!empty($transaction->userTransaction->preTransaction->user))
                                                    <a @can('User profile') href="{{route('user.profile', $transaction->userTransaction->preTransaction->user->id)}}" @endcan>{{ $transaction->userTransaction->preTransaction->user->mobile_no}}</a>
                                                @elseif(!empty($transaction->userExecutePayment[0]->preTransaction->user))
                                                    <a @can('User profile') href="{{route('user.profile', $transaction->userExecutePayment[0]->preTransaction->user->id)}}" @endcan>{{ $transaction->userExecutePayment[0]->preTransaction->user->mobile_no}}</a>
                                                @endif
                                            </td>

                                            <td>
                                                @if($transaction->userTransaction)
                                                    {{ $transaction->userTransaction['amount'] ? 'Rs. '.$transaction->userTransaction['amount'] : ''}}
                                                @endif
                                            </td>

                                            <td>

                                                @if($transaction->userTransaction != null && $transaction->userTransaction->commission !=null)
                                                    Rs. {{round($transaction->userTransaction->commission['after_amount'] - $transaction->userTransaction->commission['before_amount'], 2)  }}
                                                @else
                                                    Rs. 0
                                                @endif
                                            </td>

                                            <td>
                                                @include('admin.transaction.paypoint.status', ['transaction' => $transaction])
                                            </td>
                                            <td class="center">{{ $transaction->updated_at }}</td>

                                            {{--Request--}}
                                            <td>
                                                @can('Paypoint request view')
                                                    @include('admin.transaction.paypoint.request', ['transaction' => $transaction])
                                                @endcan
                                            </td>

                                            {{--Response--}}
                                            <td>
                                                @can('Paypoint response view')
                                                    @include('admin.transaction.paypoint.response', ['transaction' => $transaction])
                                                @endcan
                                            </td>

                                            <td>
                                                @can('Paypoint detail')
                                                    <a href="{{ route('paypoint.detail', $transaction->id) }}">
                                                        <button class="btn btn-primary btn-icon" type="button"><i
                                                                class="fa fa-eye"></i></button>
                                                    </a>
                                                @endcan
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
    @include('admin.asset.css.datatable')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    @include('admin.asset.css.datepicker')
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
@endsection
