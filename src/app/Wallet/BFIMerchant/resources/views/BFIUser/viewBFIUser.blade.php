@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>BFI User View</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>BFI User</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        {{--        <div class="row">--}}
        {{--            <div class="col-lg-12">--}}
        {{--                <div class="ibox ">--}}
        {{--                    <div class="ibox-title collapse-link">--}}
        {{--                        <h5>BFI Merchants</h5>--}}
        {{--                        <div class="ibox-tools">--}}
        {{--                            <a class="collapse-link">--}}
        {{--                                <i class="fa fa-chevron-up"></i>--}}
        {{--                            </a>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                    <div class="ibox-content"--}}
        {{--                         @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none" @endif>--}}
        {{--                        <div class="row">--}}
        {{--                            <div class="col-sm-12">--}}
        {{--                                <form role="form" method="get">--}}

        {{--                                    <div class="row">--}}
        {{--                                        <div class="col-md-4">--}}
        {{--                                            <div class="form-group">--}}
        {{--                                                <input type="text" name="name" placeholder="Enter User Name"--}}
        {{--                                                       class="form-control"--}}
        {{--                                                       value="{{ !empty($_GET['name']) ? $_GET['name'] : '' }}">--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                        <div class="col-md-4">--}}
        {{--                                            <div class="form-group">--}}
        {{--                                                <input type="text" name="number" placeholder="Enter Contact Number"--}}
        {{--                                                       class="form-control"--}}
        {{--                                                       value="{{ !empty($_GET['number']) ? $_GET['number'] : '' }}">--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                        <div class="col-md-4">--}}
        {{--                                            <input type="email" name="email" placeholder="Enter Email"--}}
        {{--                                                   class="form-control"--}}
        {{--                                                   value="{{ !empty($_GET['email']) ? $_GET['email'] : '' }}">--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                    <br>--}}
        {{--                                    <div>--}}
        {{--                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"--}}
        {{--                                                formaction="{{ route('user.unverifiedKYC.view') }}">--}}
        {{--                                            <strong>Filter</strong></button>--}}
        {{--                                    </div>--}}

        {{--                                    <div>--}}
        {{--                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"--}}
        {{--                                                type="submit" style="margin-right: 10px;"--}}
        {{--                                                formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>--}}
        {{--                                    </div>--}}
        {{--                                    @include('admin.asset.components.clearFilterButton')--}}
        {{--                                </form>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of BFI User</h5>
                        @can('Add BFI user')
                            <a href="{{ route('bfi.user.create') }}" class="btn btn-sm btn-primary btn-xs"
                               style="float: right;margin-top: -5px;">Add BFI User</a>
                        @endcan

                    </div>
                    @include('admin.asset.notification.notify')
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-data table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>BFI Id</th>
                                    <th>BFI Name</th>
                                    <th>API Username</th>
                                    <th>Portal Username</th>
                                    <th>Email</th>
                                    <th>IPs</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($bfiUsers as $key=>$bfiUser)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $bfiUser->bfi_id }}</td>
                                        <td>{{ $bfiUser->bfi_name }}</td>
                                        <td>{{ $bfiUser->api_username }}</td>
                                        <td>{{ $bfiUser->portal_username }}</td>
                                        <td>{{ $bfiUser->email }}</td>
                                        <td>
                                            @if(isset($bfiUser->UserApprovedIp) == true)
                                                <ul>
                                                    @foreach($bfiUser->UserApprovedIp as $userApprovedIp)
                                                        <li>{{ $userApprovedIp->ip }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="" method="post">
                                                @csrf
                                                @if($bfiUser->status == 1)
                                                    <span class="badge badge-primary">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </form>
                                        </td>
                                        <td>
                                            @can('View secret key')
                                                @if(isset($bfiUser->UserApiDetail->secret_key) == true)
                                                    {{--                                            <a href="" id="secret-key" class="btn btn-icon btn-sm btn-warning"><i class="fa fa-eye"></i></a>--}}
                                                    @include('admin.include.secret',['secret' => $bfiUser->UserApiDetail->secret_key])
                                                @endif
                                            @endcan
                                            @can('Add ip')
                                                <a href="{{ route('bfi.ip.create',$bfiUser->id) }}" title="Add IPs"
                                                   class="btn btn-icon btn-sm btn-primary m-t-n-xs"><i
                                                        class="fa fa-plus"></i></a>
                                            @endcan
                                            @can('Edit BFI user status')
                                                <a href="{{ route('bfi.user.status.edit',$bfiUser->id) }}"
                                                   class="btn btn-sm btn-icon btn-info m-t-n-xs"
                                                   title="Change Status"><i
                                                        class="fa fa-edit"></i></a>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                            {{ $users->appends(request()->query())->links() }}--}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    @include('admin.asset.css.chosen')

    <style>
        .pagination {
            padding-top: -20px;
            padding-left: 15px;
        }

        .dataTables_wrapper {
            padding-bottom: 5px;
        }
    </style>

@endsection

@section('scripts')
    @include('admin.asset.js.chosen')

    @include('admin.asset.css.sweetalert')
    <!-- Page-Level Scripts -->
    @include('admin.asset.js.datatable')

    @include('admin.asset.js.sweetalert')
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let userId = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "BFI Merchant will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + userId).trigger('click');
                swal.close();

            })
        });
    </script>
    <script>

        $('.key').on('click', function (e) {
            e.preventDefault();
            var secret = $('input[name="secret-key"]').val();
            alert(secret);
            swal({
                title: 'Secret key',

            }, function () {
                swal.close();
            });
        });


    </script>

    {{--    <script>--}}
    {{--        $(document).ready(function (e) {--}}

    {{--            let a = "Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries";--}}

    {{--            $('.dataTables_info').text(a);--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection


