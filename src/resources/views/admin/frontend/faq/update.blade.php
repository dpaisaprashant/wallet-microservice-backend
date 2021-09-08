@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Frontend FAQs Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Frontend</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Update FAQ</strong>
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
                        <form method="post" action="{{route('frontend.faq.update',$faq->id)}}" enctype="multipart/form-data">@csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Question</label>
                                <div class="col-sm-10">
                                    <input name="question" type="text"
                                           class="form-control" value="{{$faq->question}}" required>
                                </div>
                            </div>

                            <input type="text" name="belongs_to" value="{{config('app.'.'name')}}" hidden>

                            <hr class="hr-line-dashed">

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Answer</label>
                                <div class="col-sm-10">
                                    <textarea name="answer" class="form-control" required>{{$faq->answer}}</textarea>
                                </div>
                            </div>

                            <hr class="hr-line-dashed">

                            @if(strtolower(config('app.'.'name')) == "icash")

                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">Question Type</label>
                                    <div class="col-sm-10">
                                        <input name="question_type" type="text" value="{{$faq->question_type}}"
                                               class="form-control">
                                    </div>
                                </div>

                                <hr class="hr-line-dashed">

                                <div class="form-group  row">
                                    <label class="col-sm-2 col-form-label">icon</label>
                                    <div class="col-sm-10">
                                        <input name="icon" type="text"
                                               class="form-control" value="{{$faq->icon}}">
                                    </div>
                                </div>

                            @endif

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

