@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Magnus Linked Accounts</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Magnus Linked Accounts</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Magnus Linked Accounts</strong>
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
                        <h5>Filter Magnus Linked Accounts</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text" class="form-control date_from" placeholder="From" name="from" autocomplete="off"  value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_to" type="text" class="form-control date_to" placeholder="To" name="to" autocomplete="off"  value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group date" style="padding-top: 10px">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>

                                                <input  type="text" class="form-control date_from" placeholder="Date" name="date" autocomplete="off"  value="{{ !empty($_GET['date']) ? $_GET['date'] : '' }}">

                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group" style="padding-top: 10px">
                                                <select data-placeholder="Select Pre-Transaction status..."
                                                        class="chosen-select" tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status: </option>
                                                    <option value="">All</option>
                                                    @if(!empty($_GET['status']))
                                                        <option value="VERIFIED"
                                                                @if($_GET['status']  == 'VERIFIED') selected @endif >
                                                            Verified
                                                        </option>
                                                        <option value="UNVERIFIED"
                                                                @if($_GET['status'] == 'UNVERIFIED') selected @endif>
                                                            Unverified
                                                        </option>
                                                    @else
                                                        <option value="VERIFIED">VERIFIED</option>
                                                        <option value="UNVERIFIED">UNVERIFIED</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pre_transaction_id">Enter User Email or Mobile Number</label>
                                                <input type="text" name="user" placeholder="Enter user email/mobile"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('admin.magnus.linked-account') }}"><strong>Filter</strong></button>
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
                        <div class="row">
                            <div class = "col-3">
                                <h5>List of Magnus Linked Accounts</h5>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="User Login Sessions">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Customer Alias</th>
                                    <th>Deposit Account Holder ID</th>
                                    <th>Deposit Account ID</th>
                                    <th>Deposit Account Number</th>
                                    <th>Mobile Number</th>
                                    <th>Requesters Registered Mobile Number</th>
                                    <th>Requesters User Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>User</th>
{{--                                    <th>Actions</th>--}}
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($linked_accounts as $linked_account)
                                        <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$linked_account->customer_alias}}</td>
                                        <td>{{$linked_account->dep_acc_holder_id}}</td>
                                        <td>{{$linked_account->dep_acc_id}}</td>
                                        <td>{{$linked_account->dep_acc_no}}</td>
                                        <td>{{$linked_account->mobile_no}}</td>
                                        <td>{{$linked_account->requester_registered_mobile_no}}</td>
                                        <td>{{$linked_account->requester_user_name}}</td>
                                        <td>{{$linked_account->status}}</td>
                                        <td>{{$linked_account->tx_date_ad}}</td>
                                        <td>{{$linked_account->user->mobile_no . "-" . $linked_account->user->name}}</td>
{{--                                        <td>--}}
{{--                                            <a style="margin-top: 5px;"--}}
{{--                                               href="#"--}}
{{--                                               class="btn btn-sm btn-icon btn-primary m-t-n-xs"--}}
{{--                                               title="user profile"><i class="fa fa-eye"></i></a>--}}
{{--                                        </td>--}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @isset($linked_accounts)
                                {{ $linked_accounts->appends(request()->query())->links()}}
                            @endisset
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
    @include('admin.asset.css.datepicker')
@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    @isset($linked_accounts)
        <script>
            $(document).ready(function (e) {
                let a = "Showing {{ $linked_accounts->firstItem() }} to {{ $linked_accounts->lastItem() }} of {{ $linked_accounts->total() }} entries";
                $('.dataTables_info').text(a);
            });
        </script>
    @endisset
@endsection
