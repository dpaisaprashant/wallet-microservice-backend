@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Edit Agent</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Edit Agent</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Select User</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="col-md-12">
                            @include('admin.asset.notification.notify')
                        </div>
                        <form method="post" action="{{ route('agent.edit', $agent->id) }}" enctype="multipart/form-data"
                              id="agentForm">
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Mobile No.</label>
                                <div class="col-sm-10">
                                    <input name="mobile_no" value="{{ $agent->user->mobile_no }}" type="text"
                                           class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Business PAN</label>
                                <div class="col-sm-10">
                                    <input name="business_pan" value="{{ $agent->business_pan }}" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Business Name</label>
                                <div class="col-sm-10">
                                    <input name="business_name" value="{{ $agent->business_name }}" type="text"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Parent Agent</label>
                                <div class="col-sm-10">
                                    <select id="agentStatus" data-placeholder="Choose Agent Type..." class="chosen-select"  tabindex="2" name="code_used_id" required>
                                        <option value="" disabled>Select Parent Agent</option>
                                        <option value="" selected>--- No parent Agent ---</option>
                                    @foreach($parentAgents as $parentAgent)
                                            @if($parentAgent->user->id == $agent->code_used_id)
                                                <option value="{{ $parentAgent->user->id }}" selected>
                                                    {{ ucwords(strtolower($parentAgent->user->name)) }}
                                                </option>
                                            @else
                                                <option value="{{ $parentAgent->user->id }}">
                                                    {{ ucwords(strtolower($parentAgent->user->name)) }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Agent Type</label>
                                <div class="col-sm-10">
                                    <select id="agentStatus" data-placeholder="Choose Agent Type..."
                                            class="chosen-select" tabindex="2" name="agent_type_id" required>
                                        <option value="" selected disabled>Agent Type</option>
                                        @foreach($agentTypes as $type)
                                            <option
                                                value="{{ $type->id }}"{{ $type->id == $agent->agent_type_id ? "selected" : "" }}>
                                                {{ ucwords(strtolower($type->name)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Agent Status</label>
                                <div class="col-sm-10">
                                    <select id="agentStatus" data-placeholder="Choose Status..." class="chosen-select"
                                            tabindex="2" name="status" required>
                                        <option value="" selected disabled>Status.</option>
                                        <option
                                            value="{{ \App\Models\Agent::STATUS_ACCEPTED }}"
                                            {{ \App\Models\Agent::STATUS_ACCEPTED == $agent->status ? "selected" : "" }}
                                        >
                                            {{ \App\Models\Agent::STATUS_ACCEPTED }}
                                        </option>

                                        <option
                                            value="{{ \App\Models\Agent::STATUS_REJECTED }}"
                                            {{ \App\Models\Agent::STATUS_REJECTED == $agent->status ? "selected" : "" }}
                                        >
                                            {{ \App\Models\Agent::STATUS_REJECTED }}
                                        </option>

                                        <option
                                            value="{{ \App\Models\Agent::STATUS_PROCESSING }}"
                                            {{ \App\Models\Agent::STATUS_PROCESSING == $agent->status ? "selected" : "" }}
                                        >
                                            {{ \App\Models\Agent::STATUS_PROCESSING }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Institution Type</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Choose Mobile No..." class="chosen-select" tabindex="2"
                                            name="institution_type" required>
                                        <option value="" selected disabled>Institution Type</option>
                                        <option value="{{ \App\Models\Agent::INSTITUTION_TYPE_COMPANY }}"
                                            {{ \App\Models\Agent::INSTITUTION_TYPE_COMPANY == $agent->institution_type ? "selected" : "" }}
                                        >{{ \App\Models\Agent::INSTITUTION_TYPE_COMPANY }}</option>
                                        <option value="{{ \App\Models\Agent::INSTITUTION_TYPE_INDIVIDUAL }}"
                                            {{ \App\Models\Agent::INSTITUTION_TYPE_INDIVIDUAL == $agent->institution_type ? "selected" : "" }}
                                        >{{ \App\Models\Agent::INSTITUTION_TYPE_INDIVIDUAL }}</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Business owner citizenship front</label>
                                <div class="col-sm-8">
                                    <input name="business_owner_citizenship_front"  type="file" class="custom-file-input">
                                    <label for="business_owner_citizenship_front" class="custom-file-label">Upload Citizenship Front Document...</label>
                                </div>
                                <div class="col-sm-2">
                                    @if(isset($agent->business_owner_citizenship_front))
                                        <a href="{{ config('dpaisa-api-url.agent_url') . $agent->business_owner_citizenship_front}}"
                                           target="_blank">
                                            <img class="d-block w-100"
                                                 src="{{ config('dpaisa-api-url.agent_url') . $agent->business_owner_citizenship_front}}"
                                                 alt="Business owner citizenship front"
                                                 style="max-width: 50px;object-fit: cover">
                                        </a>
                                    @else
                                        <p>Photo Unavailable</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Business owner citizenship back</label>
                                <div class="col-sm-8">
                                    <input name="business_owner_citizenship_back"  type="file" class="custom-file-input">
                                    <label for="business_owner_citizenship_back" class="custom-file-label">Upload Citizenship Back Document...</label>
                                </div>
                                <div class="col-sm-2">
                                    @if(isset($agent->business_owner_citizenship_back))
                                        <a href="{{ config('dpaisa-api-url.agent_url') . $agent->business_owner_citizenship_back}}"
                                           target="_blank">
                                            <img class="d-block w-100"
                                                 src="{{ config('dpaisa-api-url.agent_url') . $agent->business_owner_citizenship_back}}"
                                                 alt="Business owner citizenship back"
                                                 style="max-width: 50px;object-fit: cover">
                                        </a>
                                    @else
                                        <p>Photo Unavailable</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Passport Size Photo</label>
                                <div class="col-sm-8">
                                    <input name="pp_photo"  type="file" class="custom-file-input">
                                    <label for="pp_photo" class="custom-file-label">Upload Passport Size Photo...</label>
                                </div>
                                <div class="col-sm-2">
                                    @if(isset($agent->pp_photo))
                                        <a href="{{ config('dpaisa-api-url.agent_url') . $agent->pp_photo}}"
                                           target="_blank">
                                            <img class="d-block w-100"
                                                 src="{{ config('dpaisa-api-url.agent_url') . $agent->pp_photo}}"
                                                 alt="Passport Size Photo"
                                                 style="max-width: 50px;object-fit: cover">
                                        </a>
                                    @else
                                        <p>Photo Unavailable</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tax Clearance Certificate</label>
                                <div class="col-sm-8">
                                    <input name="tax_clearance_certificate"  type="file" class="custom-file-input">
                                    <label for="tax_clearance_certificate" class="custom-file-label">Upload tax clearance document Photo...</label>
                                </div>
                                <div class="col-sm-2">
                                    @if(isset($agent->tax_clearance_certificate))
                                        <a href="{{ config('dpaisa-api-url.agent_url') . $agent->tax_clearance_certificate}}"
                                           target="_blank">
                                            <img class="d-block w-100"
                                                 src="{{ config('dpaisa-api-url.agent_url') . $agent->tax_clearance_certificate}}"
                                                 alt="Company Tax Clearance Certificate"
                                                 style="max-width: 50px;object-fit: cover">
                                        </a>
                                    @else
                                        <p>Photo Unavailable</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Pan/Vat Document</label>
                                <div class="col-sm-8">
                                    <input name="pan_vat_document"  type="file" class="custom-file-input">
                                    <label for="pan_vat_document" class="custom-file-label">Upload Pan/Vat Document Photo...</label>
                                </div>
                                <div class="col-sm-2">
                                    @if(isset($agent->pan_vat_document))
                                        <a href="{{ config('dpaisa-api-url.agent_url') . $agent->pan_vat_document}}"
                                           target="_blank">
                                            <img class="d-block w-100"
                                                 src="{{ config('dpaisa-api-url.agent_url') . $agent->pan_vat_document}}"
                                                 alt="Pan/Vat document"
                                                 style="max-width: 50px;object-fit: cover">
                                        </a>
                                    @else
                                        <p>Photo Unavailable</p>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash Out Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="cash_out_type">
                                        <option value="FLAT" @if($agent->cash_out_type == 'FLAT') selected @endif>Flat</option>
                                        <option value="PERCENTAGE" @if($agent->cash_out_type == 'PERCENTAGE') selected @endif>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash Out Value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $agent->cash_out_value }}" name="cash_out_value" type="text" class="form-control">
                                    <small>*If FLAT value should be in paisa</small>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash In Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="cash_in_type">
                                        <option value="FLAT" @if($agent->cash_in_type == 'FLAT') selected @endif>Flat</option>
                                        <option value="PERCENTAGE" @if($agent->cash_in_type == 'PERCENTAGE') selected @endif>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash In Value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $agent->cash_in_value }}" name="cash_in_value" type="text" class="form-control">
                                    <small>*If FLAT value should be in paisa</small>
                                </div>
                            </div>--}}


                            <div id="reasonDiv" class="form-group row" style="display: none">
                                <label class="col-sm-2 col-form-label">Rejection Reason</label>
                                <div class="col-sm-10">
                                    <textarea id="reason" name="reason" style="width: 100%" rows="7">Your agent request has been rejected.</textarea>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <a href="{{ config('dpaisa-api-url.agent_url') . $agent->pan_vat_document}}"
                                       target="_blank">
                                        <img class="d-block w-100"
                                             src="{{ config('dpaisa-api-url.agent_url') . $agent->pan_vat_document}}"
                                             alt="Pan/Vat document"
                                             style="max-width: 400px;object-fit: cover">
                                        <b>Pan Vat Document</b>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="{{ config('dpaisa-api-url.agent_url') . $agent->tax_clearance_certificate}}"
                                       target="_blank">
                                        <img class="d-block w-100"
                                             src="{{ config('dpaisa-api-url.agent_url') . $agent->tax_clearance_certificate}}"
                                             alt="Company Tax Clearance Certificate"
                                             style="max-width: 400px;object-fit: cover">
                                        <b>Tax Clearance Document</b>
                                    </a>
                                </div>
                                <div class="col-sm-4">
                                    <a href="{{ config('dpaisa-api-url.agent_url') . $agent->pp_photo}}"
                                       target="_blank">
                                        <img class="d-block w-100"
                                             src="{{ config('dpaisa-api-url.agent_url') . $agent->pp_photo}}"
                                             alt="Passport Size Photo"
                                             style="max-width: 400px;object-fit: cover">
                                        <b>Passport size Photo</b>
                                    </a>
                                </div>
                            </div>
                            <div class="row" style="padding-top: 20px">
                                <div class="col-sm-6">
                                    <a href="{{ config('dpaisa-api-url.agent_url') . $agent->business_owner_citizenship_front}}"
                                       target="_blank">
                                        <img class="d-block w-100"
                                             src="{{ config('dpaisa-api-url.agent_url') . $agent->business_owner_citizenship_front}}"
                                             alt="Business owner citizenship front"
                                             style="max-width: 500px;object-fit: cover">
                                        <b>Document Front</b>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{ config('dpaisa-api-url.agent_url') . $agent->business_owner_citizenship_back}}"
                                       target="_blank">
                                        <img class="d-block w-100"
                                             src="{{ config('dpaisa-api-url.agent_url') . $agent->business_owner_citizenship_back}}"
                                             alt="Business owner citizenship back"
                                             style="max-width: 500px;object-fit: cover">
                                        <b>Document Back</b>
                                    </a>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Edit Agent</strong>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('styles')
    <link href="{{ asset('admin/css/plugins/summernote/summernote-bs4.css') }}" rel="stylesheet">

    <style>
        .note-editing-area {
            height: 150px;
        }
    </style>

    @include('admin.asset.css.chosen')

    <!-- Sweet Alert -->
    <link href="{{ asset('admin/css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

@endsection

@section('scripts')
    @include('admin.asset.js.chosen')


    <!-- Sweet alert -->
    <script src="{{ asset('admin/js/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $('#handle').on('click', function (e) {

            e.preventDefault();

            swal({
                title: "Are you sure?",
                text: "This user will be set as an Agent",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#18a689",
                confirmButtonText: "Yes, approve",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#handleBtn').trigger('click');
                swal.close();
            })
        });
    </script>

    <script>
        $('#agentStatus').on('change', function (e) {
            let status = $("#agentStatus option:selected").val();
            let reason = $('#reasonDiv');

            if (status === 'REJECTED') {
                reason.show()
                $('#reason').prop('required', true)
                return;
            }
            $('#reason').prop('required', false)
            reason.hide()
        })
    </script>

    <script>
        $('.custom-file-input').on('change', function () {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>



@endsection

