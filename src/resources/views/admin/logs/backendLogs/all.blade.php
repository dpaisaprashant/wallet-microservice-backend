@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Backend Logs</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Logs</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Backend Logs</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>Filter Backend Logs</h5>
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
                                <form role="form" method="get" action="{{ route('backendLog.all') }}">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" name="log_name" placeholder="Log Name"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['log_name']) ? $_GET['log_name'] : '' }}">
                                            </div>
                                        </div>

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
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit">
                                            <strong>Filter</strong></button>
                                    </div>
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
                        <h5>List of Backend logs</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Backend logs">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Log Name</th>
                                    <th>Description</th>
                                    <th>User</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>New Properties</th>
                                    <th>Old Properties</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + ($logs->perPage() * ($logs->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            {{ $log->log_name }}
                                        </td>
                                        <td>
                                            {{ $log->description }}
                                        </td>
                                        <td>
                                            {{ $log->causer['email']}}
                                        </td>

                                        <td class="center">{{ $log->created_at }}</td>

                                        <td class="center">{{ $log->updated_at }}</td>

                                        <td>
                                            <a data-toggle="modal" href="#modal-form-new{{$log->id}}">
                                                <button class="btn btn-warning btn-icon" type="button"><i
                                                        class="fa fa-info"></i></button>
                                            </a>
                                            <div id="modal-form-new{{ $log->id }}" class="modal fade"
                                                 aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h3 class="m-t-none m-b">NEW PROPERTIES</h3>
                                                                    <hr>
                                                                    <dl class="row m-t-md">
                                                                        <?php $properties = json_decode($log->properties, true); ?>
                                                                        @foreach($properties['attributes'] as $key => $value)
                                                                            <dt class="col-md-6 text-right">{{ $key }}</dt>
                                                                            <dd class="col-md-6">{{ $value }}</dd>
                                                                        @endforeach
                                                                    </dl>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            @isset($properties['old'])
                                                <a data-toggle="modal" href="#modal-form-old{{$log->id}}">
                                                    <button class="btn btn-warning btn-icon" type="button"><i
                                                            class="fa fa-info"></i></button>
                                                </a>
                                                <div id="modal-form-old{{ $log->id }}" class="modal fade"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <h3 class="m-t-none m-b">OLD PROPERTIES</h3>
                                                                        <hr>
                                                                        <dl class="row m-t-md">
                                                                            <?php $properties = json_decode($log->properties, true); ?>
                                                                            @isset($properties['old'])
                                                                                @foreach($properties['old'] as $key => $value)
                                                                                    <dt class="col-md-6 text-right">{{ $key }}</dt>

                                                                                    <dd class="col-md-6">{{ $value }}</dd>
                                                                                @endforeach
                                                                            @endisset
                                                                        </dl>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endisset
                                        </td>
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
