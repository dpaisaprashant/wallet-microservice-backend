@extends('admin.layouts.admin_design')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Transaction Comparison for Wallet and NCHL Bank Transfer API </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
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
                        <h5>Filter Bank Transfers</h5>
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
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
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
                                    <br>

                                    <div>
                                        {{--                                        <form action="{{ route('nchlBankTransferApiByDate.report') }}" method="post">--}}
                                        {{--                                            @csrf--}}

                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit">
                                            <strong>Filter</strong>
                                        </button>

                                        {{--                                        </form>--}}

                                    </div>
                                    @include('admin.asset.components.clearFilterButton')

                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($_GET['from']) && !empty($_GET['to']))
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Compared Transactions from Wallet</h5>

                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> {{$disputedTransactions['totalTransactionCount']}}</h5>
                            <h5><b>Total Amount Sum:</b> Rs. {{$disputedTransactions['totalAmount']}}</h5>
                            <div class="table-responsive" id="comparedTransactionId">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="clearance transactions">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Transaction ID</th>
                                        <th>User Mobile Number</th>
                                        <th>Bank</th>
                                        <th>Amount (NRs.)</th>
                                        <th>Debit Status</th>
                                        <th>Credit Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($disputedTransactions['transactions'] as $transaction)
                                        <tr class="gradeC">
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{ $transaction->pre_transaction_id }}</td>
                                            <td>{{ $transaction->transaction_id }}</td>
                                            <td>
                                                @if(!empty($transaction->user))
                                                    <a @can('User profile') href="{{route('user.profile', $transaction->user_id)}}" @endcan>{{ $transaction->user['mobile_no']}}</a>
                                                @endif
                                            </td>
                                            <td>{{ $transaction->bank }}</td>

                                            <td>
                                                {{ $transaction->amount ?? 0}}
                                            </td>

                                            <td>
                                                {{ $transaction->debit_status }}
                                            </td>
                                            <td>
                                                {{ $transaction->credit_status }}
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Compared Transactions from API</h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> {{count($disputedTransactions['comparedNchlAPIs'])}}</h5>
                            <h5><b>Total Amount Sum:</b> Rs. {{$disputedTransactions['totalAmountAPI']}}</h5>
                            <div class="table-responsive" id="comparedTransactionId">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="clearance transactions">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Transaction ID</th>
                                        <th>Amount (NRs.)</th>
                                        <th>Debit Status</th>
                                        <th>Credit Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($disputedTransactions['comparedNchlAPIs'] as $nchlAPI)
                                        @if(!empty($nchlAPI))
                                            <tr class="gradeC">
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{ $nchlAPI['cipsBatchDetail']['batchId'] }}</td>
                                                <td>
                                                    {{ $nchlAPI['cipsBatchDetail']['batchAmount']}}
                                                </td>
                                                <td>
                                                    {{ $nchlAPI['cipsBatchDetail']['debitStatus'] }}
                                                </td>
                                                <td>{{ $nchlAPI['cipsTransactionDetailList']['0']['creditStatus'] }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Transactions in which status is success in wallet but not in API</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive" id="transactionInWalletButNotInExcelId">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="clearance transactions">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Transaction Id</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($disputedTransactions['wallet_success_mismatches'] as $wallet_success_mismatch)
                                        @if(!empty($wallet_success_mismatch))
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$wallet_success_mismatch->pre_transaction_id}}</td>
                                                <td>{{$wallet_success_mismatch->transaction_id}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Transactions in which status is success in API but not in Wallet</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive" id="transactionInWalletButNotInExcelId">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="clearance transactions">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Transaction Id</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($disputedTransactions['nchl_success_mismatches'] as $nchl_success_mismatch)
                                        @if(!empty($nchl_success_mismatch))
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$nchl_success_mismatch->pre_transaction_id}}</td>
                                                <td>{{$nchl_success_mismatch->transaction_id}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Transactions in which debit status do not match</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive" id="transactionInWalletButNotInExcelId">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="clearance transactions">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Transaction Id</th>
                                        <th>Debit Status</th>
                                        <th>Debit Response Message</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($disputedTransactions['debit_mismatches'] as $debit_mismatch)
                                        @if(!empty($debit_mismatch))
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$debit_mismatch->pre_transaction_id}}</td>
                                                <td>{{$debit_mismatch->transaction_id}}</td>
                                                <td>{{$debit_mismatch->debit_status}}</td>
                                                <td>{{$debit_mismatch->debit_response_message}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Transactions in which credit status do not match</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive" id="transactionInWalletButNotInExcelId">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="clearance transactions">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Transaction Id</th>
                                        <th>Credit Status</th>
                                        <th>Credit Response Message</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($disputedTransactions['credit_mismatches'] as $credit_mismatch)
                                        @if(!empty($credit_mismatch))
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$credit_mismatch->pre_transaction_id}}</td>
                                                <td>{{$credit_mismatch->transaction_id}}</td>
                                                <td>{{$credit_mismatch->credit_status}}</td>
                                                <td>{{$credit_mismatch->credit_response_message}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h4>Transactions in which amount does not match</h4>
                        </div>
                        <div class="ibox-content">

                            <div class="table-responsive" id="transactionInWalletButNotInExcelId">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="clearance transactions">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Transaction Id</th>
                                        <th>Amount (NRs.)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($disputedTransactions['amount_mismatches'] as $amount_mismatch)
                                        @if(!empty($amount_mismatch))
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$amount_mismatch->pre_transaction_id}}</td>
                                                <td>{{$amount_mismatch->transaction_id}}</td>
                                                <td>{{$amount_mismatch->amount}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>

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
    @include('admin.asset.js.datatableWithPaging')
    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

@endsection






