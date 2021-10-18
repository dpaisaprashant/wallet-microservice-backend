@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        @include('admin.asset.notification.notify')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Agents</h5>
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Enter Agent Name"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['name']) ? $_GET['name'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="agent_number_email" placeholder="Enter Agent Number or Email"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['agent_number_email']) ? $_GET['agent_number_email'] : '' }}">
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <input type="text" name="parent_agent" placeholder="Enter Parent Agent Name"
                                                   class="form-control"
                                                   value="{{ !empty($_GET['parent_agent']) ? $_GET['parent_agent'] : '' }}">
                                        </div>

                                        <div class="col-md-3">
                                            <input type="text" name="parent_agent_number_email" placeholder="Enter Parent-Agent Number or Email"
                                                   class="form-control"
                                                   value="{{ !empty($_GET['parent_agent_number_email']) ? $_GET['parent_agent_number_email'] : '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_from" type="text" class="form-control date_from"
                                                       placeholder="From" name="from_agent_created_at" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                <input id="date_load_to" type="text" class="form-control date_to"
                                                       placeholder="To" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-4" style="padding-bottom: 15px; padding-top: 15px; ">
                                            <select name="agent_status" class="form-control">
                                                <option value="" disabled selected>--- Filter by Agent Status ---</option>
                                                @foreach($agentStatus as $agent_status)
                                                    @if(!empty($_GET['agent_status']))
                                                        @if($_GET['agent_status'] == $agent_status->status)
                                                            <option value="{{$agent_status->status}}" selected>{{$agent_status->status}}</option>
                                                        @else
                                                            <option value="{{$agent_status->status}}">{{$agent_status->status}}</option>
                                                        @endif
                                                    @else
                                                        <option value="{{$agent_status->status}}">{{$agent_status->status}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('agent.view') }}"><strong>Filter</strong></button>
                                    </div>

                                    {{--<div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>
                                    </div>--}}
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
                        <h5>List of registered users</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="SajiloPay user's list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Agent</th>
                                    <th>Agent Type</th>
                                    <th>Parent Agent</th>
                                    <th>Contact Number</th>
                                    <th>Institution Type</th>
                                    <th>Business Name</th>
                                    <th>Business PAN</th>
                                    {{-- <th>Cash Out Type | Value </th>
                                     <th>Cash In Type | Value </th>--}}
                                    {{--<th>Business Doc</th>--}}
                                    {{--<th>Email</th>--}}
                                    <th>Agent status</th>
                                    <th>Reference Code</th>
                                    <th>Wallet Balance</th>
                                    <th>Agent Created At</th>
                                    {{--<th>Total <br>Payment Amount</th>
                                    <th>Total <br>Loaded Amount</th>--}}
                                    {{-- <th>No. of <br>Transactions</th>--}}
                                  {{--  <th>Total <br>CashBack Amount</th>--}}
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)

                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($users->perPage() * ($users->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            {{--<img alt="image"  src="img/profile_small.jpg" style="">--}}
                                            <a @can('User profile') href="{{route('user.profile', $user->id)}}" @endcan>{{ $user->name}}
                                                <br>
                                                {{$user->email}}
                                            </a>
                                        </td>
                                        <td>
                                            {{ ucwords(strtolower(optional(optional($user->agent)->agentType)->name)) }}
                                        </td>
                                        <td>
                                            <b>Name: </b> {{ optional(optional($user->agent)->codeUsed)->name ?? ""}}
                                            <br>
                                            <b>Email: </b> {{optional(optional($user->agent)->codeUsed)->email ?? ""}}
                                            <br>
                                            <b>Number: </b> {{optional(optional($user->agent)->codeUsed)->mobile_no ?? ""}}

                                        </td>
                                        <td>
                                            @if(!empty($user->phone_verified_at))
                                                <i class="fa fa-check-circle" style="color: green;"></i>
                                                &nbsp;{{ $user->mobile_no }}
                                            @else
                                                <i class="fa fa-times-circle" style="color: red;"></i>
                                                &nbsp;{{ $user->mobile_no }}
                                            @endif
                                        </td>
                                        <td>{{ $user->agent->institution_type ?? "" }}</td>
                                        <td>
                                            {{ $user->agent->business_name }}
                                        </td>
                                        <td>
                                            {{ $user->agent->business_pan }}
                                        </td>
                                        {{--<td>
                                            @isset($user->agent['business_document'])
                                                <img src="{{ config('dpaisa-api-url.agent_url') . $user->agent['business_document'] }}" style="width: 40%">
                                            @endisset
                                        </td>--}}
                                        {{--<td>
                                            {{ $user->agent->cash_out_type }} | {{ $user->agent->cash_out_type == 'FLAT' ? 'Rs.' . ($user->agent->cash_out_value ?? 0) / 100 :  $user->agent->cash_out_value}}
                                        </td>

                                        <td>
                                            {{ $user->agent->cash_in_type }} | {{ $user->agent->cash_in_type == 'FLAT' ? 'Rs.' . ($user->agent->cash_in_value ?? 0) / 100 :  $user->agent->cash_in_value}}

                                        </td>--}}
                                        <td>
                                            @include('admin.agent.status', ['agent' => $user->agent])
                                        </td>
                                        <td>
                                            {{ $user->agent->reference_code }}
                                        </td>
                                        <td>Rs. {{ $user->wallet->balance }}</td>


{{--
                                        <td>Rs. {{ $user->getTotalPaymentAmount() }}</td>

                                        <td>Rs. {{ $user->getTotalLoadedAmount() }}</td>--}}

                                        {{--<td>{{ count($user->userTransactionEvents) }}</td>--}}

                                        {{--<td>Rs. {{ $user->getTotalCashBack() }}</td>--}}
                                        <td>{{ \Carbon\Carbon::parse($user->agent->created_at)->format('F d Y') }}</td>

                                        <td class="center">
                                            @if(auth()->user()->hasAnyPermission(['User profile','View agent profile']))
                                                    <a style="margin-top: 5px;"
                                                       href="{{route('user.profile', $user->id)}}"
                                                       class="btn btn-sm btn-icon btn-primary m-t-n-xs"
                                                       title="user profile"><i class="fa fa-eye"></i></a>
                                            @endif
                                            @can('User transactions')
                                                <a style="margin-top: 5px;"
                                                   href="{{route('user.transaction', $user->id)}}"
                                                   class="btn btn-sm btn-icon btn-info m-t-n-xs"
                                                   title="user transactions"><i class="fa fa-credit-card"></i></a>
                                            @endcan

                                            @can('Agent edit')
                                                <a style="margin-top: 5px;" href="{{route('agent.edit', $user->agent->id)}}"
                                                   class="btn btn-sm btn-icon btn-success m-t-n-xs" title="Edit Agent"><i
                                                        class="fa fa-edit"></i></a>
                                            @endcan

                                            @can('Agent delete')
                                                <form action="{{ route('agent.delete', $user->id) }}" method="post">
                                                    @csrf
                                                    <button style="margin-top: 5px;"
                                                            class="reset btn btn-sm btn-icon btn-danger m-t-n-xs"
                                                            rel="{{ $user->id }}"><i class="fa fa-trash"></i></button>
                                                    <button id="resetBtn-{{ $user->id }}" style="display: none"
                                                            type="submit"><strong>Reset Password</strong></button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $users->appends(request()->query())->links() }}
                        </div>

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
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

@endsection

@section('scripts')

    @include('admin.asset.js.datepicker')

    @include('admin.asset.js.chosen')

    @include('admin.asset.js.datatable')

    <script>
        $(document).ready(function (e) {

            let a = "Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries";

            $('.dataTables_info').text(a);
        });
    </script>


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>

    <script>
        let walletAmount = @if(!empty($_GET['wallet_balance'])) `{{ $_GET['wallet_balance'] }}`;
        @else '0;100000'; @endif
        let split = walletAmount.split(';');


        $(".ionrange_wallet_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = @if(!empty($_GET['transaction_payment'])) `{{ $_GET['transaction_payment'] }}`;
        @else '0;100000';
        @endif
            split = walletAmount.split(';');

        $(".ionrange_payment_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });

        walletAmount = @if(!empty($_GET['transaction_loaded'])) `{{ $_GET['transaction_loaded'] }}`;
        @else '0;100000';
        @endif
            split = walletAmount.split(';');

        $(".ionrange_loaded_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });


        walletAmount = @if(!empty($_GET['transaction_number'])) `{{ $_GET['transaction_number'] }}`;
        @else '0;1000';
        @endif
            split = walletAmount.split(';');

        $(".ionrange_number").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 1000,
            from: split[0],
            to: split[1],
        });


    </script>

    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "This user will be removed from agent",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, remove",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>
@endsection





