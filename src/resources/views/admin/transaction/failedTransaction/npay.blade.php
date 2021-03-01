@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>E Banking</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>NPAY</strong>
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
                        <h5>Filter Failed NPAY Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" >
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or Number" class="form-control" value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="bank" placeholder="Bank" class="form-control" value="{{ !empty($_GET['bank']) ? $_GET['bank'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status...</option>
                                                    <option value="" >All</option>
                                                    @if(!empty($_GET['status']))
                                                        <option value="completed" @if($_GET['status']  == 'completed') selected @endif>Complete</option>
                                                        <option value="validated" @if($_GET['status']  == 'validated') selected @endif>Validates</option>
                                                    @else
                                                        <option value="completed">Complete</option>
                                                        <option value="validated">Validates</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="ionrange_balance">Amount</label>
                                            <input type="text" name="amount" class="ionrange_amount">
                                        </div>

                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off" value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off" value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 40px;">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                        <option value="" selected disabled>Sort By...</option>
                                                        @if(!empty($_GET['sort']))
                                                            <option value="date" @if($_GET['sort'] == 'date') selected @endif>Latest Date</option>
                                                            <option value="amount" @if($_GET['sort'] == 'amount') selected @endif>Highest amount</option>
                                                        @else
                                                            <option value="date">Latest Date</option>
                                                            <option value="amount">Highest Amount</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="status" value="validated">

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('userLoadTransaction.failed') }}"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('failed.npay.excel') }}"><strong>Excel</strong></button>
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
                        <h5>List of NPAY (Load Fund) transactions</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Transaction ID</th>
                                    <th>User</th>
                                    <th>Bank</th>
                                    <th>Description</th>
                                    <th>Gateway Ref no.</th>
                                    <th>Amount</th>
                                    <th>Commission</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Response</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($failedTransactions as $transaction)
                                        <tr class="gradeC">
                                            <td>{{ $loop->index + ($failedTransactions->perPage() * ($failedTransactions->currentPage() - 1)) + 1 }}</td>
                                            <td>
                                                {{ $transaction->transaction_id }}
                                            </td>
                                            <td>
                                                <a  @can('User profile') href="{{route('user.profile', $transaction->user_id)}}" @endcan>{{ $transaction->user['mobile_no']}}</a>
                                            </td>
                                            <td>
                                                {{ $transaction->payment_mode }}
                                            </td>
                                            <td>
                                                {{ $transaction->description }}
                                            </td>
                                            <td>{{ $transaction->gateway_ref_no }}</td>
                                            <td class="center">Rs.{{ $transaction->amount }}</td>
                                            <td class="center">Rs.{{ $transaction->commission['before_amount'] - $transaction->commission['after_amount'] }}</td>

                                            <td>
                                                @if($transaction->status == 'COMPLETED')
                                                    <span class="badge badge-primary">{{ $transaction->status }}</span>
                                                @elseif($transaction->status == 'VALIDATED')
                                                    <span class="badge badge-warning">{{ $transaction->status }}</span>
                                                @else
                                                    <span class="badge badge-danger">{{ $transaction->status }}</span>
                                                @endif
                                            </td>

                                            <td class="center">{{ $transaction->updated_at }}</td>

                                            <td>
                                                @isset($transaction->loadTransactionResponse)
                                                    @include('admin.transaction.npay.response', ['transaction' => $transaction->loadTransactionResponse])
                                                @endisset
                                            </td>
                                            <td>
                                                @can('Failed npay response view')
                                                    @include('admin.transaction.npay.detail', ['transaction' => $transaction])
                                                @endcan

                                                @can('Failed npay detail')
                                                    <a href="{{ route('eBanking.detail', $transaction->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
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
                paging: false,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Npay Transaction list'},
                    {extend: 'pdf', title: 'Npay Transaction list'},

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
    {{--<script src="{{ asset('admin/js/plugins/ionRangeSlider/ion.rangeSlider.min.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>

        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`; @else '0;100000'; @endif
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
@endsection


