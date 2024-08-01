@extends('admin.layouts.admin_design')
@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Wallet Ledger</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Home</a>
            </li>

            <li class="breadcrumb-item active">
                <strong>Report</strong>
            </li>

            <li class="breadcrumb-item active">
                <strong>Wallet Ledger</strong>
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
                                        <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                            <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from_date" autocomplete="off" value="{{ !empty($_GET['from_date']) ? $_GET['from_date'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                            <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to_date" autocomplete="off" value="{{ !empty($_GET['to_date']) ? $_GET['to_date'] : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div>
                                    <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('report.range.wallet_ledger') }}"><strong>Generate Report</strong></button>
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
            @if(!empty($_GET['from_date']) || !empty($_GET['to_date']))
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Wallet Ledger for {{$data['from_date']}} @if(isset($data['to_date'])) to {{$data['to_date']}} @endif</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" title="Wallet user's list">
                            <thead>
                            <tr>
                                <th>SN</th>
                                <th>Particulars</th>
                                <th>Debit</th>
                                <th>Credit</th>
                                <th>Balance</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>-</td>
                                <td>OPENING BALANCE</td>
                                <td>-</td>
                                <td>-</td>
                                {{--<td>{{round($data['opening_balance'])}}</td>--}}
                                <td>{{$data['opening_balance']}}
                            </tr>

                            <?php
                            $transaction = $data['transactions'];
                            //$balance = round($data['opening_balance']);
                            $balance = $data['opening_balance'];
                            ?>

                            <?php for($i= 0; $i < count($transaction); $i++) { ?>

                            <?php
                            if($transaction[$i]->account_type == "debit"){
                                $balance = $balance - $transaction[$i]->amount/100;
                            }
                            elseif ($transaction[$i]->account_type == "credit"){
                                $balance = $balance + $transaction[$i]->amount/100;
                            }
                            ?>
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>
                                    <?php

                                    $pre_transaction_id = $transaction[$i]->pre_transaction_id;
                                    if($transaction[$i]->pre_transaction_id == null){

                                        if($transaction[$i-1]->commissionable_id = $transaction[$i]->commissionable_id){
                                            $pre_transaction_id = $transaction[$i-1]->pre_transaction_id;
                                        }else if($transaction[$i-1]->commissionable_id = $transaction[$i]->commissionable_id){
                                            $pre_transaction_id = $transaction[$i+1]->pre_transaction_id;
                                        }

                                    }
                                    ?>
                                    {{$pre_transaction_id}}/{{$transaction[$i]->vendor}}/{{$transaction[$i]->service_type}}
                                </td>
                                <td>@if($transaction[$i]->account_type == "debit") {{$transaction[$i]->amount/100}} @endif</td>
                                <td>@if($transaction[$i]->account_type == "credit") {{$transaction[$i]->amount/100}} @endif</td>
                                <td>{{$balance}}</td>

                            </tr>

                            <?php } ?>

                            </tbody>
                            <tfoot>
                            <tr>
                                <td>-</td>
                                <td>CLOSING BALANCE</td>
                                <td>-</td>
                                <td>-</td>
                                <td>{{$data['closing_balance']}}</td>
                                {{--<td>{{round($data['closing_balance'])}}</td>--}}
                            </tr>
                            </tfoot>
                        </table>
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





