@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Notification</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Notifications</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create</strong>
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
                        <h5>Create new notification</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" enctype="multipart/form-data" action="{{route('notification.create')}}" >
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Title</label>

                                <div class="col-sm-10">
                                    <input name="title" type="text" class="form-control" required></div>
                            </div>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row"><label class="col-sm-2 col-form-label"> Topics (Groups)<br/></label>

                                <div class="col-sm-10">
                                    @foreach($allTopics as $topic)
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" value="{{ $topic }}" name="topics[]">
                                                <i></i> {{ ucfirst(str_replace('_', ' ', $topic)) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                                    <div class="form-group row"> <label class="col-sm-2 col-form-label">Select Districts</label>
                                        <div class="col-lg-10 col-sm-10">
                                        <select class="select2_demo_2 form-control" multiple="multiple" name="district_topics[]">
                                            @foreach($allDistrictTopics as $districtTopic)
                                                <option value="{{ $districtTopic }}">{{ $districtTopic }}</option>
                                            @endforeach
                                        </select>
                                        </div>
                                    </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Message</label>
                                <div class="col-lg-10 col-sm-10">
                                    <div class="ibox ">

                                        <div class="ibox-content no-padding">

                                            <textarea name="message" required style="width: 100%">


                                            </textarea>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Image</label>

                                <div class="col-sm-10">

                                    <div class="custom-file">
                                        <input name="image" id="logo1" type="file" class="custom-file-input">
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

{{--                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Main Image</label>--}}

{{--                                <div class="col-sm-10">--}}

{{--                                    <div class="custom-file">--}}
{{--                                        <input name="main_img" id="logo2" type="file" class="custom-file-input">--}}
{{--                                        <label for="logo2" class="custom-file-label">Choose file...</label>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Send Notification</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('styles')
    @include('admin.asset.css.summernote')
    @include('admin.asset.css.select2')
    <link href="{{ asset('admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('scripts')
   @include('admin.asset.js.summernote')
   @include('admin.asset.js.select2')
   <script src="{{ asset('admin/js/plugins/iCheck/icheck.min.js') }}"></script>
   <script>
       $(document).ready(function () {
           $('.i-checks').iCheck({
               checkboxClass: 'icheckbox_square-green',
               radioClass: 'iradio_square-green',
           });
       });
   </script>


    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection

