@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend NEWS Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Frontend</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Update NEWS</strong>
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
                        <form method="post" action="{{route('frontend.news.update',$news->id)}}" enctype="multipart/form-data">@csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Heading</label>
                                <div class="col-sm-10">
                                    <input name="heading" type="text" value="{{$news->heading}}"
                                           class="form-control" required>
                                </div>
                            </div>

                            <input type="text" name="belongs_to" value="{{config('app.'.'name')}}" hidden>

                            <hr class="hr-line-dashed">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Sub Heading</label>
                                <div class="col-sm-10">
                                    <input name="sub_heading" type="text" value="{{$news->sub_heading}}"
                                           class="form-control">
                                </div>
                            </div>


                            <hr class="hr-line-dashed">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">News Link</label>
                                <div class="col-sm-10">
                                    <input name="news_link" type="text" value="{{$news->news_link}}"
                                           class="form-control">
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

                                @if(!empty($news->image))
                                    <div class="row" style="margin-top: 20px;">
                                        <div class="col-md-4">

                                            <img class="d-block w-100"
                                                 src="{{ config('dpaisa-api-url.public_document_url') . $news->image}}"
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

