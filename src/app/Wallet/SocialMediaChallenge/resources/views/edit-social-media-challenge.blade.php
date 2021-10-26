@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Social Media Challenge</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('socialmediachallenge.view') }}">Social Media Challenge</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Edit Social Media Challenge</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('socialmediachallenge.update',$socialMediaChallenge->id) }}"  enctype="multipart/form-data" id="socialChallengeForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input name="title" type="text" class="form-control" value="{{$socialMediaChallenge->title}}" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Challenge Code</label>
                                <div class="col-sm-10">
                                    <input name="code" type="text" class="form-control" value="{{$socialMediaChallenge->code}}" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Challenge Type</label>
                                <div class="col-sm-10">
                                    <input name="type" type="text" class="form-control" value="{{$socialMediaChallenge->type}}" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Challenge Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" >{{$socialMediaChallenge->description}}</textarea>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Terms and Conditions</label>
                                <div class="col-sm-10">
                                    <textarea name="terms_and_conditions" class="form-control">{{$socialMediaChallenge->terms_and_conditions}}</textarea>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Allowed Attempts per User</label>
                                <div class="col-sm-10">
                                    <input name="attempts_per_user" type="number" class="form-control" value="{{$socialMediaChallenge->attempts_per_user}}" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label for="expired_at" class="col-sm-2 col-form-label">Expiry Date and Time</label>
                                <div class="col-sm-10">
                                    <div class="input-group date">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input type="date" id="expired_at" class="form-control"
                                               placeholder="Select Expiry Date" name="expired_at" value="{{$socialMediaChallenge->expired_at}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Select Status..." class="chosen-select" tabindex="2"
                                            name="status">
                                        <option value="1" @if($socialMediaChallenge->status==1) selected @endif>Active</option>
                                        <option value="0" @if($socialMediaChallenge->status==0) selected @endif>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Update</button>
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

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
@endsection
