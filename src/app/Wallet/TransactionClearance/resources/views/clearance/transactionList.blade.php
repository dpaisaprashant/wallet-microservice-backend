@extends('admin.layouts.admin_design')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Clearance</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Clearance</strong>
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


                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction type..."
                                                        class="chosen-select" tabindex="2" name="transaction_type" required>
                                                    <option value="" selected disabled>Select Transaction Type...
                                                    </option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['transaction_type']))
                                                        @foreach($transactionTypes as $key => $transactionType)
                                                            <option value="{{ $key }}"
                                                                    @if($_GET['transaction_type'] == $key) selected @endif>{{ $transactionType }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($transactionTypes as $key => $transactionType)
                                                            <option value="{{ $key }}"> {{ $transactionType }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('clearance.transactions') }}"><strong>Generate
                                                Report</strong></button>
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
                @if(!empty($_GET['from']) && !empty($_GET['to']))
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>Paypoint report from {{ $_GET['from'] . ' to ' . $_GET['to'] }}</h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> {{ $totalTransactionCount }}</h5>
                            <h5><b>Total Amount Sum:</b> Rs. {{ $totalTransactionAmountSum }}</h5>
                            <h5><b>Total Fee Sum:</b> Rs. {{ $totalTransactionFeeSum }}</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="clearance transactions">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Vendor</th>
                                        <th>Amount</th>
                                        <th>Transaction Fee</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>{{$transaction->pre_transaction_id}}</td>
                                            <td>{{$transaction->vendor}}</td>
                                            <td>{{$transaction->amount}}</td>
                                            <td>{{$transaction->fee ?? 0}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $transactions->appends(request()->query())->links() }}
                                <div class="">
                                    <div class="col-md-4" style="float: right">

                                        <form id="excelClearance" action="{{ route('clearance.generate') }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="from" value="{{ $_GET['from'] ?? "" }}">
                                            <input type="hidden" name="to" value="{{ $_GET['to'] ?? "" }}">
                                            <input type="hidden" name="transaction_type" value="{{ $_GET['transaction_type'] ?? "" }}">

                                            <div class="input-group date">
                                                <div class="custom-file" style="margin-right: 19px;">
                                                    <input name="file" id="logo1" type="file" class="custom-file-input" accept=".csv, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                                    <label for="logo1" class="custom-file-label">Upload excel file&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                                </div>
                                            </div>
                                            <br>
                                            <button id="print" type="submit" class="btn btn-primary" formtarget="_blank" style="float: right; margin-right: 17px;">Clear All Transactions</button>
                                            <button id="printReport" type="submit" class="btn btn-primary clear" formtarget="_blank" rel="{{ route('clearance.generate') }}" style="display: none"></button>
                                        </form>
                                    </div>
                                </div>
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

    @include('admin.asset.css.sweetalert')

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

    @include('admin.asset.js.sweetalert')

    <script>
        $('#print').on('click', function (e) {

            let excel = $('#logo1').val();

            if(!excel) {
                alert('please import an excel file!');
                e.preventDefault();
                return;
            }

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "All the listed transaction will be cleared",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, clear Transactions!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#printReport').trigger('click');
                $('#print').hide();
                $('#excelClearance').hide();
                swal.close();

            })
        });
    </script>

    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>

    <script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries";
            $('.dataTables_info').text(a);
        });
        @endif
    </script>

@endsection






