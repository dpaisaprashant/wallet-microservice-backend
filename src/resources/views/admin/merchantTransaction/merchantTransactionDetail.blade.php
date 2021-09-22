@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Merchant Transaction Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    Merchant Transaction
                </li>
                <li class="breadcrumb-item active">
                    <strong>Detail</strong>
                </li>
            </ol>
        </div>
        {{--<div class="col-lg-4">
            <div class="title-action">
                <a href="invoice_print.html" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Transaction Detail </a>
            </div>
        </div>--}}
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox-content p-xl">
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Merchant:</h5>
                            <address>
                                <strong>{{ $transaction->merchant->name }}</strong><br>
                                Email: {{ $transaction->merchant->email }}<br>
                                Number: {{ $transaction->merchant->mobile_no }}<br>
                            </address>


                            <span>User:</span>
                            <address>
                                <strong>{{ $transaction->user->name }}</strong><br>
                                Email: {{ $transaction->user->email }}<br>
                                Number: {{ $transaction->user->mobile_no }}<br>
                            </address>

                            <address>
                                <strong>Amount: Rs. {{ $transaction->amount }}<br></strong>
                                <strong>Commission: Rs. {{ optional($transaction->commission)['before_amount'] - optional($transaction->commission)['after_amount'] }}<br></strong>
                            </address>

                        </div>

                        <div class="col-sm-6 text-right">
                            <h4>Transaction Id:</h4>
                            <h4 class="text-navy">#{{ $transaction->transactions->pre_transaction_id ?? "---" }}</h4>

                            <h4>Discount: {{$transaction->discount ?? "No Discount"}}</h4>
                            <h4>CashBack: {{$transaction->cashback ?? "No Cashback"}}</h4>

                            <p style="margin-top: 20px;">
                                <?php
                                $date = explode(' ', $transaction->created_at);
                                ?>
                                <span><strong>Transaction Date:</strong> {{ date('d M, Y', strtotime($date[0]))}}</span><br/>
                                <span><strong>Time:</strong> {{ date('h:i a', strtotime($date[1]))}}</span><br><br>

                            </p>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
@endsection
