@extends('admin.layouts.admin_design')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Campaign Voter Report</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Home</a>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Report</strong>
                </li>

                <li class="breadcrumb-item active">
                    <strong>Campaign Voters Report</strong>
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
                        <h5>Filter Transactions</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>

                    {{--                    <div class="ibox-content" @if( empty($_GET) || (!empty($_GET['page']) && count($_GET) === 1)  ) style="display: none"  @endif>--}}
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="get" action="{{ route('report.voting') }}"
                                      id="filter">
                                    <br>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Select Campaign<sup>*</sup></label>
                                        <div class="col-4" style="text-align: center !important;">
                                            <select class="chosen-select" tabindex="2"
                                                    name="event_code" required>
                                                <option value="" selected disabled>-- Select Campaign --</option>

                                                @foreach($events as $event)
                                                    <option value="{{ $event->event_code }}"
                                                            @if(!empty($_GET['event_code']) && $_GET['event_code'] == $event->event_code) selected @endif> {{ $event->name }}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Participant</label>
                                        <div class="col-4" style="text-align: center !important;">
                                            <input type="text" name="participant_name"
                                                   placeholder="Participant Name" class="form-control"
                                                   value="{{ !empty($_GET['participant_name']) ? $_GET['participant_name'] : '' }}">
                                        </div>

                                        <div class="col-4" style="text-align: center !important;">
                                            <input type="number" name="participant_mobile_no"
                                                   placeholder="Participant Mobile Number" class="form-control"
                                                   value="{{ !empty($_GET['participant_mobile_no']) ? $_GET['participant_mobile_no'] : '' }}">
                                        </div>
                                    </div>
                                <br>
                                    <div class="row">
                                        <label class="col-sm-2 col-form-label">Select Voted At Date</label>
                                        <div class="col-4">
                                            <div class="input-group date">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="date_load_from" type="text"
                                                       class="form-control date_from" placeholder="From"
                                                       name="from" autocomplete="off"
                                                       value="{{ !empty($_GET['from']) ? $_GET['from'] : '' }}"
                                                >
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-4">
                                            <div class="input-group date">
                                                 <span class="input-group-addon">
                                                     <i class="fa fa-calendar"></i>
                                                 </span>
                                                <input id="date_load_to" type="text"
                                                       class="form-control date_to" placeholder="To" name="to"
                                                       autocomplete="off"
                                                       value="{{ !empty($_GET['to']) ? $_GET['to'] : '' }}">
                                            </div>
                                        </div>

                                    </div>

                                    <div>
                                        <button class="btn btn-sm btn-primary float-right m-t-n-xs" type="submit"
                                                formaction="{{ route('report.voter') }}">
                                            <strong>Generate Report</strong>
                                        </button>
                                    </div>

                                    <button id="excelBtn" class="btn btn-sm btn-warning float-right m-t-n-xs" type="submit" style="margin-right: 10px;" formaction="{{ route('swipe-voting.voter.excel') }}"><strong>Excel</strong></button>

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
                @include('admin.asset.notification.notify')
                <div class="col-lg-12">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5>List Generated for Campaign Voters Report</h5>
                        </div>

                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example"
                                       title="Campaign Participants Report">
                                    <thead>
                                    <tr>
                                        <th>S.N.</th>
                                        <th>Participant Name</th>
                                        <th>Participant Mobile</th>
                                        <th>Voter Name</th>
                                        <th>Voter Mobile</th>
                                        <th>Participant Registered Date</th>
                                        <th>Voter Registered Date</th>
                                        <th>Voted At</th>
                                        <th>Event Code</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($votes as $vote)
                                        <tr>
                                            <td>{{$loop->index+1}}</td>
                                            <td>
                                                <a href="{{route('user.profile', $vote->participant->user->id)}}" target="_blank">
                                                {{$vote->participant->name}}
                                                </a>
                                            </td>
                                            <td>{{$vote->participant->mobile_no}}</td>
                                            <td>
                                                <a href="{{route('user.profile', $vote->user->id)}}" target="_blank">
                                                {{$vote->user->name}}
                                                </a>
                                            </td>
                                            <td>{{$vote->user->mobile_no}}</td>
                                            <td>{{$vote->participant->created_at}}</td>
                                            <td>{{$vote->user->phone_verified_at}}</td>
                                            <td>{{$vote->created_at}}</td>
                                            <td>{{$vote->participant->event_code}}</td>
                                        </tr>
                                    @endforeach

                                    </tbody>

                                </table>
                                {{ $votes->appends(request()->query())->links() }}
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
        // if (typeof participants == 'undefined')
        $(document).ready(function (e) {
            let a = "Showing @if(isset($votes)) {{ $votes->firstItem() }} to {{ $votes->lastItem() }} of {{ $votes->total() }} @endif entries";
            $('.dataTables_info').text(a);
        });
    </script>

@endsection


