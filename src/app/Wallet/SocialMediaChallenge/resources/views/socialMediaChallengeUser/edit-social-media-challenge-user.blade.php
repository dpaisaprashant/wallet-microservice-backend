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

                <li class="breadcrumb-item">
                    <a href="{{ route('socialmediachallenge.user.view',$socialMediaChallengeUser->socialMediaChallenge->id) }}">Social
                        Media Challenge Users</a>
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
                        <h5>Edit {{$socialMediaChallengeUser->user->name}}
                            's {{$socialMediaChallengeUser->socialMediaChallenge->title}} Info</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post"
                              action="{{ route('socialmediachallenge.user.update',$socialMediaChallengeUser->id) }}"
                              enctype="multipart/form-data" id="socialChallengeForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Link</label>
                                <div class="col-sm-10">
                                    <input name="link" type="text" class="form-control"
                                           value="{{$socialMediaChallengeUser->link}}" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Caption</label>
                                <div class="col-sm-10">
                                    <input name="caption" type="text" class="form-control"
                                           value="{{$socialMediaChallengeUser->caption}}" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Challenge Status</label>
                                <div class="col-sm-10">
                                    <input name="challenge_status" type="text" class="form-control"
                                           value="{{$socialMediaChallengeUser->challenge_status}}" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Embed Link</label>
                                <div class="col-sm-10">
                                    <input name="embed_link" type="text" class="form-control"
                                           value="{{$socialMediaChallengeUser->embed_link}}">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Facebook Link</label>
                                <div class="col-sm-10">
                                    <input name="facebook_link" type="text" class="form-control"
                                           value="{{$socialMediaChallengeUser->facebook_link}}">
                                </div>
                            </div>



                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                </div>
                            </div>


                        </form>
                        <form action="{{ route('socialmediachallenge.user.winner', $socialMediaChallengeUser->id) }}" method="POST">
                            @csrf

                            <input type="hidden" name="user_id"
                                   value="{{$socialMediaChallengeUser->user->id}}">
                            <input type="hidden" name="social_challenge_id"
                                   value="{{$socialMediaChallengeUser->socialMediaChallenge->id}}">
                            <input type="hidden" name="won_at"
                                   value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
                            <input type="text" name="description"
                                   value="Winner of {{$socialMediaChallengeUser->socialMediaChallenge->title}}!">

                                <button
                                    class="reset btn btn-icon btn-outline-success btn-sm m-t-n-xs"
                                    rel="{{ $socialMediaChallengeUser->id }}"><i
                                        class="fa fa-trophy"></i>
                                </button>
                                <button id="resetBtn-{{ $socialMediaChallengeUser->id }}"
                                        style="display: none" type="submit"
                                        href="{{ route('socialmediachallenge.user.winner',$socialMediaChallengeUser->id) }}"
                                        class="resetBtn btn btn-icon btn-outline-success btn-sm m-t-n-xs">
                                    <i class="fa fa-trophy"></i></button>

                                &nbsp; &nbsp;<i class="fa fa-trophy" style="color:inherit;"> Winner</i>
                            @endif
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
