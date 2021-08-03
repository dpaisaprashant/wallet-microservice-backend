@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Check Payment Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Check payment detail</strong>
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
                        {{--<div class="col-md-12">
                            <header class="example-header">
                                <h1 class="text-center">Transaction Detail</h1>
                            </header>
                        </div>--}}

                        <div class="col-sm-6" style="margin-top: 30px;">
                            <h5>From User: </h5>
                            <address>
                                <strong></strong><br>
                                Wallet id : {{ $bfiToUserFundTransfer->wallet_id }}<br>
                                Email: <br>
                                Contact
                                Number: <br>
                                From Pre Transaction Id :

                                Amount : <br>
                                From User: <br>
                                To User: <br>
                                To User Name : <br>
                                To User Email :
                            </address>

                            {{--                            @isset($transaction->userTransaction)--}}
                            {{--                                <address>--}}
                            {{--                                    <strong>Amount: Rs. {{ $transaction->userTransaction->amount }}<br></strong>--}}
                            {{--                                    @if(!empty($transaction->userTransaction->commission))--}}
                            {{--                                        <strong>Commission: Rs. {{ ($transaction->userTransaction->commission['before_amount'] - $transaction->userTransaction->commission['after_amount']) }}<br></strong>--}}
                            {{--                                    @else--}}
                            {{--                                        <strong>Commission: Rs. 0 </strong>--}}
                            {{--                                    @endif--}}

                            {{--                                </address>--}}
                            {{--                            @endisset--}}
                        </div>

                        <div class="col-sm-6 text-right" style="margin-top: 20px;">
                            <h4>Process Id</h4>
                            <h4 class="text-navy">{{ $bfiToUserFundTransfer->process_id }}</h4>

                            <p style="margin-top: 20px;">
                                <?php
                                $checkPaymentDate = explode(' ', optional($bfiToUserFundTransfer->bfiCheckPayment)->created_at);
                                $bfiToUserFundTransferDate = explode(' ', $bfiToUserFundTransfer->created_at);
                                ?>
                                <span><strong>Check Payment Date : </strong> </span><br/>
                                <span><strong>BFI to User fund Transfer Date</strong> : {{ date('d M Y',strtotime($bfiToUserFundTransferDate[0])) }} </span>

                            </p>
                        </div>
                    </div>

                    <hr>


               {{--     <?php

                    $step1 = false;
                    if (optional($userToBfiFundTransferCheckPaymentDetails->bfiCheckPayment)->status == "SUCCESS") {
                        $step1 = true;
                    }else{
                        $step1 = false;
                    }

                    $step2 = false;

                    if($userToBfiFundTransferCheckPaymentDetails->status == "SUCCESS"){
                        $step2 = true;
                    }else{
                        $step2 = false;
                    }

                    $step3 = false;
                    if($userToBfiFundTransferCheckPaymentDetails->status == "SUCCESS" && $userToBfiFundTransferCheckPaymentDetails->bfiCheckPayment->status == "SUCCESS"){
                        $step3 = true;
                    }else{
                        $step3 = false;
                    }
                    ?>--}}


                    <div class="row">
                        <div class="col-md-12">
                            <div class="container-fluid">
                                <div class="row example-basic">
                                    <div class="col-md-12 example-title">
                                        <h2>Check Payment Steps</h2>
                                        <p>Steps involved for the User to bfi fund transfer to complete</p>
                                    </div>
                                    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
                                        <ul class="timeline">
                                            <li class="timeline-item period">
                                                <div class="timeline-content">
                                                    <h2 class="timeline-title">STEP 1</h2>
                                                </div>
                                            </li>
                                            <li class="timeline-item">
                                                <div class="timeline-marker step1"></div>
                                                <div class="timeline-content">
                                                    <h2 class="timeline-title">Check Payment</h2>
                                                    <p>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <address>
                                                                <strong>Transaction
                                                                    ID:</strong>
                                                                <br>
                                                                <strong>Bfi
                                                                    Id:</strong>
                                                                <br>
                                                                <strong>Wallet
                                                                    Id:</strong>
                                                                <br>
                                                                <strong>Status:</strong>

                                                                <br>
                                                                <br>
                                                                <strong>Request from bfi</strong><br>
                                                               {{-- <?php $request_from_bfi = json_decode($userToBfiFundTransferCheckPaymentDetails->bfiCheckPayment->request_from_bfi, true)?>
                                                                @if(! is_array($request_from_bfi))
                                                                    <?php $request_from_bfi = json_decode($request_from_bfi) ?>
                                                                @endif
                                                                @if($request_from_bfi != null)
                                                                    <?php foreach ($request_from_bfi as $key => $value) { ?>

                                                                    {{ $key }} :
                                                                    @if($key == 'amount' )
                                                                        Rs. {{ empty($value) ? 0 : $value / 100 }}<br>
                                                                    @else
                                                                        {{ $value }}<br>
                                                                    @endif

                                                                    <?php }?>
                                                                @endif--}}
                                                                <br><br>
                                                                <strong>Response to bfi</strong><br>
                                                               {{-- <?php $response_to_bfi = json_decode($userToBfiFundTransferCheckPaymentDetails->bfiCheckPayment->response_to_bfi, true)?>
                                                                @if(! is_array($response_to_bfi))
                                                                    <?php $response_to_bfi = json_decode($response_to_bfi) ?>
                                                                @endif
                                                                @if($response_to_bfi != null)
                                                                    <?php foreach ($response_to_bfi as $key => $value) { ?>

                                                                    {{ $key }} :
                                                                    @if($key == 'amount' )
                                                                        Rs. {{ empty($value) ? 0 : $value / 100 }}<br>
                                                                    @else
                                                                        @if(!is_array($value))
                                                                            {{ $value }}<br>
                                                                        @else
                                                                            @foreach($value as $key=>$newValue)
                                                                                {{ $key }} :
                                                                                {{ $newValue }}<br>
                                                                            @endforeach
                                                                        @endif
                                                                    @endif

                                                                    <?php }?>
                                                                @endif--}}
                                                                <br><br>
                                                                <strong>Request to wallet</strong><br>
                                                              {{--  <?php $request_to_wallet = json_decode($userToBfiFundTransferCheckPaymentDetails->bfiCheckPayment->request_to_wallet, true)?>
                                                                @if(! is_array($request_to_wallet))
                                                                    <?php $request_to_wallet = json_decode($request_to_wallet) ?>
                                                                @endif
                                                                @if($request_to_wallet != null)
                                                                    <?php foreach ($request_to_wallet as $key => $value) { ?>

                                                                    {{ $key }} :
                                                                    @if($key == 'amount' )
                                                                        Rs. {{ empty($value) ? 0 : $value / 100 }}<br>
                                                                    @else
                                                                        @if(!is_array($value))
                                                                            {{ $value }}<br>
                                                                        @else
                                                                            @foreach($value as $key=>$newValue)
                                                                                {{ $key }} :
                                                                                {{ $newValue }}<br>
                                                                            @endforeach
                                                                        @endif
                                                                    @endif

                                                                    <?php }?>
                                                                @endif--}}

                                                                <br><br>
                                                                <strong>Response from wallet</strong><br>
                                                              {{--  <?php $response_from_wallet = json_decode($userToBfiFundTransferCheckPaymentDetails->bfiCheckPayment->response_from_wallet, true)?>
                                                                @if(! is_array($response_from_wallet))
                                                                    <?php $response_from_wallet = json_decode($response_from_wallet) ?>
                                                                @endif
                                                                @if($response_from_wallet != null)
                                                                    <?php foreach ($response_from_wallet as $key => $value) { ?>

                                                                    {{ $key }} :
                                                                    @if($key == 'amount' )
                                                                        Rs. {{ empty($value) ? 0 : $value / 100 }}<br>
                                                                    @else
                                                                        @if(!is_array($value))
                                                                            {{ $value }}<br>
                                                                        @else
                                                                            @foreach($value as $key=>$newValue)
                                                                                {{ $key }} :
                                                                                @if(!is_array($newValue))
                                                                                    {{ $newValue }}<br>
                                                                                @endif
                                                                            @endforeach
                                                                        @endif
                                                                    @endif

                                                                    <?php }?>
                                                                @endif
--}}

                                                            </address>
                                                        </div>
                                                        {{--                                                        <div class="col-md-6">--}}
                                                        {{--                                                            <strong>Response</strong><br>--}}
                                                        {{--                                                            --}}{{--                                                            <?php $response =  json_decode($transaction->response, true)?>--}}
                                                        {{--                                                            --}}{{--                                                            @if(! is_array($response))--}}
                                                        {{--                                                            --}}{{--                                                                <?php $response =  json_decode($response) ?>--}}
                                                        {{--                                                            --}}{{--                                                            @endif--}}
                                                        {{--                                                            --}}{{--                                                            @if($response != null)--}}
                                                        {{--                                                            --}}{{--                                                                <?php foreach ($response as $key => $value) { ?>--}}

                                                        {{--                                                            --}}{{--                                                                {{ $key }} :--}}
                                                        {{--                                                            --}}{{--                                                                @if($key == 'amount' )--}}
                                                        {{--                                                            --}}{{--                                                                    Rs. {{ empty($value) ? 0 : $value / 100 }}<br>--}}
                                                        {{--                                                            --}}{{--                                                                @else--}}
                                                        {{--                                                            --}}{{--                                                                    @if(is_string($value))--}}
                                                        {{--                                                            --}}{{--                                                                        {{ $value }}<br>--}}
                                                        {{--                                                            --}}{{--                                                                    @else--}}
                                                        {{--                                                            --}}{{--                                                                        @if(is_array($value))--}}
                                                        {{--                                                            --}}{{--                                                                            @foreach($value as $key1 => $value1)--}}
                                                        {{--                                                            --}}{{--                                                                                @if(is_string($value1))--}}
                                                        {{--                                                            --}}{{--                                                                                    {{ $key1 }} : {{ $value1 }} <br>--}}
                                                        {{--                                                            --}}{{--                                                                                @else--}}
                                                        {{--                                                            --}}{{--                                                                                    @foreach($value1 as $key2 => $value2)--}}
                                                        {{--                                                            --}}{{--                                                                                        @if(is_string($value2))--}}
                                                        {{--                                                            --}}{{--                                                                                            {{ $key2 }} : {{ $value2 }} <br>--}}
                                                        {{--                                                            --}}{{--                                                                                        @else--}}
                                                        {{--                                                            --}}{{--                                                                                            --}}{{----}}{{--@foreach($value2 as $key3 => $value3)--}}
                                                        {{--                                                            --}}{{--                                                                                                {{ $key3 }} : {{ $value3 }} <br>--}}
                                                        {{--                                                            --}}{{--                                                                                            @endforeach--}}
                                                        {{--                                                            --}}{{--                                                                                        @endif--}}
                                                        {{--                                                            --}}{{--                                                                                    @endforeach--}}
                                                        {{--                                                            --}}{{--                                                                                @endif--}}
                                                        {{--                                                            --}}{{--                                                                            @endforeach--}}
                                                        {{--                                                            --}}{{--                                                                        @else--}}
                                                        {{--                                                            --}}{{--                                                                            {{ $key }}: <?php print_r($value) ?>--}}
                                                        {{--                                                            --}}{{--                                                                        @endif--}}
                                                        {{--                                                            --}}{{--                                                                    @endif--}}
                                                        {{--                                                            --}}{{--                                                                @endif--}}

                                                        {{--                                                            --}}{{--                                                                <?php }?>--}}
                                                        {{--                                                            --}}{{--                                                            @endif--}}
                                                        {{--                                                        </div>--}}
                                                    </div>


                                                    </p>
                                                </div>
                                            </li>

                                            <li class="timeline-item period">
                                                <div class="timeline-content">
                                                    <h2 class="timeline-title">STEP 2</h2>
                                                </div>
                                            </li>
                                            <li class="timeline-item">
                                                <div class="timeline-marker step2"></div>
                                                <div class="timeline-content">
                                                    <h2 class="timeline-title">User to bfi fund transfer</h2>
                                                    <p>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <address>
                                                                <strong>Transaction
                                                                    ID:</strong>
                                                                <br>
                                                                <strong>Bfi
                                                                    Id:</strong>
                                                                <br>
                                                                <strong>Wallet
                                                                    Id:</strong>
                                                                <br>
                                                                <strong>Status:</strong>
                                                                {{--@if($userToBfiFundTransferCheckPaymentDetails->status == "SUCCESS")
                                                                    <span class="badge badge-primary">Success</span><br>
                                                                @elseif($userToBfiFundTransferCheckPaymentDetails->status == "PROCESSING")
                                                                    <span class="badge badge-success">Processing</span>
                                                                    <br>
                                                                @endif
                                                                @if(isset($userToBfiFundTransferCheckPaymentDetails->purpose) == true)
                                                                    <strong>Purpose
                                                                        : </strong>{{ $userToBfiFundTransferCheckPaymentDetails->purpose }}
                                                                    <br>
                                                                @endif
                                                                @if(isset($userToBfiFundTransferCheckPaymentDetails->transaction_detail) == true)
                                                                    <strong>Transaction Detail
                                                                        : </strong>{{ $userToBfiFundTransferCheckPaymentDetails->transaction_detail }}
                                                                    <br>
                                                                @endif--}}
                                                                <br>
                                                                <br>
                                                                <strong>Request from bfi</strong><br>
{{--                                                                <?php $request_from_bfi = json_decode($userToBfiFundTransferCheckPaymentDetails->request_from_bfi, true)?>--}}
{{--                                                                @if(! is_array($request_from_bfi))--}}
{{--                                                                    <?php $request_from_bfi = json_decode($request_from_bfi) ?>--}}
{{--                                                                @endif--}}
{{--                                                                @if($request_from_bfi != null)--}}
{{--                                                                    <?php foreach ($request_from_bfi as $key => $value) { ?>--}}

{{--                                                                    {{ $key }} :--}}
{{--                                                                    @if($key == 'amount' )--}}
{{--                                                                        Rs. {{ empty($value) ? 0 : $value / 100 }}<br>--}}
{{--                                                                    @else--}}
{{--                                                                        {{ $value }}<br>--}}
{{--                                                                    @endif--}}

{{--                                                                    <?php }?>--}}
{{--                                                                @endif--}}
                                                                <br><br>
                                                                <strong>Response to bfi</strong><br>
{{--                                                                <?php $response_to_bfi = json_decode($userToBfiFundTransferCheckPaymentDetails->response_to_bfi, true)?>--}}
{{--                                                                @if(! is_array($response_to_bfi))--}}
{{--                                                                    <?php $response_to_bfi = json_decode($response_to_bfi) ?>--}}
{{--                                                                @endif--}}
{{--                                                                @if($response_to_bfi != null)--}}
{{--                                                                    <?php foreach ($response_to_bfi as $key => $value) { ?>--}}

{{--                                                                    {{ $key }} :--}}
{{--                                                                    @if($key == 'amount' )--}}
{{--                                                                        Rs. {{ empty($value) ? 0 : $value / 100 }}<br>--}}
{{--                                                                    @else--}}
{{--                                                                        @if(!is_array($value))--}}
{{--                                                                            {{ $value }}<br>--}}
{{--                                                                        @else--}}
{{--                                                                            @foreach($value as $key=>$newValue)--}}
{{--                                                                                {{ $key }} :--}}
{{--                                                                                {{ $newValue }}<br>--}}
{{--                                                                            @endforeach--}}
{{--                                                                        @endif--}}
{{--                                                                    @endif--}}

{{--                                                                    <?php }?>--}}
{{--                                                                @endif--}}
                                                                <br><br>
                                                                <strong>Request to wallet</strong><br>
{{--                                                                <?php $request_to_wallet = json_decode($userToBfiFundTransferCheckPaymentDetails->request_to_wallet, true)?>--}}
{{--                                                                @if(! is_array($request_to_wallet))--}}
{{--                                                                    <?php $request_to_wallet = json_decode($request_to_wallet) ?>--}}
{{--                                                                @endif--}}
{{--                                                                @if($request_to_wallet != null)--}}
{{--                                                                    <?php foreach ($request_to_wallet as $key => $value) { ?>--}}

{{--                                                                    {{ $key }} :--}}
{{--                                                                    @if($key == 'amount' )--}}
{{--                                                                        Rs. {{ empty($value) ? 0 : $value / 100 }}<br>--}}
{{--                                                                    @else--}}
{{--                                                                        @if(!is_array($value))--}}
{{--                                                                            {{ $value }}<br>--}}
{{--                                                                        @else--}}
{{--                                                                            @foreach($value as $key=>$newValue)--}}
{{--                                                                                {{ $key }} :--}}
{{--                                                                                {{ $newValue }}<br>--}}
{{--                                                                            @endforeach--}}
{{--                                                                        @endif--}}
{{--                                                                    @endif--}}

{{--                                                                    <?php }?>--}}
{{--                                                                @endif--}}

                                                                <br><br>
                                                                <strong>Response from wallet</strong><br>
{{--                                                                <?php $response_from_wallet = json_decode($userToBfiFundTransferCheckPaymentDetails->response_from_wallet, true)?>--}}
{{--                                                                @if(! is_array($response_from_wallet))--}}
{{--                                                                    <?php $response_from_wallet = json_decode($response_from_wallet) ?>--}}
{{--                                                                @endif--}}
{{--                                                                @if($response_from_wallet != null)--}}
{{--                                                                    <?php foreach ($response_from_wallet as $key => $value) { ?>--}}

{{--                                                                    {{ $key }} :--}}
{{--                                                                    @if($key == 'amount' )--}}
{{--                                                                        Rs. {{ empty($value) ? 0 : $value / 100 }}<br>--}}
{{--                                                                    @else--}}
{{--                                                                        @if(!is_array($value))--}}
{{--                                                                            {{ $value }}<br>--}}
{{--                                                                        @else--}}
{{--                                                                            @foreach($value as $key=>$newValue)--}}
{{--                                                                                {{ $key }} :--}}
{{--                                                                                @if(!is_array($newValue))--}}
{{--                                                                                    {{ $newValue }}<br>--}}
{{--                                                                                @endif--}}
{{--                                                                            @endforeach--}}
{{--                                                                        @endif--}}
{{--                                                                    @endif--}}

{{--                                                                    <?php }?>--}}
{{--                                                                @endif--}}


                                                            </address>
                                                        </div>
                                                        {{--                                                        <div class="col-md-6">--}}
                                                        {{--                                                            <strong>Response</strong><br>--}}
                                                        {{--                                                            --}}{{--                                                            <?php $response =  json_decode($transaction->response, true)?>--}}
                                                        {{--                                                            --}}{{--                                                            @if(! is_array($response))--}}
                                                        {{--                                                            --}}{{--                                                                <?php $response =  json_decode($response) ?>--}}
                                                        {{--                                                            --}}{{--                                                            @endif--}}
                                                        {{--                                                            --}}{{--                                                            @if($response != null)--}}
                                                        {{--                                                            --}}{{--                                                                <?php foreach ($response as $key => $value) { ?>--}}

                                                        {{--                                                            --}}{{--                                                                {{ $key }} :--}}
                                                        {{--                                                            --}}{{--                                                                @if($key == 'amount' )--}}
                                                        {{--                                                            --}}{{--                                                                    Rs. {{ empty($value) ? 0 : $value / 100 }}<br>--}}
                                                        {{--                                                            --}}{{--                                                                @else--}}
                                                        {{--                                                            --}}{{--                                                                    @if(is_string($value))--}}
                                                        {{--                                                            --}}{{--                                                                        {{ $value }}<br>--}}
                                                        {{--                                                            --}}{{--                                                                    @else--}}
                                                        {{--                                                            --}}{{--                                                                        @if(is_array($value))--}}
                                                        {{--                                                            --}}{{--                                                                            @foreach($value as $key1 => $value1)--}}
                                                        {{--                                                            --}}{{--                                                                                @if(is_string($value1))--}}
                                                        {{--                                                            --}}{{--                                                                                    {{ $key1 }} : {{ $value1 }} <br>--}}
                                                        {{--                                                            --}}{{--                                                                                @else--}}
                                                        {{--                                                            --}}{{--                                                                                    @foreach($value1 as $key2 => $value2)--}}
                                                        {{--                                                            --}}{{--                                                                                        @if(is_string($value2))--}}
                                                        {{--                                                            --}}{{--                                                                                            {{ $key2 }} : {{ $value2 }} <br>--}}
                                                        {{--                                                            --}}{{--                                                                                        @else--}}
                                                        {{--                                                            --}}{{--                                                                                            --}}{{----}}{{--@foreach($value2 as $key3 => $value3)--}}
                                                        {{--                                                            --}}{{--                                                                                                {{ $key3 }} : {{ $value3 }} <br>--}}
                                                        {{--                                                            --}}{{--                                                                                            @endforeach--}}
                                                        {{--                                                            --}}{{--                                                                                        @endif--}}
                                                        {{--                                                            --}}{{--                                                                                    @endforeach--}}
                                                        {{--                                                            --}}{{--                                                                                @endif--}}
                                                        {{--                                                            --}}{{--                                                                            @endforeach--}}
                                                        {{--                                                            --}}{{--                                                                        @else--}}
                                                        {{--                                                            --}}{{--                                                                            {{ $key }}: <?php print_r($value) ?>--}}
                                                        {{--                                                            --}}{{--                                                                        @endif--}}
                                                        {{--                                                            --}}{{--                                                                    @endif--}}
                                                        {{--                                                            --}}{{--                                                                @endif--}}

                                                        {{--                                                            --}}{{--                                                                <?php }?>--}}
                                                        {{--                                                            --}}{{--                                                            @endif--}}
                                                        {{--                                                        </div>--}}
                                                    </div>


                                                    </p>
                                                </div>
                                            </li>


                                            {{--                                            @endforeach--}}

                                            {{--                                            @if(count($transaction->userExecutePayment) == 0)--}}


                                            <li class="timeline-item period">
                                                <div class="timeline-content">
                                                    <h2 class="timeline-title">STEP 3</h2>
                                                </div>
                                            </li>
                                            <li class="timeline-item">
                                                <div class="timeline-marker step3"></div>
                                                <div class="timeline-content">
                                                    <h2 class="timeline-title">User to bfi fund transfer</h2>
                                                    <p>
{{--                                                        @if($step3)--}}
{{--                                                            User to bfi fund transfer fund transfer Complete--}}
{{--                                                        @else--}}
{{--                                                            User to bfi fund transfer fund transfer not complete--}}
{{--                                                        @endif--}}
                                                    </p>
                                                </div>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('styles')

    <style>
        body {

            font-family: "Effra", Helvetica, sans-serif;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6 {
            color: #3D4351;
            margin-top: 0;
        }

        a {
            color: #FF6B6B;
        }


        .example-header {
            background: #3D4351;
            color: #FFF;
            font-weight: 300;
            padding: 3em 1em;
            text-align: center;
        }

        .example-header h1 {
            color: #FFF;
            font-weight: 300;
            margin-bottom: 20px;
        }

        .example-header p {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-weight: 700;
        }

        .container-fluid .row {
            padding: 0 0 4em 0;
        }

        .container-fluid .row:nth-child(even) {
            background: #F1F4F5;
        }

        .example-title {
            text-align: center;
        }

        .example-title p {
            margin: 0 auto;
            font-size: 16px;
            max-width: 400px;
        }

        /*==================================
            TIMELINE
        ==================================*/
        /*-- GENERAL STYLES
        ------------------------------*/
        .timeline {
            line-height: 1.4em;
            list-style: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .timeline h1, .timeline h2, .timeline h3, .timeline h4, .timeline h5, .timeline h6 {
            line-height: inherit;
        }

        /*----- TIMELINE ITEM -----*/
        .timeline-item {
            padding-left: 40px;
            position: relative;
        }

        .timeline-item:last-child {
            padding-bottom: 0;
        }

        /*----- TIMELINE INFO -----*/
        .timeline-info {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 3px;
            margin: 0 0 .5em 0;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /*----- TIMELINE MARKER -----*/
        .timeline-marker {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            width: 15px;
        }

        .timeline-marker:before {
            background: #FF6B6B;
            border: 3px solid transparent;
            border-radius: 100%;
            content: "";
            display: block;
            height: 15px;
            position: absolute;
            top: 4px;
            left: 0;
            width: 15px;
            transition: background 0.3s ease-in-out, border 0.3s ease-in-out;
        }

        .timeline-marker:after {
            content: "";
            width: 3px;
            background: #CCD5DB;
            display: block;
            position: absolute;
            top: 24px;
            bottom: 0;
            left: 6px;
        }

        .timeline-item:last-child .timeline-marker:after {
            content: none;
        }


        /*----- TIMELINE CONTENT -----*/
        .timeline-content {
            padding-bottom: 0px;
        }

        .timeline-content p:last-child {
            margin-bottom: 0;
        }

        /*----- TIMELINE PERIOD -----*/
        .period {
            padding: 0;
        }

        .period .timeline-info {
            display: none;
        }

        .period .timeline-marker:before {
            background: transparent;
            content: "";
            width: 15px;
            height: auto;
            border: none;
            border-radius: 0;
            top: 0;
            bottom: 30px;
            position: absolute;
            border-top: 3px solid #CCD5DB;
            border-bottom: 3px solid #CCD5DB;
        }

        .period .timeline-marker:after {
            content: "";
            height: 32px;
            top: auto;
        }

        .period .timeline-content {
            padding: 40px 0 30px;
        }

        .period .timeline-title {
            margin: 0;
        }

        /*----------------------------------------------
            MOD: TIMELINE SPLIT
        ----------------------------------------------*/
        @media (min-width: 768px) {
            .timeline-split .timeline, .timeline-centered .timeline {
                display: table;
            }

            .timeline-split .timeline-item, .timeline-centered .timeline-item {
                display: table-row;
                padding: 0;
            }

            .timeline-split .timeline-info, .timeline-centered .timeline-info,
            .timeline-split .timeline-marker,
            .timeline-centered .timeline-marker,
            .timeline-split .timeline-content,
            .timeline-centered .timeline-content,
            .timeline-split .period .timeline-info,
            .timeline-centered .period .timeline-info {
                display: table-cell;
                vertical-align: top;
            }

            .timeline-split .timeline-marker, .timeline-centered .timeline-marker {
                position: relative;
            }

            .timeline-split .timeline-content, .timeline-centered .timeline-content {
                padding-left: 30px;
            }

            .timeline-split .timeline-info, .timeline-centered .timeline-info {
                padding-right: 30px;
            }

            .timeline-split .period .timeline-title, .timeline-centered .period .timeline-title {
                position: relative;
                left: -45px;
            }
        }

        /*----------------------------------------------
            MOD: TIMELINE CENTERED
        ----------------------------------------------*/
        @media (min-width: 992px) {
            .timeline-centered,
            .timeline-centered .timeline-item,
            .timeline-centered .timeline-info,
            .timeline-centered .timeline-marker,
            .timeline-centered .timeline-content {
                display: block;
                margin: 0;
                padding: 0;
            }

            .timeline-centered .timeline-item {
                padding-bottom: 40px;
                overflow: hidden;
            }

            .timeline-centered .timeline-marker {
                position: absolute;
                left: 50%;
                margin-left: -7.5px;
            }

            .timeline-centered .timeline-info,
            .timeline-centered .timeline-content {
                width: 50%;
            }

            .timeline-centered > .timeline-item:nth-child(odd) .timeline-info {
                float: left;
                text-align: right;
                padding-right: 30px;
            }

            .timeline-centered > .timeline-item:nth-child(odd) .timeline-content {
                float: right;
                text-align: left;
                padding-left: 30px;
            }

            .timeline-centered > .timeline-item:nth-child(even) .timeline-info {
                float: right;
                text-align: left;
                padding-left: 30px;
            }

            .timeline-centered > .timeline-item:nth-child(even) .timeline-content {
                float: left;
                text-align: right;
                padding-right: 30px;
            }

            .timeline-centered > .timeline-item.period .timeline-content {
                float: none;
                padding: 0;
                width: 100%;
                text-align: center;
            }

            .timeline-centered .timeline-item.period {
                padding: 50px 0 90px;
            }

            .timeline-centered .period .timeline-marker:after {
                height: 30px;
                bottom: 0;
                top: auto;
            }

            .timeline-centered .period .timeline-title {
                left: auto;
            }
        }

        /*----------------------------------------------
            MOD: MARKER OUTLINE
        ----------------------------------------------*/
        .marker-outline .timeline-marker:before {
            background: transparent;
            border-color: #FF6B6B;
        }

        .marker-outline .timeline-item:hover .timeline-marker:before {
            background: #FF6B6B;
        }

    </style>

    <style>

        .timeline-content p {
            font-size: 14px;
        }

        .timeline-marker::before {
            background: red;
        }

        .timeline-marker::after {
            background: red;
        }


{{--        @if($step1 == true)--}}
            .step1::before {
            background: green;
        }

        .step1::after {
            background: green;
        }
{{--        @elseif($step1 == false)--}}
{{--             .step1::before {--}}
{{--            background: red;--}}
{{--        }--}}

{{--        .step1::after {--}}
{{--            background: red;--}}
{{--        }--}}
{{--        @endif--}}


{{--        @if($step2 == true)--}}

            .step2::before {
            background: green;
        }

        .step2::after {
            background: green;
        }


{{--        @else--}}
{{--            .step2::before {--}}
{{--            background: red;--}}
{{--        }--}}

{{--        .step2::after {--}}
{{--            background: red;--}}
{{--        }--}}

{{--        @endif--}}



{{--        @if($step3)--}}
            .step3::before {
            background: green;
        }

        .step3::after {
            background: green;
        }
{{--        @endif--}}
    </style>
@endsection

@section('scripts')
    <script src="https://use.typekit.net/bkt6ydm.js"></script>
    <script>try {
            Typekit.load({async: true});
        } catch (e) {
        }</script>
@endsection
