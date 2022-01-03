@extends('admin.layouts.admin_design')
@section('content')
    @can('Edit user kyc')
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row m-b-lg m-t-lg">
                <div class="col-md-4" style="margin-top: 20px;">
                    <div class="profile-image">
                        @isset($user->kyc['p_photo'])
                            <img src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['p_photo'] }}"
                                 class="rounded-circle circle-border m-b-md" alt="profile">
                        @else
                            <img src="{{ asset('admin/img/a4.jpg') }}" class="rounded-circle circle-border m-b-md"
                                 alt="profile">
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
                            <h5>Edit User KYC Details</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{route('user.updateKyc',$user->id)}}"
                                  enctype="multipart/form-data">
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
                                                                <i style="color: green;" class="fa fa-check"></i>
                                                                Verified
                                                            </div>
                                                        </div>
                                                    </dd>
                                                @else
                                                    <dt class="col-md-3 text-right"
                                                        style="margin-top: auto; margin-bottom: auto;">Verification
                                                        Status
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
                                                        </div>
                                                    </dd>
                                                @endif
                                                <dt class="col-md-3 text-right">
                                                    <label for="first_name">First Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="first_name"
                                                           value="{{$user->kyc->first_name == null ? 'Not available' : $user->kyc->first_name}}"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="middle_name">Middle Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="middle_name"
                                                           value="{{$user->kyc->middle_name == null ? ' ' : $user->kyc->middle_name}}">
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="last_name">Last Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="last_name"
                                                           value="{{$user->kyc->last_name == null ? 'Not available' : $user->kyc->last_name}}"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="email">Email:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="email"
                                                           value="{{$user->kyc->email == null ? 'Not available' : $user->kyc->email}}"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="date_of_birth">Date Of Birth:</label>
                                                <dd class="col-md-8">
                                                        @include('admin.user.datepicker',['type'=>'dob'])
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="gender">Gender:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <select name="gender" class="form-control form-control-sm" required>
                                                        @if($user->kyc->gender == 'm')
                                                            <option selected value="m">Male</option>
                                                            <option value="f">Female</option>
                                                            <option value="o">Other</option>
                                                        @elseif($user->kyc->gender == 'f')
                                                            <option value="m">Male</option>
                                                            <option selected value="f">Female</option>
                                                            <option value="o">Other</option>
                                                        @elseif($user->kyc->gender == 'o')
                                                            <option value="m">Male</option>
                                                            <option value="f">Female</option>
                                                            <option selected value="o">Other</option>
                                                        @endif
                                                    </select>

                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="fathers_name">Fathers Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="fathers_name" value="{{ $user->kyc->fathers_name }}"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="mothers_name">Mothers Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="mothers_name" value="{{ $user->kyc->mothers_name }}"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="grand_fathers_name">Grandfather's Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="grand_fathers_name"
                                                           value="{{ $user->kyc->grand_fathers_name }}" required>
                                                </dd>


                                                <dt class="col-md-3 text-right">
                                                    <label for="spouse_name">Spouse Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="spouse_name" value="{{ $user->kyc->spouse_name }}">
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="occupation">Occupation:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="occupation" value="{{ $user->kyc->occupation }}"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="document_type">Identity Type:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <select name="document_type" class="form-control form-control-sm"
                                                            required>
                                                        @if($user->kyc->document_type == 'c')
                                                            <option selected value="c">Citizenship</option>
                                                            <option value="p">Passport</option>
                                                            <option value="l">License</option>
                                                        @elseif($user->kyc->gender == 'p')
                                                            <option value="c">Citizenship</option>
                                                            <option selected value="p">Passport</option>
                                                            <option value="l">License</option>
                                                        @elseif($user->kyc->gender == 'l')
                                                            <option value="c">Citizenship</option>
                                                            <option value="p">Passport</option>
                                                            <option selected value="l">License</option>
                                                        @else
                                                            <option selected value="">Select Document</option>
                                                            <option value="c">Citizenship</option>
                                                            <option value="p">Passport</option>
                                                            <option value="l">License</option>
                                                        @endif
                                                    </select>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="id_no">Identity Number:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="id_no"
                                                           value="{{ $user->kyc->id_no }}" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="c_issued_date">Identity Issue Date:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    @include('admin.user.datepicker',['type'=>'issueDate'])
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="c_issued_from">Identity Issue From:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="c_issued_from" value="{{ $user->kyc->c_issued_from }}"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="province">Province:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <select name="province" id="province" class="form-control form-control-sm" required>
                                                        @if($user->kyc->province)
                                                            <option value="" disabled><b>-- Select Province --</b></option>
                                                            <option value="{{$user->kyc->province}}" selected>{{$user->kyc->province}}</option>
                                                        @else
                                                            <option value="" selected disabled>-- Select Province --</option>
                                                        @endif
                                                        @foreach($provinces as $province)
                                                            @if(!($user->kyc->province == $province))
                                                                <option value="{{$province}}">{{$province}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </dd>


                                                    <dt class="col-md-3 text-right">
                                                    <label for="district">District:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                    <select name="district" id="district" class="form-control form-control-sm" required>
                                                @if($user->kyc->province)
                                                        <option value="" disabled><b>-- Select District --</b></option>
                                            @else
                                                <option value="" selected disabled>-- Select District --</option>
                                                    @endif
                                                </select>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                    <label for="municipality">Municipality:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                    <select name="municipality" id="municipality" class="form-control form-control-sm" required>
                                                @if($user->kyc->municipality)
                                                        <option value="" disabled><b>-- Select Municipality --</b></option>
                                            @else
                                                <option value="" selected disabled>-- Select Municipality --</option>
                                                    @endif
                                                </select>
                                                    </dd>
                                                    <dt class="col-md-3 text-right">
                                                        <label for="zone">Zone:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <select name="zone" class="form-control form-control-sm">
                                                            @if($user->kyc->zone)
                                                                <option value="" disabled><b>-- Select Zone --</b></option>
                                                                <option value="{{strtoupper($user->kyc->zone)}}" selected>{{$user->kyc->zone}}</option>
                                                            @else
                                                                <option value="" selected disabled>-- Select Zone --</option>
                                                            @endif
                                                            @foreach($zones as $zone)
                                                                @if(!(strtoupper($user->kyc->zone) == $zone))
                                                                    <option value="{{$zone}}">{{$zone}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="ward_no">Ward No:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="ward_no" value="{{ $user->kyc->ward_no }}" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="tmp_province">Temporary Province:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <select name="tmp_province" id="tmp_province" class="form-control form-control-sm" required>
                                                        @if($user->kyc->tmp_province)
                                                            <option value="" disabled><b>-- Select Temporary Province --</b></option>
                                                            <option value="{{$user->kyc->tmp_province}}" selected>{{$user->kyc->tmp_province}}</option>
                                                        @else
                                                            <option value="" selected disabled>-- Select Temporary Province --</option>
                                                        @endif
                                                        @foreach($provinces as $province)
                                                            @if(!($user->kyc->tmp_province == $province))
                                                                <option value="{{$province}}">{{$province}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </dd>


                                                    <dt class="col-md-3 text-right">
                                                    <label for="tmp_district">Temporary District:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                    <select name="tmp_district" id="tmp_district" class="form-control form-control-sm" required>
                                                @if($user->kyc->tmp_province)
                                                        <option value="" disabled><b>-- Select Temporary District --</b></option>
                                            @else
                                                <option value="" selected disabled>-- Select Temporary District --</option>
                                                    @endif
                                                </select>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                    <label for="tmp_municipality">Temporary Municipality:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                    <select name="tmp_municipality" id="tmp_municipality" class="form-control form-control-sm" required>
                                                @if($user->kyc->tmp_municipality)
                                                        <option value="" disabled><b>-- Select Municipality --</b></option>
                                            @else
                                                <option value="" selected disabled>-- Select Municipality --</option>
                                                    @endif
                                                </select>
                                                    </dd>
                                                    <dt class="col-md-3 text-right">
                                                        <label for="tmp_zone">Temporary Zone:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <select name="tmp_zone" class="form-control form-control-sm">
                                                            @if($user->kyc->tmp_zone)
                                                                <option value="" disabled><b>-- Select Temporary Zone --</b></option>
                                                                <option value="{{strtoupper($user->kyc->tmp_zone)}}" selected>{{$user->kyc->tmp_zone}}</option>
                                                            @else
                                                                <option value="" selected disabled>-- Select Temporary Zone --</option>
                                                            @endif
                                                            @foreach($zones as $zone)
                                                                @if(!(strtoupper($user->kyc->tmp_zone) == $zone))
                                                                    <option value="{{$zone}}">{{$zone}}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="tmp_ward_no">Temporary Ward No:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm"
                                                           name="tmp_ward_no" value="{{ $user->kyc->tmp_ward_no }}"
                                                           required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="p_photo">Passport Size Photo: </label>
                                                </dt>
                                                <dd class="col-md-7">
                                                    <div class="custom-file">
                                                        <input name="p_photo" type="file" class="custom-file-input">
                                                        <label for="p_photo" class="custom-file-label">Upload Passport
                                                            size photo...</label>
                                                    </div>
                                                </dd>
                                                <dd class="col-md-1">
                                                    <img
                                                        src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['p_photo'] }}"
                                                        style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                        alt="">
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="id_photo_front">Document Front Photo: </label>
                                                </dt>
                                                <dd class="col-md-7">

                                                    <div class="custom-file">
                                                        <input name="id_photo_front" type="file"
                                                               class="custom-file-input">
                                                        <label for="id_photo_front" class="custom-file-label">Upload
                                                            Document Front Photo...</label>
                                                    </div>
                                                </dd>
                                                <dd class="col-md-1">
                                                    <img
                                                        src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_front'] }}"
                                                        style="max-width: 50px; max-height: 35px; object-fit: cover"
                                                        alt="">
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="id_photo_back">Document back Photo: </label>
                                                </dt>
                                                <dd class="col-md-7">
                                                    <div class="custom-file">
                                                        <input name="id_photo_back" type="file"
                                                               class="custom-file-input">
                                                        <label for="id_photo_back" class="custom-file-label">Upload
                                                            Document Back Photo...</label>
                                                    </div>
                                                </dd>
                                                <dd class="col-md-1">
                                                    <img
                                                        src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back'] }}"
                                                        style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                        alt="">
                                                </dd>

                                                @if($user->merchant()->first())
                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_name">Company name</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="company_name"
                                                               value="{{ $user->kyc->company_name }}" required>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_address">Company address</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="company_address"
                                                               value="{{ $user->kyc->company_address }}" required>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_vat_pin_number">Company VAT PIN
                                                            number:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm"
                                                               name="company_vat_pin_number"
                                                               value="{{ $user->kyc->company_vat_pin_number }}"
                                                               required>
                                                    </dd>


                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_logo">Company Logo: </label>
                                                    </dt>
                                                    <dd class="col-md-7">
                                                        <div class="custom-file">
                                                            <input name="company_logo" type="file"
                                                                   class="custom-file-input">
                                                            <label for="company_logo" class="custom-file-label">Upload
                                                                Company Logo...</label>
                                                        </div>
                                                    </dd>
                                                    <dd class="col-md-1">
                                                        <img
                                                            src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_logo'] }}"
                                                            style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                            alt="">
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_document">Company Document:</label>
                                                    </dt>
                                                    <dd class="col-md-7">
                                                        <div class="custom-file">
                                                            <input name="company_document" type="file"
                                                                   class="custom-file-input">
                                                            <label for="company_document" class="custom-file-label">Upload
                                                                Company Document...</label>
                                                        </div>
                                                    </dd>
                                                    <dd class="col-md-1">
                                                        <img
                                                            src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_logo'] }}"
                                                            style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                            alt="">
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_vat_document">Company VAT Document:</label>
                                                    </dt>
                                                    <dd class="col-md-7">
                                                        <div class="custom-file">
                                                            <input name="company_vat_document" type="file"
                                                                   class="custom-file-input">
                                                            <label for="company_vat_document" class="custom-file-label">Upload
                                                                Company VAT Document...</label>
                                                        </div>
                                                    </dd>
                                                    <dd class="col-md-1">
                                                        <img
                                                            src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_vat_document'] }}"
                                                            style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                            alt="">
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_tax_clearance_document">Company Tax
                                                            Clearance Document:</label>
                                                    </dt>
                                                    <dd class="col-md-7">
                                                        <div class="custom-file">
                                                            <input name="company_tax_clearance_document" type="file"
                                                                   class="custom-file-input">
                                                            <label for="company_tax_clearance_document"
                                                                   class="custom-file-label">Upload Company Tax
                                                                Clearance Document...</label>
                                                        </div>
                                                    </dd>
                                                    <dd class="col-md-1">
                                                        <img
                                                            src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_tax_clearance_document'] }}"
                                                            style="max-width: 50px; max-height: 35px;object-fit: cover"
                                                            alt="">
                                                    </dd>
                                                @endif

                                                <div class="col-sm-4 col-sm-offset-2" style="float:right">
                                                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                                </div>
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
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_front'] }}"
                                                           target="_blank">
                                                            <img
                                                                src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_front'] }}"
                                                                style="max-width: 500px;object-fit: cover"
                                                                alt="">
                                                            <p style="color: black; font-weight: bold;">
                                                                &nbsp;DOCUMENT FRONT
                                                            </p>
                                                        </a>
                                                    </div>

                                                    <div class="col-12">
                                                        <a href="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back'] }}"
                                                           target="_blank"></a>
                                                        <img
                                                            src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['id_photo_back'] }}"
                                                            style="max-width: 500px;object-fit: cover"
                                                            alt="">
                                                        <p style="color: black; font-weight: bold;">
                                                            &nbsp;DOCUMENT BACK
                                                        </p>
                                                    </div>

                                                    @if($user->merchant()->first())

                                                        <div class="col-12">
                                                            <a href="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_document'] }}"
                                                               target="_blank"></a>
                                                            <img
                                                                src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_document'] }}"
                                                                style="max-width: 500px;object-fit: cover"
                                                                alt="">
                                                            <p style="color: black; font-weight: bold;">
                                                                &nbsp;COMPANY DOCUMENT
                                                            </p>
                                                        </div>

                                                        <div class="col-12">
                                                            <a href="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_logo'] }}"
                                                               target="_blank">
                                                                <img
                                                                    src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_logo'] }}"
                                                                    style="max-width: 500px;object-fit: cover"
                                                                    alt="">
                                                                <p style="color: black; font-weight: bold;">
                                                                    &nbsp;COMPANY LOGO
                                                                </p>
                                                            </a>
                                                        </div>

                                                        <div class="col-12">
                                                            <a href="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_vat_document'] }}"
                                                               target="_blank">
                                                                <img
                                                                    src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_vat_document'] }}"
                                                                    style="max-width: 500px;object-fit: cover"
                                                                    alt="">
                                                                <p style="color: black; font-weight: bold;">
                                                                    &nbsp;COMPANY VAT DOCUMENT
                                                                </p>
                                                            </a>
                                                        </div>

                                                        <div class="col-12">
                                                            <a href="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_tax_clearance_document'] }}"
                                                               target="_blank">
                                                                <img
                                                                    src="{{ config('dpaisa-api-url.kyc_documentation_url') . $user->kyc['company_tax_clearance_document'] }}"
                                                                    style="max-width: 500px;object-fit: cover"
                                                                    alt="">
                                                                <p style="color: black; font-weight: bold;">
                                                                    &nbsp;COMPANY TAX CLEARANCE DOCUMENT
                                                                </p>
                                                            </a>
                                                        </div>

                                                    @endif
                                                </div>
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
    @endcan
@endsection

@section('styles')

    <style>
        .select {
            display: none;
        }

        label {
            margin-right: 20px;
        }
    </style>

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
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.chosen')
@endsection

@section('scripts')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.icheck')
    @include('admin.asset.js.chosen')
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
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, accept KYC!",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                document.getElementById("acceptStatusInput").value = "accepted";
                $('#acceptBtn').trigger('click');
                swal.close();
            })
        });

        //
        // $('#reject').on('click', function (e) {
        //
        //     e.preventDefault();
        //     let url = $(this).attr('rel');
        //
        //     swal({
        //         title: "Are you sure?",
        //         text: "KYC for this user will be rejected",
        //         type: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#ed5565",
        //         confirmButtonText: "Yes, reject KYC!",
        //         closeOnConfirm: true,
        //         closeOnClickOutside: true
        //     }, function () {
        //         $('#rejectBtn').trigger('click');
        //         swal.close();
        //
        //     })
        // });


        var checkAll = $('.select-all');
        var checkboxes = $('input[type="checkbox"]');


        checkAll.on('ifChecked ifUnchecked', function (event) {

            if (event.type == "ifChecked") {
                $('input[type="checkbox"]').iCheck('check');
                $('#selectdata').html('<b>Deselect all</b>');
            } else {
                $('input[type="checkbox"]').iCheck('uncheck');
                $('#selectdata').html('<b>Select all</b>');
            }

        });


    </script>
    <script>
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>

    <script>
        function showDobBS(){
            document.getElementById('BS').style.display ='block';
            document.getElementById('AD').style.display ='none';
        }
        function showDobAD(){
            document.getElementById('AD').style.display ='block';
            document.getElementById('BS').style.display ='none';
        }
        function showIssueDateBS(){
            document.getElementById('BS_issue').style.display ='block';
            document.getElementById('AD_issue').style.display ='none';
        }
        function showIssueDateAD(){
            document.getElementById('AD_issue').style.display ='block';
            document.getElementById('BS_issue').style.display ='none';
        }
    </script>
{{--pre loading the districts, the municipalities--}}
    <script>
        $(window).on('load',function() {
            //pre-loading permanent Districts
            if (`{{$user->kyc->province}}`){
                $('select#province').filter(function (e) {
                    let province = `{{$user->kyc->province}}`;

                    let url = `{{ route('get.district') }}`


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: "POST",
                        data: {province: province},
                        dataType: 'JSON',
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            $("#overlay").fadeIn(300);
                        },
                        success: function (resp) {
                            console.log(resp)

                            let select = $('#district');
                            select.find('option').remove().end();

                            $.each(resp, function (key, value) {
                                if (`{{$user->kyc->district}}` == value){
                                    let o = new Option(value, value, false, true);
                                    select.append(o);
                                }else {
                                    let o = new Option(value, value, false, false);
                                    select.append(o);
                                }
                            });
                            select.trigger("chosen:updated");

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);

                        },
                        error: function (resp) {
                            console.log(resp);
                            alert('error');

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);
                        }
                    });
                });
            }
            //pre-loading permanent Districts Ends

            //pre-loading permanent Municipalities
            if (`{{$user->kyc->district}}`){
                $('select#district').filter(function (e) {
                    let district = `{{$user->kyc->district}}`;

                    let url = `{{ route('get.municipality') }}`


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: "POST",
                        data: {district: district},
                        dataType: 'JSON',
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            $("#overlay").fadeIn(300);
                        },
                        success: function (resp) {
                            console.log(resp)

                            let select = $('#municipality');
                            select.find('option').remove().end();

                            $.each(resp, function (key, value) {
                                if (`{{$user->kyc->municipality}}` == value){
                                    let o = new Option(value, value, false, true);
                                    select.append(o);
                                }else {
                                    let o = new Option(value, value, false, false);
                                    select.append(o);
                                }
                            });
                            select.trigger("chosen:updated");

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);

                        },
                        error: function (resp) {
                            console.log(resp);
                            alert('error');

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);
                        }
                    });
                });
            }
            //pre-loading permanent Municipalities Ends

        //    pre-loading temporary Districts
            if (`{{$user->kyc->tmp_province}}`){
                $('select#tmp_province').filter(function (e) {
                    let province = `{{$user->kyc->tmp_province}}`;

                    let url = `{{ route('get.district') }}`


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: "POST",
                        data: {province: province},
                        dataType: 'JSON',
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            $("#overlay").fadeIn(300);
                        },
                        success: function (resp) {
                            console.log(resp)

                            let select = $('#tmp_district');
                            select.find('option').remove().end();

                            $.each(resp, function (key, value) {
                                if (`{{$user->kyc->tmp_district}}` == value){
                                    let o = new Option(value, value, false, true);
                                    select.append(o);
                                }else {
                                    let o = new Option(value, value, false, false);
                                    select.append(o);
                                }
                            });
                            select.trigger("chosen:updated");

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);

                        },
                        error: function (resp) {
                            console.log(resp);
                            alert('error');

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);
                        }
                    });
                });
            }
        //    pre-loadiing Temporary Districts Ends

        //    pre_loading Temporary Municipalities Starts
            if (`{{$user->kyc->tmp_district}}`){
                $('select#tmp_district').filter(function (e) {
                    let district = `{{$user->kyc->tmp_district}}`;

                    let url = `{{ route('get.municipality') }}`


                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        method: "POST",
                        data: {district: district},
                        dataType: 'JSON',
                        cache: false,
                        async: true,
                        beforeSend: function () {
                            $("#overlay").fadeIn(300);
                        },
                        success: function (resp) {
                            console.log(resp)

                            let select = $('#tmp_municipality');
                            select.find('option').remove().end();

                            $.each(resp, function (key, value) {
                                if (`{{$user->kyc->tmp_municipality}}` == value){
                                    let o = new Option(value, value, false, true);
                                    select.append(o);
                                }else {
                                    let o = new Option(value, value, false, false);
                                    select.append(o);
                                }
                            });
                            select.trigger("chosen:updated");

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);

                        },
                        error: function (resp) {
                            console.log(resp);
                            alert('error');

                            $(".stats").fadeIn(300);
                            $("#overlay").fadeOut(300);
                        }
                    });
                });
            }
        //    pre_loading Temporary Municipalities Ends

        });
    </script>
{{--pre loading the districts, the municipalities ends --}}

{{--for permanent district--}}
    <script>
        $('#province').on('change', function (e) {
            let province = $(this).val();
            console.log(province);

            let url = `{{ route('get.district') }}`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {province: province},
                dataType: 'JSON',
                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    console.log(resp)

                    let select = $('#district');
                    select.find('option').remove().end();

                    let municipality = $('#municipality');
                    municipality.find('option').remove().end();
                    let m = new Option('--Select District First',null,false,);
                    municipality.append(m);
                    municipality.find('option').attr("disabled","disabled");

                    $.each(resp, function (key, value) {
                        if (`{{$user->kyc->district}}` == value){
                            let o = new Option(value, value, false, true);
                            select.append(o);
                        }else {
                            let o = new Option(value, value, false, false);
                            select.append(o);
                        }
                    });
                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });
    </script>
{{--for permanent district ENDS--}}

{{-- for permanent municipalities--}}
    <script>
        $('#district').on('change', function (e) {
            let district = $(this).val();
            console.log(district);

            let url = `{{ route('get.municipality') }}`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {district: district},
                dataType: 'JSON',
                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    console.log(resp)

                    let select = $('#municipality');
                    select.find('option').remove().end();

                    $.each(resp, function (key, value) {
                        if (`{{$user->kyc->municipality}}` == value){
                            let o = new Option(value, value, false, true);
                            select.append(o);
                        }else {
                            let o = new Option(value, value, false, false);
                            select.append(o);
                        }
                    });
                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });
    </script>
{{--    for permanent municipalities ends--}}

{{--    for temporary Districts starts--}}
    <script>
        $('#tmp_province').on('change', function (e) {
            let province = $(this).val();
            console.log(province);

            let url = `{{ route('get.district') }}`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {province: province},
                dataType: 'JSON',
                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    console.log(resp)

                    let select = $('#tmp_district');
                    select.find('option').remove().end();

                    let municipality = $('#tmp_municipality');
                    municipality.find('option').remove().end();
                    let m = new Option('--Select Temporary District First',null,false,);
                    municipality.append(m);
                    municipality.find('option').attr("disabled","disabled")

                    $.each(resp, function (key, value) {
                        if (`{{$user->kyc->tmp_district}}` == value){
                            let o = new Option(value, value, false, true);
                            select.append(o);
                        }else {
                            let o = new Option(value, value, false, false);
                            select.append(o);
                        }
                    });
                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });
    </script>
{{--    for temporary Districts ends--}}

{{--    for temporary Municipality Starts--}}
    <script>
        $('#tmp_district').on('change', function (e) {
            let district = $(this).val();
            console.log(district);

            let url = `{{ route('get.municipality') }}`


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: "POST",
                data: {district: district},
                dataType: 'JSON',
                cache: false,
                async: true,
                beforeSend: function () {
                    $("#overlay").fadeIn(300);
                },
                success: function (resp) {
                    console.log(resp)

                    let select = $('#tmp_municipality');
                    select.find('option').remove().end();

                    $.each(resp, function (key, value) {
                        if (`{{$user->kyc->tmp_municipality}}` == value){
                            let o = new Option(value, value, false, true);
                            select.append(o);
                        }else {
                            let o = new Option(value, value, false, false);
                            select.append(o);
                        }
                    });
                    select.trigger("chosen:updated");

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);

                },
                error: function (resp) {
                    console.log(resp);
                    alert('error');

                    $(".stats").fadeIn(300);
                    $("#overlay").fadeOut(300);
                }
            });
        });
    </script>
{{--    for temporary Municipality Ends--}}

@endsection



