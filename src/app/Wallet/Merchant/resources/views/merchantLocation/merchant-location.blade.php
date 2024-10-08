@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Merchant Locations List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Merchant Locations</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        @include('admin.asset.notification.notify')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List of Merchant Locations</h5>
                        @can('Add location')
                            <a href="{{ route('merchant.location.add')}}" class="btn btn-success btn-sm m-t-n-xs"
                               style="margin-left: 80%;margin-top:-5px"><i class="fa fa-plus"> &nbsp;Add
                                    Location</i></a>
                        @endcan
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                   title="Merchant Locations">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Location Name</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($locations as $location)
                                    <tr class="gradeX">
                                        <td>{{ $loop->index + ($locations->perPage() * ($locations->currentPage() - 1)) + 1 }}</td>
                                        <td>
                                                {{ $location->name }}
                                        </td>
                                        <td>
                                            {{ $location->created_at }}
                                        </td>

                                        <td class="center">
                                            <form action="{{ route('merchant.location.delete',$location->id) }}"
                                                  method="POST">
                                                @csrf
                                                @can('Delete location')
                                                    <button class="reset btn btn-sm btn-danger m-t-n-xs"
                                                            rel="{{ $location->id }}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <button id="resetBtn-{{ $location->id }}"
                                                            style="display: none" type="submit"
                                                            href="{{ route('merchant.location.delete',$location->id) }}"
                                                            class="resetBtn btn btn-sm btn-danger m-t-n-xs">
                                                        <i class="fa fa-trash"></i></button>
                                                @endcan
                                                @can('Edit merchant address')
                                                    <a href="{{ route('merchant.location.edit',$location->id)}}"
                                                       class="btn btn-success btn-sm m-t-n-xs"><i
                                                            class="fa fa-edit"></i></a>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                            {{ $merchantProducts->appends(request()->query())->links() }}--}}
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
    @include('admin.asset.css.sweetalert')
    @include('admin.asset.css.select2')
@endsection

@section('scripts')
    @include('admin.asset.js.select2')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datatableWithPaging')
    @include('admin.asset.js.sweetalert')
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let merchantLocation_Id = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "Selected merchant address will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + merchantLocation_Id).trigger('click');
                swal.close();

            })
        });
    </script>
@endsection




