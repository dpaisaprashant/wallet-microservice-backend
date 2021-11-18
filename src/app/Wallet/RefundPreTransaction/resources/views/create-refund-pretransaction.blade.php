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

{{--                            <div class="col-md-4" style="padding-bottom: 15px;">--}}
{{--                                <label for="transaction_type">From Date</label>--}}
{{--                                <div class="input-group date">--}}
{{--                                                    <span class="input-group-addon">--}}
{{--                                                        <i class="fa fa-calendar"></i>--}}
{{--                                                    </span>--}}
{{--                                    <input id="date_with_time" type="text" class="form-control date_with_time"--}}
{{--                                           placeholder="Select Date" name="created_at" autocomplete="off">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="container">--}}
{{--                                <div class="row">--}}
{{--                                    <div class='col-sm-6'>--}}
{{--                                        <input type='text' class="form-control" id='datetimepicker4'/>--}}
{{--                                    </div>--}}

{{--                                </div>--}}
{{--                            </div>--}}

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
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>



@endsection

@section('scripts')

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />--}}

    <!-- Include Bootstrap Datepicker -->
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>--}}

    @include('admin.asset.js.chosen')
{{--    @include('admin.asset.js.datepicker')--}}
    @include('admin.asset.js.datatable')

    <script type="text/javascript">
        $(function () {
            $('#datetimepicker4').datetimepicker({

            });
        });
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
@endsection
