@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create New Challenge</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('socialmediachallenge.view') }}">Social Media Challenge</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Add New Social Media Challenge</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" enctype="multipart/form-data" id="socialChallengeForm">
                            @csrf

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="title" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Challenge Code</label>
                                <div class="col-sm-10">
                                    <input name="code" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Challenge Type</label>
                                <div class="col-sm-10">
                                    <input name="type" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Challenge Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Terms and Conditions</label>
                                <div class="col-sm-10">
                                    <textarea name="terms_and_conditions" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Allowed Attempts per User</label>
                                <div class="col-sm-10">
                                    <input name="attempts_per_user" type="number" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label for="expired_at" class="col-sm-2 col-form-label">Expiry Date and Time</label>
                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="datetime-local" id="datetime" class="form-control"
                                               placeholder="Select Expiry Date" name="expired_at">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Select Status..." class="chosen-select" tabindex="2"
                                            name="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

{{--                            <div class="form-group  row">--}}
{{--                                <label class="col-sm-2 col-form-label">Special 1</label>--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <textarea name="special1" class="form-control"></textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group  row">--}}
{{--                                <label class="col-sm-2 col-form-label">Special 2</label>--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <textarea name="special2" class="form-control"></textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group  row">--}}
{{--                                <label class="col-sm-2 col-form-label">Special 3</label>--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <textarea name="special3" class="form-control"></textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group  row">--}}
{{--                                <label class="col-sm-2 col-form-label">Special 4</label>--}}
{{--                                <div class="col-sm-10">--}}
{{--                                    <textarea name="special4" class="form-control"></textarea>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="form-group  row" style="display:none">
                                <label class="col-sm-2 col-form-label">Created At</label>
                                <div class="col-sm-10">
                                    <input name="blocked_at" type="datetime" class="form-control"
                                           value="{{\Carbon\Carbon::now()->format('Y-m-d\TH:i')}}" required>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Add Challenge</button>
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
    @include('admin.asset.css.chosen')
    {{--    @include('admin.asset.css.datepicker')--}}
    {{--        <link href=--}}
    {{--              "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"--}}
    {{--              rel="stylesheet">--}}
    {{--    @include('admin.asset.css.datatable')--}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
{{--    <link--}}
{{--        href=--}}
{{--        "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"--}}
{{--        rel="stylesheet">--}}
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    {{--    @include('admin.asset.js.datepicker')--}}
    {{--    @include('admin.asset.js.datatable')--}}

    <script src=
            "https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
    </script>
    {{--    <script src=--}}
    {{--            "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js">--}}
    {{--    </script>--}}
    <script type="text/javascript" src=
    "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js">
    </script>
    <script src=
            "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>
{{--    <script>--}}

{{--        // Below code sets format to the--}}
{{--        // datetimepicker having id as--}}
{{--        // datetime--}}
{{--        $('#datetime').datetimepicker({--}}
{{--            format: 'yyyy-mm-dd hh:ii:ss'--}}
{{--        });--}}
{{--    </script>--}}
    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
@endsection
