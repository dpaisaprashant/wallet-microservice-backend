@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend Partner Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Frontend</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Edit Partner</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Settings</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{route('frontend.partner.update',$partner->id)}}" enctype="multipart/form-data">@csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text"
                                           class="form-control" value="{{$partner->name}}" required>
                                </div>
                            </div>

                            <input type="text" name="belongs_to" value="{{config('app.'.'name')}}" hidden>

                            <hr class="hr-line-dashed">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Link</label>
                                <div class="col-sm-10">
                                    <input name="link" type="text"
                                           class="form-control" value="{{$partner->link}}">
                                </div>
                            </div>

                            <hr class="hr-line-dashed">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="image" id="logo1" type="file" class="custom-file-input">
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>
                                </div>
                                @if(!empty($partner->image))
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-md-4">

                                            <img class="d-block w-100"
                                                 src="{{ config('dpaisa-api-url.public_document_url') . $partner->image}}"
                                                 alt="News Image">
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <hr class="hr-line-dashed">

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection

