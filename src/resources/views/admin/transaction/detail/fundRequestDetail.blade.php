@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Fund Request Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    Fund Request
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
                            <h5>From:</h5>
                            <address>
                                <strong>{{ $transaction->fromUser['name'] }}</strong><br>
                                Email: {{ $transaction->fromUser['email'] }}<br>
                                Number: {{ $transaction->fromUser['mobile_no'] }}<br>
                            </address>


                            <span>To:</span>
                            <address>
                                <strong>{{ $transaction->toUser['name'] }}</strong><br>
                                Email: {{ $transaction->toUser['email'] }}<br>
                                Number: {{ $transaction->toUser['mobile_no'] }}<br>
                            </address>

                            <address>
                            <strong>Amount: Rs. {{ $transaction->amount }}<br></strong>
                            </address>

                        </div>

                        <div class="col-sm-6 text-right">
                            @foreach($transaction->transactions as $key=>$value)
                                @if($transaction->transactions[$key]->vendor == "Transfer Funds")
                                    <h4>From User Transaction ID:</h4>
                                    <h4 class="text-navy">#{{ $transaction->transactions[$key]->pre_transaction_id }}</h4>
                                @else
                                    <h4>To User Transaction ID:</h4>
                                    <h4 class="text-navy">#{{ $transaction->transactions[$key]->pre_transaction_id }}</h4>
                                @endif
                            @endforeach

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
