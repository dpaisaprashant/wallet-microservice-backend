@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet End Balance Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Wallet End Balance</strong>
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
                                        <div class="col-md-12">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input type="datetime-local" class="form-control date_till" placeholder="date_till" name="date_till" autocomplete="off" value="{{ !empty($_GET['date_till']) ? $_GET['date_till'] : '' }}">
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('wallet.endbalance') }}"><strong>Generate Report</strong></button>
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
                @if(!empty($_GET['date_till']))
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Wallet end report balance till {{ $_GET['date_till'] }}</h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b>
                                {{$totalCount}}
                            </h5>
                            <h5><b>Wallet End Balance:</b> Rs.
                             {{ $totalSum->sum('balance') / 100}}
                            </h5>
                            <h5><b>Wallet End Bonus Balance:</b> Rs.
                                {{ $totalSum->sum('bonus_balance') / 100}}
                            </h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" title="Wallet end balance report">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Account</th>
                                        <th>Description</th>
                                        <th>Vendor</th>
                                        <th>Service Type</th>
                                        <th>User Id</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Phone</th>
                                        <th>Date</th>
                                        <th>Balance</th>
                                        <th>Bonus Balance</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $data)
                                            <tr>
                                                <td>{{$loop->index+1}}</td>
                                                <td>{{$data->account}}</td>
                                                <td>
                                                    @if($data->description == null)
                                                        <span class="badge badge-danger">Empty</span>
                                                        @else
                                                        {{$data->description}}
                                                    @endif
                                                </td>
                                                <td>{{$data->vendor}}</td>
                                                <td>{{$data->service_type}}</td>
                                                <td>{{$data->user_id}}</td>
                                                <td>{{$data->pre_transaction_id}}</td>
                                                <td>{{$data->number}}</td>
                                                <td>{{$data->created_at}}</td>
                                                <td>{{$data->balance}}</td>
                                                <td>{{$data->bonus_balance}}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                {{ $datas->appends(request()->query())->links() }}
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





