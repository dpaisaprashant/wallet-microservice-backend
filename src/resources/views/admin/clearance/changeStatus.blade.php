@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{ date('d M, Y', strtotime($clearance->transaction_date)) }} transactions' clearance status</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Clearance</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Status</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>{{ date('d M, Y', strtotime($clearance->transaction_date)) }} transactions' clearance status</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <form method="post" enctype="multipart/form-data" action="{{ route('clearance.changeStatus', $clearance->id) }}">
                            @csrf

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Signed image</label>

                                <div class="col-sm-10">
                                    @if(empty($clearance->image))
                                        <div class="custom-file">
                                            <input name="image" id="logo1" type="file" class="custom-file-input">
                                            <label for="image" class="custom-file-label">Choose file...</label>
                                        </div>
                                    @else
                                        <div class="custom-file">
                                            <input name="image" id="logo1" type="file" class="custom-file-input">
                                            <label for="image" class="custom-file-label">Choose file...</label>

                                        </div>

                                        <div class="row" style="margin-top: 20px;">
                                            <div class="col-md-4">
                                                <img class="d-block" src="{{ asset('storage/uploads/clearance/'. $clearance->image) }}" alt="" style="height: 400px">

                                            </div>
                                        </div>





                                    @endif
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Clearance status</label>

                                <div class="col-sm-10">
                                    <select data-placeholder="Choose clearance status..." class="chosen-select"  tabindex="2" name="status">
                                        <option value="" selected disabled>Select Status...</option>
                                        <option value="0" @if($clearance->status == \App\Models\Clearance::STATUS_CLEARED) selected @endif>CLEARED</option>
                                        <option value="1" @if($clearance->status == \App\Models\Clearance::STATUS_SIGNED) selected @endif>SIGNED</option>
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Update status</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@section('styles')

    <link href="{{ asset('admin/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">

    <style>
        .chosen-container-single .chosen-single{
            height: 35px !important;
            border-radius: 0px;
        }

        .chosen-container-single .chosen-single span{
            margin-top: 5px;
            margin-left: 5px;
        }

    </style>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">

@endsection

@section('scripts')

    <!-- Chosen -->
    <script src="{{ asset('admin/js/plugins/chosen/chosen.jquery.js') }}"></script>

    <script>
        $('.chosen-select').chosen({width: "100%"});
    </script>


    <script>
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>

@endsection


