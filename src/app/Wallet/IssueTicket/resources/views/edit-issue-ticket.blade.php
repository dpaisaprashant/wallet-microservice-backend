@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Block an IP</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="{{ route('issue.ticket.view') }}">Issue Tickets</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Edit</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Edit Issue Ticket</h5>
                    </div>
                    <div class="ibox-content">
                        <form method="post" action="{{ route('issue.ticket.update',$ticket->id) }}"  enctype="multipart/form-data" id="issueTicketForm">
                            @csrf
                            @method('PUT')
                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Issue Reported By</label>
                                <div class="col-sm-10">
                                    <select class="form-control chosen-select" name="user_id">
                                        @if(!empty($users))
                                            @foreach($users as $user)
                                                @if(!empty($user->id))
                                                    <option value="{{$user->id}}" @if($user->id == $ticket->user_id) selected @endif>
                                                        Name : {{$user->name}} | Mobile Number : {{$user->mobile_no}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option>No Users Found.</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Issue Description</label>
                                <div class="col-sm-10">
                                    <textarea name="issue_description" class="form-control">{{$ticket->issue_description}}</textarea>
                                </div>
                            </div>

                            <input name="issued_by" type="hidden" class="form-control" value="{{$ticket->issued_by}}">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select data-placeholder="Select Status..." class="chosen-select" tabindex="2" name="status" required>
                                        <option @if($ticket->status == 'PENDING')  selected @endif>PENDING</option>
                                        <option @if($ticket->status == 'SOLVED') selected @endif>SOLVED</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group  row">
                                <label class="col-sm-2 col-form-label">Solution Description</label>
                                <div class="col-sm-10">
                                    <textarea name="solution_description" class="form-control">{{$ticket->solution_description}}</textarea>
                                </div>
                            </div>

                            <input name="solved_by" type="hidden" class="form-control" value="{{$ticket->solved_by}}">
                            <input name="solved_at" type="hidden" class="form-control" value="{{$ticket->solved_at}}">

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Update</button>
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
    <script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} entries";
            $('.dataTables_info').text(a);
        });
        @endif
    </script>

    <!-- IonRangeSlider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
    <script>
        let amount = @if(!empty($_GET['amount'])) `{{ $_GET['amount'] }}`;
        @else '0;100000'; @endif
        let split = amount.split(';');
        $(".ionrange_amount").ionRangeSlider({
            type: "double",
            grid: true,
            min: 0,
            max: 100000,
            from: split[0],
            to: split[1],
            prefix: "Rs."
        });
    </script>

    <script>
        $('#excel').submit(function (e) {
            e.preventDefault();
            let url = $(this).attr('action').val();
        });
    </script>

@endsection
