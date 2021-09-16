 @extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>All NCHL Aggregated Payments</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Nchl Aggregated Payments</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>All</strong>
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
                        <h5>Filter Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('nchl.aggregatePayment') }}"
                                      id="filter">
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="uid" placeholder="User Transaction ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['uid']) ? $_GET['uid'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="pre_transaction_id"
                                                       placeholder="Pre Transaction Id" class="form-control"
                                                       value="{{ !empty($_GET['pre_transaction_id']) ? $_GET['pre_transaction_id'] : '' }}">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row" style="margin-top: 20px">
                                        {{-- <div class="col-md-6">
                                             <label for="ionrange_amount">Amount</label>
                                             <input type="text" name="amount" class="ionrange_amount">
                                         </div>--}}

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="From Amount"
                                                       name="from_amount" autocomplete="off"
                                                       value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="To Amount"
                                                       name="to_amount" autocomplete="off"
                                                       value="{{ !empty($_GET['to_amount']) ? $_GET['to_amount'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 40px;">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Sort By..." class="chosen-select" tabindex="2"
                                                        name="sort">
                                                    <option value="" selected disabled>Sort By...</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Vendor...." class="chosen-select"
                                                        tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..."
                                                        class="chosen-select" tabindex="2" name="service">
                                                    <option value="" selected disabled>Select Service Type...</option>
                                                    <option value="">All</option>

                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction type..."
                                                        class="chosen-select" tabindex="2" name="transaction_type">
                                                    <option value="" selected disabled>Select Transaction Type...
                                                    </option>
                                                    <option value="">All</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('nchl.aggregatePayment') }}">
                                            <strong>Filter</strong>
                                        </button>
                                    </div>
                                    <div>
                                        <button id="compareBtn" class="btn btn-sm btn-primary float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('nchlAggregatedTransferApi.compare') }}">
                                            <strong>Compare with API</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('nchl.aggregatePayment') }}">
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
                            <h5>List of all Nchl Aggregated Payments</h5>

                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> {{ $nchlAggregatedTotalCount }}</h5>
                            <h5><b>Total Amount Sum:</b> Rs. {{ $nchlAggregatedTotalAmount }} </h5>
                            <h5><b>Total Transaction Fee:</b> Rs. {{ $nchlAggregatedTotalFee }}</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Nchl Aggregated Payment">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Pre Transaction Id</th>
                                        <th>Request Id</th>
                                        <th>User</th>
                                        <th>Service Type</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Transaction Fee</th>
                                        <th>Response Id</th>
                                        <th>Ref Id</th>
                                        <th>Debit Status</th>
                                        <th>Credit Status</th>
                                        <th>Response Code</th>
                                        <th>Response Description</th>
                                        <th>Check Response Code</th>
                                        <th>Check Response Description</th>
                                        <th>Action</th>
                                        <th>API</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($nchlAggregatedPayments as $key => $nchlAggregatedPayment)
                                        <tr>
                                            <td>{{ $loop->index + ($nchlAggregatedPayments->perPage() * ($nchlAggregatedPayments->currentPage() - 1)) + 1  }}</td>
                                            <td>{{ $nchlAggregatedPayment->pre_transaction_id }}</td>
                                            <td>{{ $nchlAggregatedPayment->request_id }}</td>
                                            <td>{{ optional(optional($nchlAggregatedPayment->preTransaction)->user)->mobile_no}}</td>
                                            <td>{{ $nchlAggregatedPayment->service_type }}</td>
                                            <td>{{ $nchlAggregatedPayment->transaction_id }}</td>
                                            <td>Rs. {{ $nchlAggregatedPayment->amount }}</td>
                                            <td>{{ $nchlAggregatedPayment->transaction_fee }}</td>
                                            <td>{{ $nchlAggregatedPayment->response_id }}</td>
                                            <td>{{ $nchlAggregatedPayment->ref_id }}</td>
                                            <td>{{ $nchlAggregatedPayment->debit_status }}</td>
                                            <td>{{ $nchlAggregatedPayment->credit_status }}</td>
                                            <td>{{ $nchlAggregatedPayment->response_code }}</td>
                                            <td>
                                                @if($nchlAggregatedPayment->response_description == "SUCCESS")
                                                    <span class="badge badge-primary">Success</span>
                                                @elseif($nchlAggregatedPayment->response_description == "ERROR")
                                                    <span class="badge badge-danger">Error</span>
                                                @endif
                                            </td>
                                            <td>{{ $nchlAggregatedPayment->check_response_code }}</td>
                                            <td>{{ $nchlAggregatedPayment->check_response_description }}</td>
                                            <td>
                                                @include('admin.transaction.nchlAggregatedPayment.checkRequest',['nchlAggregatedPayment' => $nchlAggregatedPayment,'id' => '1'])
                                                @include('admin.transaction.nchlAggregatedPayment.checkResponse',['nchlAggregatedPayment' => $nchlAggregatedPayment,'id' => '2'])
                                                @include('admin.transaction.nchlAggregatedPayment.nchlAggregateRequest',['nchlAggregatedPayment' => $nchlAggregatedPayment,'id' => '3'])
                                                @include('admin.transaction.nchlAggregatedPayment.nchlAggregateResponse',['nchlAggregatedPayment' => $nchlAggregatedPayment,'id' => '4'])
                                                <a href="{{ route('nchl.aggregatedPayment.detail', $nchlAggregatedPayment->id) }}">
                                                    <button class="btn btn-primary btn-icon" type="button"><i
                                                            class="fa fa-eye"></i></button>
                                                </a>
                                            </td>
                                            <td>
                                                <form
                                                    action="{{ route('nchlAggregatedTransferApi.report', $nchlAggregatedPayment->transaction_id) }}"
                                                    method="post">
                                                    @csrf
                                                    <button class="btn btn-primary btn-icon" type="submit" title="API Details">
                                                        <i class="fa fa-database"></i></button>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $nchlAggregatedPayments->appends(request()->query())->links() }}
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
            let a = "Showing {{ $nchlAggregatedPayments->firstItem() }} to {{ $nchlAggregatedPayments->lastItem() }} of {{ $nchlAggregatedPayments->total() }} entries";
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


