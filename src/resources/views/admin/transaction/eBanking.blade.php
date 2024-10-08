@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NPay Web/Mobile Banking</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>NPay Web/Mobile Banking</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter NPay Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
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
                                                <input type="text" name="user" placeholder="Email or Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="bank" placeholder="Bank" class="form-control"
                                                       value="{{ !empty($_GET['bank']) ? $_GET['bank'] : '' }}">
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
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['status']))
                                                        <option value="completed"
                                                                @if($_GET['status']  == 'completed') selected @endif>
                                                            Completed
                                                        </option>
                                                        <option value="validated"
                                                                @if($_GET['status']  == 'validated') selected @endif>
                                                            Validated
                                                        </option>
                                                        <option value="error"
                                                                @if($_GET['status']  == 'error') selected @endif>Error
                                                        </option>
                                                    @else
                                                        <option value="completed">Completed</option>
                                                        <option value="validated">Validated</option>
                                                        <option value="error">Error</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
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

                                        <div class="col-md-6 mt-3">
                                            <label for="ionrange_balance">Pre Transaction Id</label>
                                            {{--                                            <input type="text" name="amount" class="ionrange_amount">--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                        <input type="text" class="form-control"
                                                               placeholder="Pre Transaction Id"
                                                               name="pre_transaction_id" autocomplete="off"
                                                               value="{{ !empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : '' }}">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('eBanking') }}"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('npay.excel') }}"><strong>Excel</strong></button>
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
                            <h5>List of NPay (Load Fund) transactions</h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> {{ $totalCountEbanking }}</h5>
                            <h5><b>Total Amount Sum:</b> Rs. {{ $totalSumEbanking }}</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="NPay transactions list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>UID</th>
                                        <th>Pre Transaction ID</th>
                                        <th>Transaction ID</th>
                                        <th>User</th>
                                        <th>Bank</th>
                                        <th>Description</th>
                                        <th>Gateway Ref no.</th>
                                        <th>Amount</th>
                                        <th style="width: 1%">Commission</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th style="width: 1%">Response</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($userLoadTransactions as $transaction)
                                        <tr class="gradeC">
                                            <td>{{ $loop->index + ($userLoadTransactions->perPage() * ($userLoadTransactions->currentPage() - 1)) + 1 }}</td>
                                            <td>{{ $transaction->transactions->uid ?? '---' }}</td>
                                            <td>{{$transaction->pre_transaction_id}}</td>
                                            <td>
                                                {{ $transaction->transaction_id }}
                                            </td>
                                            <td>
                                                {{ $transaction->user['mobile_no'] ?? ""}}
                                            </td>
                                            <td>
                                                {{ $transaction->payment_mode }}
                                            </td>
                                            <td>
                                                {{ $transaction->description }}
                                            </td>
                                            <td>{{ $transaction->gateway_ref_no }}</td>
                                            <td class="center">Rs.{{ $transaction->amount }}</td>

                                            <td>
                                                Rs. {{ $transaction->transaction_fee  ?? 0}}
                                            </td>

                                            <td>
                                                @include('admin.transaction.npay.status', ['transaction' => $transaction])
                                            </td>
                                            <td class="center">{{ $transaction->updated_at }}</td>
                                            <td>
                                                @isset($transaction->loadTransactionResponse)
                                                    @include('admin.transaction.npay.response', ['transaction' => $transaction->loadTransactionResponse])
                                                @endisset
                                            </td>
                                            <td>
                                                @include('admin.transaction.npay.detail', ['transaction' => $transaction])
                                                @can('Fund transfer detail')
                                                    <a href="{{ route('eBanking.detail', $transaction->id) }}">
                                                        <button class="btn btn-primary btn-icon" type="button"><i
                                                                class="fa fa-eye"></i></button>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                                {{ $userLoadTransactions->appends(request()->query())->links() }}
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
            let a = "Showing {{ $userLoadTransactions->firstItem() }} to {{ $userLoadTransactions->lastItem() }} of {{ $userLoadTransactions->total() }} entries";
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
