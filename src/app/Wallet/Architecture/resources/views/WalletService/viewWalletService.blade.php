@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Service</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View Wallet Service</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">


        {{--        <div class="row">--}}
        {{--            <div class="col-lg-12">--}}
        {{--                <div class="ibox">--}}
        {{--                    <div class="ibox-title collapse-link">--}}
        {{--                        <h5>Filter Transaction Type</h5>--}}
        {{--                        <div class="ibox-tools">--}}
        {{--                            <a class="collapse-link">--}}
        {{--                                <i class="fa fa-chevron-up"></i>--}}
        {{--                            </a>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="ibox-content"--}}
        {{--                         @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>--}}
        {{--                        <div class="row">--}}
        {{--                            <div class="col-sm-12">--}}
        {{--                                <form role="form" method="get">--}}

        {{--                                    <div class="row">--}}
        {{--                                        <div class="col-md-3">--}}
        {{--                                            <div class="form-group">--}}
        {{--                                                <select data-placeholder="Choose transaction status..."--}}
        {{--                                                        class="chosen-select" tabindex="2" name="sort">--}}
        {{--                                                    <option value="" selected disabled>Sort By...</option>--}}
        {{--                                                    @if(!empty($_GET['sort']))--}}
        {{--                                                        <option value="wallet_balance"--}}
        {{--                                                                @if($_GET['sort']  == 'wallet_balance') selected @endif >--}}
        {{--                                                            Wallet Balance--}}
        {{--                                                        </option>--}}
        {{--                                                        <option value="transaction_number"--}}
        {{--                                                                @if($_GET['sort'] == 'transaction_number') selected @endif>--}}
        {{--                                                            Transaction Number--}}
        {{--                                                        </option>--}}
        {{--                                                        <option value="transaction_payment"--}}
        {{--                                                                @if($_GET['sort'] == 'transaction_payment') selected @endif>--}}
        {{--                                                            Transaction Payment--}}
        {{--                                                        </option>--}}
        {{--                                                        <option value="transaction_loaded"--}}
        {{--                                                                @if($_GET['sort'] == 'transaction_loaded') selected @endif>--}}
        {{--                                                            Transaction Loaded--}}
        {{--                                                        </option>--}}
        {{--                                                    @else--}}
        {{--                                                        <option value="wallet_balance">Wallet Balance</option>--}}
        {{--                                                        <option value="transaction_number">Transaction Number</option>--}}
        {{--                                                        <option value="transaction_payment">Transaction Payment</option>--}}
        {{--                                                        <option value="transaction_loaded">Transaction Loaded</option>--}}
        {{--                                                    @endif--}}
        {{--                                                </select>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                    <div class="col-md-3">--}}
        {{--                                        <div class="form-group">--}}
        {{--                                            <input type="text" name="number" placeholder="Enter Contact Number"--}}
        {{--                                                   class="form-control"--}}
        {{--                                                   value="{{ !empty($_GET['number']) ? $_GET['number'] : '' }}">--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}


        {{--                                    <div class="col-md-3">--}}
        {{--                                        <input type="email" name="email" placeholder="Enter Email"--}}
        {{--                                               class="form-control"--}}
        {{--                                               value="{{ !empty($_GET['email']) ? $_GET['email'] : '' }}">--}}
        {{--                                    </div>--}}

        {{--                                    <div class="col-md-3">--}}
        {{--                                        <div class="form-group">--}}
        {{--                                            <select data-placeholder="Choose transaction status..."--}}
        {{--                                                    class="chosen-select" tabindex="2" name="sort">--}}
        {{--                                                <option value="" selected disabled>Sort By...</option>--}}
        {{--                                                @if(!empty($_GET['sort']))--}}
        {{--                                                    <option value="wallet_balance"--}}
        {{--                                                            @if($_GET['sort']  == 'wallet_balance') selected @endif >--}}
        {{--                                                        Wallet Balance--}}
        {{--                                                    </option>--}}
        {{--                                                    <option value="transaction_number"--}}
        {{--                                                            @if($_GET['sort'] == 'transaction_number') selected @endif>--}}
        {{--                                                        Transaction Number--}}
        {{--                                                    </option>--}}
        {{--                                                    <option value="transaction_payment"--}}
        {{--                                                            @if($_GET['sort'] == 'transaction_payment') selected @endif>--}}
        {{--                                                        Transaction Payment--}}
        {{--                                                    </option>--}}
        {{--                                                    <option value="transaction_loaded"--}}
        {{--                                                            @if($_GET['sort'] == 'transaction_loaded') selected @endif>--}}
        {{--                                                        Transaction Loaded--}}
        {{--                                                    </option>--}}
        {{--                                                @else--}}
        {{--                                                    <option value="wallet_balance">Wallet Balance</option>--}}
        {{--                                                    <option value="transaction_number">Transaction Number</option>--}}
        {{--                                                    <option value="transaction_payment">Transaction Payment</option>--}}
        {{--                                                    <option value="transaction_loaded">Transaction Loaded</option>--}}
        {{--                                                @endif--}}
        {{--                                            </select>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                            </div>--}}
        {{--                            <br>--}}
        {{--                            <div>--}}
        {{--                                --}}{{--                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"--}}
        {{--                                --}}{{--                                                formaction="{{ route('architecture.vendor.transaction', $vendorName) }}">--}}
        {{--                                <strong>Filter</strong></button>--}}
        {{--                            </div>--}}

        {{--                            <div>--}}
        {{--                            </div>--}}
        {{--                            @include('admin.asset.components.clearFilterButton')--}}
        {{--                            </form>--}}
        {{--                        </div>--}}

        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                @include('admin.asset.notification.notify')
                <div class="ibox-title">
                    <h5>List of wallet service</h5>
                    @can('Add wallet transaction type')
                        <a href="{{route('wallet.transaction.type.create')}}"
                           class="btn btn-primary btn-sm float-right">Add
                            Wallet Service</a>
                    @endcan
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example"
                               title="Dpasis user's list">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Transaction type</th>
                                <th>User type</th>
                                <th>Vendor</th>
                                <th>Transaction category</th>
                                <th>Service type</th>
                                <th>Service</th>
                                <th>Service enabled</th>
                                <th>Validate balance</th>
                                <th>Validate kyc</th>
                                <th>Validate limit</th>
                                <th>Limit type</th>
                                <th>Micro service</th>
                                <th>Payment type</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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


@endsection

