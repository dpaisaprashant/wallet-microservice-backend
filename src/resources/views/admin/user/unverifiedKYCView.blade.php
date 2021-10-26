@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Unverified KYC Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Users</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Unverified KYC Users</strong>
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
                        <h5>Filter Users</h5>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Enter User Name" class="form-control" value="{{ !empty($_GET['name']) ? $_GET['name'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="number" placeholder="Enter Contact Number" class="form-control" value="{{ !empty($_GET['number']) ? $_GET['number'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="email" name="email" placeholder="Enter Email" class="form-control" value="{{ !empty($_GET['email']) ? $_GET['email'] : '' }}">
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Choose User Type..." class="chosen-select"  tabindex="2" name="user_type">
                                                    <option value="" selected disabled>Sort By User Type</option>
                                                    <option value="" selected>All</option>
                                                    @if(!empty($_GET['user_type']))
                                                        @if($_GET['user_type'] == "normal_user")
                                                            <option value="normal_user" selected>Normal user</option>
                                                            <option value="agent">Agent</option>
                                                            <option value="merchant">Merchant</option>
                                                        @elseif($_GET['user_type'] == "agent")
                                                            <option value="normal_user">Normal user</option>
                                                            <option value="agent" selected>Agent</option>
                                                            <option value="merchant">Merchant</option>
                                                        @elseif($_GET['user_type'] == 'merchant')
                                                            <option value="normal_user">Normal user</option>
                                                            <option value="agent">Agent</option>
                                                            <option value="merchant" selected>Merchant</option>
                                                        @endif
                                                    @else
                                                        <option value="normal_user">Normal user</option>
                                                        <option value="agent">Agent</option>
                                                        <option value="merchant">Merchant</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit" formaction="{{ route('user.unverifiedKYC.view') }}"><strong>Filter</strong></button>
                                    </div>

                                    <div>
                                        <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('user.excel') }}"><strong>Excel</strong></button>
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
                        <h5>List of unverified KYC users</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($users->perPage() * ($users->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                            {{--<img alt="image"  src="img/profile_small.jpg" style="">--}}
                                            &nbsp;{{ $user->name }}
                                        </td>
                                        <td>{{ $user->mobile_no }}</td>
                                        <td class="center">{{ $user->email }}</td>
                                        <td>
                                            @include('admin.user.userType.displayUserTypes',['user' => $user])
                                        </td>
                                        <td class="center">
                                            @can('User KYC view')
                                            <a href="{{route('user.kyc', $user->id)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>KYC</strong></a>
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
    <link href="{{ asset('admin/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    @include('admin.asset.css.chosen')

    <style>
        .pagination{
            padding-top: -20px;
            padding-left: 15px;
        }

        .dataTables_wrapper{
            padding-bottom: 5px;
        }
    </style>

@endsection

@section('scripts')
   @include('admin.asset.js.chosen')

    <script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                paging: false,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Unverified KYC Users List'},
                    {extend: 'pdf', title: 'Unverified KYC Users List'},
                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');
                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]
            });
        });
    </script>

    <script>
        $(document).ready(function (e) {

            let a = "Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries";

            $('.dataTables_info').text(a);
        });
    </script>
@endsection


