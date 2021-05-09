@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Fund Request</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Fund Request</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Fund Request</h5>
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
                                        {{--<div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="Transaction ID" class="form-control" value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
                                            </div>
                                        </div>--}}
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="from_user" placeholder="From User Email or Number" class="form-control" value="{{ !empty($_GET['from_user']) ? $_GET['from_user'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="to_user" placeholder="To User Email or Number" class="form-control" value="{{ !empty($_GET['to_user']) ? $_GET['to_user'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                        <option value="" selected disabled>Sort By...</option>
                                                        @if(!empty($_GET['sort']))
                                                            <option value="request_date" @if($_GET['sort'] == 'request_date') selected @endif>Request Date</option>
                                                            <option value="response_date" @if($_GET['sort'] == 'response_date') selected @endif>Latest Date</option>
                                                            <option value="amount" @if($_GET['sort'] == 'amount') selected @endif>Highest amount</option>
                                                        @else
                                                            <option value="request_date">Request Date</option>
                                                            <option value="response_date">Response Date</option>
                                                            <option value="amount">Amount</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-md-3" style="padding-top: 15px;">
                                            <label for="request_status">Request Status</label>
                                            <div class="form-group">
                                                <select name="request_status" data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                    <option value="" selected disabled>Select Request Status...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['request_status']))
                                                        <option value="successful" @if($_GET['request_status']  == 'successful') selected @endif>Successful</option>
                                                        <option value="failed" @if($_GET['request_status']  == 'failed') selected @endif>Failed</option>
                                                    @else
                                                        <option value="successful">Successful</option>
                                                        <option value="failed">Failed</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="padding-top: 15px;">
                                            <label for="response_status">Response Status</label>
                                            <div class="form-group">
                                                <select name="response_status" data-placeholder="Choose transaction status..." class="chosen-select"  tabindex="2">
                                                    <option value="" selected disabled>Select Response Status...</option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['response_status']))
                                                        <option value="accepted" @if($_GET['response_status']  == 'accepted') selected @endif>Accepted</option>
                                                        <option value="rejected" @if($_GET['response_status']  == 'rejected') selected @endif>Rejected</option>
                                                        <option value="pending" @if($_GET['response_status']  == 'pending') selected @endif>Pending</option>
                                                    @else
                                                        <option value="accepted">Accepted</option>
                                                        <option value="rejected">Rejected</option>
                                                        <option value="pending">Pending</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 mt-3">
                                            <label for="ionrange_amount">Amount</label>
{{--                                            <input type="text" name="amount" class="ionrange_amount">--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control" placeholder="From Amount" name="from_amount" autocomplete="off" value="{{ !empty($_GET['from_amount']) ? $_GET['from_amount'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control" placeholder="To Amount" name="to_amount" autocomplete="off" value="{{ !empty($_GET['to_amount']) ? $_GET['to_amount'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <label for="request_date_load_from">Request Date From</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                 <i class="fa fa-calendar"></i>
                                             </span>
                                                <input id="request_date_load_from" type="text" class="form-control request_date_from" placeholder="From" name="request_from" autocomplete="off" value="{{ !empty($_GET['request_from']) ? $_GET['request_from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <label for="request_date_load_to">Request Date To</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                     <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="request_date_load_to" type="text" class="form-control request_date_to" placeholder="To" name="request_to" autocomplete="off" value="{{ !empty($_GET['request_to']) ? $_GET['request_to'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <label for="response_date_load_from">Response Date From</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="response_date_load_from" type="text" class="form-control response_date_from" placeholder="From" name="response_from" autocomplete="off" value="{{ !empty($_GET['response_from']) ? $_GET['response_from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3" style="padding-top: 40px;">
                                            <label for="response_date_load_to">Response Date To</label>
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="response_date_load_to" type="text" class="form-control response_date_to" placeholder="To" name="response_to" autocomplete="off" value="{{ !empty($_GET['response_to']) ? $_GET['response_to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('fundRequest') }}"><strong>Filter</strong></button>
                                    </div>
                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('fundRequest.excel') }}"><strong>Excel</strong></button>
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
                        <h5>List of fund requests</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Fund Request transaction list">
                                <thead>
                                <tr>
                                    <th>s.No.</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Amount</th>
                                    <th>Commission</th>
                                    <th>Request Status</th>
                                    <th>Respond Status</th>
                                    <th>Request Date</th>
                                    <th>Response Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($fundRequests as $fundRequest)
                                    <tr class="gradeC">
                                    <td>{{ $loop->index + ($fundRequests->perPage() * ($fundRequests->currentPage() - 1)) + 1 }}</td>
                                    <td>
                                        <a  @can('User profile') href="{{route('user.profile', $fundRequest->from_user)}}" @endcan>{{ $fundRequest->fromUser['mobile_no'] }}</a>
                                    </td>
                                    <td>
                                        <a  @can('User profile') href="{{route('user.profile', $fundRequest->to_user)}}" @endcan>{{ $fundRequest->toUser['mobile_no'] }}</a>
                                    </td>
                                    <td class="center">Rs.{{ $fundRequest->amount }}</td>
                                    <td class="center">Rs.{{ optional($fundRequest->commission)['before_amount'] - optional($fundRequest->commission)['after_amount'] }}</td>

                                    <td>
                                        @include('admin.transaction.fundRequest.requestStatus', ['transaction' => $fundRequest])
                                    </td>

                                    <td>
                                        @include('admin.transaction.fundRequest.responseStatus', ['transaction' => $fundRequest])
                                    </td>
                                    <td class="center">
                                        {{ $fundRequest->created_at }}
                                    </td>
                                    <td class="center">
                                        @if(!is_null($fundRequest->response))
                                            {{ $fundRequest->updated_at }}
                                        @endif
                                    </td>
                                     <td>
                                        @include('admin.transaction.fundRequest.detail', ['transaction' => $fundRequest])
                                        @can('Fund request detail')
                                             <a href="{{ route('fundRequest.detail', $fundRequest->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
                                         @endcan
                                     </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $fundRequests->appends(request()->query())->links() }}
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    @include('admin.asset.css.datepicker')
@endsection

@section('scripts')

   @include('admin.asset.js.chosen')
    <!-- Date picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
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
                startDate:new Date(start_date),
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
                startDate:new Date(start_date),
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
            let a = "Showing {{ $fundRequests->firstItem() }} to {{ $fundRequests->lastItem() }} of {{ $fundRequests->total() }} entries";
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
@endsection
