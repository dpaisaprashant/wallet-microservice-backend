<div role="tabpanel" id="agent" class="tab-pane @if($activeTab == 'agent') active @endif">
    <div class="panel-body">

        <div class="row">
            <div class="col-md-7">
                <dl class="row m-t-md">

                    @if(!empty($user->agent))

                        <dt class="col-md-3 text-right">Agent OR Sub Agent</dt>
                        <dd class="col-md-8">@if($user->isAgent()) AGENT @elseif($user->isSubAgent()) SUB AGENT @endif</dd>

                        @isset($user->agent->code_used_id)
                        <dt class="col-md-3 text-right">Parent Agent</dt>
                        <dd class="col-md-8">{{ $user->agent->codeUsed->name . " ({$user->agent->codeUsed->mobile_no})" }}</dd>
                        @endisset
                        <dt class="col-md-3 text-right">Business Name</dt>
                        <dd class="col-md-8">{{ $user->agent->business_name }}</dd>

                        <dt class="col-md-3 text-right">Business Pan</dt>
                        <dd class="col-md-8">{{ $user->agent->business_pan }}</dd>

                        <dt class="col-md-3 text-right">Agent Type</dt>
                        <dd class="col-md-8">
                            @isset($user->agent->agentType)
                            {{ $user->agent->agentType->name }}
                            @else
                                NOT SET
                            @endisset
                        </dd>

                        <dt class="col-md-3 text-right">Reference Code</dt>
                        <dd class="col-md-8">{{ $user->agent->reference_code }}</dd>

                        <dt class="col-md-3 text-right">Company Address</dt>
                        <dd class="col-md-8">{{ $user->agent->company_address }}</dd>

                    @else
                        <dt class="col-md-3 text-right" style="font-size: 16px;">Agent form not filled</dt>
                    @endif
                </dl>
            </div>
            @if(!empty($user->agent))
                <div class="col-md-5">
                    <h3>Documents</h3>
                    <div id="agentCarouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @isset($user->agent['business_document'])
                                <li data-target="#agentCarouselExampleIndicators" data-slide-to="0" class="active"></li>
                            @endisset

                            @isset($user->agent['business_owner_citizenship_front'])
                                <li data-target="#agentCarouselExampleIndicators" data-slide-to="1" class="@if(empty($user->agent['business_document'])) active @endif"></li>
                            @endisset

                            @isset($user->agent['business_owner_citizenship_back'])
                                <li data-target="#agentCarouselExampleIndicators" data-slide-to="2" class=""></li>
                            @endisset

                                @isset($user->agent['pp_photo'])
                                    <li data-target="#agentCarouselExampleIndicators" data-slide-to="3" class=""></li>
                                @endisset

                                @isset($user->agent['pan_vat_document'])
                                    <li data-target="#agentCarouselExampleIndicators" data-slide-to="3" class=""></li>
                                @endisset

                            @isset($user->agent['tax_clearance_certificate'])
                                <li data-target="#agentCarouselExampleIndicators" data-slide-to="3" class=""></li>
                            @endisset
                        </ol>
                        <div class="carousel-inner">

                            @isset($user->agent['business_document'])
                            <div class="carousel-item active">
                                <a href="{{ config('dpaisa-api-url.agent_url') . $user->agent['business_document'] }}" target="_blank">
                                    <img class="d-block w-100" src="{{ config('dpaisa-api-url.agent_url') . $user->agent['business_document'] }}" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            BUSINESS DOCUMENT
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endisset

                            @isset($user->agent['business_owner_citizenship_front'])
                            <div class="carousel-item @if(empty($user->agent['business_document'])) active @endif">
                                <a href="{{ config('dpaisa-api-url.agent_url') . $user->agent['business_owner_citizenship_front'] }}" target="_blank">
                                    <img class="d-block w-100" src="{{ config('dpaisa-api-url.agent_url') . $user->agent['business_owner_citizenship_front'] }}" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                           BUSINESS OWNER CITIZENSHIP FRONT
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endisset

                            @isset($user->agent['business_owner_citizenship_back'])
                            <div class="carousel-item">
                                <a href="{{ config('dpaisa-api-url.agent_url') . $user->agent['business_owner_citizenship_back'] }}" target="_blank">
                                    <img class="d-block w-100" src="{{ config('dpaisa-api-url.agent_url') . $user->agent['business_owner_citizenship_back'] }}" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            BUSINESS OWNER CITIZENSHIP BACK
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endisset

                            @isset($user->agent['pp_photo'])
                            <div class="carousel-item">
                                <a href="{{ config('dpaisa-api-url.agent_url') . $user->agent['pp_photo'] }}" target="_blank">
                                    <img class="d-block w-100" src="{{ config('dpaisa-api-url.agent_url') . $user->agent['pp_photo'] }}" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            PP PHOTO
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endisset

                            @isset($user->agent['pan_vat_document'])
                                    <div class="carousel-item">
                                        <a href="{{ config('dpaisa-api-url.agent_url') . $user->agent['pan_vat_document'] }}" target="_blank">
                                            <img class="d-block w-100" src="{{ config('dpaisa-api-url.agent_url') . $user->agent['pan_vat_document'] }}" alt="First slide">
                                            <div class="carousel-caption d-none d-md-block">
                                                <p style="color: black; font-weight: bold;">
                                                    PAN/VAT DOCUMENT
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endisset

                            @isset($user->agent['tax_clearance_certificate'])
                            <div class="carousel-item">
                                <a href="{{ config('dpaisa-api-url.agent_url') . $user->agent['tax_clearance_certificate'] }}" target="_blank">
                                    <img class="d-block w-100" src="{{ config('dpaisa-api-url.agent_url') . $user->agent['tax_clearance_certificate'] }}" alt="First slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <p style="color: black; font-weight: bold;">
                                            TAX CLEARANCE CERTIFICATE
                                        </p>
                                    </div>
                                </a>
                            </div>
                            @endisset
                        </div>

                        <a class="carousel-control-prev" href="#agentCarouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#agentCarouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
