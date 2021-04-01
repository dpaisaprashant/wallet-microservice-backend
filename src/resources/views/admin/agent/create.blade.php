@extends('admin.layouts.admin_design')
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create Agent</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Agent</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create Agent</strong>
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
                        <form method="post" action="{{ route('agent.create') }}" enctype="multipart/form-data" id="transactionIdForm">
                            @csrf
                            <div class="form-group  row"><label class="col-sm-2 col-form-label">Mobile No.</label>
                                <div class="col-sm-10">
                                    <select id="selectTransaction" data-placeholder="Choose Mobile No..." class="chosen-select"  tabindex="2" name="user_id" required>
                                        <option value="" selected disabled>Mobile No.</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" >{{ $user->name . ' - ' . $user->mobile_no }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Business PAN</label>
                                <div class="col-sm-10">
                                    <input name="business_pan" type="text" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Business Name</label>
                                <div class="col-sm-10">
                                    <input name="business_name" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Agent Type</label>
                                <div class="col-sm-10">
                                    <select id="agentStatus" data-placeholder="Choose Agent Type..." class="chosen-select"  tabindex="2" name="agent_type_id" required>
                                        <option value="" selected disabled>Select Agent Type</option>
                                        @foreach($agentTypes as $type)
                                            <option value="{{ $type->id }}">
                                                {{ ucwords(strtolower($type->name)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <button class="btn btn-sm btn-primary m-t-n-xs" type="submit"><strong>Create Agent</strong></button>
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
    <!-- SUMMERNOTE -->
    <script src="{{ asset('admin/js/plugins/summernote/summernote-bs4.js') }}"></script>

    <script>
        $(document).ready(function(){

            $('.summernote').summernote();

        });
    </script>

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
                confirmButtonColor: "#1E78A2",
                confirmButtonText: "Yes, approve",
                closeOnConfirm: true,
                closeOnClickOutside: true
            }, function () {
                $('#handleBtn').trigger('click');
                swal.close();
            })
        });
    </script>



@endsection

