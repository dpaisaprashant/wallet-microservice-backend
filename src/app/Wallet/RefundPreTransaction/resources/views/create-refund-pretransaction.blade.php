@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create PreTransaction</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Refunds</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create PreTransaction</strong>
                </li>
            </ol>
        </div>
    </div>
    @include('admin.asset.notification.notify')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Create PreTransaction Row</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" enctype="multipart/form-data" id="createPreTransactionForm">
                            @csrf

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">User Phone Number</label>
                                <div class="col-sm-10">
                                    <input name="user_mobile_no" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Amount</label>
                                <div class="col-sm-10">
                                    <input name="amount" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <input name="description" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Created At</label>
                                <div class="col-sm-10">
                                    <input name="created_at" type="datetime-local" class="form-control" required>
                                </div>
                            </div>


                            <div class="col-md-4" style="padding-bottom: 15px;">
                                <label for="transaction_type">Created Date</label>
                                <div class="input-group date">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                    <input id="date_with_time" type="text" class="form-control date_with_time"
                                           placeholder="Select Date" name="created_at" autocomplete="off">
                                </div>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class='col-sm-6'>
                                        <input type='text' class="form-control" id='datetimepicker4'/>
                                        <input type="text" class="form-control" id="example">
                                    </div>

                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Create</button>
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
    @include('admin.asset.css.datatable')

    <link rel="stylesheet" href="{{asset('admin/css/plugins/clockpicker/clockpicker.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>

@endsection

@section('scripts')

    <!-- Necessary -->
{{--    <link rel="stylesheet" href="/path/to/cdn/bootstrap.min.css" />--}}
{{--    <script src="/path/to/cdn/jquery.slim.min.js"></script>--}}
{{--    <script src="/path/to/cdn/bootstrap.min.js"></script>--}}
{{--    <script src="/path/to/cdn/popper.min.js"></script>--}}
    <!-- Font Awesome Iconic Font -->
{{--    <link rel="stylesheet" href="/path/to/cdn/fontawesome.min.css" />--}}
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <script src="{{asset('admin/js/plugins/clockpicker/clockpicker.js')}}"></script>

    @include('admin.asset.js.chosen')
{{--    @include('admin.asset.js.datepicker')--}}
    @include('admin.asset.js.datatable')

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker4').datetimepicker({

            });
        });

        $(function () {
            $('#example').datetimepicker();
        });
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
@endsection
