@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Pre Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Refunded Pre-Transactions</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Refunded Pre-Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content"
                         @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="user_number">User Number</label>
                                            <input type="number" name="user_number" placeholder="Enter User Number"
                                                   class="form-control"
                                                   value="{{ !empty($_GET['user_number']) ? $_GET['user_number'] : '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pre_transaction_id">Enter Pre-Transaction ID</label>
                                                <input type="text" name="pre_transaction_id"
                                                       placeholder="Enter Pre Transaction ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="transaction_type">Transaction Type</label>
                                                <select data-placeholder="Select Transaction Type" class="chosen-select"
                                                        tabindex="2" name="transaction_type">
                                                    <option value="" selected disabled>Select Transaction Type...
                                                    </option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['transaction_type']))

                                                        @foreach($transaction_types as $transaction_type)
                                                            <option value="{{$transaction_type}}"
                                                                    @if($_GET['transaction_type']  == $transaction_type) selected @endif >{{$transaction_type}}</option>
                                                        @endforeach

                                                    @else
                                                        @foreach($transaction_types as $transaction_type)
                                                            <option
                                                                value="{{$transaction_type}}">{{$transaction_type}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-bottom: 15px;">
                                            <label for="transaction_type">From Date</label>
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-bottom: 15px;">
                                            <label for="transaction_type">To Date</label>
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="transaction_number">Pre Transaction Amount</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="From Pre-Transaction Amount"
                                                               name="from_preTransaction_amount" autocomplete="off"
                                                               value="{{ !empty($_GET['from_preTransaction_amount']) ? $_GET['from_preTransaction_amount'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="To Pre-Transaction Amount"
                                                               name="to_preTransaction_amount" autocomplete="off"
                                                               value="{{ !empty($_GET['to_preTransaction_amount']) ? $_GET['to_preTransaction_amount'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>


                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                        {{-- formaction="{{ route('preTransaction.view') }}--}}
                                        ><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    @include('admin.asset.notification.notify')

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Pre Transaction list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User Number</th>
                                    <th>Pre Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Vendor</th>
                                    <th>Service type</th>
                                    <th>Micro Service Type</th>
                                    <th>Transaction Type</th>
                                    <th>URL</th>
                                    <th>Before Balance</th>
                                    <th>After Balance</th>
                                    <th>Before Bonus Balance</th>
                                    <th>After Balance Bonus</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th style="width: 100px !important;">JsonInfo</th>
                                    <th style="width: 100px !important;">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($preTransactions as $preTransaction)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + ($preTransactions->perPage() * ($preTransactions->currentPage() - 1)) + 1 }}</td>
                                        <td>{{optional($preTransaction->user)->mobile_no}}</td>
                                        <td>{{ $preTransaction->pre_transaction_id }}</td>
                                        <td>Rs. {{$preTransaction->amount}}</td>
                                        <td>{{$preTransaction->description}}</td>
                                        <td>
                                            {{ $preTransaction->vendor }}
                                        </td>
                                        <td>
                                            {{ $preTransaction->service_type }}
                                        </td>
                                        <td>{{ $preTransaction->microservice_type }}</td>
                                        <td>{{ $preTransaction->transaction_type }}</td>
                                        <td>{{ $preTransaction->url }}</td>
                                        <td>{{ $preTransaction->before_balance }}</td>
                                        <td>{{ $preTransaction->after_balance }}</td>
                                        <td>{{ $preTransaction->before_bonus_balance }}</td>
                                        <td>{{ $preTransaction->after_bonus_balance }}</td>
                                        <td>{{$preTransaction->created_at}}</td>

                                        <td>
                                            @if($preTransaction->status=="FAILED")
                                                <span class="badge badge-danger">{{$preTransaction->status}}</span>
                                            @elseif($preTransaction->status=="SUCCESS")
                                                <span class="badge badge-primary">{{$preTransaction->status}}</span>
                                            @else
                                                <span class="badge badge-secondary">Null</span>
                                            @endif
                                        </td>
                                        <td>
                                            @include('RefundPreTransaction::preTransactionJsonRequest', ['preTransaction' => $preTransaction])
                                            @include('RefundPreTransaction::preTransactionJsonResponse', ['preTransaction' => $preTransaction])
                                            @include('RefundPreTransaction::preTransactionRequestParameter', ['preTransaction' => $preTransaction])
                                            @include('RefundPreTransaction::preTransactionSpecials', ['preTransaction' => $preTransaction])
                                        </td>
                                        <td>
                                            @can('Refund edit pretransaction')
                                                <a href="{{ route('refund.pretransaction.edit',$preTransaction->id)}}"
                                                   class="btn btn-success btn-sm m-t-n-xs"><i
                                                        class="fa fa-edit"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $preTransactions->appends(request()->query())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('styles')


    @include('admin.asset.css.datepicker')

    @include('admin.asset.css.chosen')

    @include('admin.asset.css.datatable')

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')


    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $preTransactions->firstItem() }} to {{ $preTransactions->lastItem() }} of {{ $preTransactions->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>

    <!-- IonRangeSlider -->
    {{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>--}}
    {{--        <script>--}}
    {{--            let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`;--}}
    {{--            @else '0;100000'; @endif--}}
    {{--            let split = amount.split(';');--}}
    {{--            $(".ionrange_amount").ionRangeSlider({--}}
    {{--                type: "double",--}}
    {{--                grid: true,--}}
    {{--                min: 0,--}}
    {{--                max: 100000,--}}
    {{--                from: split[0],--}}
    {{--                to: split[1],--}}
    {{--                prefix: "Rs."--}}
    {{--            });--}}
    {{--        </script>--}}
@endsection
