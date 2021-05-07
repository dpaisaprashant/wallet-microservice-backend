@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All Card load transaction</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>All Card load list</strong>
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

                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('nicasia.cyberSourceLoad') }}" id="filter">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="reference_number" placeholder="Reference Number" class="form-control" value="{{ !empty($_GET['reference_number']) ? $_GET['reference_number'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="pre_transaction_id" placeholder="Pre Transaction ID" class="form-control" value="{{ !empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or number" class="form-control" value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
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
                                                <input type="number" class="form-control" placeholder="From Amount" name="from_amount" autocomplete="off" value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="To Amount" name="to_amount" autocomplete="off" value="{{ !empty($_GET['to_amount']) ? $_GET['to_amount'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 40px;">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Status" class="chosen-select"  tabindex="2" name="status">
                                                    <option value="" selected disabled>Status</option>
                                                    @if(!empty($_GET['status']))
                                                        <option value="STARTED" @if($_GET['sort'] == 'STARTED') selected @endif> Started </option>
                                                        <option value="PROCESSING" @if($_GET['sort'] == 'PROCESSING') selected @endif> Processing </option>
                                                        <option value="SUCCESS" @if($_GET['sort'] == 'SUCCESS') selected @endif> Success </option>
                                                        <option value="ERROR" @if($_GET['sort'] == 'ERROR') selected @endif> Error </option>
                                                        @else
                                                            <option value="STARTED"> Started </option>
                                                            <option value="PROCESSING"> Processing </option>
                                                            <option value="SUCCESS"> Success </option>
                                                            <option value="ERROR"> Error </option>
                                                        @endif

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('transaction.complete') }}"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('transaction.complete.excel') }}"><strong>Excel</strong></button>
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
                    <div class="ibox-title">
                        <h5>List of all Card load list</h5>

                    </div>
                    <div class="ibox-content">
{{--                        <h5><b>Total Count:</b> {{ $totalTransactionCount }}</h5>--}}
{{--                        <h5><b>Total Amount Sum:</b> Rs. {{ $totalTransactionAmountSum }}</h5>--}}
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Complete Card load list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Reference Number</th>
                                    <th>Pre Transaction ID</th>
                                    <th>UID</th>
                                    <th>Transaction ID</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Reason code</th>
                                    <th>Signed datetime</th>
                                    <th>Response datetime</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $key=>$transaction)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$transaction->reference_number}}</td>
                                        <td>{{$transaction->pre_transaction_id}}</td>
                                        <td>{{$transaction->user['mobile_no']}}</td>
                                        <td>{{$transaction->transaction_uuid}}</td>
                                        <td>{{$transaction->amount}}</td>
                                        <td>@include('admin.transaction.nicAsiaCyberSourceTransaction.status',['transaction' => $transaction])</td>
                                        @if($transaction->reason_code == null)
                                            <td><span class="badge badge-danger">Null</span></td>
                                        @else
                                            <td><span class="badge badge-success">{{$transaction->reason_code}}</span></td>
                                        @endif
                                            <td>{{$transaction->signed_datetime}}</td>
                                        @if($transaction->response_datetime != null)
                                            <td>{{$transaction->response_datetime}}</td>
                                        @else
                                            <td><span class="badge badge-danger">Null</span></td>
                                        @endif
                                        <td>
                                           @include('admin.transaction.nicAsiaCyberSourceTransaction.request',['transaction' => $transaction])
                                            @include('admin.transaction.nicAsiaCyberSourceTransaction.response',['transaction' => $transaction])
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
    </div>
@endsection


@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
{{--    <script>--}}
{{--        $(document).ready(function (e) {--}}
{{--            let a = "Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries";--}}
{{--            $('.dataTables_info').text(a);--}}
{{--        });--}}
{{--    </script>--}}


    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection


