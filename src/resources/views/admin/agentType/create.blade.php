@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Agent Type</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent Type</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Agent Type</strong>
                </li>
            </ol>
        </div>

    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Create Agent Type</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="col-md-12">
                            @include('admin.asset.notification.notify')
                        </div>
                        <form method="post" action="{{ route('agent.type.create') }}" enctype="multipart/form-data" id="transactionIdForm">
                            @csrf

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Agent Type</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Parent Agent</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="agent_type_id">
                                        <option value="" selected>Main Agent</option>
                                        @foreach($parentAgents as $agent)
                                            <option value="{{ $agent->id }}">{{ $agent->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash Out Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="default_cash_out_type">
                                        <option value="FLAT">Flat</option>
                                        <option value="PERCENTAGE">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash Out Value</label>
                                <div class="col-sm-10">
                                    <input name="default_cash_out_value" type="text" class="form-control">
                                    <small>*If FLAT value should be in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash In Type</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="default_cash_in_type">
                                        <option value="FLAT">Flat</option>
                                        <option value="PERCENTAGE">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Default Cash In Value</label>
                                <div class="col-sm-10">
                                    <input name="default_cash_in_value" type="text" class="form-control">
                                    <small>*If FLAT value should be in paisa</small>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>


                            <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Create Agent Type</strong></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
