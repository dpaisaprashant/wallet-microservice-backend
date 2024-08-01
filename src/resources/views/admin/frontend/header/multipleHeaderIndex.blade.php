@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend Header Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Frontend</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Headers</strong>
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
                        <h5>List of all abouts</h5>
                        @can('Frontend header create')
                            <div class="ibox-tools" style="top: 8px;">
                                <a class="btn btn-primary" href="{{route('frontend.header.create')}}"> <i class="fa fa-plus-circle"></i> Add New Header</a>
                            </div>
                        @endcan
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Top Title</th>
                                    <th>Bottom Title</th>
                                    <th>Sub Title</th>
                                    <th>Google Link</th>
                                    <th>Apple Link</th>
                                    <th>Button Text</th>
                                    <th>Button Link</th>
                                    <th>Image</th>
                                    <th>Google Image</th>
                                    <th>Apple Image</th>
                                    <th>Service Header</th>
                                    <th>Service Description</th>
                                    <th>Sequence</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($headers as $header)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + 1}}</td>
                                        <td>{{ $header->top_title}}</td>
                                        <td>{{$header->bottom_title}}</td>
                                        <td>{{$header->sub_title}}</td>
                                        <td>{{$header->google_link}}</td>
                                        <td>{{$header->apple_link}}</td>
                                        <td>{{$header->button_text}}</td>
                                        <td>{{$header->button_link}}</td>
                                        <td>
                                            @if(!empty($header->image))
                                                <img
                                                     src="{{ config('dpaisa-api-url.public_document_url') . $header->image }}"
                                                     alt="Header Image" style="height: 120px;">
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($header->google_image))
                                                <img
                                                    src="{{ config('dpaisa-api-url.public_document_url') . $header->google_image }}"
                                                    alt="Google Image" style="height: 120px;">
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($header->apple_image))
                                                <img
                                                    src="{{ config('dpaisa-api-url.public_document_url') . $header->apple_image }}"
                                                    alt="Apple Image" style="height: 120px;">
                                            @endif
                                        </td>
                                        <td>{{ $header->service_header}}</td>
                                        <td>{{$header->service_description}}</td>
                                        <td>{{$header->sequence}}</td>
                                        <td>
                                            @can('Frontend header update')
                                                <a href="{{route('frontend.header.edit',$header->id)}}"><button class="btn btn-info btn-icon" type="button"><i class="fa fa-edit"></i></button></a>
                                            @endcan

                                            @can('Frontend header delete')
                                                <form action="{{route('frontend.header.delete')}}" method="post" id="deactivateForm" style="display: inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $header->id }}">
                                                    <button id="deactivate" class="btn btn-danger btn-icon deactivate" rel="{{ $header->id  }}"><i class="fa fa-trash"></i></button>
                                                    <button id="deactivateBtn-{{ $header->id  }}" type="submit" style=" display:none;" rel="{{ route('frontend.header.delete') }}"></button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $headers->appends(request()->query())->links() }}
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

    <script>
        $(document).ready(function (e) {
            let a = "Showing {{ $headers->firstItem() }} to {{ $headers->lastItem() }} of {{ $headers->total() }} entries";
            $('.dataTables_info').text(a);
        });
    </script>


@endsection


