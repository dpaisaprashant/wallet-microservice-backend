<div role="tabpanel" id="kyc" class="tab-pane @if($activeTab == 'kyc') active @endif">
    <div class="panel-body">

        <div class="row">
            <div class="col-md-7">
                <dl class="row m-t-md">

                    @if(!empty($merchant->kyc))

                        @if($merchant->kyc->status == 1 )
                            <dt class="col-md-3 text-right" >Verification Status</dt>
                            <dd class="col-md-8">

                                @include('admin.user.kyc.status', ['kyc' => $merchant->kyc])

                            </dd>
                        @else

                            <dt class="col-md-3 text-right" style="margin-top: auto; margin-bottom: auto;" >Verification Status</dt>
                            <dd class="col-md-8" style="margin-top: auto; margin-bottom: auto;" >

                                @can('Verify KYC')
                                    <div class="row">
                                        <div class="col-md-4">
                                            @include('admin.user.kyc.status', ['kyc' => $merchant->kyc])
                                        </div>
                                        <div class="col-md-2" style="padding-right: 0px; margin-left: -45px;">
                                            <form id="kycForm" action="{{ route('user.changeKYCStatus') }}" method="post">

                                                @csrf
                                                <input type="hidden" value="{{ $merchant->kyc->id }}" name="kyc">
                                                <input type="hidden" value="accepted" name="status">
                                                <button rel="{{ route('user.changeKYCStatus') }}" id="accept" class="btn btn-primary btn-sm kyc-btn" type="submit">Accept</button>
                                                <button id="acceptBtn" class="btn btn-primary" type="submit" style="display: none">Verify KYC</button>
                                            </form>
                                        </div>

                                        <div class="col-md-2" style="padding-left: 0px; margin-left: -10px;">
                                            <form id="kycForm" action="{{ route('user.changeKYCStatus') }}" method="post">
                                                @csrf
                                                <input type="hidden" value="{{ $merchant->kyc->id }}" name="kyc">
                                                <input type="hidden" value="rejected" name="status">
                                                <button rel="{{ route('user.changeKYCStatus') }}" id="reject" class="btn btn-danger btn-sm kyc-btn" type="submit">Reject</button>
                                                <button id="rejectBtn" class="btn btn-primary" type="submit" style="display: none">Verify KYC</button>
                                            </form>
                                        </div>
                                    </div>
                                @endcan



                            </dd>

                        @endif



                        <dt class="col-md-3 text-right">Date of Birth</dt>
                        <dd class="col-md-8">{{ date('M d, Y', strtotime($merchant->kyc->date_of_birth)) }}</dd>

                        <dt class="col-md-3 text-right">Gender</dt>
                        <dd class="col-md-8">
                            @if($merchant->kyc->gender == 'm')
                                Male
                            @elseif($merchant->kyc->gender == 'f')
                                Female
                            @elseif($merchant->kyc->gender == 'o')
                                Other
                            @endif
                        </dd>

                        <dt class="col-md-3 text-right">Address</dt>
                        <dd class="col-md-8">{{ $merchant->kyc->municipality }}, {{ $merchant->kyc->district }}, Nepal</dd>

                        <dt class="col-md-3 text-right">Father's Name</dt>
                        <dd class="col-md-8">{{ $merchant->kyc->fathers_name }}</dd>

                        <dt class="col-md-3 text-right">Mother's Name</dt>
                        <dd class="col-md-8">{{ $merchant->kyc->mothers_name }}</dd>

                        <dt class="col-md-3 text-right">Grandfathers's Name</dt>
                        <dd class="col-md-8">{{ $merchant->kyc->grand_fathers_name }}</dd>

                        <dt class="col-md-3 text-right">Occupation</dt>
                        <dd class="col-md-8">{{ $merchant->kyc->occupation }}</dd>

                        <dt class="col-md-3 text-right">Identity Type</dt>
                        <dd class="col-md-8">{{ $merchant->kyc->documentationType() }}</dd>

                        <dt class="col-md-3 text-right">Identity Number</dt>
                        <dd class="col-md-8">{{ $merchant->kyc->id_no }}</dd>

                        <dt class="col-md-3 text-right">Identity Issue Date</dt>
                        <dd class="col-md-8">{{ date('M d, Y', strtotime($merchant->kyc->c_issued_date)) }}</dd>

                        <dt class="col-md-3 text-right">Identity Issue From</dt>
                        <dd class="col-md-8">{{ $merchant->kyc->c_issued_from }}</dd>


                    @else
                        <dt class="col-md-3 text-right" style="font-size: 16px;">KYC form not filled</dt>
                    @endif
                </dl>
            </div>
            @if(!empty($merchant->kyc))
                <div class="col-md-5">
                    <h3>Documents</h3>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1" class=""></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <a href="{{ config('dpaisa-api-url.merchant_kyc_documentation_url') . $merchant->kyc['id_photo_front'] }}" target="_blank">
                                    <img class="d-block w-100" src="{{ config('dpaisa-api-url.merchant_kyc_documentation_url') . $merchant->kyc['id_photo_front'] }}" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            DOCUMENT FRONT
                                        </p>
                                    </div>
                                </a>

                            </div>

                            <div class="carousel-item">
                                <a href="{{ config('dpaisa-api-url.merchant_kyc_documentation_url') . $merchant->kyc['id_photo_back'] }}" target="_blank">
                                    <img class="d-block w-100" src="{{ config('dpaisa-api-url.merchant_kyc_documentation_url') . $merchant->kyc['id_photo_back'] }}" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                           DOCUMENT BACK
                                        </p>
                                    </div>
                                </a>

                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>



                </div>
            @endif
        </div>
    </div>
</div>
