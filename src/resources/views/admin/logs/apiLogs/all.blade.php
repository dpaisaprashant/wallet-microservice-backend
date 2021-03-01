@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>API Logs</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Logs</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>API Logs</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter API Logs</h5>
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
                                <form role="form" method="get" action="{{ route('apiLog.all') }}">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="user" placeholder="User mobile no"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user']) ? $_GET['user'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="check_payment_id" placeholder="check payment id"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['check_payment_id']) ? $_GET['check_payment_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="execute_payment_id" placeholder="execute payment id"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['execute_payment_id']) ? $_GET['execute_payment_id'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="refStan" placeholder="refStan"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['refStan']) ? $_GET['refStan'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="transaction_id" placeholder="transaction id"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['transaction_id']) ? $_GET['transaction_id'] : '' }}">
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

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit">
                                            <strong>Filter</strong></button>
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
                        <h5>List of API logs</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="API logs">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Message</th>
                                    <th>Context</th>
                                    <th>Exception</th>
                                    <th>level</th>
                                    <th>Date</th>
                                    <th>Check Payment ID</th>
                                    <th>Execute Payment ID</th>
                                    <th>RefStan</th>
                                    <th>Transaction ID</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + ($logs->perPage() * ($logs->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            {{ $log['user'] }}
                                        </td>
                                        <td>
                                            {{ $log->message }}
                                        </td>
                                        <td>
                                            @include('admin.logs.apiLogs.context', ['context' => $log->context])
                                        </td>

                                        <td>
                                            @if(isset($log->context['exception']))
                                                @include('admin.logs.apiLogs.exception', ['exception' => $log->context['exception']])
                                            @endif
                                        </td>

                                        <td>{{$log->level}}</td>
                                        <td>{{ $log->datetime }}</td>
                                        <td>{{ $log->check_payment_id }}</td>
                                        <td>{{ $log->execute_payment_id }}</td>
                                        <td>{{ $log->refStan }}</td>
                                        <td>{{ $log->transaction_id }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $logs->appends(request()->query())->links() }}
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
    <style>
        @media (min-width: 576px){}
            .modal-dialog {
                max-width: 700px;
            }
    </style>
@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>
@endsection
