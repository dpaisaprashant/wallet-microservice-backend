@extends('admin.layouts.admin_design')
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Customer Service Ticketing System</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Issue Tickets</strong>
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
                    <div class="ibox-title collapse-link">
                        <h5>Filter Data of Issue Tickets</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('issue.ticket.view') }}"
                                      id="filter">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="user_name" placeholder="Issue Reported By (User)"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['user_name']) ? $_GET['user_name'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="phone_number" placeholder="Phone Number (User)"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['phone_number']) ? $_GET['phone_number'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="issued_by"
                                                       placeholder="Ticket Created By (Admin)"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['issued_by']) ? $_GET['issued_by'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 20px">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="solved_by"
                                                       placeholder="Ticket Solved By (Admin)"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['solved_by']) ? $_GET['solved_by'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" name="issue_description"
                                                       placeholder="Issue Description"
                                                       class="form-control"
                                                       value="{{ !empty($_GET['issue_description']) ? $_GET['issue_description'] : '' }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select data-placeholder="Select Status...." class="chosen-select"
                                                        tabindex="2" name="status">
                                                    <option value="" selected disabled>Select Status...</option>
                                                    @if(!empty($_GET['status']))
                                                        @foreach($status as $stat)
                                                            <option value="{{$stat}}"
                                                                    @if($_GET['status']  == $stat) selected @endif >{{$stat}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($status as $stat)
                                                            <option value="{{$stat}}">{{$stat}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row" style="margin-top: 20px">



                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                <input id="date_from" type="text" class="form-control date_from"
                                                       placeholder="From Created At" name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group date">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                <input id="date_to" type="text" class="form-control date_to"
                                                       placeholder="To Created At" name="to" autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('issue.ticket.view') }}">
                                            <strong>Filter</strong>
                                        </button>
                                    </div>

                                    {{--                                            <div>--}}
                                    {{--                                                <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs"--}}
                                    {{--                                                        type="submit" style="margin-right: 10px;"--}}
                                    {{--                                                        formaction="{{ route('npsaccountlinkload.excel') }}">--}}
                                    {{--                                                    <strong>Excel</strong></button>--}}
                                    {{--                                            </div>--}}
                                    @include('admin.asset.components.clearFilterButton')
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!empty($_GET))
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List of all Issue Tickets</h5>
                            @can('Create issue ticket')
                                <a href="{{ route('issue.ticket.create')}}" class="btn btn-success btn-sm m-t-n-xs"
                                   style="float: right;margin-right:-55px;margin-top:-5px"><i class="fa fa-plus"> &nbsp;Add Ticket</i></a>
                            @endcan
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Complete Requests List">
                                    <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Issue Reported By (User)</th>
                                        <th>Phone Number (User)</th>
                                        <th>Ticket Created By (Admin)</th>
                                        <th style="width: 350px">Issue Description</th>
                                        <th>Status</th>
                                        <th>Solved By</th>
                                        <th style="width: 350px">Solution Description</th>
                                        <th>Created At</th>
                                        <th>Solved At</th>
                                        <th style='width: 50px'>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($issueTickets as $ticket)

                                        <tr class="gradeC">
                                            <td>{{ $loop->index + ($issueTickets->perPage() * ($issueTickets->currentPage() - 1)) + 1 }}</td>
                                            <td>{{ optional($ticket->user)->name }}</td>
                                            <td>{{ optional($ticket->user)->mobile_no }}</td>
                                            <td>{{ $ticket->adminCreator->name }}</td>
                                            <td>{{ \Illuminate\Support\Str::limit($ticket->issue_description, 150, $end='...') }}</td>
                                            <td>
                                                <span
                                                    class="badge {{$ticket->status=="SOLVED" ? "badge-primary" : "badge-danger"}}">{{ $ticket->status }}</span>
                                            </td>
                                            <td>{{ optional($ticket->adminSolver)->name }}</td>
                                            <td>{{  \Illuminate\Support\Str::limit($ticket->solution_description, 150, $end='...') }}</td>
                                            <td>{{ $ticket->created_at }}</td>
                                            <td>{{ $ticket->solved_at }}</td>
                                            <td>
                                                <form action="{{ route('issue.ticket.delete',$ticket->id) }}"
                                                      method="POST">
                                                    @csrf
                                                    @can('Delete issue ticket')
                                                        <button
                                                            class="reset btn btn-sm btn-danger m-t-n-xs"
                                                            rel="{{ $ticket->id }}"><i
                                                                class="fa fa-trash"></i>
                                                        </button>

                                                        <button id="resetBtn-{{ $ticket->id }}"
                                                                style="display: none" type="submit"
                                                                href="{{ route('issue.ticket.delete',$ticket->id) }}"
                                                                class="resetBtn btn btn-sm btn-danger m-t-n-xs">
                                                            <i class="fa fa-trash"></i></button>
                                                    @endcan
                                                    @can('Edit issue ticket')
                                                        <a href="{{ route('issue.ticket.edit',$ticket->id)}}"
                                                           class="btn btn-success btn-sm m-t-n-xs"><i
                                                                class="fa fa-edit"></i></a>
                                                    @endcan
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {{ $issueTickets->appends(request()->query())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('styles')
    @include('admin.asset.css.chosen')
    @include('admin.asset.css.datepicker')
    @include('admin.asset.css.datatable')
    @include('admin.asset.css.sweetalert')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
@endsection

@section('scripts')
    @include('admin.asset.js.chosen')
    @include('admin.asset.js.datepicker')
    @include('admin.asset.js.datatable')
    @include('admin.asset.js.sweetalert')
    <script>
        $('.reset').on('click', function (e) {
            e.preventDefault();
            let ticket_id = $(this).attr('rel');
            swal({
                title: "Are you sure?",
                text: "Ticket will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: false
            }, function () {
                $('#resetBtn-' + ticket_id).trigger('click');
                swal.close();

            })
        });
    </script>
    <script>
        @if(!empty($_GET))
        $(document).ready(function (e) {
            let a = "Showing {{ $issueTickets->firstItem() }} to {{ $issueTickets->lastItem() }} of {{ $issueTickets->total() }} entries";
            $('.dataTables_info').text(a);
        });
        @endif
    </script>
@endsection


