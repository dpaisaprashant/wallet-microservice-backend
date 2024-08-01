@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend Banner Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Frontend</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Banners</strong>
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
                        <h5>List of all banners</h5>
                        @can('Frontend banner create')
                            <div class="ibox-tools" style="top: 8px;">
                                <a class="btn btn-primary" href="{{ route('frontend.banner.create') }}"> <i
                                        class="fa fa-plus-circle"></i> Add New Banner</a>
                            </div>
                        @endcan
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example"
                                title="Banners List">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Mobile Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banners as $banner)
                                        <tr class="gradeC">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $banner->title }}</td>
                                            <td>
                                                @if (!empty($banner->image))
                                                    <img src="{{ '172.31.251.2:5052/storage/' . $banner->image }}"
                                                        alt="Banner Image" style="height: 120px;">
                                                @endif
                                            </td>

                                            <td>
                                                @if (!empty($banner->mobile_image))
                                                    <img src="{{ config('dpaisa-api-url.public_document_url') . $banner->mobile_image }}"
                                                        alt="Banner Mobile Image" style="height: 120px;">
                                                @endif
                                            </td>


                                            <td>
                                                @can('Frontend banner update')
                                                    <a href="{{ route('frontend.banner.update', $banner->id) }}"><button
                                                            class="btn btn-info btn-icon" type="button"><i
                                                                class="fa fa-edit"></i></button></a>
                                                @endcan
                                                @can('Frontend banner delete')
                                                    <form action="{{ route('frontend.banner.delete') }}" method="post"
                                                        id="deactivateForm" style="display: inline">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $banner->id }}">
                                                        <button class="btn btn-danger btn-icon deactivate"
                                                            rel="{{ $banner->id }}"><i class="fa fa-trash"></i></button>
                                                        <button id="deactivateBtn-{{ $banner->id }}" type="submit"
                                                            style=" display:none;"
                                                            rel="{{ route('frontend.banner.delete') }}"></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
    <!-- Sweet Alert -->
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')

    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $('.deactivate').on('click', function(e) {

            e.preventDefault();
            let id = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "This data will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ed5565",
                confirmButtonText: "Yes, delete!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function() {
                let deactivateButton = '#deactivateBtn-' + id;
                $(deactivateButton).trigger('click');
                swal.close();
            })
        });
    </script>
@endsection
