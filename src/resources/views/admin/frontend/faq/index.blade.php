@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend FAQ Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Frontend</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Frequently Asked Questions</strong>
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
                        <h5>List of all FAQs</h5>
                        @can('Frontend faq create')
                            <div class="ibox-tools" style="top: 8px;">
                                <a class="btn btn-primary" href="{{route('frontend.faq.create')}}"> <i class="fa fa-plus-circle"></i> Add New FAQ</a>
                            </div>
                        @endcan
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" title="General settings list">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    @if(strtolower(config('app.'.'name')) == "icash")
                                        <th>Question Type</th>
                                        <th>Icon</th>
                                    @endif
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($faqs as $faq)
                                    <tr class="gradeC">
                                        <td>{{ $loop->index + 1}}</td>
                                        <td>{{ $faq->question}}</td>
                                        <td>{{ $faq->answer}}</td>
                                        @if(strtolower(config('app.'.'name')) == "icash")
                                            <td>{{ $faq->question_type}}</td>
                                            <td>{{ $faq->icon}}</td>
                                        @endif
                                        <td>{{ $faq->created_at}}</td>
                                        <td>
                                            @can('Frontend faq update')
                                                <a href="{{route('frontend.faq.update',$faq->id)}}"><button class="btn btn-info btn-icon" type="button"><i class="fa fa-edit"></i></button></a>
                                            @endcan

                                            @can('Frontend faq delete')
                                                    <form action="{{route('frontend.faq.delete')}}" method="post" id="deactivateForm" style="display: inline">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $faq->id }}">
                                                        <button id="deactivate" class="btn btn-danger btn-icon deactivate" rel="{{ $faq->id  }}"><i class="fa fa-trash"></i></button>
                                                        <button id="deactivateBtn-{{ $faq->id  }}" type="submit" style=" display:none;" rel="{{ route('frontend.faq.delete') }}"></button>
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


