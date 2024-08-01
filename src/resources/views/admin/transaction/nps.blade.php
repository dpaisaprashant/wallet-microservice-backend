@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NPS Web/Mobile Banking</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Nps</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter NPS Transactions</h5>
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

                                                    @if(!empty($_GET['status']))
                                                        <option value="all"
                                                                @if($_GET['status'] == 'all') selected @endif>All
                                                        </option>
                                                        <option value="completed"
                                                                @if($_GET['status']  == 'completed') selected @endif>
                                                            Completed
                                                        </option>
                                                        <option value="validated"
                                                                @if($_GET['status']  == 'validated') selected @endif>
                                                            Validated
                                                        </option>
                                                        <option value="error"
                                                                @if($_GET['status']  == 'error') selected @endif>
                                                            Error
                                                        </option>
                                                    @else
                                                        <option value="all">All</option>
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
                                                        <input type="number" class="form-control"
                                                               placeholder="Pre Transaction Id"
                                                               name="pre_transaction_id"
                                                               autocomplete="off"
                                                               value="{{ !empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('nps') }}"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('nps.excel') }}"><strong>Excel</strong></button>
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
                            <h5>List of NPS transactions</h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> {{ $npsTotalTransactionCount }}</h5>
                            <h5><b>Total Amount Sum:</b> Rs. {{ $npsTotalTransactionSum }}</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="NPS transactions list">
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

                                    @foreach($npsLoadTransactions as $npsLoadTransaction)
                                        <tr>
                                            <td>{{ $loop->index + ($npsLoadTransactions->perPage() * ($npsLoadTransactions->currentPage() - 1)) + 1 }}</td>
                                            <td>{{optional($npsLoadTransaction->transactions)->uid ?? '---'}}</td>
                                            <td>{{$npsLoadTransaction->pre_transaction_id}}</td>
                                            <td>{{$npsLoadTransaction->transaction_id}}</td>
                                            <td>{{optional($npsLoadTransaction->user)->mobile_no}}</td>
                                            <td>{{$npsLoadTransaction->payment_mode}}</td>
                                            <td>{{$npsLoadTransaction->description}}</td>
                                            <td>{{$npsLoadTransaction->gateway_ref_no}}</td>
                                            <td class="center">Rs {{$npsLoadTransaction->amount}}</td>
                                            <td>Rs {{$npsLoadTransaction->transaction_fee ?? 0}}</td>
                                            <td>
                                                @if(isset($npsLoadTransaction->preTransaction->transactionEvent))

                                                    <span class="badge badge-primary">Complete</span>
                                                @else
                                                    <span class="badge badge-danger">Incomplete</span>
                                                @endif
                                            </td>

                                            <td>{{$npsLoadTransaction->created_at}}</td>
                                            <td>{{$npsLoadTransaction->response}}</td>
                                            <td>
                                                @include('admin.transaction.nps.detail', ['transaction' => $npsLoadTransaction])
                                                {{--                                                todo: add permission--}}
                                                <a href="{{ route('nps.detail', $npsLoadTransaction->id) }}">
                                                    <button class="btn btn-primary btn-icon" type="button"><i
                                                            class="fa fa-eye"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                                {{ $npsLoadTransactions->appends(request()->query())->links() }}
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
            let a = "Showing {{ $npsLoadTransactions->firstItem() }} to {{ $npsLoadTransactions->lastItem() }} of {{ $npsLoadTransactions->total() }} entries";
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
