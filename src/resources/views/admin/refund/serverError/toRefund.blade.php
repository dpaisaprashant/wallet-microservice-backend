@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Potential Transactions to Refund</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Transactions</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Potential Transactions to Refund</strong>
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
                        <h5>List of potential transactions to refund</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="potential-transaction-to-refund">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Pre Transaction Id</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Vendor</th>
                                    <th>Status</th>
                                    <th>Microservice Type</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($disputedPreTransactions as $preTransaction)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + ($disputedPreTransactions->perPage() * ($disputedPreTransactions->currentPage() - 1)) + 1 }}</td>
                                        <a  @can('User profile') href="{{route('user.profile', $preTransaction->user_id)}}" @endcan> {{ $preTransaction->user['mobile_no'] }} </a>
                                        <td>{{ $preTransaction->pre_transaction_id }}</td>
                                        <td>{{ $preTransaction->amount }}</td>
                                        <td>
                                            {{ $preTransaction->description }}
                                        </td>
                                        <td class="center">{{ $preTransaction->vendor }}</td>
                                        <td class="center">{{ $preTransaction->status }}</td>
                                        <td class="center">{{ $preTransaction->created_at }}</td>
                                        <td>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $disputedPreTransactions->appends(request()->query())->links() }}
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
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $disputedPreTransactions->firstItem() }} to {{ $disputedPreTransactions->lastItem() }} of {{ $disputedPreTransactions->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>

@endsection


