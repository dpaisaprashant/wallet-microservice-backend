@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-7">
            <h2>Clearance Transactions</h2>
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
        <div class="col-lg-5">
            <div class="title-action">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <b>Clearance Date:</b> {{ $clearance->created_at }}
                        <br>
                        <b>Transaction Date:</b> {{ $clearance->transaction_from_date . ' - ' . $clearance->transaction_to_date }}
                    </li>
                </ol>
            </div>
        </div>
    </div>

    <div class="row" style="margin-top: 14px">

        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title" style="padding-right: 15px;">
                    <span class="label label-success float-right">Total</span>
                    <h5>Clearance Transaction</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $transactionCount }}</h1>
                    <small>Number of transactions in this clearance  </small>
                </div>
            </div>
        </div>


        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title" style="padding-right: 15px;">
                    <span class="label label-success float-right">Total</span>
                    <h5>Transaction amount sum</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">Rs. {{ $transactionAmountSum }}</h1>
                    <small>Sum of amount in transactions of clearance</small>
                </div>
            </div>
        </div>



        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title" style="padding-right: 15px";>
                    <span class="label label-info float-right">Total</span>
                    <h5>Original Dispute Count</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $originalDisputeCount }}</h1>
                    <small>Number of disputes while creating clearance</small>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title" style="padding-right: 15px";>
                    <span class="label label-info float-right">Total</span>
                    <h5>Handled Disputes</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{ $handledDisputeCount }}</h1>
                    <small>Number of Dispute Handled</small>
                </div>
            </div>
        </div>


    </div>

    <div class="wrapper wrapper-content animated fadeInRight" style="padding-top: 0px;">
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

                    <div class="ibox-content"
                         @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
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
                                                <select data-placeholder="Select Vendor...." class="chosen-select"
                                                        tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['vendor']))
                                                        @foreach($vendors as $vendor)
                                                            <option value="{{$vendor}}"
                                                                    @if($_GET['vendor']  == $vendor) selected @endif >{{$vendor}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($vendors as $vendor)
                                                            <option value="{{$vendor}}">{{$vendor}}</option>
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
                                                        @foreach($serviceTypes as $serviceType)
                                                            <option value="{{ $serviceType }}"
                                                                    @if($_GET['service'] == $serviceType) selected @endif>{{ $serviceType }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($serviceTypes as $serviceType)
                                                            <option
                                                                value="{{ $serviceType }}"> {{ $serviceType }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="ionrange_amount">Amount</label>
                                            <input type="text" name="amount" class="ionrange_amount">
                                        </div>


                                        <div class="col-md-6" style="margin-top: 40px;">
                                            <div class="form-group">
                                                <select data-placeholder="Clearance Status..." class="chosen-select" tabindex="2"
                                                        name="status">
                                                    <option value="" selected disabled>Clearance Status...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['status']))
                                                        <option value="cleared"
                                                                @if($_GET['status'] == 'cleared') selected @endif>Cleared
                                                        </option>
                                                        <option value="dispute"
                                                                @if($_GET['status'] == 'dispute') selected @endif>Dispute
                                                        </option>
                                                    @else
                                                        <option value="cleared">Cleared</option>
                                                        <option value="dispute">Dispute</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="clearance_id" value="{{ $clearance->id }}">
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('clearance.transactions', $clearance) }}"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('clearance.transaction.excel') }}"><strong>Excel</strong></button>
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
                        <h5>List of clearance transactions</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Transactions cleared on {{ $clearance->created_at }}">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Transaction ID</th>
                                    <th>User</th>
                                    <th>Vendor</th>
                                    <th>Service Type</th>
                                    <th>Amount</th>
                                    <th>Clearance Status</th>
                                    <th>Transaction Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clearanceTransactions as $transaction)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>
                                            @if(!empty($transaction->clearanceable->transaction_id))
                                                {{ $transaction->clearanceable->transaction_id}}
                                            @elseif(!empty($transaction->clearanceable->refStan))
                                                {{ $transaction->clearanceable->refStan}}
                                            @else
                                                {{ $transaction->id }}
                                            @endif
                                        </td>
                                        <td>
                                            <a @can('User profile') href="{{ route('user.profile', $transaction->clearanceable['user_id']) }}" @endcan> {{ $transaction->clearanceable->user['mobile_no'] }} </a>
                                        </td>
                                        <td>
                                            {{ $transaction->clearanceable->vendor }}
                                            {{ $transaction->clearanceable->payment_mode }}
                                        </td>
                                        <td>
                                            {{ $transaction->clearanceable->transactions['service_type'] }}
                                        </td>
                                        <td class="center">Rs. {{ $transaction->clearanceable->amount }}</td>
                                        <td>
                                            @if(empty($transaction->dispute_status) || $transaction->dispute_status == 0)
                                                <span class="badge badge-primary">Cleared</span>
                                            @elseif($transaction->dispute_status == 1)
                                                <span class="badge badge-danger">Dispute</span>
                                            @endif
                                        </td>
                                        <td class="center">{{ $transaction->clearanceable->created_at }}</td>
                                        <td>
                                            @if($transaction->dispute_status == 1)
                                                @if(auth()->user()->hasAnyPermission(['Clearance npay handle dispute', 'Clearance paypoint handle dispute']))
                                                    <a href="{{ route('dispute.detail.clearance', $transaction->clearanceable->dispute->id) }}">
                                                        <button class="btn btn-danger btn-icon" type="button"
                                                                title="handle dispute"><i class="fa fa-money"></i>
                                                        </button>
                                                    </a>
                                                @endif
                                            @endif
                                            @if($transaction->transaction_type == 'App\Models\UserToUserFundTransfer')
                                                @include('admin.transaction.fundTransfer.detail', ['transaction' => $transaction->clearanceable])
                                                <a href="{{ route('userToUserFundTransfer.detail', $transaction->transaction_id) }}">
                                                    <button class="btn btn-primary btn-icon" type="button"><i
                                                            class="fa fa-eye"></i></button>
                                                </a>
                                            @elseif($transaction->transaction_type == 'App\Models\UserLoadTransaction')

                                                @include('admin.transaction.npay.detail', ['transaction' => $transaction->clearanceable])
                                                <a href="{{ route('eBanking.detail', $transaction->transaction_id) }}">
                                                    <button class="btn btn-primary btn-icon" type="button"><i
                                                            class="fa fa-eye"></i></button>
                                                </a>

                                            @elseif($transaction->transaction_type == 'App\Models\UserTransaction')
                                                @include('admin.transaction.paypoint.detail', ['transaction' => $transaction->clearanceable])
                                                <a href="{{ route('paypoint.detail', $transaction->transaction_id) }}">
                                                    <button class="btn btn-primary btn-icon" type="button"><i
                                                            class="fa fa-eye"></i></button>
                                                </a>
                                            @elseif($transaction->transaction_type == 'App\Models\FundRequest')

                                                @include('admin.transaction.fundRequest.detail', ['transaction' => $transaction->clearanceable])
                                                <a href="{{ route('fundRequest.detail', $transaction->transaction_id) }}">
                                                    <button class="btn btn-primary btn-icon" type="button"><i
                                                            class="fa fa-eye"></i></button>
                                                </a>
                                            @endif
                                        </td>
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
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datatable')
    @include('admin.asset.css.datepicker')

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`;
        @else '0;100000';
            @endif
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


