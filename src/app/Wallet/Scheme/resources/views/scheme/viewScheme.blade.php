@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Scheme List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Scheme List</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        @include('admin.asset.notification.notify')

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of Scheme</h5>
                        @can('Create scheme')
                            <a href="{{ route('scheme.create') }}" class="btn btn-sm btn-primary btn-xs"
                               style="float: right;margin-top: -5px;">Add New Scheme</a>
                        @endcan

                    </div>

                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-data table-striped table-bordered table-hover dataTables-example"
                                   title="Scheme list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Scheme Name</th>
                                    <th>Scheme Code</th>
                                    <th>Allow Cashback</th>
                                    <th>Allow Commission</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($schemes as $key=>$scheme)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $scheme->name }}</td>
                                        <td>{{ $scheme->scheme_code }}</td>
                                        <td>
                                            @if($scheme->allow_cashback == 1)
                                                <span class="badge badge-primary">true</span>
                                            @else
                                                <span class="badge badge-danger">false</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($scheme->allow_commission == 1)
                                                <span class="badge badge-primary">true</span>
                                            @else
                                                <span class="badge badge-danger">false</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($scheme->status == 1)
                                                <span class="badge badge-primary">active</span>
                                            @else
                                                <span class="badge badge-danger">in-active</span>
                                            @endif
                                        </td>
                                        <td>

                                        @can('Edit scheme')
                                                    <a href="{{ route('scheme.edit',$scheme->id) }}" title="Edit Scheme"
                                                       class="btn btn-icon btn-sm btn-primary m-t-n-xs"><i
                                                            class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                            @endcan

                                        @can('Delete scheme')
                                                    <form action="{{ route('scheme.delete',$scheme->id) }}" style="float: left;margin-right: 5px;" method="POST">
                                                        @csrf
                                                        <input id="resetValue" type="hidden" name="scheme_id" value="{{ $scheme->id }}">
                                                        <button href="{{ route('scheme.delete', $scheme->id) }}" class="reset btn btn-icon btn-sm btn-danger m-t-n-xs" rel="{{ $scheme->id }}"><i class="fa fa-trash"></i></button>
                                                        <button id="resetBtn-{{ $scheme->id }}" style="display: none" type="submit" href="{{ route('scheme.delete', $scheme->id) }}"  class="resetBtn btn btn-icon btn-sm btn-danger m-t-n-xs"><i class="fa fa-trash"></i></button>
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
                text: "Scheme data will be deleted",
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


