@extends('admin.layouts.admin_design')
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row m-b-lg m-t-lg">
            <div class="col-md-4" style="margin-top: 20px;">
                <div class="profile-image">
                    @isset($user->kyc['p_photo'])
                        <img src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['p_photo'] }}" class="rounded-circle circle-border m-b-md" alt="profile">
                    @else
                        <img src="{{ asset('admin/img/a4.jpg') }}" class="rounded-circle circle-border m-b-md" alt="profile">
                    @endisset
                </div>
                <div class="profile-info">
                    <div class="">
                        <div>
                            <h2 class="no-margins">
                                {{ $user->name }}
                            </h2>
                            <h4>Joined: {{ date('M d, Y', strtotime($user->created_at)) }}</h4>
                            <h4>Number: {{ $user->mobile_no }}</h4>

                            @if(!empty($user->kyc))
                                <h4>Address: {{ $user->kyc->district }}, Province {{ $user->kyc->province }}</h4>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5" style="margin-top: 20px;">

            </div>

        </div>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                @include('admin.asset.notification.notify')
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>User KYC Details</h5>
                    </div>
                    <div class="ibox-content">

                        <form id="kycForm" action="{{ route('user.changeKYCStatus') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-7">
                                    <dl class="row m-t-md">
                                        @if(!empty($user->kyc))
                                            @if($user->kyc->status == 1 && $user->kyc->accept == 1)
                                                <dt class="col-md-3 text-right">Verification Status</dt>
                                                <dd class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <i style="color: green;" class="fa fa-check"></i> Verified
                                                        </div>
                                                        @if($user->kyc->accept === 0 )
                                                            @can('KYC accept')
                                                                <div class="col-md-2"
                                                                     style="padding-right: 0px; margin-left: -45px;">
                                                                    {{-- <form id="kycForm" action="{{ route('user.changeKYCStatus') }}" method="post">

                                                                         @csrf--}}
                                                                    <input type="hidden" value="{{ $user->kyc->id }}"
                                                                           name="kyc">
                                                                    <input type="hidden" value="accepted" name="status">
                                                                    <button rel="{{ route('user.changeKYCStatus') }}"
                                                                            id="accept" class="btn btn-primary btn-sm"
                                                                            type="submit">Accept
                                                                    </button>
                                                                    <button id="acceptBtn" type="submit"
                                                                            style="display: none"></button>
                                                                    {{--</form>--}}
                                                                </div>
                                                            @endcan
                                                        @endif

                                                        @if($user->kyc->accept === 1 )
                                                            @can('KYC reject')
                                                                <div class="col-md-2"
                                                                     style="padding-left: 0px; margin-left: -10px;">
                                                                    {{--<form id="kycForm" action="{{ route('user.changeKYCStatus') }}" method="post">
                                                                        @csrf--}}
                                                                    <input type="hidden" value="{{ $user->kyc->id }}"
                                                                           name="kyc">
                                                                    <input type="hidden" value="rejected" name="status">
                                                                    <a data-toggle="modal" href="#modal-reject-kyc">
                                                                        <button class="btn btn-danger btn-sm"
                                                                                type="button">
                                                                            Reject
                                                                        </button>
                                                                    </a>
                                                                    <button id="rejectBtn" type="submit"
                                                                            style="display: none"></button>
                                                                    <div id="modal-reject-kyc" class="modal fade"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <h3 class="m-t-none m-b">
                                                                                                Reason of rejection</h3>
                                                                                            <hr>
                                                                                            <div
                                                                                                class="form-group  row">
                                                                                                <textarea
                                                                                                    class="form-control"
                                                                                                    name="reason"
                                                                                                    id="reason"
                                                                                                    placeholder="Reason of rejection"
                                                                                                    style="width: 100%">Your KYC form has been rejected</textarea>
                                                                                            </div>

                                                                                            <div
                                                                                                class="hr-line-dashed"></div>

                                                                                            <button style="width: 100%"
                                                                                                    rel="{{ route('user.changeKYCStatus') }}"
                                                                                                    id="reject"
                                                                                                    class="btn btn-danger ">
                                                                                                Reject
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{--</form>--}}
                                                                </div>
                                                            @endcan
                                                        @endif
                                                    </div>

                                                </dd>
                                            @else
                                                <dt class="col-md-3 text-right"
                                                    style="margin-top: auto; margin-bottom: auto;">Verification Status
                                                </dt>
                                                <dd class="col-md-8" style="margin-top: auto; margin-bottom: auto;">


                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            @if($user->kyc->accept === null)
                                                                <i style="color: red;" class="fa fa-times"></i> Not
                                                                Verified
                                                            @else
                                                                <i style="color: red;" class="fa fa-times"></i> KYC
                                                                Rejected
                                                            @endif
                                                        </div>
                                                        @if($user->kyc->accept === 0 || $user->kyc->accept === null)
                                                            @can('KYC accept')
                                                                <div class="col-md-2"
                                                                     style="padding-right: 0px; margin-left: -45px;">
                                                                    {{-- <form id="kycForm" action="{{ route('user.changeKYCStatus') }}" method="post">

                                                                         @csrf--}}
                                                                    <input type="hidden" value="{{ $user->kyc->id }}"
                                                                           name="kyc">
                                                                    <input type="hidden" value="accepted" name="status" id="acceptInputValue">
                                                                    <button rel="{{ route('user.changeKYCStatus') }}"
                                                                            id="accept" class="btn btn-primary btn-sm"
                                                                            type="submit">Accept
                                                                    </button>
                                                                    <button id="acceptBtn" type="submit"
                                                                            style="display: none"></button>
                                                                    {{--</form>--}}
                                                                </div>
                                                            @endcan
                                                        @endif

                                                        @if($user->kyc->accept == 1 || $user->kyc->accept === null)
                                                            @can('KYC reject')
                                                                <div class="col-md-2"
                                                                     style="padding-left: 0px; margin-left: -10px;">
                                                                    {{--<form id="kycForm" action="{{ route('user.changeKYCStatus') }}" method="post">
                                                                        @csrf--}}
                                                                    <input type="hidden" value="{{ $user->kyc->id }}"
                                                                           name="kyc">
                                                                    <input type="hidden" value="rejected" name="status">
                                                                    <a data-toggle="modal" href="#modal-reject-kyc">
                                                                        <button class="btn btn-danger btn-sm"
                                                                                type="button">
                                                                            Reject
                                                                        </button>
                                                                    </a>
                                                                    <button id="rejectBtn" type="submit"
                                                                            style="display: none"></button>
                                                                    <div id="modal-reject-kyc" class="modal fade"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <h3 class="m-t-none m-b">
                                                                                                Reason of rejection</h3>
                                                                                            <hr>
                                                                                            <div
                                                                                                class="form-group  row">
                                                                                                <textarea
                                                                                                    class="form-control"
                                                                                                    name="reason"
                                                                                                    id="reason"
                                                                                                    placeholder="Reason of rejection"
                                                                                                    style="width: 100%">Your KYC form has been rejected</textarea>
                                                                                            </div>

                                                                                            <div
                                                                                                class="hr-line-dashed"></div>

                                                                                            <button style="width: 100%"
                                                                                                    rel="{{ route('user.changeKYCStatus') }}"
                                                                                                    id="reject"
                                                                                                    class="btn btn-danger ">
                                                                                                Reject
                                                                                            </button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{--</form>--}}
                                                                </div>
                                                            @endcan
                                                        @endif
                                                    </div>
                                                </dd>
                                            @endif

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="first_name" {{ optional($user->kyc->kycValidation)->first_name ? "checked" : "" }}>
                                                        <i></i> First Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{$user->kyc->first_name == null ? 'Not available' : $user->kyc->first_name}}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="middle_name" {{ optional($user->kyc->kycValidation)->middle_name ? "checked" : "" }}>
                                                        <i></i> Middle Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{$user->kyc->middle_name == null ? ' ' : $user->kyc->middle_name}}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="last_name" {{ optional($user->kyc->kycValidation)->last_name ? "checked" : "" }}>
                                                        <i></i> Last Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{$user->kyc->last_name == null ? 'Not available' : $user->kyc->last_name}}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="email" {{ optional($user->kyc->kycValidation)->email ? "checked" : "" }}>
                                                        <i></i> Email
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{$user->kyc->email == null ? 'Not available' : $user->kyc->email}}</dd>


                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="date_of_birth" {{ optional($user->kyc->kycValidation)->date_of_birth ? "checked" : "" }}>
                                                        <i></i> Date of Birth
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->date_of_birth }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="gender" {{ optional($user->kyc->kycValidation)->gender ? "checked" : "" }}>
                                                        <i></i> Gender
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">
                                                @if($user->kyc->gender == 'm')
                                                    Male
                                                @elseif($user->kyc->gender == 'f')
                                                    Female
                                                @elseif($user->kyc->gender == 'o')
                                                    Other
                                                @endif
                                            </dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="fathers_name" {{ optional($user->kyc->kycValidation)->fathers_name ? "checked" : "" }}>
                                                        <i></i>Father's Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->fathers_name }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="mothers_name" {{ optional($user->kyc->kycValidation)->mothers_name ? "checked" : "" }}>
                                                        <i></i>Mother's Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->mothers_name }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="grand_fathers_name" {{ optional($user->kyc->kycValidation)->grand_fathers_name ? "checked" : "" }}>
                                                        <i></i>Grandfathers's Name
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->grand_fathers_name }}</dd>


                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="spouse_name" {{ optional($user->kyc->kycValidation)->spouse_name ? "checked" : "" }}>
                                                        <i></i>Spouse Name
                                                    </label>
                                                </div>
                                            </dt>


                                            <dd class="col-md-8">{{ $user->kyc->spouse_name }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="occupation" {{ optional($user->kyc->kycValidation)->occupation ? "checked" : "" }}>
                                                        <i></i>Occupation
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->occupation }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="document_type" {{ optional($user->kyc->kycValidation)->document_type ? "checked" : "" }}>
                                                        <i></i>Identity Type
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->documentationType() }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="id_no" {{ optional($user->kyc->kycValidation)->id_no ? "checked" : "" }}>
                                                        <i></i>Identity Number
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->id_no }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="c_issued_date" {{ optional($user->kyc->kycValidation)->c_issued_date ? "checked" : "" }}>
                                                        <i></i>Identity Issue Date
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ date('M d, Y', strtotime($user->kyc->c_issued_date)) }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="c_issued_from" {{ optional($user->kyc->kycValidation)->c_issued_from ? "checked" : "" }}>
                                                        <i></i>Identity Issue From
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->c_issued_from }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="province" {{ optional($user->kyc->kycValidation)->province ? "checked" : "" }}>
                                                        <i></i>Province
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->province }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="zone" {{ optional($user->kyc->kycValidation)->zone ? "checked" : "" }}>
                                                        <i></i>Zone
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->zone }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="district" {{ optional($user->kyc->kycValidation)->district ? "checked" : "" }}>
                                                        <i></i>District
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->district }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="municipality" {{ optional($user->kyc->kycValidation)->municipality ? "checked" : "" }}>
                                                        <i></i>Municipality
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->municipality }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="ward_no" {{ optional($user->kyc->kycValidation)->ward_no ? "checked" : "" }}>
                                                        <i></i>Ward No.
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->ward_no }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="tmp_province" {{ optional($user->kyc->kycValidation)->tmp_province ? "checked" : "" }}>
                                                        <i></i>Tmp Province
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->tmp_province }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="tmp_zone" {{ optional($user->kyc->kycValidation)->tmp_zone ? "checked" : "" }}>
                                                        <i></i>Tmp Zone
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->tmp_zone }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="tmp_district" {{ optional($user->kyc->kycValidation)->tmp_district ? "checked" : "" }}>
                                                        <i></i>Tmp District
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->tmp_district }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="tmp_municipality" {{ optional($user->kyc->kycValidation)->tmp_municipality ? "checked" : "" }}>
                                                        <i></i>Tmp Municipality
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->tmp_municipality }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="tmp_ward_no" {{ optional($user->kyc->kycValidation)->tmp_ward_no ? "checked" : "" }}>
                                                        <i></i>Tmp Ward No.
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->tmp_ward_no }}</dd>



                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="p_photo" {{ optional($user->kyc->kycValidation)->p_photo ? "checked" : "" }}>
                                                        <i></i>Passport size photo
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->p_photo }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="id_photo_front" {{ optional($user->kyc->kycValidation)->id_photo_front ? "checked" : "" }}>
                                                        <i></i>Document Front Photo
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->id_photo_front }}</dd>

                                            <dt class="col-md-3 text-right">
                                                <div class="i-checks">
                                                    <label>
                                                        <input type="checkbox"
                                                               name="id_photo_back" {{ optional($user->kyc->kycValidation)->id_photo_back ? "checked" : "" }}>
                                                        <i></i>Document Back Photo
                                                    </label>
                                                </div>
                                            </dt>
                                            <dd class="col-md-8">{{ $user->kyc->id_photo_back }}</dd>
                                        @else
                                            <dt class="col-md-3 text-right" style="font-size: 16px;">KYC form not
                                                filled
                                            </dt>
                                        @endif
                                    </dl>
                                </div>

                                @if(!empty($user->kyc))
                                    <div class="col-md-5">
                                        <h3>Documents</h3>
                                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                            <ol class="carousel-indicators">
                                                <li data-target="#carouselExampleIndicators" data-slide-to="0"
                                                    class="active"></li>
                                                <li data-target="#carouselExampleIndicators" data-slide-to="1"
                                                    class=""></li>
                                            </ol>
                                            <div class="carousel-inner">
                                                <div class="carousel-item active">
                                                    <a href="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_front'] }}"
                                                       target="_blank">
                                                        <img class="d-block w-100"
                                                             src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_front'] }}"
                                                             alt="First slide">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <p style="color: black; font-weight: bold;">
                                                                DOCUMENT FRONT
                                                            </p>
                                                        </div>
                                                    </a>

                                                </div>

                                                <div class="carousel-item">
                                                    <a href="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back'] }}"
                                                       target="_blank">
                                                        <img class="d-block w-100"
                                                             src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back'] }}"
                                                             alt="First slide">
                                                        <div class="carousel-caption d-none d-md-block">
                                                            <p style="color: black; font-weight: bold;">
                                                                DOCUMENT BACK
                                                            </p>
                                                        </div>
                                                    </a>

                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                               role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#carouselExampleIndicators"
                                               role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>


                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')

    <style>
        .btn-sm {
            padding: 2px;
        }
    </style>

    <style>
        .profile-image img {
            width: 125px;
            height: 125px;
        }

        .profile-image {
            width: 145px;
        }
    </style>

    <!-- Sweet Alert -->
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
    @include('admin.asset.css.icheck')
@endsection

@section('scripts')

    @include('admin.asset.js.icheck')
    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $('#accept').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "KYC for this user will be verified",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3366ff",
                confirmButtonText: "Yes, accept KYC!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                document.getElementById("acceptInputValue").value = "accepted";
                $('#acceptBtn').trigger('click');
                swal.close();
            })
        });


        $('#reject').on('click', function (e) {

            e.preventDefault();
            let url = $(this).attr('rel');

            swal({
                title: "Are you sure?",
                text: "KYC for this user will be rejected",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#ed5565",
                confirmButtonText: "Yes, reject KYC!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#rejectBtn').trigger('click');
                swal.close();

            })
        });
    </script>
@endsection



