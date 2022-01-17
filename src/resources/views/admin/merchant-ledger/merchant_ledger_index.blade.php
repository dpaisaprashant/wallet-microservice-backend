@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Merchant Ledgers</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant Ledger</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Merchant Ledger</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Merchant Ledgers</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off"  value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off"  value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                        <div class = "col-6" style="padding-top: 10px">
                                            <select name="merchant" class="form-control form-control-sm" required>
                                                <option value="" selected disabled>-- Select Merchant --</option>
                                                @foreach($merchants as $merchant)
                                                    @if(!empty($_GET['merchant']))
                                                        @if($merchant->id == $_GET['merchant'])
                                                            <option value="{{$merchant->id}}" selected>{{$merchant->mobile_no . "-" .$merchant->name}}</option>
                                                        @else
                                                            <option value="{{$merchant->id}}">{{$merchant->moble_no . "-" .$merchant->name}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$merchant->id}}">{{$merchant->moble_no . "-" .$merchant->name}}</option>
                                                    @endif

                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group" style="padding-top: 10px">
                                                <select data-placeholder="Select Pre-Transaction status..."
                                                        class="chosen-select" tabindex="2" name="transaction_type">
                                                    <option value="" selected disabled>-- Select Transaction Type -- </option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['transaction_type']))
                                                        <option value="{{\App\Models\MagnusWithdraw::class}}"
                                                                @if($_GET['transaction_type']  == \App\Models\MagnusWithdraw::class) selected @endif >
                                                            Magnus Withdraw
                                                        </option>
                                                        <option value="{{\App\Models\MagnusDeposit::class}}"
                                                                @if($_GET['transaction_type'] == \App\Models\MagnusDeposit::class) selected @endif>
                                                            Magnus Deposit
                                                        </option>
                                                    @else
                                                        <option value="{{\App\Models\MagnusWithdraw::class}}">Magnus Withdraw</option>
                                                        <option value="{{\App\Models\MagnusDeposit::class}}">Magnus Deposit</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('admin.merchant.ledger.index') }}"><strong>Filter</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="row">
                            <div class = "col-3">
                                <h5>List of Merchant Ledgers</h5>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="User Login Sessions">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Date</th>
                                    <th>Transaction Code</th>
                                    <th>Merchant Name</th>
                                    <th>Account Name</th>
                                    <th>SFACL Transaction ID</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Amount</th>
                                    <th>Description(Kaifhiyat)</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                @isset($ledgers)
                                    @php($amount = 0)
                                    @foreach($ledgers as $ledger)
                                        <tbody>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$ledger->created_at}}</td>
                                            <td>{{$ledger->uid}}</td>
                                            <td>{{$ledger->user->name}}</td>
                                            <td>{{$ledger->account_mobile_no}}</td>
                                            <td>{{$ledger->tx_id}}</td>
                                            @if($ledger->uniquePreTransaction->transaction_type == \App\Models\Microservice\PreTransaction::TRANSACTION_TYPE_DEBIT)
                                                <td style="color: red">{{$ledger->amount}}</td>
                                                <td>--</td>
{{--                                                <td>--}}
{{--                                                    @php($amount = $amount - $ledger->amount)--}}
{{--                                                    {{$amount}}--}}
{{--                                                </td>--}}
                                            @else
                                                <td>--</td>
                                                <td style="color: green">{{$ledger->amount}}</td>
{{--                                                <td>--}}
{{--                                                    @php($amount = $amount + $ledger->amount)--}}
{{--                                                    {{$amount}}--}}
{{--                                                </td>--}}
                                            @endif
                                            <td>{{$ledger->balance}}</td>
                                            <td>{{$ledger->descripiton}}</td>
                                            <td>
                                                <a style="margin-top: 5px;"
                                                   href="{{route('admin.merchant.ledger.detail',$ledger->id)}}"
                                                   class="btn btn-sm btn-icon btn-primary m-t-n-xs"
                                                   title="user profile"><i class="fa fa-eye"></i></a>
                                            </td>
                                        </tbody>
                                    @endforeach
                                @endisset
                            </table>
                            @isset($ledgers)
                            {{ $ledgers->appends(request()->query())->links()}}
                            @endisset
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datatable')
    @include('admin.asset.css.datepicker')
@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    @isset($ledgers)
        <script>
            $(document).ready(function (e) {
                let a = "Showing {{ $ledgers->firstItem() }} to {{ $ledgers->lastItem() }} of {{ $ledgers->total() }} entries";
                $('.dataTables_info').text(a);
            });
        </script>
    @endisset
@endsection
