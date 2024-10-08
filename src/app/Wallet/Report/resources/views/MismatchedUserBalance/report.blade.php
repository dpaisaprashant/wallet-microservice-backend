@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Mismatched User Balance Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Mismatched User Balance</strong>
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
                                            <div class="form-group">
                                                <input type="text" name="user_name"
                                                       placeholder="User Name" class="form-control"
                                                       value="{{ !empty($_GET['user_name']) ? $_GET['user_name'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" name="mobile_no"
                                                       placeholder="Mobile Number" class="form-control"
                                                       value="{{ !empty($_GET['mobile_no']) ? $_GET['mobile_no'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{route('report.mismatchedUserBalance')}}"><strong>Generate Mismatch Report</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
{{--                                     <div>--}}
{{--                                         <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>--}}
{{--                                     </div>--}}
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
                            <h5>Mismatched User Balance</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" title="Mismatched User Balances">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>User Name</th>
                                        <th>Mobile Number</th>
                                        <th>Balance In Wallet</th>
                                        <th>Balance In Latest Transaction</th>
                                        <th>Bonus Balance In Wallet</th>
                                        <th>Bonus Balance In Latest Transaction</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $user)
                                            <tr class="gradeX">
                                                <td>{{ $loop->index +  1 }}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->mobile_no}}</td>
                                                <td>{{$user->wallet->balance}}</td>
                                                <td>@if($user->latestUserTransactionEvent){{$user->latestUserTransactionEvent->balance}}@else 0 @endif</td>
                                                <td>{{$user->wallet->bonus_balance}}</td>
                                                <td>@if($user->latestUserTransactionEvent){{$user->latestUserTransactionEvent->bonus_balance}}@else 0 @endif</td>
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


    @include('admin.asset.css.datepicker')

    @include('admin.asset.css.chosen')

    @include('admin.asset.css.datatable')

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

@endsection





