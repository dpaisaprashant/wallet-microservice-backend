@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Load Wallet</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Load Wallet</strong>
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
                        <h5>Filter Data of Load Wallet</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('npsaccountlinkload.view') }}" id="filter">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="gateway_transaction_id" placeholder="Gateway Transaction ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['gateway_transaction_id']) ? $_GET['gateway_transaction_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="merchant_txn_id" placeholder="Merchant Txn ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['merchant_txn_id']) ? $_GET['merchant_txn_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="reference_id" placeholder="Reference ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['reference_id']) ? $_GET['reference_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="linked_accounts_id" placeholder="Linked Account ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['linked_accounts_id']) ? $_GET['linked_accounts_id'] : '' }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-top: 20px">

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_from" type="text" class="form-control date_from"
                                                       placeholder="From Created At" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_to" type="text" class="form-control date_to"
                                                       placeholder="To Created At" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control"
                                                       placeholder="From Amount" name="from_amount"
                                                       autocomplete="off"
                                                       value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control"
                                                       placeholder="To Amount" name="to_amount"
                                                       autocomplete="off"
                                                       value="{{ !empty($_GET['to_amount']) ? $_GET['to_amount'] : '' }}">
                                            </div>
                                        </div>

{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="input-group date">--}}
{{--                                                <span class="input-group-addon">--}}
{{--                                                    <i class="fa fa-calendar"></i>--}}
{{--                                                </span>--}}
{{--                                                <input id="date_from_load" type="text" class="form-control date_from_load"--}}
{{--                                                       placeholder="From Load Time Stamp" name="from_load" autocomplete="off"--}}
{{--                                                       value="{{ !empty($_GET['from_load']) ? $_GET['from_load'] : '' }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="input-group date">--}}
{{--                                                <span class="input-group-addon">--}}
{{--                                                    <i class="fa fa-calendar"></i>--}}
{{--                                                </span>--}}
{{--                                                <input id="date_to_load" type="text" class="form-control date_to_load"--}}
{{--                                                       placeholder="To Load Time Stamp" name="to_load" autocomplete="off"--}}
{{--                                                       value="{{ !empty($_GET['to_load']) ? $_GET['to_load'] : '' }}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>

                                    <div class="row" style="margin-top: 40px;">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Load Status...." class="chosen-select"
                                                        tabindex="2" name="load_status">
                                                    <option value="" selected disabled>Select Load Status...</option>
                                                    @if(!empty($_GET['load_status']))
                                                        @foreach($load_status as $stat)
                                                            <option value="{{$stat}}"
                                                                @if($_GET['load_status']  == $stat) selected @endif >{{$stat}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($load_status as $stat)
                                                            <option value="{{$stat}}">{{$stat}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="phone_number" placeholder="User Phone Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['phone_number']) ? $_GET['phone_number'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('npsaccountlinkload.view') }}"><strong>Filter</strong>
                                        </button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('npsaccountlinkload.excel') }}">
                                            <strong>Excel</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($_GET))
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all Transactions</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Complete Requests List">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Amount</th>
                                        <th>Gateway Transaction ID</th>
                                        <th>Load Status</th>
                                        <th>Load Time Stamp</th>
                                        <th>Merchant Txn ID</th>
                                        <th>Reference ID</th>
                                        <th>User Phone Number</th>
                                        <th>Linked Account ID</th>
                                        <th>Created At</th>
                                        <th style='width: 100px'>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($npsAccountLinkLoads as $npsAccountLinkLoad)

                                        <tr class="gradeC">
                                            <td>{{ $loop->index + ($npsAccountLinkLoads->perPage() * ($npsAccountLinkLoads->currentPage() - 1)) + 1 }}</td>
                                            <td>{{ $npsAccountLinkLoad->amount }}</td>
                                            <td>{{ $npsAccountLinkLoad->gateway_transaction_id }}</td>
                                            <td>
                                                <span class="badge {{$npsAccountLinkLoad->load_status=="Transaction Success" ? "badge-primary" : "badge-danger"}}">{{ $npsAccountLinkLoad->load_status }}</span>
                                            </td>
                                            <td>{{ $npsAccountLinkLoad->load_time_stamp }}</td>
                                            <td>{{ $npsAccountLinkLoad->merchant_txn_id }}</td>
                                            <td>{{ $npsAccountLinkLoad->reference_id }}</td>
                                            <td>
                                                @if(!empty($npsAccountLinkLoad->preTransaction->user->mobile_no))
                                                    {{ $npsAccountLinkLoad->preTransaction->user->mobile_no }}
                                                @else
                                                    No Data
                                                @endif
                                            </td>
                                            <td>{{ $npsAccountLinkLoad->linked_accounts_id }}</td>
                                            <td>{{ $npsAccountLinkLoad->created_at }}</td>
                                            <td>
                                                @include('NPSAccountLinkLoad::transactionRemarks', ['npsAccountLinkLoad' => $npsAccountLinkLoad])
                                                @include('NPSAccountLinkLoad::jsonButtons', ['npsAccountLinkLoad' => $npsAccountLinkLoad])
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $npsAccountLinkLoads->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection


@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $npsAccountLinkLoads->firstItem() }} to {{ $npsAccountLinkLoads->lastItem() }} of {{ $npsAccountLinkLoads->total() }} entries";
            $('.dataTables_info').text(a);
        });
        @endif
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`;
        @else '0;100000'; @endif
        let split = amount.split(';');
        $(".ionrange_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });
    </script>

    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection


