@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Transaction Detail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    Transaction
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
                        {{--<div class="col-md-12">
                            <header class="example-header">
                                <h1 class="text-center">Transaction Detail</h1>
                            </header>
                        </div>--}}
                        <div class="col-sm-6" style="margin-top: 30px;">
                            <h5>User:</h5>
                            <address>
                                <strong>{{ $transaction->transactions->user->name}}</strong><br>
                                Email: {{ $transaction->transactions->user->email }}<br>
                                Contact Number: {{ $transaction->transactions->user->mobile_no }}
                            </address>


                            <span>Bank:</span>
                            <address>
                                <strong>{{ $transaction->payment_mode }}</strong><br>
                                Process Id: {{ $transaction->process_id }}<br>
                                Gateway Ref No: {{ $transaction->gateway_ref_no }}<br>
                                Status:     @if($transaction->status == 'VALIDATED')
                                                <span class="badge badge-warning">{{ $transaction->status }}</span>
                                            @elseif($transaction->status == 'INVALID')
                                                <span class="badge badge-danger">{{ $transaction->status }}</span>
                                            @elseif($transaction->status == 'COMPLETED')
                                                <span class="badge badge-primary">{{ $transaction->status }}</span>
                                            @elseif($transaction->status == 'TESTED')
                                                <span class="badge badge-warning">{{ $transaction->status }}</span>
                                            @elseif($transaction->status == 'ERROR')
                                                <span class="badge badge-danger">{{ $transaction->status }}</span>
                                            @elseif($transaction->status == 'SUCCESS')
                                                <span class="badge badge-primary">{{ $transaction->status }}</span>
                                            @endif
                            </address>

                            <address>
                                <strong>Amount: Rs. {{ $transaction->amount }}<br></strong>
                                @if(! empty($transaction->commission))
                                <strong>Commission: Rs. {{ $transaction->commission['before_amount'] - $transaction->commission['after_amount'] }}<br></strong>
                                @endif
                            </address>

                        </div>

                        <div class="col-sm-6 text-right" style="margin-top: 20px;">
                            <h4>Transaction ID.</h4>
                            <h4 class="text-navy">#{{ $transaction->transaction_id }}</h4>

                            <p style="margin-top: 20px;">
                                <?php
                                    $date = explode(' ', $transaction->created_at);
                                ?>
                                <span><strong>Transaction Date:</strong> {{ date('d M, Y', strtotime($date[0]))}}</span><br/>
                                <span><strong>Time:</strong> {{ date('h:i a', strtotime($date[1]))}}</span>
                            </p>

                        </div>
                    </div>

                    <hr>


                    <?php

                        $step1 = false;
                        $step2 = false;
                        $step3 = false;
                        $step3Error = false;
                        $step3NoResponse = false;
                        $step4 = false;

                        if ($transaction->process_id != 'INVALID' && $transaction->status == 'VALIDATED' && $transaction->gateway_ref_no == 'INVALID') {
                            $step1 = true;
                        }

                        if ($transaction->process_id != 'INVALID' && $transaction->status == 'VALIDATED' && $transaction->gateway_ref_no != 'INVALID') {
                            $step1= true;
                            $step2 = true;
                        }

                        if ($transaction->process_id != 'INVALID' && $transaction->gateway_ref_no != 'INVALID') {
                            if ($transaction->status == 'COMPLETED') {
                                $step1= true;
                                $step2 = true;
                                $step3 = true;
                                $step4 = true;

                            }elseif ($transaction->status == 'ERROR' ) {
                                $step3Error = true;
                            } else {
                                $step3NoResponse = true;
                            }
                        }





                    ?>

                   <div class="row">
                       <div class="col-md-12">
                           <div class="container-fluid">
                               <div class="row example-basic">
                                   <div class="col-md-12 example-title">
                                       <h2>Transaction Steps</h2>
                                       <p>Steps involved for the transaction to complete</p>
                                   </div>
                                   <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
                                       <ul class="timeline">

                                           <li class="timeline-item period">
                                               <div class="timeline-content">
                                                   <h2 class="timeline-title">STEP 1</h2>
                                               </div>
                                           </li>
                                           <li class="timeline-item">
                                              {{-- <div class="timeline-info">
                                                   <span>April 02, 2016</span>
                                               </div>--}}
                                               <div class="timeline-marker step1"></div>
                                               <div class="timeline-content">
                                                   <h2 class="timeline-title">Validate Merchant</h2>
                                                   <p>
                                                       <strong>Process ID: </strong> {{ $transaction->process_id }} <br>
                                                       <strong>Gateway Ref No.: </strong> {{ $transaction->gateway_ref_no }}
                                                       <br>
                                                       <strong>Status: </strong> {{ $transaction->status }}
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
                                                   <h2 class="timeline-title">Post Transaction Detail</h2>
                                                   <p>
                                                       <strong>Process ID: </strong> {{ $transaction->process_id }} <br>
                                                       <strong>Gateway Ref No.: </strong> {{ $transaction->gateway_ref_no }}
                                                       <br>
                                                       <strong>Status: </strong> {{ $transaction->status }}
                                                   </p>
                                               </div>
                                           </li>

                                           <li class="timeline-item period">
                                               <div class="timeline-content">
                                                   <h2 class="timeline-title">STEP 3</h2>
                                               </div>
                                           </li>
                                           <li class="timeline-item">
                                               <div class="timeline-marker step3"></div>
                                               <div class="timeline-content">
                                                   <h2 class="timeline-title">Delivery URL</h2>
                                                   <p>
                                                           <strong>Process ID: </strong> {{ $transaction->process_id }} <br>
                                                           <strong>Gateway Ref No.: </strong> {{ $transaction->gateway_ref_no }}
                                                           <br>
                                                           <strong>Status:</strong> {{ $transaction->status }} <br>

                                                           @if(!$step3)
                                                               @if($step3Error)
                                                                   <br><strong>Message: </strong>Error while loading fund
                                                               <br>
                                                               @elseif($step3NoResponse)
                                                                   <br><strong>Message: </strong>No response from NPAY
                                                               <br>
                                                               @endif
                                                           @endif

                                                       @if(!empty($transaction->loadTransactionResponse))
                                                           <br>
                                                           <strong>Response</strong>

                                                           <address>
                                                               <?php $response =  json_decode($transaction->loadTransactionResponse->response, true)?>

                                                               <?php foreach (json_decode($response) as $key => $value) { ?>
                                                               {{ $key }} :
                                                               @if($key == 'amount' )
                                                                   &nbsp; Rs. {{ empty($value) ? 0 : $value / 100 }}<br>
                                                               @else
                                                                   &nbsp;{{ $value }}<br>
                                                               @endif
                                                               <?php }?>
                                                           </address>

                                                   @endif
                                                   </p>
                                               </div>

                                           </li>

                                           <li class="timeline-item period">
                                               <div class="timeline-content">
                                                   <h2 class="timeline-title">STEP 4</h2>
                                               </div>
                                           </li>
                                           <li class="timeline-item">
                                               <div class="timeline-marker step4"></div>
                                               <div class="timeline-content">
                                                   <h2 class="timeline-title">Transaction Response URL</h2>
                                                   <p>
                                                       <strong>Process ID:</strong> {{ $transaction->process_id }} <br>
                                                       <strong>Gateway Ref No.:</strong> {{ $transaction->gateway_ref_no }}
                                                       <br>
                                                       <strong>Status:</strong> {{ $transaction->status }}
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



        @if($step1)
            .step1::before {
                background: green;
            }
        .step1::after {
                background: green;
            }
        @endif

        @if($step2)
            .step2::before {
                background: green;
            }
        .step2::after {
                background: green;
            }
        @endif

        @if($step3)
            .step3::before {
                background: green;
            }
            .step3::after {
                background: green;
            }
        @endif

        @if($step4)
            .step4::before {
                background: green;
            }
            .step4::after {
                background: green;
            }
        @endif
    </style>
@endsection

@section('scripts')
    <script src="https://use.typekit.net/bkt6ydm.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
@endsection
