@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>User Audit Trail</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>{{$data['user'][0]->name}}</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Audit Trail</strong>
                </li>
            </ol>
        </div>
        <div class="row" style="padding-top: 20px; padding-left: 15px">
            <div class="col-lg-6">
                <h3>{{$data['user'][0]->name}} ({{$data['user'][0]->mobile_no}})</h3>
            </div>
            <div class="col-lg-6">
                <h3>Main Balance: Rs. {{$data['user'][0]->balance/100}}</h3>
            </div>
            <div class="col-lg-6">
                <h3>Bonus Balance: Rs. {{$data['user'][0]->bonus_balance/100}}</h3>
            </div>
            <div class="col-lg-6">
                <h3>Actual Balance:
                    Rs. {{round(($data['user'][0]->balance/100+$data['user'][0]->bonus_balance/100), 2)}}</h3>
            </div>
            <div class="col-lg-6">
                <h3>Expected Balance:
                    Rs. {{round(($data['sum'][0]->credit_total - $data['sum'][0]->debit_total),2)}}</h3>
            </div>
            <div class="col-lg-6">
                <?php
                if (round(($data['user'][0]->balance / 100 + $data['user'][0]->bonus_balance / 100), 2) != round(($data['sum'][0]->credit_total - $data['sum'][0]->debit_total), 2)) {
                    echo "Mismatch";
                } else {
                    echo "Match";
                }
                ?>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of {{$data['user'][0]->name }}'s Audit Trail</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="user audit trail">
                                <thead>
                                    <tr>
                                    <th>S.N</th>
                                    <th>pre_transaction_id</th>
                                    <th>vendor</th>
                                    <th>service_type</th>
                                    <th>commissionable_id</th>
                                    <th>debit</th>
                                    <th>credit</th>
                                    <th>amount</th>
                                    <th>balance</th>
                                    <th>bonus_balance</th>
                                    <th>created_at</th>
                                    <th>status</th>
                                    <th>total_balance</th>
                                    <th>check</th>
                                    <th>difference</th>
                                </tr>
                                </thead>
                                <?php
                                $i = 1;
                                $expected_balance = 0;
                                ?>
                                @foreach($data['audit'] as $audit)
                                    <?php

                                    $actual_balance = round($audit->balance, 2) + round($audit->bonus_balance, 2);
                                    if ($audit->status == 'SUCCESS') {
                                        if ($audit->account_type == 'debit') {
                                            $expected_balance = round($expected_balance, 2) - round($audit->amount, 2);
                                        } else {
                                            $expected_balance = round($expected_balance, 2) + round($audit->amount, 2);
                                        }
                                    } else {

                                        if ($audit->refund_id > 0) {
                                            $expected_balance = round($expected_balance, 2) - round($audit->amount, 2);
                                        }

                                        // $mystring = $audit->json_response;
                                        // $findme   = 'Server error:';
                                        // $pos = strpos($mystring, $findme);

                                        // // Note our use of ===.  Simply == would not work as expected
                                        // // because the position of 'a' was the 0th (first) character.
                                        // if ($pos != false) {
                                        //     $expected_balance = round($expected_balance, 2) - round($audit->amount, 2);
                                        // }
                                    }

                                    $differece = $expected_balance - $actual_balance;


                                    ?>
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$audit->pre_transaction_id}}</td>
                                        <td>{{$audit->vendor}}</td>
                                        <td>{{$audit->service_type}}</td>
                                        <td>
                                            @if($audit->commissionable_id > 0)
                                                {{$audit->commissionable_id}}
                                            @endif
                                        </td>
                                        <td>
                                            <p style="color: red"><?php
                                                if ($audit->account_type == 'debit') {
                                                    echo $audit->account_type;
                                                }
                                                ?></p>
                                        </td>
                                        <td>
                                            <p style="color: green">
                                                <?php
                                                if ($audit->account_type == 'credit') {
                                                    echo $audit->account_type;
                                                }
                                                ?>
                                            </p>
                                        </td>
                                        <td>{{$audit->amount}}</td>
                                        <td>{{$audit->balance}}</td>
                                        <td>{{$audit->bonus_balance}}</td>
                                        <td>{{$audit->created_at}}</td>
                                        <td>
                                            @if($audit->status === 'SUCCESS')
                                                <p style="color: green">
                                                    {{$audit->status}}
                                                </p>
                                            @else
                                                <p style="color: red">
                                                    {{$audit->status}}
                                                </p>
                                            @endif
                                        </td>
                                        <td>{{$actual_balance}}</td>
                                        <td>{{$expected_balance}}</td>
                                        <td>{{$differece}}</td>
                                    </tr>
                                    <?php $i++ ?>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection

@section('styles')

    @include('admin.asset.css.datatable')
@endsection

@section('scripts')

    @include('admin.asset.js.datatableWithPaging')

    {{--    <script>--}}
    {{--        $(document).ready(function (e) {--}}

    {{--            let a = "Showing {{ $data['audit'] }} to {{ end($data['audit']) }} of {{ count($data['audit']) }} entries";--}}
    {{--            $('.dataTables_info').text(a);--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection

