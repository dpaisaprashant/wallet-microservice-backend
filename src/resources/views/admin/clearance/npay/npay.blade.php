@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>NPay Clearance</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Clearance</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>NPay</strong>
                </li>
            </ol>
        </div>
    </div>
    @can('Clearance npay')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Select Clearance Date</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            @include('admin.asset.notification.notify')
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('npay.clearance.otp') }}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group date">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input type="text" class="form-control date_from" placeholder="Select Date" name="date" required autocomplete="off" @if (!empty($_GET['date'])) value="{{ date('d M, Y', strtotime($_GET['date']))}}" @endif>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"><strong>View clearance transactions</strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
@endsection

@section('styles')
   @include('admin.asset.css.datatable')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
    {{--@include('admin.asset.css.datepicker')--}}
   <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

   <style>
       .calendar-time {
           display: none;
       }
   </style>
@endsection

@section('scripts')
   {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>

    <script>
        $(".date_from").datepicker({
            autoclose: true,
            todayHighlight: true,
            format: 'dd M, yyyy',
            keyboardNavigation: false,
        });
    </script>--}}

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


   <script>
       $(function() {
           $('.date_from').daterangepicker({
               timePicker: true,
               startDate: moment().startOf('hour'),
               endDate: moment().startOf('hour').add(32, 'hour'),
               //timePicker24Hour: true,
               locale: {
                   format: 'YYYY-MM-DD'
               },
               autoUpdateInput: true
           });
       });
   </script>

    @include('admin.asset.js.datatable')
@endsection


