@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Wallet Transaction Types</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Wallet Transaction Types</strong>
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
                        <h5>Create Wallet Transaction Type</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">

                                <form method="post" action="{{route('wallet.transaction.type.store')}}">
                                    @csrf
                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Transaction Type</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Choose transaction status..."
                                                    class="chosen-select" tabindex="2" name="transaction_type">
                                                <option value="" selected disabled>Transaction Type</option>
                                                @foreach($transactionTypes as $key=>$transactionType)
                                                    <option value="{{$key}}">{{$transactionType}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">User type</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="User type..."
                                                    class="chosen-select" tabindex="2" name="user_type">
                                                <option value="" selected disabled>User Type</option>
                                                @foreach($userTypes as $key=>$userType)
                                                    <option value="{{$key}}">{{$userType}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Vendor</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="vendor"
                                                   placeholder="Vendor">
                                        </div>
                                    </div>


                                    <div class="form-group  row">
                                        <label class="col-sm-2 col-form-label">Transaction Category</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Choose transaction category..."
                                                    class="chosen-select" tabindex="2" name="transaction_category">
                                                <option value="" selected disabled>Transaction Category</option>
                                                @if(!empty($_GET['transaction_category']))
                                                    <option value="PAYMENT"
                                                            @if($_GET['transaction_category']  == 'PAYMENT') selected @endif >
                                                        Payment
                                                    </option>
                                                    <option value="LOAD"
                                                            @if($_GET['transaction_category']  == 'LOAD') selected @endif >
                                                        Load
                                                    </option>
                                                    <option value="BANK_TRANSFER"
                                                            @if($_GET['transaction_category']  == 'BANK_TRANSFER') selected @endif >
                                                        Bank Transfer
                                                    </option>
                                                    <option value="FUND_TRANSFER"
                                                            @if($_GET['transaction_category']  == 'FUND_TRANSFER') selected @endif >
                                                        Fund Transfer
                                                    </option>
                                                    <option value="FUND_REQUEST"
                                                            @if($_GET['transaction_category']  == 'FUND_REQUEST') selected @endif >
                                                        Fund Request
                                                    </option>

                                                @else
                                                    <option value="PAYMENT">Payment</option>
                                                    <option value="LOAD">Load</option>
                                                    <option value="BANK_TRANSFER">Bank Transfer</option>
                                                    <option value="FUND_TRANSFER">Fund Transfer</option>
                                                    <option value="FUND_REQUEST">Fund Request</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Service
                                            type</label>
                                        <div class="col-lg-10 col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="service_type"
                                                   placeholder="Service type">
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Service</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm" name="service"
                                                   placeholder="Service">
                                        </div>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Service
                                            Enabled</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Service Enabled"
                                                    class="chosen-select" tabindex="2" name="service_enabled">
                                                <option value="" selected disabled>Service Enabled</option>
                                                @if(!empty($_GET['service_enabled']))
                                                    <option value="wallet_balance"
                                                            @if($_GET['service_enabled']  == 'Enabled') selected @endif >
                                                        Enabled
                                                    </option>
                                                    <option value="transaction_number"
                                                            @if($_GET['service_enabled'] == 'Disabled') selected @endif>
                                                        Disabled
                                                    </option>
                                                @else
                                                    <option value="Enabled">Enabled</option>
                                                    <option value="Disabled">Disabled</option>
                                                @endif
                                            </select></div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Validate
                                            balance</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Validate balance"
                                                    class="chosen-select" tabindex="2" name="validate_balance">
                                                <option value="" selected disabled>Validate balance</option>
                                                @if(!empty($_GET['validate_balance']))
                                                    <option value="True"
                                                            @if($_GET['validate_balance']  == 'True') selected @endif >
                                                        True
                                                    </option>
                                                    <option value="False"
                                                            @if($_GET['validate_balance'] == 'False') selected @endif>
                                                        False
                                                    </option>
                                                @else
                                                    <option value="True">True</option>
                                                    <option value="False">False</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Validate
                                            Kyc </label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Validate kyc"
                                                    class="chosen-select" tabindex="2" name="validate_kyc">
                                                <option value="" selected disabled>Validate Kyc</option>
                                                @if(!empty($_GET['validate_kyc']))
                                                    <option value="True"
                                                            @if($_GET['validate_kyc']  == 'True') selected @endif >
                                                        True
                                                    </option>
                                                    <option value="False"
                                                            @if($_GET['validate_kyc'] == 'False') selected @endif>
                                                        False
                                                    </option>
                                                @else
                                                    <option value="True">True</option>
                                                    <option value="False">False</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Validate
                                            limit</label>

                                        <div class="col-sm-10">
                                            <select data-placeholder="Validate limit"
                                                    class="chosen-select" tabindex="2" name="validate_limit">
                                                <option value="" selected disabled>Validate limit</option>
                                                @if(!empty($_GET['validate_limit']))
                                                    <option value="True"
                                                            @if($_GET['validate_limit']  == 'True') selected @endif >
                                                        True
                                                    </option>
                                                    <option value="False"
                                                            @if($_GET['validate_limit'] == 'False') selected @endif>
                                                        False
                                                    </option>
                                                @else
                                                    <option value="True">True</option>
                                                    <option value="False">False</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Limit
                                            type</label>
                                        <div class="col-sm-10">
                                            <select data-placeholder="Limit type"
                                                    class="chosen-select" tabindex="2" name="limit_type">
                                                <option value="" selected disabled>Limit Type</option>
                                                @if(!empty($_GET['limit_type']))
                                                    <option value="PAYMENT"
                                                            @if($_GET['limit_type']  == 'PAYMENT') selected @endif >
                                                        Payment
                                                    </option>
                                                    <option value="LOAD"
                                                            @if($_GET['limit_type']  == 'LOAD') selected @endif >
                                                        Load
                                                    </option>
                                                    <option value="BANK_TRANSFER"
                                                            @if($_GET['limit_type']  == 'BANK_TRANSFER') selected @endif >
                                                        Bank Transfer
                                                    </option>
                                                    <option value="TRANSFER"
                                                            @if($_GET['limit_type']  == 'TRANSFER') selected @endif >
                                                        Transfer
                                                    </option>

                                                @else
                                                    <option value="PAYMENT">Payment</option>
                                                    <option value="LOAD">Load</option>
                                                    <option value="BANK_TRANSFER">Bank Transfer</option>
                                                    <option value="TRANSFER">Transfer</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Micro
                                            service</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm"
                                                   placeholder="MicroService" name="microservice">
                                        </div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Payment
                                            type</label>

                                        <div class="col-sm-10">
                                            <select data-placeholder="Payment Type"
                                                    class="chosen-select" tabindex="2" name="payment_type">
                                                <option value="" selected disabled>Payment type</option>
                                                @if(!empty($_GET['payment_type']))
                                                    <option value="debit"
                                                            @if($_GET['payment_type']  == 'debit') selected @endif >
                                                        Debit
                                                    </option>
                                                    <option value="credit"
                                                            @if($_GET['payment_type'] == 'credit') selected @endif>
                                                        Credit
                                                    </option>
                                                @else
                                                    <option value="debit">Debit</option>
                                                    <option value="credit">Credit</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Special1</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm"
                                                   placeholder="special1" name="special1">
                                        </div>
                                    </div>

                                    <div class="form-group  row"><label class="col-sm-2 col-form-label">Special2</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control form-control-sm"
                                                   placeholder="special2" name="special2">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>


                                    <div class="form-group row">
                                        <div class="col-sm-4 col-sm-offset-2">
                                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

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


@endsection
