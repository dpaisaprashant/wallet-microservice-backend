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
                    <h3>Agent Documents</h3>
                        <div class="row">

                            @isset($user->agent['business_document'])
                            <div class="col-md-12">
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
                            <div class="col-md-12">
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
                            <div class="col-md-12">
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
                            <div class="col-md-12">
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

                            @isset($user->agent['tax_clearance_certificate'])
                            <div class="col-md-12">
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
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
