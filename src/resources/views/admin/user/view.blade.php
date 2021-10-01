@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>User</strong>
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
                        <h5>Filter Users</h5>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Enter User Name"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['name']) ? $_GET['name'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="number" placeholder="Enter Contact Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['number']) ? $_GET['number'] : '' }}">
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <input type="email" name="email" placeholder="Enter Email"
                                                   class="form-control"
                                                   value="{{ !empty($_GET['email']) ? $_GET['email'] : '' }}">
                                        </div>

                                        {{--<div class="col-md-3">
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
                                        </div>--}}


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
                                                formaction="{{ route('user.view') }}"><strong>Filter</strong></button>
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
                    <div class="ibox-title">
                        <h5>List of registered users</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Dpasis user's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Contact Number</th>
                                    {{--<th>Email</th>--}}
                                    <th>KYC status</th>
                                    <th>Wallet Balance</th>
                                    <th>User type</th>
                                    <th>Bonus Balance</th>
                                    {{--<th>Total <br>Fund Send Amount</th>
                                    <th>Total <br>Fund Received Amount</th>
                                    <th>Total <br>Payment Amount</th>
                                    <th>Total <br>Loaded Amount</th>--}}
                                    {{-- <th>No. of <br>Transactions</th>--}}
                                    {{--<th>Total <br>CashBack Amount</th>--}}
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                        <tr class="gradeX">
                                            <td>{{ $loop->index + ($users->perPage() * ($users->currentPage() - 1)) + 1 }}</td>
                                            <td>
                                                {{--<img alt="image"  src="img/profile_small.jpg" style="">--}}
                                                <a @can('User profile') href="{{route('user.profile', $user->id)}}" @endcan>{{ $user->name }}</a>
                                            </td>
                                            <td>
                                                @if(!empty($user->phone_verified_at))
                                                    <i class="fa fa-check-circle" style="color: green;"></i>
                                                    &nbsp;{{ $user->mobile_no }}
                                                @else
                                                    <i class="fa fa-times-circle" style="color: red;"></i>
                                                    &nbsp;{{ $user->mobile_no }}
                                                @endif
                                            </td>
                                            {{--<td class="center">
                                                @if(!empty($user->email_verified_at))
                                                    <i class="fa fa-check-circle" style="color: green;"></i> &nbsp;{{ $user->email }}
                                                @else
                                                    <i class="fa fa-times-circle" style="color: red;"></i>&nbsp;{{ $user->email }}
                                                @endif
                                            </td>--}}
                                            <td>
                                                @include('admin.user.kyc.status', ['kyc' => $user->kyc])
                                            </td>
                                            <td>Rs. {{ $user->wallet->balance }}</td>
                                            <td>
                                                @include('admin.user.userType.displayUserTypes',['user' => $user])
                                            </td>
                                            <td>Rs. {{ $user->wallet->bonus_balance }}</td>

                                            {{--<td>Rs. {{ $user->getFundSendAmount() }}</td>

                                            <td>Rs. {{ $user->getFundReceiveAmount() }}</td>

                                            <td>Rs. {{ $user->getTotalPaymentAmount() }}</td>

                                            <td>Rs. {{ $user->getTotalLoadedAmount() }}</td>--}}

                                            {{--<td>{{ count($user->userTransactionEvents) }}</td>--}}

                                            {{--<td>Rs. {{ $user->getTotalCashBack() }}</td>--}}

                                            <td class="center">
                                                @can('User profile')
                                                    <a style="margin-top: 5px;"
                                                       href="{{route('user.profile', $user->id)}}"
                                                       class="btn btn-sm btn-icon btn-primary m-t-n-xs"
                                                       title="user profile"><i class="fa fa-eye"></i></a>
                                                @endcan

                                                @can('User transactions')
                                                    <a style="margin-top: 5px;"
                                                       href="{{route('user.transaction', $user->id)}}"
                                                       class="btn btn-sm btn-icon btn-info m-t-n-xs"
                                                       title="user transactions"><i
                                                            class="fa fa-credit-card"></i></a>
                                                @endcan

                                                <a style="margin-top: 5px;"
                                                   href="{{route('user.bank.accounts', $user->id)}}"
                                                   class="btn btn-sm btn-icon btn-warning m-t-n-xs"
                                                   title="user bank accounts"><i class="fa fa-bank"></i></a>

                                                @can('Create user kyc')
                                                    @if(empty($user->kyc))
                                                        <a style="margin-top: 5px;"
                                                           href="{{route('user.createUserKyc',$user->id)}}"
                                                           class="btn btn-sm btn-icon btn-primary m-t-n-xs"
                                                           title="user profile"><i class="fa fa-plus"></i></a>
                                                    @endif
                                                @endcan

                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $users->appends(request()->query())->links() }}
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

            let a = "Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        let walletAmount = @if(!empty($_GET['wallet_balance'])) `{{ $_GET['wallet_balance'] }}`;
        @else '0;100000'; @endif
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

        walletAmount = @if(!empty($_GET['transaction_payment'])) `{{ $_GET['transaction_payment'] }}`;
        @else '0;100000';
        @endif
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

        walletAmount = @if(!empty($_GET['transaction_loaded'])) `{{ $_GET['transaction_loaded'] }}`;
        @else '0;100000';
        @endif
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


        walletAmount = @if(!empty($_GET['transaction_number'])) `{{ $_GET['transaction_number'] }}`;
        @else '0;1000';
        @endif
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





