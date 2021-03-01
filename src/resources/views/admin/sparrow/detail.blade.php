@extends('admin.layouts.admin_design')
@section('content')
    <div class="wrapper wrapper-content">
        {{--Admin Dashboard--}}
        <h2 style="margin-top: -5px; margin-left: 5px;">SMS Dashboard</h2>
        <div class="row">
                <div class="col-lg-3">
                    <div class="ibox ">
                        <div class="ibox-title" style="padding-right: 15px;">
                            <span class="label label-success float-right">Total</span>
                            <h5>SMS Sent</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">{{ $smsCount }}</h1>
                            <small>Number of SMS sent </small>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection


