@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend Header Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Frontend</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Header Settings</strong>
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
                        <form method="post" action="{{route('frontend.header.edit',$header->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Top Title</label>
                                <div class="col-sm-10">
                                    <input value="{{ $header->top_title ?? '' }}" name="top_title" type="text"
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Bottom Title</label>
                                <div class="col-sm-10">
                                    <input value="{{ $header->bottom_title ?? '' }}" name="bottom_title" type="text"
                                           class="form-control" required>
                                </div>
                            </div>
                            @if(strtolower(config('app.'.'name')) == 'dpaisa'|| strtolower(config('app.'.'name')) == 'master')
                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Sub Title</label>
                                    <div class="col-sm-10">
                                        <input value="{{ $header->sub_title ?? '' }}" name="sub_title" type="text"
                                               class="form-control" required>
                                    </div>
                                </div>
                            @endif

                                <hr class="hr-line-dashed">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Google Play Store Link</label>
                                <div class="col-sm-10">
                                    <input value="{{ $header->google_link ?? '' }}" name="google_link" type="text"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Google Play Store Image</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="google_image" id="logo1" type="file" class="custom-file-input">
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                    @if(!empty($header->google_image))
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="{{ config('dpaisa-api-url.public_document_url') . $header->google_image }}"
                                                     alt="First slide">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <hr class="hr-line-dashed">


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Apple App Store Link</label>
                                <div class="col-sm-10">
                                    <input value="{{ $header->apple_link ?? '' }}" name="apple_link" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Apple App Store Image</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="apple_image" id="logo1" type="file" class="custom-file-input">
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                    @if(!empty($header->apple_image))
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">

                                                <img class="d-block w-100"
                                                    src="{{ config('dpaisa-api-url.public_document_url') . $header->apple_image }}"
                                                    alt="First slide">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                                <hr class="hr-line-dashed">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Button Text</label>
                                <div class="col-sm-10">
                                    <input value="{{ $header->button_text ?? '' }}" name="button_text" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Button Link</label>
                                <div class="col-sm-10">
                                    <input value="{{ $header->button_link ?? '' }}" name="button_link" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <hr class="hr-line-dashed">


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Background Image</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="image" id="logo1" type="file" class="custom-file-input">
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                    @if(!empty($header->image))
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="{{ config('dpaisa-api-url.public_document_url') . $header->image }}"
                                                     alt="First slide">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>


                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Service Header</label>
                                <div class="col-sm-10">
                                    <input value="{{ $header->service_header ?? '' }}" name="service_header" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Service Description</label>
                                <div class="col-sm-10">
                                    <textarea name="service_description" class="form-control" required>{!! $header->service_description ?? '' !!}</textarea>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Sequence</label>
                                <div class="col-sm-10">
                                    <input value="{{ $header->sequence ?? '' }}" name="sequence" type="number"
                                           class="form-control">
                                </div>
                            </div>

                            <input type="text" name="belongs_to" value="{{config('app.'.'name')}}" hidden>

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

