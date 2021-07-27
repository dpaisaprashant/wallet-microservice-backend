@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>User to bfi fund transfer</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>User to bfi fund transfer</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter User to bfi fund transfer</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content"
                         @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        {{--<div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>--}}
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user"
                                                       placeholder="User Name" class="form-control"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="bfi_id" placeholder="BFI Id"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['bfi_id']) ? $_GET['bfi_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction Id"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="wallet_id" placeholder="Wallet Id"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['wallet_id']) ? $_GET['wallet_id'] : '' }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3" style="padding-top: 15px;">
                                            <label for="response_status">Process Id</label>
                                            <div class="form-group">
                                                <input type="text" name="process_id" placeholder="Process Id"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['process_id']) ? $_GET['process_id'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="padding-top: 15px;">
                                            <label for="response_status">Status</label>
                                            <div class="form-group">
                                                <select name="status"
                                                        data-placeholder="Choose  status..."
                                                        class="chosen-select" tabindex="2">
                                                    <option value="" selected disabled>Select Status...
                                                    </option>

                                                    @if(!empty($_GET['status']))
                                                        <option value="ALL"
                                                                @if($_GET['status']  == 'ALL') selected @endif>
                                                            All
                                                        </option>
                                                        <option value="SUCCESS"
                                                                @if($_GET['status']  == 'SUCCESS') selected @endif>
                                                            Success
                                                        </option>
                                                        <option value="PROCESSING"
                                                                @if($_GET['status']  == 'PROCESSING') selected @endif>
                                                            Processing
                                                        </option>

                                                    @else
                                                        <option value="ALL">All</option>
                                                        <option value="SUCCESS">Success</option>
                                                        <option value="PROCESSING">Processing</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">

                                            {{--                                            <input type="text" name="amount" class="ionrange_amount">--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="from_pre_transaction_id">From Pre Transaction Id</label>
                                                    <div class="form-group">
                                                        <input type="text" name="from_pre_transaction_id" placeholder="From Pre Transaction Id"
                                                               class="form-control"
                                                               value="{{ !empty($_GET['from_pre_transaction_id']) ? $_GET['from_pre_transaction_id'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="to_pre_transaction_id">To Pre Transaction Id</label>
                                                    <div class="form-group">
                                                        <input type="text" name="to_pre_transaction_id" placeholder="To Pre Transaction Id"
                                                               class="form-control"
                                                               value="{{ !empty($_GET['to_pre_transaction_id']) ? $_GET['to_pre_transaction_id'] : '' }}">
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('view.user.to.bfi.fund.transfer') }}"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('fundRequest.excel') }}"><strong>Excel</strong>
                                        </button>
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
                        <h5>List of User to bfi fund transfer</h5>
                    </div>
                    <div class="ibox-content">
                        <h5><b>Total Count:</b> {{ $userToBfiFundTransferTotalCount }}</h5>
                        <h5><b>Total Amount Sum:</b> Rs.  {{$userToBfiFundTransferTotalAmount}}</h5>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Fund Request transaction list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>BFI Id</th>
                                    <th>Transaction Id</th>
                                    <th>Process Id</th>
                                    <th>Wallet Id</th>
                                    <th>Amount</th>
                                    <th>Purpose</th>
                                    <th>Transaction Detail</th>
                                    <th>Status</th>
                                    <th>From Pre Transaction Id</th>
                                    <th>To Pre Transaction Id</th>
                                    <th>Action</th>
                                    <th>Request from bfi</th>
                                    <th>Response to bfi</th>
                                    <th>Request to wallet</th>
                                    <th>Response from wallet</th>
                                    <th>Check Payment Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($userToBfiFundTransfers as $key=>$userToBfiFundTransfer)
                                    <tr>
                                        <td>{{ $loop->index + ($userToBfiFundTransfers->perPage() * ($userToBfiFundTransfers->currentPage() - 1)) + 1 }}</td>
                                        <td>{{ isset($userToBfiFundTransfer->bfiUser->bfi_name) == null?'Null':$userToBfiFundTransfer->bfiUser->bfi_name }}</td>
                                        <td>{{ $userToBfiFundTransfer->bfi_id }}</td>
                                        <td>{{ $userToBfiFundTransfer->transaction_id }}</td>
                                        <td>{{ $userToBfiFundTransfer->process_id }}</td>
                                        <td>{{ $userToBfiFundTransfer->wallet_id }}</td>
                                        <td>Rs.{{ $userToBfiFundTransfer->amount }}</td>
                                        <td>
                                            @if($userToBfiFundTransfer->purpose == null)
                                                <span class="badge badge-danger">Null</span>
                                            @else
                                                {{$userToBfiFundTransfer->purpose}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($userToBfiFundTransfer->transaction_detail == null)
                                                <span class="badge badge-danger">Null</span>
                                            @else
                                                {{$userToBfiFundTransfer->transaction_detail}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($userToBfiFundTransfer->status == 'SUCCESS')
                                                <span class="badge badge-primary">Success</span>
                                            @elseif($userToBfiFundTransfer->status == 'PROCESSING')
                                                <span class="badge badge-success">Processing</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($userToBfiFundTransfer->from_pre_transaction_id == null)
                                                <span class="badge badge-danger">Null</span>
                                                @else
                                            {{$userToBfiFundTransfer->from_pre_transaction_id}}
                                            @endif
                                        </td>
                                        <td>
                                            @if($userToBfiFundTransfer->to_pre_transaction_id == null)
                                                <span class="badge badge-danger">Null</span>
                                            @else
                                                {{$userToBfiFundTransfer->to_pre_transaction_id}}
                                            @endif
                                        </td>
                                        <td>
                                            @include('admin.include.BfiExecutePayment.bfiExecutePaymentInfo',['id'=> $userToBfiFundTransfer->id,'bank_transaction_id'=>$userToBfiFundTransfer->bank_transaction_id,'bank_transaction_date'=>$userToBfiFundTransfer->bank_transaction_date,'initiating_account'=>$userToBfiFundTransfer->initiating_account,'initiating_account_name'=>$userToBfiFundTransfer->initiating_account_name,'remarks'=>$userToBfiFundTransfer->remarks])
                                        </td>
                                        <td>
                                            @include('admin.include.BfiExecutePayment.requestFromBfi',['id'=>$userToBfiFundTransfer->id,'request_from_bfi'=>$userToBfiFundTransfer->request_from_bfi])
                                        </td>
                                        <td>
                                            @include('admin.include.BfiExecutePayment.responseToBfi',['id'=>$userToBfiFundTransfer->id,'response_to_bfi'=>$userToBfiFundTransfer->response_to_bfi])
                                        </td>
                                        <td>
                                            @include('admin.include.BfiExecutePayment.requestToWallet',['id'=>$userToBfiFundTransfer->id,'request_to_wallet'=>$userToBfiFundTransfer->request_to_wallet])
                                        </td>
                                        <td>
                                            @include('admin.include.BfiExecutePayment.responseFromWallet',['id'=>$userToBfiFundTransfer->id,'response_from_wallet'=>$userToBfiFundTransfer->response_from_wallet])
                                        </td>
                                        <td>
                                            <a href="{{ route('user.to.bfi.fund.transfer.check.payment',$userToBfiFundTransfer->id) }}" class="btn btn-sm btn-icon btn-success" title="Check Payment Details"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                                                        {{ $userToBfiFundTransfers->appends(request()->query())->links() }}
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
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    @include('admin.asset.css.datepicker')
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    <!-- Date picker -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(".request_date_from").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });
    </script>

    <script>
        $(".request_date_from").change(function () {
            var start_date = $(this).val();

            $(".request_date_to").val('');
            $(".request_date_to").removeAttr('readonly');
            $(".request_date_to").datepicker('destroy');
            $(".request_date_to").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: new Date(start_date),
                format: 'dd M, yyyy'
            });
        });

        $(".request_date_to").keyup(function () {
            $(this).val('');
        });
    </script>

    <script>
        $(".response_date_from").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });

    </script>

    <script>
        $(".response_date_from").change(function () {
            var start_date = $(this).val();

            $(".response_date_to").val('');
            $(".response_date_to").removeAttr('readonly');
            $(".response_date_to").datepicker('destroy');
            $(".response_date_to").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: new Date(start_date),
                format: 'dd M, yyyy'
            });
        });

        $(".response_date_to").keyup(function () {
            $(this).val('');
        });
    </script>
    <!-- End Date picker -->

    @include('admin.asset.js.datatable')
        <script>
            $(document).ready(function (e) {
                let a = "Showing {{ $userToBfiFundTransfers->firstItem() }} to {{ $userToBfiFundTransfers->lastItem() }} of {{ $userToBfiFundTransfers->total() }} entries";
                $('.dataTables_info').text(a);
            });
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
@endsection
