@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Fund Transfer</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Fund Transfer</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Fund Transfer</h5>
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
                                                <input type="text" name="from_user" placeholder="From User Name or Email" class="form-control" value="{{ !empty($_GET['from_user']) ? $_GET['from_user'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="to_user" placeholder="To User Name or Email" class="form-control" value="{{ !empty($_GET['to_user']) ? $_GET['to_user'] : '' }}">
                                            </div>
                                        </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select data-placeholder="Sort By..." class="chosen-select"  tabindex="2" name="sort">
                                                        <option value="" selected disabled>Sort By...</option>
                                                        @if(!empty($_GET['sort']))
                                                            <option value="date" @if($_GET['sort'] == 'date') selected @endif>Latest Date</option>
                                                            <option value="amount" @if($_GET['sort'] == 'amount') selected @endif>Highest amount</option>
                                                        @else
                                                            <option value="date">Date</option>
                                                            <option value="amount">Amount</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mt-3">
                                            <label for="ionrange_balance">Fund</label>
{{--                                            <input type="text" name="fund" class="ionrange_fund" value="{{ !empty($_GET['fund']) ? $_GET['fund'] : '' }}">--}}
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control" placeholder="From Fund" name="from_fund" autocomplete="off" value="{{ !empty($_GET['from_fund']) ? $_GET['from_fund'] : '' }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-dollar"></i>
                                                </span>
                                                        <input type="number" class="form-control" placeholder="To Fund" name="to_fund" autocomplete="off" value="{{ !empty($_GET['to_fund']) ? $_GET['to_fund'] : '' }}">
                                                    </div>
                                                </div>
                                            </div>
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
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('transaction.userToUserFundTransfer') }}"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('fundTransfer.excel') }}"><strong>Excel</strong></button>
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
                        <h5>List of fund transfer transaction</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="User to user fund transfer list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Fund</th>
                                    <th>Commission</th>
                                    <th>Transfer Date</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($fundTransfers as $fundTransfer)
                                    <tr class="gradeC">
                                    <td>{{ $loop->index + ($fundTransfers->perPage() * ($fundTransfers->currentPage() - 1)) + 1 }}</td>
                                    <td>
                                        <a  @can('User profile') href="{{route('user.profile', $fundTransfer->from_user)}}" @endcan> {{ $fundTransfer->fromUser['mobile_no'] ?? ''}} </a>
                                    </td>
                                    <td>
                                        <a  @can('User profile') href="{{route('user.profile', $fundTransfer->to_user)}}" @endcan> {{ $fundTransfer->toUser['mobile_no'] }} </a>
                                    </td>
                                    <td class="center">Rs.{{ $fundTransfer->amount }}</td>

                                    <td>Rs. {{ optional($fundTransfer->commission)['before_amount'] - optional($fundTransfer->commission)['after_amount'] }}</td>

                                    <td class="center">
                                        {{ $fundTransfer->created_at }}
                                    </td>

                                     <td>
                                        @include('admin.transaction.fundTransfer.detail', ['transaction' => $fundTransfer])
                                        @can('Fund transfer detail')
                                            <a href="{{ route('userToUserFundTransfer.detail', $fundTransfer->id) }}"><button class="btn btn-primary btn-icon" type="button"><i class="fa fa-eye"></i></button></a>
                                        @endcan
                                     </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                            {{ $fundTransfers->appends(request()->query())->links() }}
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
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $fundTransfers->firstItem() }} to {{ $fundTransfers->lastItem() }} of {{ $fundTransfers->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>
    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = @if(!empty($_GET['fund'])) `{{ $_GET['fund'] }}`; @else '0;100000'; @endif
        let split = amount.split(';');
        $(".ionrange_fund").ionRangeSlider({
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
