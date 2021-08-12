@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Merchants</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-success float-right">Valid</span>
                        <h5>Valid KYC Merchant Count</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $stats['validMerchantCount'] }}</h1>
                        <small>Number of merchant with valid KYC</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-danger float-right">Invalid</span>
                        <h5>Invalid KYC Merchant Count</h5>
                    </div>
                    <div class="ibox-content">
{{--                        <h1 class="no-margins">{{ $stats['invalidMerchantCount'] }}</h1>--}}
                        <small>Number of merchant with invalid KYC</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-info float-right">Count</span>
                        <h5>Number of merchant transaction</h5>
                    </div>
                    <div class="ibox-content">
{{--                        <h1 class="no-margins">{{ $stats['successfulMerchantTransactionCount'] }}</h1>--}}
                        <small>Number of successful merchant transaction</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title" style="padding-right: 15px;">
                        <span class="label label-primary float-right">Sum</span>
                        <h5>Sum of merchant transaction</h5>
                    </div>
                    <div class="ibox-content">
{{--                        <h1 class="no-margins">Rs. {{ $stats['successfulMerchantTransactionSum'] }}</h1>--}}
                        <small>Sum of merchant transaction amount</small>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Merchants</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">


                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Enter User Name"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['name']) ? $_GET['name'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="number" placeholder="Enter Contact Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['number']) ? $_GET['number'] : '' }}">
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <input type="email" name="email" placeholder="Enter Email"
                                                   class="form-control"
                                                   value="{{ !empty($_GET['email']) ? $_GET['email'] : '' }}">
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="sort">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    @if(!empty($_GET['sort']))
                                                        <option value="wallet_balance"
                                                                @if($_GET['sort']  == 'wallet_balance') selected @endif >
                                                            Wallet Balance
                                                        </option>
                                                        <option value="transaction_number"
                                                                @if($_GET['sort'] == 'transaction_number') selected @endif>
                                                            Transaction Number
                                                        </option>
                                                        <option value="transaction_payment"
                                                                @if($_GET['sort'] == 'transaction_payment') selected @endif>
                                                            Transaction Payment
                                                        </option>
                                                        <option value="transaction_loaded"
                                                                @if($_GET['sort'] == 'transaction_loaded') selected @endif>
                                                            Transaction Loaded
                                                        </option>
                                                    @else
                                                        <option value="wallet_balance">Wallet Balance</option>
                                                        <option value="transaction_number">Transaction Number</option>
                                                        <option value="transaction_payment">Transaction Payment</option>
                                                        <option value="transaction_loaded">Transaction Loaded</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="padding-bottom: 15px;">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <label for="transaction_number">Transaction Number</label>
                                            {{--                                            <input type="text" name="transaction_number" class="ionrange_number">--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="From Transaction Amount"
                                                               name="from_transaction_number" autocomplete="off"
                                                               value="{{ !empty($_GET['from_transaction_number']) ? $_GET['from_transaction_number'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="To Transaction Amount"
                                                               name="to_transaction_number" autocomplete="off"
                                                               value="{{ !empty($_GET['to_transaction_number']) ? $_GET['to_transaction_number'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="wallet_balance">Wallet Balance</label>
                                            {{--                                            <input type="text" name="wallet_balance" class="ionrange_wallet_amount">--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="From Wallet balance"
                                                               name="from_wallet_balance" autocomplete="off"
                                                               value="{{ !empty($_GET['from_wallet_balance']) ? $_GET['from_wallet_balance'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="To Wallet balance" name="to_wallet_balance"
                                                               autocomplete="off"
                                                               value="{{ !empty($_GET['to_wallet_balance']) ? $_GET['to_wallet_balance'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="transaction_amount">Transaction Payment</label>
                                            {{--                                            <input type="text" name="transaction_payment" class="ionrange_payment_amount">--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="From Transaction payment"
                                                               name="from_transaction_payment" autocomplete="off"
                                                               value="{{ !empty($_GET['from_transaction_payment']) ? $_GET['from_transaction_payment'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="To Transaction payment"
                                                               name="to_transaction_payment" autocomplete="off"
                                                               value="{{ !empty($_GET['to_transaction_payment']) ? $_GET['to_transaction_payment'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="transaction_amount">Transaction Loaded</label>
                                            {{--                                            <input type="text" name="transaction_loaded" class="ionrange_loaded_amount">--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="From Transaction loaded"
                                                               name="from_transaction_loaded" autocomplete="off"
                                                               value="{{ !empty($_GET['from_transaction_loaded']) ? $_GET['from_transaction_loaded'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="To Transaction loaded"
                                                               name="to_transaction_loaded" autocomplete="off"
                                                               value="{{ !empty($_GET['to_transaction_loaded']) ? $_GET['to_transaction_loaded'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <br><label>Phone Verification</label><br>
                                            <div class="form-group">
                                                <select data-placeholder="Phone Verification..." class="chosen-select"
                                                        tabindex="2" name="verification">
                                                    <option value="" selected disabled>Phone Verification...</option>
                                                    @if(!empty($_GET['verification']))
                                                        <option value="all"
                                                                @if($_GET['verification']  == 'all') selected @endif >
                                                            All
                                                        </option>
                                                        <option value="verified"
                                                                @if($_GET['verification']  == 'verified') selected @endif >
                                                            Verified
                                                        </option>
                                                        <option value="unverified"
                                                                @if($_GET['verification'] == 'unverified') selected @endif>
                                                            Unverified
                                                        </option>
                                                    @else
                                                        <option value="all">All</option>
                                                        <option value="verified">Verified</option>
                                                        <option value="unverified">Unverified</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <br><label>Referral Code</label><br>
                                            <input type="text" class="form-control" placeholder="Referral Code"
                                                   name="referral_code" autocomplete="off"
                                                   value="{{ !empty($_GET['referral_code']) ? $_GET['referral_code'] : '' }}">
                                        </div>
                                        <div class="col-md-4">
                                            <br><label>Kyc Status</label><br>
                                            <div class="form-group">
                                                <select data-placeholder="Kyc Status..." class="chosen-select"
                                                        tabindex="2" name="kyc_status">
                                                    <option value="" selected disabled>Kyc Status...</option>
                                                    @if(!empty($_GET['kyc_status']))
                                                        <option value="all"
                                                                @if($_GET['kyc_status']  == 'all') selected @endif >All
                                                        </option>
                                                        <option value="verified"
                                                                @if($_GET['kyc_status']  == 'verified') selected @endif >
                                                            Accepted
                                                        </option>
                                                        <option value="unverified"
                                                                @if($_GET['kyc_status']  == 'unverified') selected @endif >
                                                            Rejected
                                                        </option>
                                                        <option value="pending"
                                                                @if($_GET['kyc_status'] == 'pending') selected @endif>
                                                            Pending
                                                        </option>
                                                        <option value="notfilled"
                                                                @if($_GET['kyc_status'] == 'notfilled') selected @endif>
                                                            Not filled
                                                        </option>
                                                    @else
                                                        <option value="all">All</option>
                                                        <option value="verified">Accepted</option>
                                                        <option value="unverified">Rejected</option>
                                                        <option value="pending">Pending</option>
                                                        <option value="notfilled">Not filled</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('merchant.view') }}"><strong>Filter</strong></button>
                                    </div>

{{--                                    <div>--}}
{{--                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"--}}
{{--                                                type="submit" style="margin-right: 10px;"--}}
{{--                                                formaction="{{ route('merchant.excel') }}"><strong>Excel</strong></button>--}}
{{--                                    </div>--}}

                                    {{--<div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>
                                    </div>--}}
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
                        <h5>List of registered merchants</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="SajiloPay user's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Merchant</th>
                                    <th>Contact Number</th>
                                    {{--<th>Email</th>--}}
                                    <th>KYC status</th>
                                    <th>Wallet Balance</th>
                                    <th>Merchant Type</th>
{{--                                    <th>Commission Type</th>--}}
{{--                                    <th>Commission Value</th>--}}
{{--                                    <th>Total <br>Fund Deposit Amount</th>--}}
{{--                                    <th>Total <br>Fund Received Amount</th>--}}
{{--                                    <th>Total <br>Loaded Amount</th>--}}
                                   {{-- <th>No. of <br>Transactions</th>--}}
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($merchants as $merchant)
                                    <tr class="gradeX">
                                    <td>{{ $loop->index + ($merchants->perPage() * ($merchants->currentPage() - 1)) + 1 }}</td>
                                    <td>
                                         <a href="{{route('user.profile', $merchant->id)}}">{{ $merchant->name }}</a>
                                    </td>
                                    <td>
                                        @if(!empty($merchant->phone_verified_at))
                                            <i class="fa fa-check-circle" style="color: green;"></i> &nbsp;{{ $merchant->mobile_no }}
                                        @else
                                            <i class="fa fa-times-circle" style="color: red;"></i>&nbsp;{{ $merchant->mobile_no }}
                                        @endif
                                    </td>

                                    <td>
                                       @include('admin.merchant.kyc.status', ['kyc' => $merchant->kyc])
                                    </td>
                                    <td>Rs. {{ $merchant->wallet->balance }}</td>
{{--                                    <td>{{ $merchant->commission_type }}</td>--}}
{{--                                    <td>{{ $merchant->commission_value }}</td>--}}

{{--                                    <td>Rs. {{ $merchant->depositSum() }}</td>--}}

{{--                                    <td>Rs. {{ $merchant->receivedSum() }}</td>--}}


{{--                                    <td>Rs. {{ $merchant->loadedSum() }}</td>--}}

{{--                                    <td>{{ count($merchant->userTransactionEvents) }}</td>--}}
                                        <td>@include('admin.user.userType.displayUserTypes',['user'=>$merchant])</td>

                                    <td class="center">

                                            <a style="margin-top: 5px;" href="{{route('merchant.kyc.detail', $merchant->id)}}" class="btn btn-sm btn-icon btn-primary m-t-n-xs" title="Unverified Merchant Kyc List"><i class="fa fa-eye"></i></a>

                                            <a style="margin-top: 5px" href="{{ route('user.profile', $merchant->id) }}" class="btn btn-sm btn-icon btn-danger m-t-n-xs" title="Merchant Profile"><i class="fa fa-user"></i></a>
{{--                                        <a style="margin-top: 5px;" href="{{route('merchant.transaction', $merchant->id)}}" class="btn btn-sm btn-icon btn-info m-t-n-xs" title="merchant transactions"><i class="fa fa-credit-card"></i></a>--}}

{{--                                        <a style="margin-top: 5px;" href="{{route('merchant.kyc', $merchant->id)}}" class="btn btn-sm btn-icon btn-warning m-t-n-xs" title="merchant kyc"><i class="fa fa-file"></i></a>--}}

                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $merchants->appends(request()->query())->links() }}
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

    <script>
        $(document).ready(function (e) {

            let a = "Showing {{ $merchants->firstItem() }} to {{ $merchants->lastItem() }} of {{ $merchants->total() }} entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        let walletAmount = @if(!empty($_GET['wallet_balance'])) `{{ $_GET['wallet_balance'] }}`; @else '0;100000'; @endif
        let split = walletAmount.split(';');


        $(".ionrange_wallet_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = @if(!empty($_GET['transaction_payment'])) `{{ $_GET['transaction_payment'] }}`; @else '0;100000'; @endif
        split = walletAmount.split(';');

        $(".ionrange_payment_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = @if(!empty($_GET['transaction_loaded'])) `{{ $_GET['transaction_loaded'] }}`; @else '0;100000'; @endif
        split = walletAmount.split(';');

        $(".ionrange_loaded_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });


        walletAmount = @if(!empty($_GET['transaction_number'])) `{{ $_GET['transaction_number'] }}`; @else '0;1000'; @endif
        split = walletAmount.split(';');

        $(".ionrange_number").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: split[0],
            to: split[1],
        });
    </script>
@endsection





