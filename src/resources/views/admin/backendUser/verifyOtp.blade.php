

@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Change admin password</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a >Backend Users</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Change password</strong>
                </li>

            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Change {{ auth()->user()->name }}'s password</h5>
                    </div>
                    <div class="ibox-content">

                        <form action="{{ route('backendUser.verifyOtp') }}" method="post">
                            @csrf

                            <div class="form-group  row">


                                @include('admin.asset.notification.notify')

                                <label class="col-sm-2 col-form-label">Enter Your OTP</label>
                                <div class="col-sm-10">
                                    <input name="otp" type="text" id ="otp" class="form-control" required placeholder="Enter Your OTP">
                                    <p style="color: red; margin-bottom: 0px;">{{ $errors -> first('email') }}</p>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>


                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Verify OTP</button>
                                </div>
                            </div>

        
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
