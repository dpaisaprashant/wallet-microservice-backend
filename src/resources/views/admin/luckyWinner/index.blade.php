@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Winner Deposit Transactions</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Winner Deposit Transaction</strong>
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

                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('transaction.complete') }}" id="filter">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="uid" placeholder="User Transaction ID" class="form-control" value="{{ !empty($_GET['uid']) ? $_GET['uid'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="Email or number" class="form-control" value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="ionrange_amount">Amount</label>
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
                                                <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                    <option value="" selected disabled>Sort By...</option>
                                                    @if(!empty($_GET['sort']))
                                                        <option value="date" @if($_GET['sort'] == 'date') selected @endif>Latest Date</option>
                                                        <option value="amount" @if($_GET['sort'] == 'amount') selected @endif>Highest amount</option>
                                                    @else
                                                        <option value="date">Latest Date</option>
                                                        <option value="amount">Amount</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Select Vendor...." class="chosen-select"  tabindex="2" name="vendor">
                                                    <option value="" selected disabled>Select Vendor...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['vendor']))
                                                        @foreach($vendors as $vendor)
                                                            <option value="{{$vendor}}"
                                                                    @if($_GET['vendor']  == $vendor) selected @endif >{{$vendor}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($vendors as $vendor)
                                                            <option value="{{$vendor}}">{{$vendor}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2" name="service">
                                                    <option value="" selected disabled>Select Service Type...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['service']))
                                                        @foreach($serviceTypes as $serviceType)
                                                            <option value="{{ $serviceType }}" @if($_GET['service'] == $serviceType) selected @endif>{{ $serviceType }}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($serviceTypes as $serviceType)
                                                            <option value="{{ $serviceType }}"> {{ $serviceType }} </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('loadTestFund.index') }}"><strong>Filter</strong></button>
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
                        <h5>List of all winner deposit transactions</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Lucky winner transaction list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Admin</th>
                                    <th>UID</th>
                                    <th>Pre Transaction Id</th>
                                    <th>User</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Bonus Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $transaction)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + ($transactions->perPage() * ($transactions->currentPage() - 1)) + 1 }}</td>
                                        <td>{{ $transaction->admin_id }}</td>
                                        <td>{{ $transaction->uid ?? '---' }}</td>
                                        <td>{{ $transaction->pre_transaction_id ?? '---' }}</td>
                                        <td>
                                            <a  @can('User profile') href="{{route('user.profile', $transaction->user_id)}}" @endcan> {{ $transaction->user['mobile_no'] }} </a>
                                        </td>
                                        <td>
                                            {{ $transaction->description }}
                                        </td>
                                        <td class="center">Rs. {{ $transaction->amount }}</td>
                                        <td class="center">Rs. {{ $transaction->bonus_amount }}</td>
                                        <td class="center">{{ $transaction->created_at }}</td>
                                        <td>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $transactions->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>

    <!-- IonRangeSlider -->
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

    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection


