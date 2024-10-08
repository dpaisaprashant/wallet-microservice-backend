@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Update Agent Type</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent Type</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Update Agent Type</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Update Agent Type</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="col-md-12">
                            @include('admin.asset.notification.notify')
                        </div>
                        <form method="post" action="{{ route('agent.type.update', $agentType) }}" enctype="multipart/form-data" id="transactionIdForm">
                            @csrf

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Agent Type</label>
                                <div class="col-sm-10">
                                    <input value="{{ $agentType->name }}" name="name" type="text" class="form-control" disabled>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Parent Agent</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="agent_type_id">
                                        <option value="" selected>Main Agent</option>
                                        @foreach($parentAgents as $agent)
                                            <option value="{{ $agent->id }}" {{ $agent->id == $agentType->agent_type_id ? "selected" : "" }}>{{ $agent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            {{--<div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash Out Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="default_cash_out_type">
                                        <option value="FLAT" @if($agentType->default_cash_out_type == 'FLAT') selected @endif>Flat</option>
                                        <option value="PERCENTAGE" @if($agentType->default_cash_out_type == 'PERCENTAGE') selected @endif>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash Out Value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $agentType->default_cash_out_value }}" name="default_cash_out_value" type="text" class="form-control">
                                    <small>*If FLAT value should be in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash In Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="default_cash_in_type">
                                        <option value="FLAT" @if($agentType->default_cash_in_type == 'FLAT') selected @endif>Flat</option>
                                        <option value="PERCENTAGE" @if($agentType->default_cash_in_type == 'PERCENTAGE') selected @endif>Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash In Value</label>
                                <div class="col-sm-10">
                                    <input value="{{ $agentType->default_cash_in_value }}" name="default_cash_in_value" type="text" class="form-control">
                                    <small>*If FLAT value should be in paisa</small>
                                </div>
                            </div>--}}

                            <div class="hr-line-dashed"></div>
                            <small>NOTE: If the parent agent is changed the cashback and the limits will stay the same for this agent type. Cashback and Limit should be changed separately</small>
                            <br>
                            <br>
                            <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Update Agent Type</strong></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
