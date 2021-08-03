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
                        <form method="post" action="{{ route('agent.edit', $agent->id) }}" enctype="multipart/form-data" id="agentForm">
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Mobile No.</label>
                                <div class="col-sm-10">
                                    <input name="mobile_no" value="{{ $agent->user->mobile_no }}" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Business PAN</label>
                                <div class="col-sm-10">
                                    <input name="business_pan" value="{{ $agent->business_pan }}" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Business Name</label>
                                <div class="col-sm-10">
                                    <input name="business_name" value="{{ $agent->business_name }}" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Agent Type</label>
                                <div class="col-sm-10">
                                    <select id="agentStatus" data-placeholder="Choose Agent Type..." class="chosen-select"  tabindex="2" name="agent_type_id" required>
                                        <option value="" selected disabled>Agent Type</option>
                                        @foreach($agentTypes as $type)
                                        <option value="{{ $type->id }}"{{ $type->id == $agent->agent_type_id ? "selected" : "" }}>
                                            {{ ucwords(strtolower($type->name)) }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Agent Status</label>
                                <div class="col-sm-10">
                                    <select id="agentStatus" data-placeholder="Choose Status..." class="chosen-select"  tabindex="2" name="status" required>
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
                                    <select data-placeholder="Choose Mobile No..." class="chosen-select"  tabindex="2" name="institution_type" required>
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
                                <div class="col-sm-10">
                                    <a href="{{ config('dpaisa-api-url.admin_documentation_url') . $agent->business_owner_citizenship_front}}" target="_blank">
                                        <img class="d-block w-100" src="{{ config('dpaisa-api-url.kyc_documentation_url') . $agent->business_owner_citizenship_front}}" alt="Business owner citizenship front">
                                    </a>

                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Business owner citizenship back</label>
                                <div class="col-sm-10">
                                    <a href="{{ config('dpaisa-api-url.admin_documentation_url') . $agent->business_owner_citizenship_back}}" target="_blank">
                                        <img class="d-block w-100" src="{{ config('dpaisa-api-url.kyc_documentation_url') . $agent->business_owner_citizenship_back}}" alt="Business owner citizenship back">
                                    </a>

                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">PP photo</label>
                                <div class="col-sm-10">
                                    <a href="{{ config('dpaisa-api-url.admin_documentation_url') . $agent->pp_photo}}" target="_blank">
                                        <img class="d-block w-100" src="{{ config('dpaisa-api-url.kyc_documentation_url') . $agent->pp_photo}}" alt="PP Photo">
                                    </a>

                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Tax clearance certificate</label>
                                <div class="col-sm-10">
                                    <a href="{{ config('dpaisa-api-url.admin_documentation_url') . $agent->tax_clearance_certificate}}" target="_blank">
                                        <img class="d-block w-100" src="{{ config('dpaisa-api-url.kyc_documentation_url') . $agent->tax_clearance_certificate}}" alt="Tax clearance certificate">
                                    </a>

                                </div>
                            </div>

                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Pan vat document</label>
                                <div class="col-sm-10">
                                    <a href="{{ config('dpaisa-api-url.admin_documentation_url') . $agent->pan_vat_document}}" target="_blank">
                                        <img class="d-block w-100" src="{{ config('dpaisa-api-url.kyc_documentation_url') . $agent->pan_vat_document}}" alt="Pan vat document">
                                    </a>

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
                            <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Edit Agent</strong></button>
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
        .note-editing-area{
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
                confirmButtonColor: "#3366ff",
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
            let status = $("#agentStatus option:selected" ).val();
            let reason = $('#reasonDiv');

            if (status === 'REJECTED') {
                reason.show()
                $('#reason').prop('required', true)
                return ;
            }
            $('#reason').prop('required', false)
            reason.hide()
        })
    </script>



@endsection

