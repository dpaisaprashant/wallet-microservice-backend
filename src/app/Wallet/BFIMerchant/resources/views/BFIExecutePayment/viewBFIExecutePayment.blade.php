@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>BFI execute payment</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>BFI execute payment</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter BFI Execute Payment</h5>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="user"
                                                       placeholder="User Name" class="form-control"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="process_id" placeholder="Process ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['process_id']) ? $_GET['process_id'] : '' }}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">


                                        <div class="col-md-4" style="padding-top: 10px;">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select data-placeholder="Select Status...." class="chosen-select"
                                                        tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status...</option>
                                                    @if(!empty($_GET['status']))
                                                        @foreach($status as $stat)
                                                            <option value="{{$stat}}"
                                                                    @if($_GET['status']  == $stat) selected @endif >{{$stat}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($status as $stat)
                                                            <option value="{{$stat}}">{{$stat}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-top: 8px;">
                                            <label for="ionrange_amount">Amount</label>

                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control"
                                                       placeholder="From Amount" name="from_amount"
                                                       autocomplete="off"
                                                       value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                                {{--                                                    </div>--}}
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="margin-top: 34px;">
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
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4" style="padding-top: 10px;">
                                            <label for="request_date_load_from">Created At Date</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                 <i class="fa fa-calendar"></i>
                                             </span>
                                                <input id="from" type="text"
                                                       class="form-control from" placeholder="From"
                                                       name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="margin-top: 35px;">
{{--                                            <label for="request_date_load_to">Created At Date To</label>--}}
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                     <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="to" type="text"
                                                       class="form-control to" placeholder="To"
                                                       name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('view.bfi.execute.payment') }}">
                                            <strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('execute.payment.report.excel') }}">
                                            <strong>Excel</strong>
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
                        <h5>List of BFI execute Payment</h5>
                    </div>
                    <div class="ibox-content">
                        <h5><b>Total Count:</b> {{ $bfiExecutePaymentsTotalCount }}</h5>
                        <h5><b>Total Amount Sum:</b> Rs. {{ $bfiExecutePaymentsTotalAmount }} </h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="BFI execute payment list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>BFI Id</th>
                                    <th>Transaction Id</th>
                                    <th>Transaction Category</th>
                                    <th>Process Id</th>
                                    <th>Wallet Id</th>
                                    <th>Amount</th>
                                    <th>Purpose</th>
                                    <th>Transaction Detail</th>
                                    <th>Status</th>
                                    <th>Pre Transaction Id</th>
                                    <th>Action</th>
                                    <th>Request from bfi</th>
                                    <th>Response to bfi</th>
                                    <th>Request to wallet</th>
                                    <th>Response from wallet</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bfiExecutePayments as $key=>$bfiExecutePayment)
                                    <tr>
                                        <td>{{ $loop->index + ($bfiExecutePayments->perPage() * ($bfiExecutePayments->currentPage() - 1)) + 1 }}</td>
                                        <td>{{ isset($bfiExecutePayment->bfiUser->bfi_name) == null ? "Null" : $bfiExecutePayment->bfiUser->bfi_name}}</td>
                                        <td>{{ $bfiExecutePayment->bfi_id }}</td>
                                        <td>{{ $bfiExecutePayment->transaction_id }}</td>
                                        <td>
                                            @if($bfiExecutePayment->transaction_category == "DEBIT")
                                                <span class="badge badge-success">Debit</span>
                                            @elseif($bfiExecutePayment->transaction_category == "CREDIT")
                                                <span class="badge badge-primary">Credit</span>
                                            @elseif($bfiExecutePayment->transaction_category == null)
                                                <span class="badge badge-danger">Null</span>
                                            @endif
                                        </td>
                                        <td>{{ $bfiExecutePayment->process_id }}</td>
                                        <td>{{ $bfiExecutePayment->wallet_id }}</td>
                                        <td>Rs.{{ $bfiExecutePayment->amount }}</td>
                                        <td>
                                            @if($bfiExecutePayment->purpose == null)
                                                <span class="badge badge-danger">Null</span>
                                            @else
                                                {{ $bfiExecutePayment->purpose }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($bfiExecutePayment->transaction_detail == null)
                                                <span class="badge badge-danger">Null</span>
                                            @else
                                                {{ $bfiExecutePayment->transaction_detail }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($bfiExecutePayment->status == "SUCCESS")
                                                <span class="badge badge-primary">Success</span>
                                            @elseif($bfiExecutePayment->status == "PROCESSING")
                                                <span class="badge badge-success">Processing</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($bfiExecutePayment->pre_transaction_id == null)
                                                <span class="badge badge-danger">Null</span>
                                            @else
                                                {{ $bfiExecutePayment->pre_transaction_id }}
                                            @endif
                                        </td>

                                        <td>
                                            @include('BFIMerchant::include.BfiExecutePayment.bfiExecutePaymentInfo',[
                                                    'id'=>$bfiExecutePayment->id,
                                                    'bank_transaction_id'=>$bfiExecutePayment->bank_transaction_id,
                                                    'bank_transaction_date'=>$bfiExecutePayment->bank_transaction_date,
                                                    'initiating_account' =>$bfiExecutePayment->initiating_account,
                                                    'initiating_account_name'=>$bfiExecutePayment->initiating_account_name,
                                                    'remarks'=>$bfiExecutePayment->remarks])
                                        </td>
                                        <td>
                                            @include('BFIMerchant::include.BfiExecutePayment.requestFromBfi',['id'=>$bfiExecutePayment->id,'request_from_bfi'=>$bfiExecutePayment->request_from_bfi])
                                        </td>
                                        <td>
                                            @include('BFIMerchant::include.BfiExecutePayment.responseToBfi',['id'=>$bfiExecutePayment->id,'response_to_bfi'=>$bfiExecutePayment->response_to_bfi])
                                        </td>
                                        <td>
                                            @include('BFIMerchant::include.BfiExecutePayment.requestToWallet',['id'=>$bfiExecutePayment->id,'request_to_wallet'=>$bfiExecutePayment->request_to_wallet])

                                        </td>
                                        <td>
                                            @include('BFIMerchant::include.BfiExecutePayment.responseFromWallet',['id'=>$bfiExecutePayment->id,'response_from_wallet'=>$bfiExecutePayment->response_from_wallet])

                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $bfiExecutePayments->appends(request()->query())->links() }}
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
        $(".from").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });
    </script>

    <script>
        $(".from").change(function () {
            var start_date = $(this).val();

            $(".to").val('');
            $(".to").removeAttr('readonly');
            $(".to").datepicker('destroy');
            $(".to").datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: new Date(start_date),
                format: 'dd M, yyyy'
            });
        });

        $(".to").keyup(function () {
            $(this).val('');
        });
    </script>

    <!-- End Date picker -->

    @include('admin.asset.js.datatable')
    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $bfiExecutePayments->firstItem() }} to {{ $bfiExecutePayments->lastItem() }} of {{ $bfiExecutePayments->total() }} entries";
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
