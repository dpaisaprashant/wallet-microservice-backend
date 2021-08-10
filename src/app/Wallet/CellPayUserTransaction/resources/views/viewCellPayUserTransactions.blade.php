
@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Cell Pay User Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>View CellPay User Transactions</strong>
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
                        <h5>Filter CellPay User Transactions</h5>
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
                                                <input type="text" name="account" placeholder="Enter User Account"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['account']) ? $_GET['account'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm"
                                                   value="{{ !empty($_GET['user_number']) ? $_GET['user_number'] : '' }}"
                                                   name="user_number" placeholder="Enter User mobile Number">
                                        </div>


                                        <div class="col-md-4">
                                            <input type="text" name="reference_number" placeholder="Enter Reference Number"
                                                   class="form-control"
                                                   value="{{ !empty($_GET['reference_number']) ? $_GET['reference_number'] : '' }}">
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select data-placeholder="Select CellPay User Transaction status..."
                                                        class="chosen-select" tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status: </option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['status']))
                                                        <option value="true"
                                                                @if($_GET['status']  == 'true') selected @endif >
                                                            SUCCESS
                                                        </option>
                                                        <option value="false"
                                                                @if($_GET['status'] == 'false') selected @endif>
                                                            FAILED
                                                        </option>
                                                        <option value=""
                                                                @if($_GET['status'] == "null") selected @endif>
                                                            NULL
                                                        </option>
                                                    @else
                                                        <option value="true">SUCCESS</option>
                                                        <option value="false">FAILED</option>
                                                        <option value="null">NULL</option>

                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="service_type">Service Type</label>
                                                <select data-placeholder="Select Service Type" class="chosen-select"
                                                        tabindex="2" name="service_type">
                                                    <option value="" selected disabled>Select Service Type...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['service_type']))

                                                        @foreach($service_types as $service_type)
                                                            <option value="{{$service_type}}"
                                                                    @if($_GET['service_type']  == $service_type) selected @endif >{{$service_type}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($service_types as $service_type)
                                                            <option
                                                                value="{{$service_type}}">{{$service_type}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vendor">Vendor</label>
                                                <select data-placeholder="Select Vendor...." class="chosen-select"
                                                        tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['vendor']))

                                                        @foreach($vendors as $vendor)
                                                            <option value="{{$vendor}}"
                                                                    @if($_GET['vendor']  == $vendor) selected @endif >{{$vendor}}</option>
                                                        @endforeach

                                                    @else
                                                        @foreach($vendors as $vendor)
                                                            <option
                                                                value="{{$vendor}}">{{$vendor}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

{{--                                        <div class="col-md-3">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="sort">Sort</label>--}}
{{--                                                <select data-placeholder="Sort By..." class="chosen-select" tabindex="2"--}}
{{--                                                        name="sort">--}}
{{--                                                    <option value="">All</option>--}}
{{--                                                    <option value="" selected disabled>Sort By...</option>--}}
{{--                                                    @if(!empty($_GET['sort']))--}}
{{--                                                        <option value="date"--}}
{{--                                                                @if($_GET['sort'] == 'date') selected @endif>Latest Date--}}
{{--                                                        </option>--}}
{{--                                                        <option value="amount"--}}
{{--                                                                @if($_GET['sort'] == 'amount') selected @endif>Highest--}}
{{--                                                            amount--}}
{{--                                                        </option>--}}
{{--                                                    @else--}}
{{--                                                        <option value="date">Latest Date</option>--}}
{{--                                                        <option value="amount">Amount</option>--}}
{{--                                                    @endif--}}
{{--                                                </select>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}


                                        <div class="col-md-4" style="padding-bottom: 15px;">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From Date" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4" style="padding-bottom: 15px;">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To Date" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-10">
                                            <label>Cellpay User Transaction Amount</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="From Pre-Transaction Amount"
                                                               name="from_amount" autocomplete="off"
                                                               value="{{ !empty($_GET['from_cellPayUserTransaction_amount']) ? $_GET['from_cellPayUserTransaction_amount'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-dollar"></i>
                                                    </span>
                                                        <input type="number" class="form-control"
                                                               placeholder="To Pre-Transaction Amount"
                                                               name="to_amount" autocomplete="off"
                                                               value="{{ !empty($_GET['to_cellPayUserTransaction_amount']) ? $_GET['to_cellPayUserTransaction_amount'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('cellPayUserTransaction.view') }}"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>
                                    </div>
                                    @include('admin.asset.components.clearFilterButton')
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                @include('admin.asset.notification.notify')

                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example"
                               title="CellPay User Transactions list">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Account</th>
                                <th>User Mobile Number</th>
                                <th>Amount</th>
                                <th>Description</th>
                                <th>Reference Number</th>
                                <th>Vendor</th>
                                <th>Service type</th>
                                <th>Transaction Id</th>
                                <th>Transfer Type Id</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cellPayUserTransactions as $cellPayUserTransaction)
                                <tr class="gradeC">
                                    <td>{{$loop->index + ($cellPayUserTransactions->perPage() * ($cellPayUserTransactions->currentPage() - 1)) + 1 }}</td>
                                    <td>{{$cellPayUserTransaction->account}}</td>
{{--                                    <td>--}}
{{--                                        @foreach($preTransactions as $preTransaction)--}}
{{--                                                @if($cellPayUserTransaction->reference_no == $preTransaction->pre_transaction_id)--}}
{{--                                                    {{$preTransaction->cellPayUserTransaction->account}}--}}
{{--                                                @endif--}}
{{--                                        @endforeach--}}
{{--                                    </td>--}}
                                    <td>{{optional(optional($cellPayUserTransaction->preTransaction)->user)->mobile_no}}</td>
{{--                                    {{dd($cellPayUserTransaction)}}--}}
                                    <td>{{$cellPayUserTransaction->amount}}</td>
                                    <td>{{$cellPayUserTransaction->description}}</td>
                                    <td>{{$cellPayUserTransaction->reference_no}}</td>
                                    <td>{{$cellPayUserTransaction->vendor}}</td>
                                    <td>{{$cellPayUserTransaction->service_type}}</td>
                                    <td>{{$cellPayUserTransaction->transaction_id}}</td>
                                    <td>{{$cellPayUserTransaction->trasfer_type_id}}</td>
                                    <td>{{$cellPayUserTransaction->created_at}}</td>
                                    <td>
                                        @if($cellPayUserTransaction->status=="false")
                                            <span class="badge badge-danger">{{$cellPayUserTransaction->status}}</span>
                                        @elseif($cellPayUserTransaction->status=="true")
                                            <span class="badge badge-primary">{{$cellPayUserTransaction->status}}</span>
                                        @else
                                            <span class="badge badge-secondary">Null</span>
                                        @endif
                                    </td>
                                    <td>
                                        @include('CellPayUserTransaction::specialsCellPayUserTransactions',['$cellPayUserTransaction'=>$cellPayUserTransaction])
                                        @include('CellPayUserTransaction::errorDataCellPayUserTransactions',['$cellPayUserTransaction'=>$cellPayUserTransaction])
                                        @include('CellPayUserTransaction::otherInfoCellPayUserTransactions',['$cellPayUserTransaction'=>$cellPayUserTransaction])
                                        @include('CellPayUserTransaction::jsonRequestCellPayUserTransactions',['$cellPayUserTransaction'=>$cellPayUserTransaction])
                                        @include('CellPayUserTransaction::jsonResponseCellPayUserTransactions',['$cellPayUserTransaction'=>$cellPayUserTransaction])

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $cellPayUserTransactions->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@section('styles')


    @include('admin.asset.css.datepicker')

    @include('admin.asset.css.chosen')

    @include('admin.asset.css.datatable')

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')


    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $cellPayUserTransactions->firstItem() }} to {{ $cellPayUserTransactions->lastItem() }} of {{ $cellPayUserTransactions->total() }} entries";
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

