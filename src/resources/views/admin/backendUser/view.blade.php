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
                    <strong>Admin Users</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        @include('admin.asset.notification.notify')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title collapse-link">
                        <h5>List of backend users</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="Backend user list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile No.</th>
                                    <th>Role</th>

                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr class="gradeX">
                                    <td>{{ $loop->index + ($users->perPage() * ($users->currentPage() - 1)) + 1 }}</td>
                                    <td>
                                        &nbsp;{{ $user->name }}
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile_no }}</td>
                                    <td class="center">
                                        @if(!empty($user->roles))
                                            <ul>
                                            @foreach($user->roles as $role)
                                                <li>{{ $role->name }}</li>
                                            @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="center">

                                        @can('Backend user update permission')
                                        <a href="{{ route('backendUser.permission', $user->id) }}" class="btn btn-sm btn-primary m-t-n-xs"><strong>Update permissions</strong></a>
                                        @endcan

                                        @can('Backend user update role')
                                        <a href="{{ route('backendUser.role', $user->id) }}" class="btn btn-sm btn-info m-t-n-xs"><strong>Update Role</strong></a>
                                        @endcan

                                            <br><br>
                                        @can('Backend user reset password')
                                        <form action="{{ route('backendUser.resetPassword') }}" method="post">
                                            @csrf
                                            <input id="resetValue" type="hidden" name="admin_id" value="{{ $user->id }}">
                                            <button href="{{ route('backendUser.role', $user->id) }}" class="reset btn btn-sm btn-danger m-t-n-xs" rel="{{ $user->id }}"><strong>Reset Password</strong></button>
                                            <button id="resetBtn-{{ $user->id }}" style="display: none" type="submit" href="{{ route('backendUser.role', $user->id) }}"  class="resetBtn btn btn-sm btn-danger m-t-n-xs"><strong>Reset Password</strong></button>
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
    @include('admin.asset.css.datatable')
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('scripts')

    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "This user's password will be changed to 'password'",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, reset password",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>

    @include('admin.asset.js.datatable')

    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>
@endsection


