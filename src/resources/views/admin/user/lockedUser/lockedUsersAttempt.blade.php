@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Locked Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Users</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>{{ $user['name'] }} Login attempts</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        {{--Filter section--}}

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title" >

                        <h5 style="float:left;">List of login attempts</h5>
                        
                        @can('Locked user login attempts view')                        
                        <form action="{{ route('user.loginAttemptsUpdateBulk',$user->id) }}" method="post">
                            @csrf      
                            <button title="Unlock User" rel="{{ $user->id }}" class="resetB btn btn-sm btn-primary btn-xs" style="float:right;"><i class="fa fa-unlock"><i class="fa fa-user"></i></i> Unlock</button>
                            <button id="resetBtnB-{{ $user->id }}" style="display: none" type="submit" href="{{ route('user.loginAttemptsUpdateBulk', $user->id) }}"  class="resetBtn"></button>
                        </form>                             
                        @endcan
                        
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Login attempts - {{ $user['name'] }}">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Public IP</th>
                                    <th>Server IP</th>
                                    <th>Device</th>
                                    <th>User Agent</th>
                                    <th>Description</th>
                                    <th>Date Time</th>
                                    <th>Status</th>
                                    <th>Tmp Enabled</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attempts as $attempt)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($attempts->perPage() * ($attempts->currentPage() - 1)) + 1 }}</td>
                                        <td>{{ $attempt->public_ip }}</td>
                                        <td>{{ $attempt->server_ip }}</td>
                                        <td>{{ $attempt->device }}</td>
                                        <td>{{ $attempt->user_agent }}</td>
                                        <td>{{ $attempt->description }}</td>
                                        <td>{{ $attempt->created_at }}</td>
                                        <td>
                                            @if($attempt->status == 1 && $attempt->tmp_enabled == 0)
                                                <span class="badge badge-primary">SUCCESSFUL</span>
                                            @elseif($attempt->status == 1 && $attempt->tmp_enabled == 1)
                                                <span class="badge badge-info">CHANGED</span>
                                            @else
                                                <span class="badge badge-danger">UNSUCCESSFUL</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($attempt->tmp_enabled == 0)
                                                <span class="badge badge-danger">NOT ENABLED</span>
                                            @else
                                                <span class="badge badge-primary">ENABLED</span>
                                            @endif
                                            {{ $attempt->tmp_emabled }}
                                        </td>
                                        <td>
                                            @if($attempt->tmp_enabled === 0)
                                            @can('Locked user login attempt enable')
                                            <form action="{{ route('user.loginAttemptsUpdate') }}" method="post">
                                                @csrf
                                                <input id="attempt_id" type="hidden" name="attempt_id" value="{{ $attempt->id }}">
                                                <button title="Unlock User" rel="{{ $attempt->id }}" class="reset btn btn-sm btn-icon btn-primary m-t-n-xs"><i class="fa fa-refresh"></i></button>
                                                <button id="resetBtn-{{ $attempt->id }}" style="display: none" type="submit" href="{{ route('user.loginAttemptsUpdate') }}"  class="resetBtn"></button>
                                            </form>
                                            @endcan
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $attempts->appends(request()->query())->links() }}
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
    <!-- Sweet Alert -->
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "This user's attempt will be enabled",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, enable login attempt",
                closeOnConfirm: false
            }, function () {
                console.log(userId);
                $('#resetBtn-' + userId).trigger('click');
                swal.close();
            })
        });
    </script>
    <script>
        $('.resetB').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "This user will be enabled",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, Enable User",
                closeOnConfirm: false
            }, function () {
                console.log(userId);
                $('#resetBtnB-' + userId).trigger('click');
                swal.close();
            })
        });
    </script>
    @include('admin.asset.js.datatable')
    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $attempts->firstItem() }} to {{ $attempts->lastItem() }} of {{ $attempts->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>
@endsection
