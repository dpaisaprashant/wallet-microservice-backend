@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Unverified Merchant KYC</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Merchant</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Unverified Merchant KYC Users</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">

        @include('admin.userFilter.user-filter',['title' => "Merchant",'excelRoute'=>"kyc.unverified.merchant.excel"])

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of Unverified KYC Merchant</h5>
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
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>User</th>
                                    <th>Contact Number</th>
                                    <th>Email</th>
                                    <th>Company Name</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($merchants as $key=>$merchant)
                                    <tr>
                                        <td>{{ $key+1 }}</td>

                                        <td>{{$merchant->name}}</td>

                                        <td>{{$merchant->mobile_no}}</td>

                                        <td>{{$merchant->email}}</td>

                                        <td>{{$merchant->kyc->company_name == null ? "Null" : $merchant->kyc->company_name}}</td>

                                        <td class="center">
                                            <a href="{{route('merchant.kyc.detail',$merchant->id)}}" class="btn btn-sm btn-primary m-t-n-xs"><strong>KYC</strong></a>
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

    <script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function () {
            $('.dataTables-example').DataTable({
                paging: false,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'Unverified KYC Users List'},
                    {extend: 'pdf', title: 'Unverified KYC Users List'},
                    {
                        extend: 'print',
                        customize: function (win) {
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

    {{--    <script>--}}
    {{--        $(document).ready(function (e) {--}}

    {{--            let a = "Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries";--}}

    {{--            $('.dataTables_info').text(a);--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection


