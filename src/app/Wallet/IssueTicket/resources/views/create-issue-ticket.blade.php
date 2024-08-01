@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Create a Ticket</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('issue.ticket.view') }}">Issue Tickets</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Create</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Create a Ticket</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('issue.ticket.create') }}" enctype="multipart/form-data"
                              id="issueTicketForm">
                            @csrf
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Issue Reported By</label>
                                <div class="col-sm-10">
                                    <select class="form-control chosen-select" name="user_id" required>
                                        @if(!empty($users))
                                            <option value="" disabled selected>Select User</option>
                                            @foreach($users as $user)
                                                @if(!empty($user->id))
                                                    <option value="{{$user->id}}">
                                                        Name : {{$user->name}} | Mobile Number
                                                        : {{$user->mobile_no}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="">No Users Found.</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Issue Description</label>
                                <div class="col-sm-10">
                                    <textarea name="issue_description" class="form-control"></textarea>
                                </div>
                            </div>
                            <input name="issued_by" type="hidden" class="form-control" value="{{auth()->user()->id}}">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Select Status..." class="chosen-select" tabindex="2"
                                            name="status" required>
                                        <option>PENDING</option>
                                        <option>SOLVED</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Solution Description</label>
                                <div class="col-sm-10">
                                    <textarea name="solution_description" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Create</button>
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
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')

    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')


    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
@endsection
