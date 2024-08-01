{{--@extends('admin.layouts.admin_design')--}}
{{--@section('content')--}}
{{--    <div class="row wrapper border-bottom white-bg page-heading">--}}
{{--        <div class="col-lg-8">--}}
{{--            <h2>Magnus Linked Account Details Page</h2>--}}
{{--            <ol class="breadcrumb">--}}
{{--                <li class="breadcrumb-item">--}}
{{--                    <a href="{{ route('admin.dashboard') }}">Home</a>--}}
{{--                </li>--}}
{{--                <li class="breadcrumb-item">--}}
{{--                    Test Load--}}
{{--                </li>--}}
{{--                <li class="breadcrumb-item active">--}}
{{--                    <strong>Detail</strong>--}}
{{--                </li>--}}
{{--            </ol>--}}
{{--        </div>--}}
{{--        --}}{{--<div class="col-lg-4">--}}
{{--            <div class="title-action">--}}
{{--                <a href="invoice_print.html" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Transaction Detail </a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="wrapper wrapper-content animated fadeInRight">--}}

{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="ibox-content p-xl">--}}
{{--                    <h1>Merchant Name: <strong>{{$merchant_name}}</strong></h1>--}}
{{--                    <h1>User Account: <strong>{{$user_mobile}}</strong></h1>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <h2>Request</h2>--}}
{{--                            @isset($json_request)--}}
{{--                                @foreach($json_request as $key=>$value)--}}
{{--                                    @if(is_array($value))--}}
{{--                                        @foreach($value as $key2=>$value2)--}}
{{--                                            @if(is_array($value2))--}}
{{--                                                @foreach($value2 as $key3=>$value3)--}}
{{--                                                    @if(!is_array($value3))--}}
{{--                                                        <h5>{{$key3}}: <strong>{{$value3}}</strong></h5>--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                            @else--}}
{{--                                                <h5>{{$key2}}: <strong>{{$value2}}</strong></h5>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    @else--}}
{{--                                        <h5>{{$key}}: <strong>{{$value}}</strong></h5>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            @else--}}
{{--                                <h3>Json Request is Null</h3>--}}
{{--                            @endisset--}}
{{--                        </div>--}}

{{--                        <div class="col-sm-6 text-right">--}}
{{--                            <h4>Transaction Id:</h4>--}}
{{--                            <h4 class="text-navy">#{{$pre_transaction->pre_transaction_id}}</h4>--}}

{{--                            <p style="margin-top: 20px;">--}}
{{--                                @php--}}
{{--                                    $date = explode(' ', $pre_transaction->created_at);--}}
{{--                                @endphp--}}
{{--                                <span><strong>Transaction Date:</strong> {{ date('d M, Y', strtotime($date[0]))}}</span><br/>--}}
{{--                                <span><strong>Time:</strong> {{ date('h:i a', strtotime($date[1]))}}</span><br><br>--}}
{{--                                <span><strong>Amount:</strong> {{ $pre_transaction->amount}}</span><br><br>--}}
{{--                                <span><strong>Balance:</strong> {{$transaction->balance}}</span><br><br>--}}
{{--                                <span><strong>Transaction Type:</strong> {{ $pre_transaction->transaction_type}}</span><br><br>--}}
{{--                            </p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="row">--}}
{{--                        <div class="col-sm-6">--}}
{{--                            <h2> Response</h2>--}}
{{--                            @isset($json_response)--}}
{{--                                @foreach($json_response as $key=>$value)--}}
{{--                                    @if(is_array($value))--}}
{{--                                        @foreach($value as $key2=>$value2)--}}
{{--                                            @if(is_array($value2))--}}
{{--                                                @foreach($value2 as $key3=>$value3)--}}
{{--                                                    @if(!is_array($value3))--}}
{{--                                                        <h5>{{$key3}}: <strong>{{$value3}}</strong></h5>--}}
{{--                                                    @endif--}}
{{--                                                @endforeach--}}
{{--                                            @else--}}
{{--                                                <h5>{{$key2}}: <strong>{{$value2}}</strong></h5>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    @else--}}
{{--                                        <h5>{{$key}}: <strong>{{$value}}</strong></h5>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                            @else--}}
{{--                                <h3>Json Response is Null</h3>--}}
{{--                            @endisset--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
