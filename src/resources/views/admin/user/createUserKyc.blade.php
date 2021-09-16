@extends('admin.layouts.admin_design')
@section('content')
    @can('Create user kyc')
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
                            <h5>Create User KYC Detail</h5>
                        </div>
                        <div class="ibox-content">
                            <form method="post" action="{{route('user.storeUserKyc',$user->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <dl class="row m-t-md">
                                                <dt class="col-md-3 text-right">
                                                    <label for="first_name">First Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="first_name" placeholder="Enter First Name" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="middle_name">Middle Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="middle_name" placeholder="Enter Middle Name">
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="last_name">Last Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="last_name" placeholder="Enter Last name" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="email">Email:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="email" placeholder="Enter Email" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="date_of_birth">Date Of Birth:</label>
                                                <dd class="col-md-8">
                                                    <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                        <input type="text" class="form-control date_from" name="date_of_birth" placeholder="Enter Date Of Birth" required>
                                                    </div>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="gender">Gender:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <select name="gender" class="form-control form-control-sm" required>
                                                        <option disabled selected>Select Gender</option>
                                                            <option value="m">Male</option>
                                                            <option value="f">Female</option>
                                                            <option value="o">Other</option>
                                                    </select>

                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="fathers_name">Fathers Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="fathers_name" placeholder="Enter Father's Name" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="mothers_name">Mothers Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="mothers_name" placeholder="Enter Mother's Name" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="grand_fathers_name">Grandfather's Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="grand_fathers_name" placeholder="Enter Grandfather's Name" required>
                                                </dd>


                                                <dt class="col-md-3 text-right">
                                                    <label for="spouse_name">Spouse Name:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="spouse_name" placeholder="Enter Spouse Name">
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="occupation">Occupation:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="occupation" placeholder="Enter Occupation" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="document_type">Identity Type:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <select name="document_type" class="form-control form-control-sm" required>
                                                            <option disabled selected>Select Document Type</option>
                                                            <option value="c">Citizenship</option>
                                                            <option value="p">Passport</option>
                                                            <option value="l">License</option>
                                                    </select>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="id_no">Identity Number:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="id_no" placeholder="Enter Document Id Number" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="c_issued_date">Identity Issue Date:</label>
                                                </dt>
                                            <dd class="col-md-8">
                                                <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    <input type="text" class="form-control date_from" name="c_issued_date" placeholder="Enter Document Issued Date" required>
                                                </div>
                                            </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="c_issued_from">Identity Issue From:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="c_issued_from" placeholder="Enter document Issued From" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="province">Province:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="province" placeholder="Enter Province" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="zone">Zone:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="zone" placeholder="Enter Zone" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="district">District:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="district" placeholder="Enter District" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="municipality">Municipality:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="municipality" placeholder="Enter Municipality" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="ward_no">Ward No:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="ward_no" placeholder="Enter Ward No." required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="tmp_province">Temporary Province:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="tmp_province" placeholder="Enter Temporary Province" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="tmp_zone">Temporary Zone:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="tmp_zone" placeholder="Enter Temporary Zone" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="tmp_district">Temporary District:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="tmp_district" placeholder="Enter Temporary District" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="tmp_municipality">Temporary Municipality:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="tmp_municipality" placeholder="Enter Temporary Municipality" required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="tmp_ward_no">Temporary Ward No:</label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <input type="text" class="form-control form-control-sm" name="tmp_ward_no" placeholder="Enter Temporary Ward No." required>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                    <label for="p_photo">Passport Size Photo: </label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <div class="custom-file">
                                                        <input name="p_photo"  type="file" class="custom-file-input" required>
                                                        <label for="p_photo" class="custom-file-label">Upload Passport size photo...</label>
                                                    </div>
                                                </dd>

                                                <dt class="col-md-3 text-right">
                                                <label for="id_photo_front">Document Front Photo: </label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <div class="custom-file">
                                                        <input name="id_photo_front"  type="file" class="custom-file-input" required>
                                                        <label for="id_photo_front" class="custom-file-label">Upload Document Front Photo...</label>
                                                    </div>
                                                </dd>


                                                <dt class="col-md-3 text-right">
                                                    <label for="id_photo_back">Document back Photo: </label>
                                                </dt>
                                                <dd class="col-md-8">
                                                    <div class="custom-file">
                                                        <input name="id_photo_back"  type="file" class="custom-file-input" required>
                                                        <label for="id_photo_back" class="custom-file-label">Upload Document Back Photo...</label>
                                                    </div>
                                                </dd>


                                        @if($user->merchant()->first())
                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_name">Company name</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm" name="company_name" placeholder="Enter Company Name">
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_address">Company address</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm" name="company_address" placeholder="Enter Company Address" required>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_vat_pin_number">Company VAT PIN number:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input type="text" class="form-control form-control-sm" name="company_vat_pin_number" placeholder="Enter Company VAT PIN Number" required>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_logo">Company Logo: </label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <div class="custom-file">
                                                            <input name="company_logo"  type="file" class="custom-file-input" required>
                                                            <label for="company_logo" class="custom-file-label">Upload Company Logo...</label>
                                                        </div>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_document">Company Document:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input name="company_document"  type="file" class="custom-file-input" required>
                                                        <label for="company_document" class="custom-file-label">Upload Company Document...</label>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_vat_document">Company VAT Document:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input name="company_vat_document"  type="file" class="custom-file-input" required>
                                                        <label for="company_vat_document" class="custom-file-label">Upload Company VAT Document...</label>
                                                    </dd>

                                                    <dt class="col-md-3 text-right">
                                                        <label for="company_tax_clearance_document">Company Tax Clearance Document:</label>
                                                    </dt>
                                                    <dd class="col-md-8">
                                                        <input name="company_tax_clearance_document"  type="file" class="custom-file-input" required>
                                                        <label for="company_tax_clearance_document" class="custom-file-label">Upload Company Tax Clearance Document...</label>
                                                    </dd>
                                                @endif
                                            <br>
                                            <dd class="col-md-11">
                                            <button class="btn btn-primary btn-sm" type="submit" style="float: right;width: 100px;height: 40px;">
                                                Submit
                                            </button>
                                            </dd>
                                        </dl>
                                    </div>
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
    @include('admin.asset.js.datepicker')
    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endsection



