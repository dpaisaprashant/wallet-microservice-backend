@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Khalti</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Khalti</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Khalti Transactions</h5>
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


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or Number"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
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

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose vendor..."
                                                        class="chosen-select" tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="All">All</option>
                                                    @if(!empty($_GET['vendor']))
                                                        @foreach($vendorNames as $vendorName)
                                                            <option value="{{$vendorName}}"
                                                                    @if($_GET['vendor'] == $vendorName) selected @endif>{{$vendorName}}
                                                            </option>
                                                        @endforeach

                                                    @else

                                                        @foreach($vendorNames as $vendorName)
                                                            <option value="{{$vendorName}}">{{$vendorName}}</option>
                                                        @endforeach

                                                    @endif
                                                </select>
                                            </div>
                                        </div>



                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                            <label for="ionrange_balance">Amount</label>
                                            {{--                                            <input type="text" name="amount" class="ionrange_amount">--}}
                                            <div class="row">
                                                <div class="col-md-6">
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

                                                <div class="col-md-6">
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
                                        </div>
                                        <div class="col-md-6 mt-3">
                                            <label for="ionrange_balance">Reference Number</label>
                                            {{--                                            <input type="text" name="amount" class="ionrange_amount">--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                        <input type="number" class="form-control"
                                                               placeholder="Reference Number" name="reference_no"
                                                               autocomplete="off"
                                                               value="{{ !empty($_GET['reference_no']) ? $_GET['reference_no'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('khalti.transaction') }}"><strong>Filter</strong>
                                        </button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"
                                                type="submit" style="margin-right: 10px;"
                                                formaction="{{ route('npay.excel') }}"><strong>Excel</strong></button>
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
                            <h5>List of Khalti transactions</h5>
                        </div>
                        <div class="ibox-content">
                            <h5><b>Total Count:</b> {{ $khaltiTotalTransactionCount }}</h5>
                            <h5><b>Total Amount Sum:</b> Rs. {{ $khaltiTotalTransactionSum }}</h5>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Khalti transactions list">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>Mobile no</th>
                                        <th>Message</th>
                                        <th>Reference No</th>
                                        <th>Service</th>
                                        <th>Vendor</th>
                                        <th>Status</th>
                                        <th>State</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($khaltiTransactions as $khaltiTransaction)
                                        <tr>
                                            <td>{{ $loop->index + ($khaltiTransactions->perPage() * ($khaltiTransactions->currentPage() - 1)) + 1 }}</td>
                                            <td>{{ $khaltiTransaction->account }}</td>
                                            <td>Rs

                                                {{$khaltiTransaction->amount}}

                                            </td>
                                            <td> <a @can('User profile') href="{{route('user.profile', optional($khaltiTransaction->user)->id)}}" @endcan>{{ optional($khaltiTransaction->user)->mobile_no }}</a></td>
                                            <td>{{$khaltiTransaction->message}}</td>
                                            <td>{{$khaltiTransaction->reference_no}}</td>
                                            <td>{{$khaltiTransaction->service}}</td>
                                            <td>{{$khaltiTransaction->vendor}}</td>
                                            <td>{{$khaltiTransaction->status}}</td>
                                            <td>@include('admin.transaction.khalti.state',['khaltiTransaction' => $khaltiTransaction])</td>
                                            <td>
                                                @can('View khalti detail page')
                                                    <a href="{{ route('khalti.specific',$khaltiTransaction->id) }}"
                                                       class="btn btn-icon btn-sm btn-primary"><i class="fa fa-eye"></i></a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                                {{ $khaltiTransactions->appends(request()->query())->links() }}
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
    @include('admin.asset.css.datatable')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    @include('admin.asset.css.datepicker')

@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $khaltiTransactions->firstItem() }} to {{ $khaltiTransactions->lastItem() }} of {{ $khaltiTransactions->total() }} entries";
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
@endsection
