@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>KYC Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>KYC Settings</strong>
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
                        <form method="post" action="{{ route('settings.kyc') }}" enctype="multipart/form-data"
                              id="notificationForm">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">KYC Refill Duration</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="kyc_refill_duration">
                                        <option value="" selected disabled>Not Set</option>
                                        @if(!empty($settings['kyc_refill_duration']))
                                            <option value="6"
                                                    @if($settings['kyc_refill_duration'] == '6') selected @endif>6 Months
                                            </option>
                                            <option value="12"
                                                    @if($settings['kyc_refill_duration'] == '12') selected @endif>12 Months
                                            </option>
                                            <option value="18"
                                                    @if($settings['kyc_refill_duration'] == '18') selected @endif>18 Months
                                            </option>
                                        @else
                                            <option value="6">6 Months</option>
                                            <option value="12">12 Months</option>
                                            <option value="18">18 Months</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>

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
