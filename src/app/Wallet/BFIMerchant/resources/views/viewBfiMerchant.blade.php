@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>BFI Merchant View</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>BFI Merchant</strong>
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
        @include('admin.asset.notification.notify')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of BFI Merchants</h5>
                        @can('Add BFI Merchant')
                            <a href="{{ route('bfi.create') }}" class="btn btn-sm btn-primary btn-xs"
                               style="float: right;margin-top: -5px;">Add BFI Merchant</a>
                        @endcan
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Merchant Name</th>
                                    <th>BFI Name</th>
                                    <th>Merchant type</th>
                                    <th>Merchant Mobile Number</th>
                                    <th>Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($merchantBFIs as $key=>$merchantBFI)
                                    <tr>
                                        <td> {{ $key+1 }}</td>
                                        <td> {{ $merchantBFI->merchant->name }}</td>
                                        <td> {{ $merchantBFI->bfiUser->bfi_name }}</td>
                                        <td><span
                                                class="badge badge-success"> {{ $merchantBFI->merchant->merchantType->name }} </span>
                                        </td>
                                        <td> {{$merchantBFI->merchant->mobile_no }}</td>
                                        <td>
                                            @can('Delete BFI Merchant')
                                            <form
                                                action=" {{ route('bfi.delete',$merchantBFI->id)  }}"
                                                method="post">
                                                @csrf
                                                <button
                                                    href="{{ route('bfi.delete',$merchantBFI->id) }}"
                                                    class="reset btn btn-sm btn-danger m-t-n-xs"
                                                    rel="{{ $merchantBFI->id }}"><i
                                                        class="fa fa-trash"></i>
                                                </button>

                                                <button id="resetBtn-{{ $merchantBFI->id }}"
                                                        style="display: none" type="submit"
                                                        href="{ route('bfi.delete',$merchantBFI->id) }}"
                                                        class="resetBtn btn btn-sm btn-danger m-t-n-xs">
                                                    <i class="fa fa-trash"></i></button>
                                            </form>
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

    <script src="{{ asset('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
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

    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
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

    {{--    <script>--}}
    {{--        $(document).ready(function (e) {--}}

    {{--            let a = "Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} entries";--}}

    {{--            $('.dataTables_info').text(a);--}}
    {{--        });--}}
    {{--    </script>--}}
@endsection


