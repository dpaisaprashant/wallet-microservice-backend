@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Register Using Referral User Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong> Register Using Referral User Report</strong>
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
                        <h5>Select Date</h5>
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
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('referral.registerUsingReferralUserReport') }}"><strong>Generate Report</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                    {{-- <div>
                                         <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>
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

                @if(!empty($_GET['referred_from']) || (!empty($_GET['from']) && !empty($_GET['to'])))

                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Registered Using Referral report from {{ $_GET['from'] . ' to ' . $_GET['to'] }}</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" title="{{ "registered_using_referral_report_" . $_GET['from'] . '_to_' . $_GET['to']  }}">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Referred From</th>
                                        <th>Referred From Earnings</th>
                                        <th>User Name</th>
                                        <th>Mobile No.</th>
                                        <th>KYC Status</th>
                                        <th>Transaction Count</th>
                                        <th>Total Balance</th>
                                        <th>Total Referral Amount</th>
                                        <th>Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $totalTransaction = 0; $totalAmount = 0; $totalReferralAmount = 0;?>
                                    @foreach($registerUsingReferralUsers as $user)
                                        <tr class="gradeX">
                                            <td>{{ $loop->index + ($registerUsingReferralUsers->perPage() * ($registerUsingReferralUsers->currentPage() - 1)) + 1 }}</td>
                                            <td>{{ optional($user->referredByUser())->name }}</td>
                                            <td>
                                                @if(optional($user->registerReferral())->status == 'COMPLETE')
                                                    Rs. {{ optional($user->registerReferral())->referred_from_amount }}
                                                @else
                                                    Rs. 0
                                                @endif
                                            </td>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                @if(!empty($user->phone_verified_at))
                                                    <i class="fa fa-check-circle" style="color: green;"></i> &nbsp;{{ $user->mobile_no }}
                                                @else
                                                    <i class="fa fa-times-circle" style="color: red;"></i>&nbsp;{{ $user->mobile_no }}
                                                @endif
                                            </td>

                                            <td>
                                                @include('admin.user.kyc.status', ['kyc' => $user->kyc])
                                            </td>

                                            <td>
                                                {{ $user->totalTransactionCount() }}
                                            </td>
                                            <td>
                                                Rs. {{ $user->wallet->balance / 100 }}
                                            </td>
                                            <td>
                                                Rs. {{ $user->totalReferralAmount() }}
                                            </td>
                                            <td>
                                                {{ $user->created_at }}
                                            </td>
                                            <?php
                                            $totalTransaction = $totalTransaction + $user->totalTransactionCount();
                                            $totalAmount = $totalAmount +  $user->wallet->balance;
                                            $totalReferralAmount = $totalReferralAmount + $user->totalReferralAmount();
                                            ?>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>Total Transaction Count</b></td>
                                        <td>{{ $totalTransaction }}</td>
                                        <td>Rs. {{ $totalAmount / 100 }}</td>
                                        <td>Rs. {{ $totalReferralAmount }}</td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                {{ $registerUsingReferralUsers->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('styles')


    @include('admin.asset.css.datepicker')

    @include('admin.asset.css.chosen')

    @include('admin.asset.css.datatable')

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

@endsection





