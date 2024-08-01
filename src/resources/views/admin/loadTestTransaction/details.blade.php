@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Test Load Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    Test Load
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
                            <h5>User: <strong>{{$transaction->user->mobile_no}}</strong></h5>
                            <h5>Before Test Load :</h5>
                            <address>
                                Before Amount: {{ $transaction->before_amount }}<br>
                                Before Bonus Balance: {{ $transaction->before_bonus_balance }}<br>
                            </address>


                            <span>After Test Load:</span>
                            <address>
                                After Amount: {{ $transaction->after_amount }}<br>
                                After Bonus Balance: {{ $transaction->after_bonus_balance }}<br>
                            </address>

                            <address>
                                <strong>Description: </strong> <br>
                                {{ $transaction->description }}<br>
                            </address>

                        </div>

                        <div class="col-sm-6 text-right">
                            <h4>Transaction Id:</h4>
                            <h4 class="text-navy">#{{ $transaction->pre_transaction_id }}</h4>

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
