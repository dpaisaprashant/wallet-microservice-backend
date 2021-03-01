<div role="tabpanel" id="companyInfo" class="tab-pane @if($activeTab == 'companyInfo') active @endif">
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

                        <dt class="col-md-3 text-right">Company Name</dt>
                        <dd class="col-md-8">{{ $merchant->kyc->company_name }}</dd>

                        <dt class="col-md-3 text-right">Company Address</dt>
                        <dd class="col-md-8">{{ $merchant->kyc->company_address }}</dd>



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
                                <a href="{{ config('dpaisa-api-url.merchant_kyc_documentation_url') . $merchant->kyc['company_document'] }}" target="_blank">
                                    <img class="d-block w-100" src="{{ config('dpaisa-api-url.merchant_kyc_documentation_url') . $merchant->kyc['company_document'] }}" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            COMPANY DOCUMENT
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
