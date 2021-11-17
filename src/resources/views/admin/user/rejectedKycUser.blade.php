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

        @include('admin.userFilter.user-filter',['title' => "User"])

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>List of rejected KYC users</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Rejected Kyc Users">
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
                                @foreach($rejectedKycUsers as $user)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($rejectedKycUsers->perPage() * ($rejectedKycUsers->currentPage() - 1)) + 1 }}</td>
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
                                        <td>Rs. {{ optional($user->wallet)->balance }}</td>
                                        <td>
                                            @include('admin.user.userType.displayUserTypes',['user' => $user])
                                        </td>
                                        <td>Rs. {{ optional($user->wallet)->bonus_balance }}</td>

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
                            {{ $rejectedKycUsers->appends(request()->query())->links() }}
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

            let a = "Showing {{ $rejectedKycUsers->firstItem() }} to {{ $rejectedKycUsers->lastItem() }} of {{ $rejectedKycUsers->total() }} entries";

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





