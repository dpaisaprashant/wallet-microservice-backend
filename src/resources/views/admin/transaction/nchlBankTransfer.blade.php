@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NCHL Bank Transfer</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>NCHL Bank Transfer</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter NCHL Bank Transfers</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" >
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or Number" class="form-control" value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="bank" placeholder="Bank" class="form-control" value="{{ !empty($_GET['bank']) ? $_GET['bank'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                        <option value="" selected disabled>Sort By...</option>
                                                        @if(!empty($_GET['sort']))
                                                            <option value="date" @if($_GET['sort'] == 'date') selected @endif>Latest Date</option>
                                                            <option value="amount" @if($_GET['sort'] == 'amount') selected @endif>Highest amount</option>
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
                                        <div class="col-md-3" >
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3" >
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction debit status..." class="chosen-select"  tabindex="2" name="debit_status">
                                                    <option value="" selected disabled>Select Debit Status...</option>
                                                    <option value="" >All</option>
                                                    @if(!empty($_GET['debit_status']))
                                                        <option value="SUCCESS" @if($_GET['debit_status']  == 'SUCCESS') selected @endif>SUCCESS</option>
                                                        <option value="ERROR" @if($_GET['debit_status']  == 'ERROR') selected @endif>ERROR</option>
                                                        <option value="NOT_COMPLETED" @if($_GET['debit_status']  == 'NOT_COMPLETED') selected @endif>NOT COMPLETED</option>
                                                    @else
                                                        <option value="SUCCESS">SUCCESS</option>
                                                        <option value="ERROR">ERROR</option>
                                                        <option value="NOT_COMPLETED">NOT COMPLETED</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction credit status..." class="chosen-select"  tabindex="2" name="credit_status">
                                                    <option value="" selected disabled>Select Credit Status...</option>
                                                    <option value="" >All</option>
                                                    @if(!empty($_GET['credit_status']))
                                                        <option value="SUCCESS" @if($_GET['credit_status']  == 'SUCCESS') selected @endif>SUCCESS</option>
                                                        <option value="ERROR" @if($_GET['credit_status']  == 'ERROR') selected @endif>ERROR</option>
                                                        <option value="NOT_COMPLETED" @if($_GET['credit_status']  == 'NOT_COMPLETED') selected @endif>NOT COMPLETED</option>
                                                    @else
                                                        <option value="SUCCESS">SUCCESS</option>
                                                        <option value="ERROR">ERROR</option>
                                                        <option value="NOT_COMPLETED">NOT COMPLETED</option>
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
                                                        <input type="number" class="form-control" placeholder="From Amount" name="from_amount" autocomplete="off" value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control" placeholder="To Amount" name="to_amount" autocomplete="off" value="{{ !empty($_GET['to_amount']) ? $_GET['to_amount'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('nchl.bankTransfer') }}"><strong>Filter</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                    {{--<div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('npay.excel') }}"><strong>Excel</strong></button>
                                    </div>--}}
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
                        <h5>List of NCHL Bank Transfers</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="NPay transactions list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>PreTransaction ID</th>
                                    <th>Transaction ID</th>
                                    <th>User</th>
                                    <th>Bank</th>
                                    <th>Amount</th>
                                    <th style="width: 1%">Commission</th>
                                    <th>Debit Status</th>
                                    <th>Credit Status</th>
                                    <th>Date</th>
                                    <th style="width: 1%">Account</th>
                                    <th style="width: 1%">Request</th>
                                    <th style="width: 1%">Response</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + ($transactions->perPage() * ($transactions->currentPage() - 1)) + 1 }}</td>
                                        <td>{{ $transaction->pre_transaction_id }}</td>
                                        <td>{{ $transaction->transaction_id }}</td>
                                        <td>

                                            @if(!empty($transaction->user))
                                                <a  @can('User profile') href="{{route('user.profile', $transaction->user_id)}}" @endcan>{{ $transaction->user['mobile_no']}}</a>
                                            @endif
                                        </td>
                                        <td>{{ $transaction->bank }}</td>

                                        <td>
                                            Rs. {{ $transaction->amount ?? 0}}
                                        </td>

                                        <td>
                                            Rs. {{ $transaction->commission_amount }}
                                        </td>

                                        <td>
                                            @include('admin.transaction.nchlBankTransfer.debitStatus')
                                        </td>

                                        <td>
                                            @include('admin.transaction.nchlBankTransfer.creditStatus')
                                        </td>


                                        <td class="center">{{ $transaction->updated_at }}</td>

                                        <td>
                                            @include('admin.transaction.nchlBankTransfer.account')
                                        </td>

                                        <td>
                                            @include('admin.transaction.nchlBankTransfer.request')
                                        </td>

                                        <td>
                                            @include('admin.transaction.nchlBankTransfer.response')
                                        </td>
                                        <td>
                                            <a href="{{ route('nchl.bankTransfer.detail', $transaction->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
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
    @include('admin.asset.css.datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    @include('admin.asset.css.datepicker')

@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`; @else '0;100000'; @endif
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
