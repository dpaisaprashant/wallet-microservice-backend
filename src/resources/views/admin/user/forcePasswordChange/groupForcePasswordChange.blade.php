@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Group Force Password Change</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Force Password Change</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Group</strong>
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
                        <h5>Force Group Change Password </h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" enctype="multipart/form-data" >
                            @csrf


                            <div class="form-group row"><label class="col-sm-2 col-form-label">  Groups <br/></label>

                                <div class="col-sm-10">
                                    @foreach($groups as $topic)
                                        <div class="i-checks">
                                            <label>
                                                <input type="checkbox" value="{{ $topic }}" name="groups[]">
                                                <i></i> {{ ucfirst(str_replace('_', ' ', $topic)) }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Message</label>
                                <div class="col-lg-10 col-sm-10">
                                    <div class="ibox ">

                                        <div class="ibox-content no-padding">

                                            <textarea name="reason" required style="width: 100%">Change password because of security reasons
                                            </textarea>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Create Group Force Change Password</button>
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
    <link href="{{ asset('admin/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
@endsection

@section('scripts')
    @include('admin.asset.js.summernote')

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

