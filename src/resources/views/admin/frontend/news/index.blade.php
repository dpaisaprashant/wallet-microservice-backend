@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend NEWS Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Frontend</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>NEWS</strong>
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
                        <h5>List of all NEWS</h5>
                        @can('Frontend news create')
                            <div class="ibox-tools" style="top: 8px;">
                                <a class="btn btn-primary" href="{{route('frontend.news.create')}}"> <i class="fa fa-plus-circle"></i> Add New FAQ</a>
                            </div>
                        @endcan
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Heading</th>
                                    <th>Sub-Heading</th>
                                    <th>news_link</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $new)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + 1}}</td>
                                        <td>{{ $new->heading}}</td>
                                        <td>{{ $new->sub_heading}}</td>
                                        <td>{{ $new->news_link}}</td>
                                        <td>
                                            <img
                                                src="{{ config('dpaisa-api-url.public_document_url') . $new->image }}"
                                                alt="Google Image" style="height: 120px;">
                                        </td>
                                        <td>{{ $new->created_at}}</td>
                                        <td>
                                            @can('Frontend news update')
                                                <a href="{{route('frontend.news.update',$new->id)}}"><button class="btn btn-info btn-icon" type="button"><i class="fa fa-edit"></i></button></a>
                                            @endcan
                                            @can('Frontend news delete')
                                                <form action="{{route('frontend.news.delete')}}" method="post" id="deactivateForm" style="display: inline">
                                                @csrf
                                                    <input type="hidden" name="id" value="{{ $new->id }}">
                                                    <button id="deactivate" class="btn btn-danger btn-icon deactivate" rel="{{ $new->id  }}"><i class="fa fa-trash"></i></button>
                                                    <button id="deactivateBtn-{{ $new->id  }}" type="submit" style=" display:none;" rel="{{ route('frontend.news.delete') }}"></button>
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
        $('.deactivate').on('click', function (e) {

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
            }, function () {
                let deactivateButton = '#deactivateBtn-' + id;
                $(deactivateButton).trigger('click');
                swal.close();
            })
        });
    </script>


@endsection


