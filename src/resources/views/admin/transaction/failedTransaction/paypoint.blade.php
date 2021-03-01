@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Failed User Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Failed User Transaction</strong>
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
                    <div class="ibox-title">
                        <h5>Filter Failed User Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" @if(!empty($_GET['transaction_id'])) value="{{ $_GET['transaction_id'] }}" @endif>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or Number" class="form-control" @if(!empty($_GET['user'])) value="{{ $_GET['user'] }}" @endif>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="refStan" placeholder="RefStan" class="form-control" @if(!empty($_GET['refStan'])) value="{{ $_GET['refStan'] }}" @endif>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="bill_no" placeholder="Bill No" class="form-control" @if(!empty($_GET['bill_no'])) value="{{ $_GET['bill_no'] }}" @endif>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="code" placeholder="Code" class="form-control" @if(!empty($_GET['code'])) value="{{ $_GET['code'] }}" @endif>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" @if(!empty($_GET['from'])) value="{{ $_GET['from'] }}" @endif>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" @if(!empty($_GET['to'])) value="{{ $_GET['to'] }}" @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="status" value="failed">

                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('userTransaction.failed') }}"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('failed.paypoint.excel') }}"><strong>Excel</strong></button>
                                    </div>
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
                        <h5>List of user failed transaction</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Transaction ID</th>
                                    <th>Ref Stan</th>
                                    <th>Code</th>
                                    <th>Bill Number</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Request</th>
                                    <th>Response</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($failedTransactions as $transaction)
                                <tr class="gradeC">
                                    <td>{{ $loop->index + ($failedTransactions->perPage() * ($failedTransactions->currentPage() - 1)) + 1 }}</td>
                                    <td>
                                        <a  @can('User profile') href="{{route('user.profile', $transaction->user_id)}}" @endcan> {{ $transaction->user['mobile_no'] }} </a>
                                    </td>
                                    <td>
                                        {{ $transaction->transaction_id }}
                                    </td>
                                    <td class="center">{{ $transaction->refStan }}</td>

                                    <td>
                                       {{ $transaction->code }}
                                    </td>
                                    <td>
                                        {{ $transaction->bill_number }}
                                    </td>

                                    <td>
                                        {{ $transaction->created_at }}
                                    </td>

                                    <td>
                                        @include('admin.transaction.paypoint.status', ['transaction' => $transaction])
                                    </td>

                                    {{--Request--}}
                                    <td>
                                        @can('Failed paypoint request view')
                                            @include('admin.transaction.paypoint.request', ['transaction' => $transaction])
                                        @endcan
                                    </td>

                                    {{--Response--}}
                                    <td>
                                        @can('Failed paypoint response view')
                                            @include('admin.transaction.paypoint.response')
                                        @endcan
                                        {{--<a href="{{route('transactionDetail')}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>View Details</strong></a>--}}
                                    </td>

                                    <td>
                                        @can('Failed paypoint detail')
                                            <a href="{{ route('paypoint.detail', $transaction->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
                                        @endcan
                                    </td>

                                </tr>
                                @endforeach

                                </tbody>

                            </table>
                            {{ $failedTransactions->appends(request()->query())->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('styles')
    <link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">

    <style>
        .chosen-container-single .chosen-single{
            height: 35px !important;
            border-radius: 0px;
        }

        .chosen-container-single .chosen-single span{
            margin-top: 5px;
            margin-left: 5px;
        }
        .pagination{
            padding-top: -20px;
            padding-left: 15px;
            padding-bottom: 200px;
        }

        .dataTables_wrapper{
            padding-bottom: 5px;
        }

    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

    {{--<link href="{{ asset('admin/css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">

@endsection

@section('scripts')

    <!-- Chosen -->
    <script src="{{ asset('admin/js/plugins/chosen/chosen.jquery.js') }}"></script>

    <script>
        $('.chosen-select').chosen({width: "100%"});
    </script>

    <!-- Data picker -->
    {{-- <script src="{{ asset('admin/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(".date_from").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });

    </script>

    <script>
        $(".date_from").change(function () {
            var start_date = $(this).val();

            $(".date_to").val('');
            $(".date_to").removeAttr('readonly');
            $(".date_to").datepicker('destroy');
            $(".date_to").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate:new Date(start_date),
                format: 'dd M, yyyy'
            });
        });

        $(".date_to").keyup(function () {
            $(this).val('');
        });
    </script>


    <script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                paginate: false,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Paypoint failed transaction list'},
                    {extend: 'pdf', title: 'Paypoint failed transaction list'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

        });

    </script>

    <script>
        $(document).ready(function (e) {

            let a = "Showing {{ $failedTransactions->firstItem() }} to {{ $failedTransactions->lastItem() }} of {{ $failedTransactions->total() }} entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        $(".ionrange_balance").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: 100,
            to: 900,
            prefix: "Rs."
        });

        $(".ionrange_debit").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: 100,
            to: 900,
            prefix: "Rs."
        });

        $(".ionrange_credit").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: 100,
            to: 900,
            prefix: "Rs."
        });


    </script>
@endsection


