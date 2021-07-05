@extends('admin.layouts.admin_design')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Clearance Compare for <b>{{ $transactionName }}</b> from <b>{{ $fromDate }}</b> to <b>{{ $toDate }}</b> </h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Clearance Transactions</strong>
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
                        <div class="ibox-title">
                            <h5>Compare Transactions</h5>
                        </div>
                        <div class="ibox-content">
                            {{--<h5><b>Total Count:</b> {{ $totalTransactionCount }}</h5>
                            <h5><b>Total Amount Sum:</b> Rs. {{ $totalTransactionAmountSum }}</h5>
                            <h5><b>Total Fee Sum:</b> Rs. {{ $totalTransactionFeeSum }}</h5>--}}
                            <div class="table-responsive" id="comparedTransactionId">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="clearance transactions">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Wallet Linked Id</th>
                                        <th>Wallet Amount</th>
                                        <th>Wallet Transaction Fee</th>
                                        <th>Excel Linked Id</th>
                                        <th>Excel Amount</th>
                                        <th>Excel Transaction Fee</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($comparedTransactions as $comparedTransaction)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$comparedTransaction["wallet"]["pre_transaction_id"]}}</td>
                                            <td>{{$comparedTransaction["wallet"]["linked_id"]}}</td>
                                            <td>{{$comparedTransaction["wallet"]["amount"]}}</td>
                                            <td>{{$comparedTransaction["wallet"]["transaction_fee"]}}</td>
                                            <td>{{$comparedTransaction["excel"]["linked_id"]}}</td>
                                            <td>{{$comparedTransaction["excel"]["amount"]}}</td>
                                            <td>{{$comparedTransaction["excel"]["transaction_fee"]}}</td>
                                        </tr>
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
                        <h5>Transaction in wallet but not in Excel</h5>
                    </div>
                    <div class="ibox-content">
                        {{--<h5><b>Total Count:</b> {{ $totalTransactionCount }}</h5>
                        <h5><b>Total Amount Sum:</b> Rs. {{ $totalTransactionAmountSum }}</h5>
                        <h5><b>Total Fee Sum:</b> Rs. {{ $totalTransactionFeeSum }}</h5>--}}
                        <div class="table-responsive" id="transactionInWalletButNotInExcelId">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="clearance transactions">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Pre Transaction Id</th>
                                    <th>Wallet Linked Id</th>
                                    <th>Wallet Amount</th>
                                    <th>Wallet Transaction Fee</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($walletTransactionsNotFoundInExcel as $walletTransaction)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$walletTransaction["pre_transaction_id"]}}</td>
                                        <td>{{$walletTransaction["linked_id"]}}</td>
                                        <td>{{$walletTransaction["amount"]}}</td>
                                        <td>{{$walletTransaction["transaction_fee"]}}</td>
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
                        <h5>Transaction in Excel but not in Wallet</h5>
                    </div>
                    <div class="ibox-content">
                        {{--<h5><b>Total Count:</b> {{ $totalTransactionCount }}</h5>
                        <h5><b>Total Amount Sum:</b> Rs. {{ $totalTransactionAmountSum }}</h5>
                        <h5><b>Total Fee Sum:</b> Rs. {{ $totalTransactionFeeSum }}</h5>--}}
                        <div class="table-responsive" id="transactionInWalletButNotInExcelId">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="clearance transactions">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Excel Linked Id</th>
                                    <th>Excel Amount</th>
                                    <th>Excel Transaction Fee</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($excelTransactionsNotFoundInWallet as $excelTransaction)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$excelTransaction["linked_id"]}}</td>
                                        <td>{{$excelTransaction["amount"]}}</td>
                                        <td>{{$excelTransaction["transaction_fee"]}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')


    @include('admin.asset.css.datatable')
@endsection

@section('scripts')
    @include('admin.asset.js.datatableWithPaging')
@endsection






