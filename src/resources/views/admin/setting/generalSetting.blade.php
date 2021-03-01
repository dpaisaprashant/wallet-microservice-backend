@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>General Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a>Settings</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>General Settings</strong>
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
                        <form method="post" action="{{ route('settings.general') }}" enctype="multipart/form-data"
                              id="notificationForm">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Maintenance mode</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="maintenance_mode">
                                        @if(!empty($settings['maintenance_mode']))
                                            <option value="ON"
                                                    @if($settings['maintenance_mode'] == 'ON') selected @endif>ON
                                            </option>
                                            <option value="OFF"
                                                    @if($settings['maintenance_mode'] == 'OFF') selected @endif>OFF
                                            </option>
                                        @else
                                            <option value="ON">ON</option>
                                            <option value="OFF" selected>OFF</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Login attempts to Lock User</label>
                                <div class="col-sm-10">
                                    <input value="{{  $settings['lock_user_login_attempt'] ?? ''}}" name="lock_user_login_attempt" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Deactivate inactive user in</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="deactivate_inactive_user_duration">
                                        <option value="" selected disabled>Not Set</option>
                                        @if(!empty($settings['deactivate_inactive_user_duration']))
                                            <option value="1"
                                                    @if($settings['deactivate_inactive_user_duration'] == '1') selected @endif>1 Months
                                            </option>
                                            <option value="3"
                                                    @if($settings['deactivate_inactive_user_duration'] == '3') selected @endif>3 Months
                                            </option>
                                            <option value="6"
                                                    @if($settings['deactivate_inactive_user_duration'] == '6') selected @endif>6 Months
                                            </option>
                                            <option value="9"
                                                    @if($settings['deactivate_inactive_user_duration'] == '9') selected @endif>9 Months
                                            </option>
                                            <option value="12"
                                                    @if($settings['deactivate_inactive_user_duration'] == '12') selected @endif>12 Months
                                            </option>
                                        @else
                                            <option value="1">1 Months</option>
                                            <option value="3">3 Months</option>
                                            <option value="6">6 Months</option>
                                            <option value="9">9 Months</option>
                                            <option value="12">12 Months</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Site Title</label>
                                <div class="col-sm-10">
                                    <input value="{{  $settings['site_title'] ?? ''}}" name="site_title" type="text"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Site Description</label>
                                <div class="col-lg-10 col-sm-10">
                                    <div class="ibox ">
                                        <div class="ibox-content no-padding">
                                            <textarea name="general_description" class="summernote"
                                                      style="display: none; height: 100px;">
                                                {!! $settings['general_description'] ?? '' !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Site Logo</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="site_logo" id="logo1" type="file" class="custom-file-input">
                                        <label for="logo1" class="custom-file-label">Choose file...</label>
                                    </div>

                                    @if(!empty($settings['site_logo']))
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="{{ asset('storage/img/settings/' . $settings['site_logo']) }}"
                                                     alt="First slide">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Fav Icon</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input name="favicon" id="favicon" type="file" class="custom-file-input">
                                        <label for="favicon" class="custom-file-label">Choose file...</label>
                                    </div>
                                    @if(!empty($settings['favicon']))
                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block w-100"
                                                     src="{{ asset('storage/img/settings/' . $settings['favicon']) }}"
                                                     alt="First slide">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['general_address'] ?? '' }}" name="general_address"
                                           type="text" class="form-control"></div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Email Address</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['general_email'] ?? ''}}" name="general_email"
                                           type="email" class="form-control"></div>
                            </div>


                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Contact Number</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['general_number'] ?? ''}}" name="general_number"
                                           type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Facebook</label>

                                <div class="col-sm-10">
                                    <input value="{{ $settings['facebook'] ?? ''}}" name="facebook" type="text"
                                           class="form-control">
                                </div>
                            </div>


                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Linkedin</label>
                                <div class="col-sm-10">
                                    <input value="{{ $settings['linkedin'] ?? ''}}" name="linkedin" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Latitude</label>

                                <div class="col-sm-10">
                                    <input value="{{ $settings['latitude'] ?? ''}}" name="latitude" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Longitude</label>

                                <div class="col-sm-10">
                                    <input value="{{ $settings['longitude'] ?? ''}}" name="longitude" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            @can('General setting update')
                                <div class="form-group row">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary btn-sm" type="submit">Save changes</button>
                                    </div>
                                </div>
                            @endcan
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
   @include('admin.asset.css.summernote')
@endsection

@section('scripts')
    @include('admin.asset.js.summernote')
    <script>
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection

